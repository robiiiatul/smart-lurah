<?php

namespace App\Models;

use CodeIgniter\Model;

class RequestDetailModel extends Model
{
    protected $table = 'detail-request'; // Nama tabel
    protected $primaryKey = 'id_detail'; // Primary key
    protected $allowedFields = [
        'id_request', 'date', 'cv', 'status'
    ]; // Kolom yang diizinkan untuk operasi CRUD

    /**
     * Simpan data cuti baru
     * @param array $data
     * @return bool
     */
    public function saveData(array $data): bool
    {
        return $this->insert($data);
    }
    
    // public function update(array $data, int $id_request): bool
    // {
        // return $this->update($id_cuti, $data);
    // }

    /**
     * Ambil semua data cuti dengan relasi ke user
     * @return array
     */
    public function get($id_request): array
    {
        return $this->select('detail-request.*')
            // ->join('user', 'user.id_user = request.id_user')
            ->where('detail-request.id_request', $id_request)
            ->orderBy('detail-request.id_detail','DESC')
            ->findAll();
    }
    
    public function approve(int $id_request): bool
    {
        return $this->update($id_request, ['status' => 'Approved']);
    }
    
    public function reject(int $id_request): bool
    {
        return $this->update($id_request, ['status' => 'Rejected']);
    }

    /**
     * Ambil detail cuti berdasarkan ID dengan relasi ke user
     * @param int $id_cuti
     * @return array|null
     */
    public function getCutiDetail(int $id_cuti): ?array
    {
        return $this->select('tbl_cuti.*, tbl_user.name as user_name, tbl_user.email as user_email')
            ->join('tbl_user', 'tbl_user.id_user = tbl_cuti.id_user')
            ->where('tbl_cuti.id_cuti', $id_cuti)
            ->first();
    }

    /**
     * Hapus cuti berdasarkan ID
     * @param int $id
     * @return bool
     */
    public function deleteData(int $id): bool
    {
        return $this->delete($id);
    }

    /**
     * Approve cuti oleh Supervisor
     * @param int $id_cuti
     * @return bool
     */
    public function approveCutiSpv(int $id_cuti): bool
    {
        return $this->update($id_cuti, ['status' => 'Supervisor']);
    }

    /**
     * Approve cuti oleh HRD
     * @param int $id_cuti
     * @return bool
     */
    public function approveCutiHRD(int $id_cuti): bool
    {
        return $this->update($id_cuti, ['status' => 'HRD']);
    }

    /**
     * Tolak cuti oleh Supervisor
     * @param int $id_cuti
     * @return bool
     */
    public function rejectSpv(int $id_cuti, $note): bool
    {
        return $this->update($id_cuti, ['status' => 'RejectSpv', 'note' => $note]);
    }

    /**
     * Tolak cuti oleh HRD
     * @param int $id_cuti
     * @return bool
     */
    public function rejectHRD(int $id_cuti): bool
    {
        return $this->update($id_cuti, ['status' => 'RejectHRD']);
    }
}
