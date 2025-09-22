<?php

namespace App\Controllers;

use App\Models\AdminModel;
use App\Models\CutiModel;
use App\Models\TimeslipModel;
use App\Models\SeragamModel;

class Karyawan extends BaseController
{
    protected $adminModel;
    protected $cutiModel;
    protected $timeslipModel;
    protected $seragamModel;

    public function __construct()
    {
        $this->adminModel = new AdminModel();
        $this->cutiModel = new CutiModel();
        $this->timeslipModel = new TimeslipModel();
        $this->seragamModel = new SeragamModel();
        helper('form'); 
    }

    public function index()
    {
        if (session()->get('role') != 'Karyawan') {
            return redirect()->to(base_url('login/index'));
        }

        $data = [
            'title' => 'Manajemen Karyawan',
            'countcuti' => $this->adminModel->countCuti(),
        ];

        return view('templates/header', $data)
            . view('templates/sidebar', $data)
            . view('dashboard', $data)
            . view('templates/footer');
    }

    public function openUser($id_user)
    {
        if (session()->get('role') != 'Karyawan') {
            return redirect()->to(base_url('login/index'));
        }
        $user = $this->adminModel->getUserDetail($id_user);
        $profile = base_url("asset/upload/avatar.PNG");
        if ($user['picture'] != '') $profile = base_url("asset/upload/" . $user['picture']);

        $data = [
            'title' => 'Manajemen Karyawan',
            'data_user' => $user,
            'picture' => $profile,
            // 'data_user' => $this->adminModel->getUserDetail($id_user),
        ];

        return view('templates/header', $data)
            . view('templates/sidebar', $data)
            . view('pages/user_detail', $data)
            . view('templates/footer');
    }

    public function formEditUser($id_user)
    {
        if (session()->get('role') != 'Karyawan') {
            return redirect()->to(base_url('login/index'));
        }

        $data = [
            'title' => 'Manajemen Karyawan',
            'data_user' => $this->adminModel->getUserDetail($id_user),
        ];

        return view('templates/header', $data)
            . view('templates/sidebar', $data)
            . view('form/editUser', $data)
            . view('templates/footer');
    }

    public function uploadPicture($id_user)
    {
        if (session()->get('role') != 'Karyawan') {
            return redirect()->to(base_url('login/index'));
        }

        $data = [
            'title' => 'Manajemen Karyawan',
            'data_user' => $this->adminModel->getUserDetail($id_user),
        ];

        return view('templates/header', $data)
            . view('templates/sidebar', $data)
            . view('form/uploadPicture', $data)
            . view('templates/footer');
    }

    public function editUser($id_user)
    {
        $role = $this->request->getPost('role') === 'HRD' ? 'Admin' : $this->request->getPost('role');

        $data = [
            'name' => $this->request->getPost('name'),
            'role' => $role,
            'employee_number' => $this->request->getPost('employee_number'),
            'join_date' => $this->request->getPost('join_date'),
            'department' => $this->request->getPost('department'),
            'card_number' => $this->request->getPost('card_number'),
            'gender' => $this->request->getPost('gender'),
            'tempat_lahir' => $this->request->getPost('tempat_lahir'),
            'tanggal_lahir' => $this->request->getPost('tanggal_lahir'),
            'religion' => $this->request->getPost('religion'),
            'race' => $this->request->getPost('race'),
            'last_education' => $this->request->getPost('last_education'),
            'blood_type' => $this->request->getPost('blood_type'),
            'phone_number' => $this->request->getPost('phone_number'),
            'email' => $this->request->getPost('email'),
            'address' => $this->request->getPost('address'),
            'city' => $this->request->getPost('city'),
            'province' => $this->request->getPost('province'),
            'postal_code' => $this->request->getPost('postal_code'),
            'contact_name' => $this->request->getPost('contact_name'),
            'contact_relation' => $this->request->getPost('contact_relation'),
            'contact_phone' => $this->request->getPost('contact_phone'),
            'martial_status' => $this->request->getPost('martial_status'),
            'dependent_total' => $this->request->getPost('dependent_total'),
            'jabatan' => $this->request->getPost('role'),
        ];

        $this->adminModel->updateUser($data, $id_user);

        session()->setFlashdata('message', 'Edit data berhasil.');
        return redirect()->to("karyawan/openUser/$id_user");
    }

