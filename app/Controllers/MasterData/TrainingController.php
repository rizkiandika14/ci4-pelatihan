<?php

namespace App\Controllers\MasterData;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class TrainingController extends BaseController
{
    protected $trainingModel, $categoryModel, $requirementModel, $userModel, $scheduleModel;
    public function __construct()
    {
        $this->trainingModel = new \App\Models\TrainingModel();
        $this->categoryModel = new \App\Models\CategoryModel();
        $this->requirementModel = new \App\Models\RequirementModel();
        $this->userModel = new \App\Models\UserModel();
        $this->scheduleModel = new \App\Models\ScheduleModel();
    }
    public function index()
    {
        $data = [
            'title' => 'Pelatihan',
            'trainings' => $this->trainingModel->join('users', 'users.id = trainings.trainer_id')->findAll(),
            'categories' => $this->categoryModel->findAll()
        ];

        return view('master_data/pelatihan/index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Pelatihan',
            'categories' => $this->categoryModel->findAll(),
            'requirements' => $this->requirementModel->findAll(),
            'trainers' => $this->userModel->where('role', 'trainer')->findAll()
        ];

        return view('master_data/pelatihan/create', $data);
    }

    public function store()
    {
        // masukkan array requirement_id ke dalam database
        $requirement_id = $this->request->getVar('requirement_id');
        $requirement_id = implode(',', $requirement_id);
        try {
        // simpan image
        $file = $this->request->getFile('image');
        $file->move('uploads');
        
        $this->trainingModel->save([
            'training_name' => $this->request->getVar('name'),
            'description' => $this->request->getVar('description'),
            'image' => $this->request->getVar('image'),
            'trainer_id' => $this->request->getVar('trainer_id'),
            'category_id' => $this->request->getVar('category_id'),
            'price' => $this->request->getVar('price'),
            'certificate' => $this->request->getVar('certificate')
        ]);

        // masukkan array requirement_id ke dalam tabel access_requirements_training
        $accessRequirements = [];
        foreach ($this->request->getVar('requirement_id') as $requirement) {
            $accessRequirements[] = [
                'training_id' => $this->trainingModel->insertID(),
                'requirement_id' => $requirement
            ];
        }
        $this->trainingModel->db->table('access_requirements_training')->insertBatch($accessRequirements);

        session()->setFlashdata('success', 'Data berhasil disimpan');

        } catch (\Throwable $th) {
            session()->setFlashdata('error', 'Data gagal disimpan ' . $th->getMessage());
        }

        return redirect()->to('/pelatihan');
    }

    public function jadwal($id)
    {
        $data = [
            'title' => 'Jadwal Pelatihan',
            'jadwals' => $this->scheduleModel->where('training_id', $id)->findAll()
        ];

        echo view('master_data/pelatihan/ajaxJadwal', $data);
    }
}
