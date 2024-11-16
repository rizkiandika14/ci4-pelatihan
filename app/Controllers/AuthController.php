<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\TokenModel;
use App\Models\UserModel;
use CodeIgniter\HTTP\ResponseInterface;
use Exception;

class AuthController extends BaseController
{
    protected $session;
    function __construct()
    {
        $this->session = session();
    }

    public function index()
    {
        $data = [
            'title' => 'Login',
        ];
        return view('auth/login', $data);
    }

    public function cekLogin()
    {
        $email = htmlspecialchars($this->request->getPost('email'));
        $password = htmlspecialchars($this->request->getPost('password'));

        $validation = \Config\Services::validation();

        $rules = [
            'email' => [
                'label' => 'Email',
                'rules' => 'required|valid_email',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                    'valid_email' => '{field} tidak valid'
                ]
            ],
            'password' => [
                'label' => 'Password',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ]
        ];

        if (!$this->validate($rules)) {
            $sessError = [
                'errEmail' => $validation->getError('email'),
                'errPassword' => $validation->getError('password')
            ];
            $this->session->setFlashdata($sessError);
            return redirect()->to('/login');
        }

        $userModel = new \App\Models\UserModel();

        $user = $userModel->where('email', $email)->first();

        if ($user) {
            if (password_verify($password, $user['password'])) {
                // membuat otp
                $otp = random_string('numeric', 6);
                $cek = $this->generateOtp($otp, $user['id']);

                if ($cek === false) {
                    $this->session->setFlashdata('error', 'Ada yang salah, Otp gagal dibuat!');
                    redirect('/login');
                }
                // send otp to email
                $mailContext = array(
                    'fullname' => $user['name'],
                    'otp' => $otp,
                    'directurl' => $cek['url'],
                );

                if ($this->sendOtp($user['email'], $mailContext)) {
                    // create session for otp auth
                    $sessOtp = [
                        'user_id' => $user['id'],
                        'sessid' => $cek['id'],
                        'email' => substr($user['email'], 0, 1) . '******@' . explode('@', $user['email'])[1],
                        'sessotp' => true
                    ];
                    $this->session->set($sessOtp);

                    $this->session->setFlashdata('success', 'OTP telah dikirim ke email anda \n Silahkan cek email anda di folder kotak masuk atau spam');
                    return redirect()->to('/otp');
                } else {
                    $this->session->setFlashdata('error', 'Ada yang salah, Otp gagal dikirim!');
                    return redirect()->to('/login');
                }
            } else {
                $this->session->setFlashdata('error', 'Email atau Password salah');
                return redirect()->to('/login');
            }
        } else {
            $this->session->setFlashdata('error', 'Email atau Password salah');
            return redirect()->to('/login');
        }

    }
    public function otp()
    {
        // Cursed Magic in action
        $session = $this->session;

        if ($session->logged_in) {
            return redirect()->to('/dashboard');
            // redirect('/dashboard');
        }

        if (empty($session->user_id) || empty($session->sessid)) {
            return redirect()->to('/');
        }

        return view('auth/otp', ['email' => $session->email, 'title' => 'OTP']);
    }

    public function generateOtp(string $otp, int $uid)
    {
        // init otp model
        $otpModel = new TokenModel();

        // generate otp
        $timestamp = new \DateTime();
        $salt = random_string(4);
        $token = implode(
            '$',
            array(
                $salt,
                sha1(implode(':', array(strval($uid), $otp, $salt)))
            )
        );

        // store otp
        $otpData = array(
            'id' => str_replace('-', '', $this->guidv4()),
            'uid' => $uid,
            'otp' => $token,
            'expired' => $timestamp->modify('+2 minutes')->getTimestamp(),
            'reason' => 'login',
        );

        $url = base_url('otp/' . $otpData['id']) . '?' . http_build_query(array(
            'token' => explode('$', $token)[1],
            'id' => $uid
        ));

        return ($otpModel->insert($otpData) !== false
            ? array(
                'id' => $otpData['id'],
                'url' => $url
            )
            : false);
    }

    public function sendOtp(string $mailAdr, array $context)
    {
        $isi_email = view('email/otp', $context);
        $email_smtp = \Config\Services::email();
        $email_smtp->setFrom('no-reply@smartnusajayananta.com', 'Notifikasi SMART NUSA JAYANANTA');
        $email_smtp->setTo($mailAdr);
        $email_smtp->setSubject("Kode OTP Smart Nusa Jayananta");
        $email_smtp->setMessage($isi_email, TRUE);
        if ($email_smtp->send()) {
            return true;
        } else {
            $email_smtp->printDebugger(['headers']);
            die;
        }
    }

    public function authentication(string $otpid = '')
    {
        // Cursed Magic in action
        $session = $this->session;
        $input = $this->request;

        // fetch otp id
        // dd($this->request->getMethod());
        switch ($this->request->getMethod()) {
            case 'POST':
                $otpid = $session->sessid;
                break;
            case 'GET':
                if (empty($input->getPost('token')) || empty($input->getPost('id'))) {
                    show_404();
                }
                break;
            default:
                show_404();
        }
        if (empty($otpid)) {
            show_404();
        }


        // initialize otp model
        $otpModel = new TokenModel();

        // fetch stored otp data
        $otp = $otpModel->where('id', $otpid)->first();
        if (is_null($otp) || $otp['reason'] !== 'login') {
            show_404();
        }

        // validate otp and uid
        $uid = $session->user_id;
        $salt = explode('$', $otp['otp'])[0];
        $token = sha1(implode(':', array($uid, $this->request->getPost('otp'), $salt)));

        if ($token !== explode('$', $otp['otp'])[1] || $uid != $otp['uid']) {
            $this->session->setFlashdata('error', 'OTP tidak sesuai!');
            return redirect()->to('/otp');
        }

        // validate expiration
        // add 20 seconds diff
        $timestamp = new \DateTime();
        if ($otp['expired'] < $timestamp->modify('+60 seconds')->getTimestamp()) {
            // delete stored otp
            $otpModel->delete($otpid);

            // redirect to login
            $this->session->setFlashdata('error', 'Kode Otp kadaluarsa!');
            return redirect()->to('/');
        }

        // remove sessid dan sessotp value from session
        $session->remove('sessid');
        $session->remove('sessotp');
        $otpModel->delete($otpid);

        // log in user
        try {
            $this->doLogin($otp['uid']);
            return redirect()->to('/dashboard');
        } catch (\Throwable $th) {
            $this->session->setFlashdata('pesan', 'Validasi Otp gagal!');
            return redirect()->to('/');
        }
    }

    protected function doLogin(int $uid)
    {
        // load model
        $userModel = new UserModel();
        $user = $userModel->where('id', $uid)->first();

        if (is_null(value: $user)) {
            throw new Exception("User data for data id {$uid} not found.");
        }

        // create session
        $sess = [
            'logged_in' => true,
            'uid' => $user['id'],
            'role' => $user['role'],
            'name' => $user['name'],
        ];
        $this->session->set($sess);
        // update last login
        // $timestamp = new \DateTime();
        // $userModel->where('user_id', $user['user_id'])->set('last_login', $timestamp->format('Y-m-d H:i:s'))->update();
    }

    // GUID v4 generator. temporary, to be changed with some library
    protected function guidv4($data = null)
    {
        $data = $data ?? random_bytes(16);

        assert(strlen($data) == 16);

        $data[6] = chr(ord($data[6]) & 0x0f | 0x40); // set version to 0100
        $data[8] = chr(ord($data[8]) & 0x3f | 0x80); // set bits 6-7 to 10

        return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
    }
}
