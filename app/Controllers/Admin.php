<?php

namespace App\Controllers;

use App\Models\AdminModel;
use App\Models\RequestModel;
use App\Models\RequestDetailModel;
use App\Models\CutiModel;
use App\Models\TimeslipModel;
use App\Models\SeragamModel;
use CodeIgniter\Controller;

class Admin extends BaseController
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
        if (session()->get('jabatan') != 'Admin') {
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
        if (session()->get('jabatan') != 'Admin') {
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

    public function formUser()
    {
        if (session()->get('jabatan') != 'Admin') {
            return redirect()->to(base_url('login/index'));
        }

        $data = [
            'title' => 'Smart Lurah'
        ];

        return view('templates/header', $data)
            . view('templates/sidebar', $data)
            . view('form/user', $data)
            . view('templates/footer');
    }

    public function addUser()
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
            'name' => $this->request->getPost('name'),
            'username' => $this->request->getPost('username'),
            'password' => $this->request->getPost('password'),
            // 'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'jabatan' => $this->request->getPost('jabatan'),
            'no_hp' => $this->request->getPost('no_hp'),
            'email' => $this->request->getPost('email'),
            'nik' => $this->request->getPost('nik'),
            'penetapan_sk' => $this->request->getPost('penetapan_sk'),
            'tgl_sk' => $this->request->getPost('tgl_sk'),
            'jmlh_insentif' => $this->request->getPost('jmlh_insentif'),
            'no_rek' => $this->request->getPost('no_rek'),
            'rt' => $this->request->getPost('rt'),
            'rw' => $this->request->getPost('rw'),
            'picture' => $fileName, 
        ];

        $this->adminModel->saveUser($data);

        session()->setFlashdata('message', '<div class="alert alert-success">Add data successfully.</div>');
        return redirect()->to(base_url('admin/user'));
    }

    public function formEditUser($id_user)
    {
        if (session()->get('jabatan') != 'Admin') {
            return redirect()->to(base_url('login/index'));
        }

        $data = [
            'title' => 'Smart Lurah',
            'data_user' => $this->adminModel->getUserDetail($id_user)
        ];

        return view('templates/header', $data)
            . view('templates/sidebar', $data)
            . view('form/editUser', $data)
            . view('templates/footer');
    }

    public function editUser($id_user)
    {
        $data = [
            'name' => $this->request->getPost('name'),
            // 'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'jabatan' => $this->request->getPost('jabatan'),
            'no_hp' => $this->request->getPost('no_hp'),
            'email' => $this->request->getPost('email'),
            'nik' => $this->request->getPost('nik'),
            'penetapan_sk' => $this->request->getPost('penetapan_sk'),
            'tgl_sk' => $this->request->getPost('tgl_sk'),
            'jmlh_insentif' => $this->request->getPost('jmlh_insentif'),
            'no_rek' => $this->request->getPost('no_rek'),
            'rt' => $this->request->getPost('rt'),
            'rw' => $this->request->getPost('rw'),
        ];

        $this->adminModel->updateUser($data, $id_user);

        session()->setFlashdata('message', '<div class="alert alert-success">Edit data successfully.</div>');
        return redirect()->to(base_url('admin/user'));
    }

    public function deleteUser()
    {
        $id = $this->request->getGet('id');
        if (!$id) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Data not found');
        }

        $this->adminModel->deleteUser($id);

        session()->setFlashdata('message', '<div class="alert alert-success">Delete data successfully.</div>');
        return $this->response->setJSON(['success' => true]);
    }

    public function request()
    {
        if (session()->get('role') !== 'Admin') {
            return redirect()->to(base_url('login/index'));
        }
        $get = $this->requestModel->get();
        $tmp = [];
        foreach ($get as $row) {
            $chk = $this->requestModel->countDetail($row['id_request']);
            $row['accepted'] = $chk;
            $tmp[] = $row;
        }

        $data = [
            'title' => 'Personal Monitoring | List Request',
            'data_master' => $tmp,
        ];

        return view('templates/header', $data)
            . view('templates/sidebar', $data)
            . view('pages/request', $data)
            . view('templates/footer');
    }

    public function requestDetail($id_request)
    {
        if (session()->get('role') !== 'Admin') {
            return redirect()->to(base_url('login/index'));
        }

        $data = [
            'title' => 'Personal Monitoring | Detail Request',
            'data_master' => $this->requestDetailModel->get($id_request),
            'id_request' => $id_request,
        ];

        return view('templates/header', $data)
            . view('templates/sidebar', $data)
            . view('pages/request-detail', $data)
            . view('templates/footer');
    }

    public function formRequestDetail($id_request)
    {
        if (session()->get('role') !== 'Admin') {
            return redirect()->to(base_url('login/index'));
        }

        $id_user = session()->get('id_user');
        $user = $this->adminModel->getUserLogin($id_user);
        // $request = $this->requestDetailModel->get($id_request);
        $data = [
            'title' => 'Personal Monitoring',
            'user' => $user,
            'id_request' => $id_request,
        ];

        return view('templates/header', $data)
            . view('templates/sidebar', $data)
            . view('form/request-detail', $data)
            . view('templates/footer');
    }

    public function addRequestDetail($id_request)
    {
        $data = [
            "date" => $this->request->getPost('date'),
            "cv" => $this->request->getPost('cv'),
            "id_request" => $id_request,
        ];

        $this->requestDetailModel->saveData($data);

        session()->setFlashdata('message', '<div class="alert alert-success">Add data successfully.</div>');
        return redirect()->to(base_url('admin/requestDetail/' . $id_request));
    }

    public function deleteRequestDetail()
    {
        $id = $this->request->getGet('id');
        if (!$id) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Data not found');
        }

        $this->requestDetailModel->deleteData($id);

        session()->setFlashdata('message', '<div class="alert alert-success">Delete data successfully.</div>');
        return $this->response->setJSON(['success' => true]);
    }
    
    public function cuti()
    {
        if (session()->get('role') !== 'Admin') {
            return redirect()->to(base_url('login/index'));
        }

        $data = [
            'title' => 'Persona Monitoring | Pengajuan Cuti',
            'data_master' => $this->cutiModel->getCuti(),
        ];

        return view('templates/header', $data)
            . view('templates/sidebar', $data)
            . view('pages/cuti', $data)
            . view('templates/footer');
    }

    public function formCuti()
    {
        if (session()->get('role') !== 'Admin') {
            return redirect()->to(base_url('login/index'));
        }

        $id_user = session()->get('id_user');
        $user = $this->adminModel->getUserLogin($id_user);
        $cuti = $user['sisa_cuti'];
        $data = [
            'title' => 'Persona Monitoring',
            'user' => $user,
            'cuti' => $cuti,
        ];

        return view('templates/header', $data)
            . view('templates/sidebar', $data)
            . view('form/cuti', $data)
            . view('templates/footer');
    }

    public function addCuti()
    {
        // $id_user = session()->get('id_user');
        $user = $this->adminModel->getUserDetail(session()->get('id_user'));
        $sisa_cuti = $user['sisa_cuti'] - 1;
        $this->adminModel->updateSisaCuti($user['id_user'], $sisa_cuti);
        $data = [
            'keterangan' => $this->request->getPost('keterangan'),
            'date_from' => $this->request->getPost('date_from'),
            'date_until' => $this->request->getPost('date_until'),
            'type' => $this->request->getPost('type'),
            'id_user' => session()->get('id_user'),
            'status' => 'HRD',
        ];

        $this->cutiModel->saveCuti($data);

        session()->setFlashdata('message', 'Data cuti berhasil ditambahkan.');
        return redirect()->to('admin/cuti');
    }

    public function openCuti($id_cuti, $id_user)
    {
        if (session()->get('role') !== 'Admin') {
            return redirect()->to(base_url('login/index'));
        }

        $user = $this->adminModel->getUserLogin($id_user);
        $cuti = $user['sisa_cuti'];

        $data = [
            'title' => 'Persona Monitoring',
            'user' => $user,
            'cuti' => $cuti,
            'data_cuti' => $this->cutiModel->getCutiDetail($id_cuti),
        ];

        return view('templates/header', $data)
            . view('templates/sidebar', $data)
            . view('pages/cuti_detail', $data)
            . view('templates/footer');
    }

    public function approveCuti()
    {
        $id = $this->request->getGet('id');
        if (!$id) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Data not found');
        }

        $this->cutiModel->approveCutiHRD($id);

        session()->setFlashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            Approve data successfully.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>');

        return $this->response->setJSON(['success' => true]);
    }

    public function rejectCuti()
    {
        $id = $this->request->getGet('id');
        if (!$id) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Data not found');
        }

        $this->cutiModel->rejectHRD($id);

        session()->setFlashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            Reject data successfully.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>');

        return $this->response->setJSON(['success' => true]);
    }

    public function timeslip()
    {
        if (session()->get('role') !== 'Admin') {
            return redirect()->to(base_url('login/index'));
        }

        $data = [
            'title' => 'Persona Monitoring | Pengajuan Timeslip',
            'data_master' => $this->timeslipModel->getTimeslip(),
        ];

        return view('templates/header', $data)
            . view('templates/sidebar', $data)
            . view('pages/timeslip', $data)
            . view('templates/footer');
    }

    public function openTimeslip($id_timeslip, $id_user)
    {
        if (session()->get('role') !== 'Admin') {
            return redirect()->to(base_url('login/index'));
        }

        $data = [
            'title' => 'Persona Monitoring',
            'user' => $this->adminModel->getUserDetail($id_user),
            'data_timeslip' => $this->timeslipModel->getTimeslipDetail($id_timeslip),
        ];

        return view('templates/header', $data)
            . view('templates/sidebar', $data)
            . view('pages/timeslip_detail', $data)
            . view('templates/footer');
    }

    public function approveTimeslip()
    {
        $id = $this->request->getGet('id');
        if (!$id) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Data not found');
        }

        $this->timeslipModel->approveHRD($id);

        session()->setFlashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            Approve data successfully.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>');

        return $this->response->setJSON(['success' => true]);
    }

    public function rejectTimeslip()
    {
        $id = $this->request->getGet('id');
        if (!$id) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Data not found');
        }

        $this->timeslipModel->rejectHRD($id);

        session()->setFlashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            Reject data successfully.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>');

        return $this->response->setJSON(['success' => true]);
    }

    public function seragam()
    {
        if (session()->get('role') !== 'Admin') {
            return redirect()->to(base_url('login/index'));
        }

        $data = [
            'title' => 'Persona Monitoring | Pengajuan Seragam Kerja',
            'data_master' => $this->seragamModel->getSeragam(),
        ];

        return view('templates/header', $data)
            . view('templates/sidebar', $data)
            . view('pages/seragam', $data)
            . view('templates/footer');
    }

    public function approveSeragam()
    {
        $id = $this->request->getGet('id');
        if (!$id) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Data not found');
        }

        $this->seragamModel->approveHRD($id);

        session()->setFlashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            Approve data successfully.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>');

        return $this->response->setJSON(['success' => true]);
    }

    public function rejectSeragam()
    {
        $id = $this->request->getGet('id');
        if (!$id) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Data not found');
        }

        $this->seragamModel->rejectHRD($id);

        session()->setFlashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            Reject data successfully.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>');

        return $this->response->setJSON(['success' => true]);
    }

}
