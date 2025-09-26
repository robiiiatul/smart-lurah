<?php

namespace App\Controllers;

use App\Models\AdminModel;
use App\Models\RequestModel;
use App\Models\RequestDetailModel;
use App\Models\CutiModel;
use App\Models\TimeslipModel;
use App\Models\SeragamModel;
use App\Models\ProgramModel;
use CodeIgniter\Controller;

class Rt extends BaseController
{
    protected $adminModel;
    protected $requestModel;
    protected $requestDetailModel;
    protected $cutiModel;
    protected $timeslipModel;
    protected $seragamModel;
    protected $programModel;

    public function __construct()
    {
        $this->adminModel = new AdminModel();
        $this->requestModel = new RequestModel();
        $this->requestDetailModel = new RequestDetailModel();
        $this->cutiModel = new CutiModel();
        $this->timeslipModel = new TimeslipModel();
        $this->seragamModel = new SeragamModel();
        $this->programModel = new ProgramModel();
        helper('form'); 
    }

    public function index()
    {
        if (session()->get('jabatan') != 'RT') {
            return redirect()->to(base_url('login/index'));
        }

        $data = [
            'title' => 'Smart Lurah'
        ];

        return view('templates/header', $data)
            . view('templates/sidebar', $data)
            . view('dashboard', $data)
            . view('templates/footer');
    }

    public function user()
    {
        if (session()->get('jabatan') != 'RT') {
            return redirect()->to(base_url('login/index'));
        }

        $data = [
            'title' => 'Smart Lurah',
            'data_user' => $this->adminModel->getUser()
        ];

        return view('templates/header', $data)
            . view('templates/sidebar', $data)
            . view('pages/user', $data)
            . view('templates/footer');
    }

    public function profile()
    {
        if (session()->get('jabatan') != 'RT') {
            return redirect()->to(base_url('login/index'));
        }

        $data = [
            'title' => 'Smart Lurah',
            'user' => $this->adminModel->getUserDetail(session()->get('id_user'))
        ];

        return view('templates/header', $data)
            . view('templates/sidebar', $data)
            . view('form/profile', $data)
            . view('templates/footer');
    }

    public function program()
    {
        if (session()->get('jabatan') != 'RT') {
            return redirect()->to(base_url('login/index'));
        }

        $data = [
            'title' => 'Smart Lurah',
            'data' => $this->programModel->getProgram()
        ];

        return view('templates/header', $data)
            . view('templates/sidebar', $data)
            . view('pages/program', $data)
            . view('templates/footer');
    }

    public function formProgram()
    {
        if (session()->get('jabatan') != 'RT') {
            return redirect()->to(base_url('login/index'));
        }

        $data = [
            'title' => 'Smart Lurah'
        ];

        return view('templates/header', $data)
            . view('templates/sidebar', $data)
            . view('form/program', $data)
            . view('templates/footer');
    }

    public function addProgram()
    {
        // ambil file gambar
        $file = $this->request->getFile('picture');
        $fileName = null;

        if ($file && $file->isValid() && !$file->hasMoved()) {
            // bikin nama unik (biar gak tabrakan)
            $fileName = $file->getRandomName();

            // simpan ke folder public/uploads
            $file->move(FCPATH . 'uploads', $fileName);
        }

        $data = [
            'judul' => $this->request->getPost('judul'),
            'tanggal' => $this->request->getPost('tanggal'),
            'keterangan' => $this->request->getPost('keterangan'),
            'id_user' => session()->get('id_user'),
            'picture' => $fileName, 
        ];

        $this->programModel->saveProgram($data);

        session()->setFlashdata('message', '<div class="alert alert-success">Add data successfully.</div>');
        return redirect()->to(base_url('rt/program'));
    }
}