    public function uploadProfile($id_user)
    {
        $file = $this->request->getFile('picture');
        
        if ($file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName(); // Generate a unique name
            // $file->move(base_url('asset/upload/picture'), $newName); // Save to the uploads directory
            // $a = WRITEPATH;
            // dd($a);
            $file->move('C:\xampp-8\htdocs\manajemen-karyawan\public\asset\upload', $newName);

            $data = [
                'picture' => $newName,
            ];

            $this->adminModel->updateUser($data, $id_user);
            
            session()->setFlashdata('message', 'Upload berhasil.');
            return redirect()->to("karyawan/openUser/$id_user");
        }

        // return redirect()->back()->with('error', 'Failed to upload photo!');

        session()->setFlashdata('message', 'Upload gagal.');
        return redirect()->to("karyawan/openUser/$id_user");
    }

    public function cuti()
    {
        if (session()->get('role') != 'Karyawan') {
            return redirect()->to(base_url('login/index'));
        }

        $data = [
            'title' => 'Manajemen Karyawan | Pengajuan Cuti',
            'data_master' => $this->cutiModel->getCuti(),
        ];

        return view('templates/header', $data)
            . view('templates/sidebar', $data)
            . view('pages/cuti', $data)
            . view('templates/footer');
    }

    public function formCuti()
    {
        if (session()->get('role') !== 'Karyawan') {
            return redirect()->to(base_url('login/index'));
        }

        $id_user = session()->get('id_user');
        $user = $this->adminModel->getUserLogin($id_user);
        $cuti = $user['sisa_cuti'];
        $data = [
            'title' => 'Manajemen Karyawan',
            'user' => $user,
            'cuti' => $cuti,
        ];

        return view('templates/header', $data)
            . view('templates/sidebar', $data)
            . view('form/cuti', $data)
            . view('templates/footer');
    }

    public function formEditCuti($id_cuti)
    {
        if (session()->get('role') != 'Karyawan') {
            return redirect()->to(base_url('login/index'));
        }

        $data_cuti = $this->cutiModel->getCutiDetail($id_cuti);
        $id_user = session()->get('id_user');
        $user = $this->adminModel->getUserLogin($id_user);
        $cuti = $user['sisa_cuti'];

        $data = [
            'title' => 'Manajemen Karyawan',
            'data' => $data_cuti,
            'user' => $user,
            'cuti' => $cuti,
        ];

        return view('templates/header', $data)
            . view('templates/sidebar', $data)
            . view('form/editCuti', $data)
            . view('templates/footer');
    }

    public function openCuti($id_cuti, $id_user)
    {
        if (session()->get('role') !== 'Karyawan') {
            return redirect()->to(base_url('login/index'));
        }

        $user = $this->adminModel->getUserDetail($id_user);
        $cuti = $user['sisa_cuti'];

        $data = [
            'title' => 'Manajemen Karyawan',
            'user' => $user,
            'cuti' => $cuti,
            'data_cuti' => $this->cutiModel->getCutiDetail($id_cuti),
        ];

        return view('templates/header', $data)
            . view('templates/sidebar', $data)
            . view('pages/cuti_detail', $data)
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
            'status' => 'Karyawan',
        ];

        $this->cutiModel->saveCuti($data);

