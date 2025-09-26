<?php

namespace App\Controllers;

use App\Models\AdminModel;
use App\Models\RequestModel;
use App\Models\RequestDetailModel;
use App\Models\CutiModel;
use App\Models\TimeslipModel;
use App\Models\SeragamModel;
use CodeIgniter\Controller;

class Rw extends BaseController
{
    protected $adminModel;
    protected $requestModel;
    protected $requestDetailModel;
    protected $cutiModel;
    protected $timeslipModel;
    protected $seragamModel;

    public function __construct()
    {
        $this->adminModel = new AdminModel();
        $this->requestModel = new RequestModel();
        $this->requestDetailModel = new RequestDetailModel();
        $this->cutiModel = new CutiModel();
        $this->timeslipModel = new TimeslipModel();
        $this->seragamModel = new SeragamModel();
        helper('form'); 
    }

    public function index()
    {
        if (session()->get('jabatan') != 'RW') {
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
        if (session()->get('jabatan') != 'RW') {
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
        if (session()->get('jabatan') != 'RW') {
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
}
