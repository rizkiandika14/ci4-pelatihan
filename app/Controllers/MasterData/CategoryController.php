<?php

namespace App\Controllers\MasterData;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class CategoryController extends BaseController
{
    protected $categoryModel;
    public function __construct()
    {
        $this->categoryModel = new \App\Models\CategoryModel();
    }
    public function index()
    {
        $data = [
            'title' => 'Kategori',
            'categories' => $this->categoryModel->findAll(),
        ];
        return view('master_data/category/index', $data);
    }

    public function store()
    {
        $valid = $this->validate([
            'name' => [
                'label' => 'Nama',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi.'
                ]
            ],
            'description' => [
                'label' => 'Deskripsi',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi.'
                ]
            ],
            'image' => [
                'label' => 'Gambar',
                'rules' => 'uploaded[image]|max_size[image,1024]|is_image[image]',
                'errors' => [
                    'uploaded' => '{field} harus diisi.',
                    'max_size' => 'Ukuran {field} terlalu besar. Maksimal 1MB.',
                    'is_image' => '{field} harus berupa gambar.'
                ]
            ]
        ]);

        if (!$valid) {
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            // dd(\Config\Services::validation()->getErrors());
            return redirect()->to('/kategori');
        }

                //get random name
        $image = $this->request->getFile('image');
        $imagePath = $image->getRandomName();

        $image->move(ROOTPATH . 'public/uploads/kategori', $imagePath);

        $data = [
            'name' => $this->request->getPost('name'),
            'description' => $this->request->getPost('description'),
            'image' => $imagePath,
        ];

        $this->categoryModel->insert($data);

        session()->setFlashdata('success', 'Data berhasil ditambahkan');
        return redirect()->to('/kategori');
    }

    public function update()
    {
        $valid = $this->validate([
            'name' => [
                'label' => 'Nama',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi.'
                ]
            ],
            'description' => [
                'label' => 'Deskripsi',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi.'
                ]
            ]
        ]);

        if($this->request->getFile('image-edit') != '') {
            $valid = $this->validate([
                'image-edit' => [
                    'label' => 'Gambar',
                    'rules' => 'uploaded[image-edit]|max_size[image-edit,1024]|is_image[image-edit]',
                    'errors' => [
                        'uploaded' => '{field} harus diisi.',
                        'max_size' => 'Ukuran {field} terlalu besar. Maksimal 1MB.',
                        'is_image' => '{field} harus berupa gambar.'
                    ]
                ]
            ]);
        }

        if (!$valid) {
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to('/kategori');
        }

        if($this->request->getFile('image-edit') != '') {
            $image = $this->request->getFile('image-edit');

            $imagePath = $image->getRandomName();

            $image->move(ROOTPATH . 'public/uploads/kategori', $imagePath);

            //delete old image
            $oldImage = $this->request->getPost('image-old');
            unlink(ROOTPATH . 'public/uploads/kategori/' . $oldImage);
        } else {
            $imagePath = $this->request->getPost('image-old');
        }

        $data = [
            'name' => $this->request->getPost('name'),
            'description' => $this->request->getPost('description'),
            'image' => $imagePath,
        ];

        $this->categoryModel->update($this->request->getPost('id'), $data);

        session()->setFlashdata('success', 'Data berhasil diubah');
        return redirect()->to('/kategori');
    }

    public function delete($id)
    {
        $category = $this->categoryModel->find($id);

        if ($category) {
            unlink(ROOTPATH . 'public/uploads/kategori/' . $category->image);
            $this->categoryModel->delete($id);
            session()->setFlashdata('success', 'Data berhasil dihapus');
        } else {
            session()->setFlashdata('error', 'Data tidak ditemukan');
        }

        return redirect()->to('/kategori');
    }
}
