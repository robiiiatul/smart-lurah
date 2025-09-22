<?php

namespace App\Models;

use CodeIgniter\Model;

class SeragamModel extends Model
{
    protected $table = 'tbl_seragam'; // Nama tabel
    protected $primaryKey = 'id_seragam'; // Primary key
    protected $allowedFields = [
        'id_user', 'status', 'keterangan'
    ]; // Kolom yang diizinkan untuk operasi CRUD

    /**
     * Simpan data seragam baru
     * @param array $data
     * @return bool
     */
    public function saveSeragam(array $data): bool
    {
        return $this->insert($data);
    }

    /**
     * Ambil semua data seragam dengan relasi ke user
     * @return array
     */
    public function getSeragam(): array
    {
        return $this->select('tbl_seragam.*, tbl_user.name as user_name, tbl_user.email as user_email')
            ->join('tbl_user', 'tbl_user.id_user = tbl_seragam.id_user')
            ->orderBy('tbl_seragam.id_seragam', 'DESC')
            ->findAll();
    }

    /**
     * Hapus seragam berdasarkan ID
     * @param int $id
     * @return bool
     */
    public function deleteSeragam(int $id): bool
    {
        return $this->delete($id);
    }

    /**
     * Approve permintaan seragam oleh Supervisor
     * @param int $id_seragam
     * @return bool
     */
    public function approveSpv(int $id_seragam): bool
    {
        return $this->update($id_seragam, ['status' => 'Supervisor']);
    }

    /**
     * Approve permintaan seragam oleh HRD
     * @param int $id_seragam
     * @return bool
     */
    public function approveHRD(int $id_seragam): bool
    {
        return $this->update($id_seragam, ['status' => 'HRD']);
    }

    /**
     * Tolak permintaan seragam oleh Supervisor
     * @param int $id_seragam
     * @return bool
     */
    public function rejectSpv(int $id_seragam): bool
    {
        return $this->update($id_seragam, ['status' => 'RejectSpv']);
    }

    /**
     * Tolak permintaan seragam oleh HRD
     * @param int $id_seragam
     * @return bool
     */
    public function rejectHRD(int $id_seragam): bool
    {
        return $this->update($id_seragam, ['status' => 'RejectHRD']);
    }
}
