<?php

namespace App\Controllers;

use App\Models\AdminModel;
use App\Models\RequestModel;
use App\Models\RequestDetailModel;

class Supervisor extends BaseController
{
    protected $adminModel;
    protected $requestModel;
    protected $requestDetailModel;

    public function __construct()
    {
        $this->adminModel = new AdminModel();
        $this->requestModel = new RequestModel();
        $this->requestDetailModel = new RequestDetailModel();
        helper('form'); 
    }

    public function index()
    {
        if (session()->get('role') !== 'Supervisor') {
            return redirect()->to(base_url('login/index'));
        }

        $data = [
            'title' => 'Personal Monitoring',
        ];

        return view('templates/header', $data)
            . view('templates/sidebar', $data)
            . view('dashboard', $data)
            . view('templates/footer');
    }

    public function request()
    {
        if (session()->get('role') !== 'Supervisor') {
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

    public function formRequest()
    {
        if (session()->get('role') !== 'Supervisor') {
            return redirect()->to(base_url('login/index'));
        }

        $id_user = session()->get('id_user');
        $user = $this->adminModel->getUserLogin($id_user);
        // $cuti = $user['sisa_cuti'];
        $data = [
            'title' => 'Personal Monitoring',
            'user' => $user,
            // 'cuti' => $cuti,
        ];

        return view('templates/header', $data)
            . view('templates/sidebar', $data)
            . view('form/request', $data)
            . view('templates/footer');
    }

    public function addRequest()
    {
        $data = [
            "date" => $this->request->getPost('date'),
            "total" => $this->request->getPost('total'),
            "note" => $this->request->getPost('note'),
            "id_user" => session()->get('id_user'),
        ];

        $this->requestModel->saveData($data);

        session()->setFlashdata('message', '<div class="alert alert-success">Add data successfully.</div>');
        return redirect()->to(base_url('supervisor/request'));
    }

    public function deleteRequest()
    {
        $id = $this->request->getGet('id');
        if (!$id) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Data not found');
        }

        $this->requestModel->deleteData($id);

        session()->setFlashdata('message', '<div class="alert alert-success">Delete data successfully.</div>');
        return $this->response->setJSON(['success' => true]);
    }

    public function requestDetail($id_request)
    {
        if (session()->get('role') !== 'Supervisor') {
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
        if (session()->get('role') !== 'Supervisor') {
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
        return redirect()->to(base_url('supervisor/requestDetail/' . $id_request));
    }

    public function approveRequest()
    {
        $id = $this->request->getGet('id');
        if (!$id) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Data not found');
        }

        $this->requestDetailModel->approve($id);

        session()->setFlashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            Approve data successfully.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>');

        return $this->response->setJSON(['success' => true]);
    }

    public function rejectRequest()
    {
        $id = $this->request->getGet('id');
        if (!$id) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Data not found');
        }

        $this->requestDetailModel->reject($id);

        session()->setFlashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            Reject data successfully.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>');

        return $this->response->setJSON(['success' => true]);
    }

    // public function editCuti($id_cuti)
    // {
    //     $data = [
    //         'keterangan' => $this->request->getPost('keterangan'),
    //         'date_from' => $this->request->getPost('date_from'),
    //         'date_until' => $this->request->getPost('date_until'),
    //         'type' => $this->request->getPost('type'),
    //         'id_user' => session()->get('id_user'),
    //         'status' => 'Karyawan',
    //     ];

    //     $this->requestModel->updateCuti($data, $id_cuti);

    //     session()->setFlashdata('message', '<div class="alert alert-success">Edit data successfully.</div>');
    //     return redirect()->to(base_url('supervisor/cuti'));
    // }

    // public function openCuti($id_cuti, $id_user)
    // {
    //     if (session()->get('role') !== 'Supervisor') {
    //         return redirect()->to(base_url('login/index'));
    //     }

    //     $user = $this->adminModel->getUserLogin($id_user);
    //     $cuti = $user['sisa_cuti'];

    //     $data = [
    //         'title' => 'Personal Monitoring',
    //         'user' => $user,
    //         'cuti' => $cuti,
    //         'data_cuti' => $this->requestModel->getCutiDetail($id_cuti),
    //     ];

    //     return view('templates/header', $data)
    //         . view('templates/sidebar', $data)
    //         . view('pages/cuti_detail', $data)
    //         . view('templates/footer');
    // }

    // public function approveCuti()
    // {
    //     $id = $this->request->getGet('id');
    //     if (!$id) {
    //         throw new \CodeIgniter\Exceptions\PageNotFoundException();
    //     }

    //     $this->requestModel->approveCutiSpv($id);
    //     session()->setFlashdata('message', '<div class="alert alert-success">Approve data successfully.</div>');

    //     return $this->response->setJSON(['success' => true]);
    // }

    // public function rejectCuti()
    // {
    //     $id = $this->request->getGet('id');
    //     $note = $this->request->getGet('note');
    //     if (!$id) {
    //         throw new \CodeIgniter\Exceptions\PageNotFoundException();
    //     }

    //     $data = [
    //         'note' => $note,
    //     ];

    //     $this->requestModel->rejectSpv($id, $note);
    //     session()->setFlashdata('message', '<div class="alert alert-success">Reject data successfully.</div>');

    //     return $this->response->setJSON(['success' => true]);
    // }
}