        session()->setFlashdata('message', 'Data cuti berhasil ditambahkan.');
        return redirect()->to('karyawan/cuti');
    }

    public function editCuti($id_cuti)
    {
        $data = [
            'keterangan' => $this->request->getPost('keterangan'),
            'date_from' => $this->request->getPost('date_from'),
            'date_until' => $this->request->getPost('date_until'),
            'type' => $this->request->getPost('type'),
            'id_user' => session()->get('id_user'),
            'status' => 'Karyawan',
        ];

        $this->cutiModel->updateCuti($data, $id_cuti);

        session()->setFlashdata('message', '<div class="alert alert-success">Edit data successfully.</div>');
        return redirect()->to(base_url('karyawan/cuti'));
    }

    public function deleteCuti()
    {
        $id = $this->request->getGet('id');
        if (!$this->cutiModel->deleteCuti($id)) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Cuti ID $id tidak ditemukan.");
        }

        session()->setFlashdata('message', 'Data cuti berhasil dihapus.');
        return $this->response->setJSON(['success' => true]);
    }

    public function timeslip()
    {
        if (session()->get('role') !== 'Karyawan') {
            return redirect()->to(base_url('login/index'));
        }

        $data = [
            'title' => 'Manajemen Karyawan | Pengajuan Timeslip',
            'data_master' => $this->timeslipModel->getTimeslip(),
        ];

        return view('templates/header', $data)
            . view('templates/sidebar', $data)
            . view('pages/timeslip', $data)
            . view('templates/footer');
    }

    public function formTimeslip()
    {
        if (session()->get('role') !== 'Karyawan') {
            return redirect()->to(base_url('login/index'));
        }

        $id_user = session()->get('id_user');
        $data = [
            'title' => 'Manajemen Karyawan',
            'user' => $this->adminModel->getUserLogin($id_user),
        ];

        return view('templates/header', $data)
            . view('templates/sidebar', $data)
            . view('form/timeslip', $data)
            . view('templates/footer');
    }

    public function addTimeslip()
    {
        $file = $this->request->getFile('bukti');
        
        if ($file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName(); // Generate a unique name
            // $file->move(base_url('asset/upload/picture'), $newName); // Save to the uploads directory
            // $a = WRITEPATH;
            // dd($a);
            $file->move('C:\xampp-8\htdocs\manajemen-karyawan\public\asset\upload', $newName);

            $data = [
                "keterangan" => $this->request->getPost('keterangan'),
                "date_from" => $this->request->getPost('date_from'),
                // "date_until" => $this->request->getPost('date_until'),
                "jam_mulai" => $this->request->getPost('jam_mulai'),
                "jam_selesai" => $this->request->getPost('jam_selesai'),
                "type" => $this->request->getPost('type'),
                "id_user" => session()->get('id_user'),
                'bukti' => $newName,
                "status" => 'Karyawan'
                // Tambahkan field lainnya sesuai kebutuhan...
            ];
    
            $this->timeslipModel->saveTimeslip($data);
    
            session()->setFlashdata('message', '<div class="alert alert-success">Add data successfully.</div>');
            return redirect()->to(base_url('karyawan/timeslip'));
        }

        session()->setFlashdata('message', 'Bukti gagal di upload.');
        return redirect()->to("karyawan/timeslip");
    }

    public function openTimeslip($id_timeslip, $id_user)
    {
        if (session()->get('role') !== 'Karyawan') {
            return redirect()->to(base_url('login/index'));
        }

        $data_timeslip = $this->timeslipModel->getTimeslipDetail($id_timeslip);
        // dd($data_timeslip['bukti']);
        // $profile = base_url("asset/upload/avatar.PNG");
        if ($data_timeslip['bukti'] != '') $bukti = base_url("asset/upload/" . $data_timeslip['bukti']);

        $data = [
            'title' => 'Manajemen Karyawan',
            'user' => $this->adminModel->getUserDetail($id_user),
            'data_timeslip' => $data_timeslip,
            'bukti' => $bukti,
        ];

        return view('templates/header', $data)
            . view('templates/sidebar', $data)
            . view('pages/timeslip_detail', $data)
            . view('templates/footer');
    }

    public function deleteTimeslip()
    {
        $id = $this->request->getGet('id');
        if (!$this->timeslipModel->deleteTimeslip($id)) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Timeslip ID $id tidak ditemukan.");
        }

        session()->setFlashdata('message', 'Data cuti berhasil dihapus.');
        return $this->response->setJSON(['success' => true]);
    }

    public function seragam()
    {
        if (session()->get('role') !== 'Karyawan') {
            return redirect()->to(base_url('login/index'));
        }

        $data = [
            'title' => 'Manajemen Karyawan | Pengajuan Seragam Kerja',
            'data_master' => $this->seragamModel->getSeragam(),
        ];

        return view('templates/header', $data)
            . view('templates/sidebar', $data)
            . view('pages/seragam', $data)
            . view('templates/footer');
    }

    public function addSeragam()
    {
        $data = [
            "keterangan" => $this->request->getPost('keterangan'),
            "id_user" => session()->get('id_user'),
            "status" => 'Supervisor'
        ];

        $this->seragamModel->saveSeragam($data);

        session()->setFlashdata('message', '<div class="alert alert-success">Add data successfully.</div>');
        return redirect()->to(base_url('karyawan/seragam'));
    }
}
