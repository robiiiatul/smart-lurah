<?php

namespace App\Models;

use CodeIgniter\Model;

class CutiModel extends Model
{
    protected $table = 'tbl_cuti'; // Nama tabel
    protected $primaryKey = 'id_cuti'; // Primary key
    protected $allowedFields = [
        'id_user', 'date_from', 'date_until', 'keterangan', 'status', 'type', 'note'
    ]; // Kolom yang diizinkan untuk operasi CRUD

    /**
     * Simpan data cuti baru
     * @param array $data
     * @return bool
     */
    public function saveCuti(array $data): bool
    {
        return $this->insert($data);
    }
    
    public function updateCuti(array $data, int $id_cuti): bool
    {
        return $this->update($id_cuti, $data);
    }

    /**
     * Ambil semua data cuti dengan relasi ke user
     * @return array
     */
    public function getCuti(): array
    {
        return $this->select('tbl_cuti.*, tbl_user.name as user_name, tbl_user.email as user_email')
            ->join('tbl_user', 'tbl_user.id_user = tbl_cuti.id_user')
            ->orderBy('tbl_cuti.id_cuti','DESC')
            ->findAll();
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
    public function deleteCuti(int $id): bool
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
