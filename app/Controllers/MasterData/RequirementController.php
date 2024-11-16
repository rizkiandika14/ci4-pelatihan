<?php

namespace App\Controllers\MasterData;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class RequirementController extends BaseController
{
    protected $requirement;
    public function __construct()
    {
        $this->requirement = new \App\Models\RequirementModel();
    }
    public function index()
    {
        $data = [
            'title' => 'Requirement',
            'requirements' => $this->requirement->findAll(),
        ];

        return view('master_data/requirement/index', $data);
    }

    public function store()
    {
        try {
            $this->requirement->save([
                'description' => $this->request->getPost('description'),
                'is_required' => $this->request->getPost('is_required'),
            ]);

            session()->setFlashdata('success', 'Data berhasil disimpan');
        } catch (\Exception $e) {
            session()->setFlashdata('error', $e->getMessage());
        }

        return redirect()->to('/syarat');
    }

    public function update()
    {
        try {
            $this->requirement->save([
                'id' => $this->request->getPost('id'),
                'description' => $this->request->getPost('description'),
                'is_required' => $this->request->getPost('is_required'),
            ]);

            session()->setFlashdata('success', 'Data berhasil diubah');
        } catch (\Exception $e) {
            session()->setFlashdata('error', $e->getMessage());
        }

        return redirect()->to('/syarat');
    }

    public function delete($id)
    {
        try {
            $this->requirement->delete($id);

            session()->setFlashdata('success', 'Data berhasil dihapus');
        } catch (\Exception $e) {
            session()->setFlashdata('error', $e->getMessage());
        }

        return redirect()->to('/syarat');
    }
}
