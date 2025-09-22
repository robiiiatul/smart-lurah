<?php

namespace App\Models;

use CodeIgniter\Model;

class TimeslipModel extends Model
{
    protected $table = 'tbl_timeslip'; // Nama tabel
    protected $primaryKey = 'id_timeslip'; // Primary key
    protected $allowedFields = [
        'id_user', 'keterangan', 'status', 'type', 'date_from', 'date_until', 'jam_mulai', 'jam_selesai','bukti'
    ]; // Kolom yang diizinkan untuk operasi CRUD

    /**
     * Simpan data timeslip baru
     * @param array $data
     * @return bool
     */
    public function saveTimeslip(array $data): bool
    {
        return $this->insert($data);
    }

    /**
     * Ambil semua data timeslip dengan relasi ke user
     * @return array
     */
    public function getTimeslip(): array
    {
        return $this->select('tbl_timeslip.*, tbl_user.name as user_name, tbl_user.email as user_email')
            ->join('tbl_user', 'tbl_user.id_user = tbl_timeslip.id_user')
            ->orderBy('tbl_timeslip.id_timeslip','DESC')
            ->findAll();
    }

    /**
     * Ambil detail timeslip berdasarkan ID
     * @param int $id_timeslip
     * @return ?array
     */
    public function getTimeslipDetail(int $id_timeslip): ?array
    {
        return $this->select('tbl_timeslip.*, tbl_user.name as user_name, tbl_user.email as user_email')
            ->join('tbl_user', 'tbl_user.id_user = tbl_timeslip.id_user')
            ->where('tbl_timeslip.id_timeslip', $id_timeslip)
            ->first();
    }

    /**
     * Hapus timeslip berdasarkan ID
     * @param int $id
     * @return bool
     */
    public function deleteTimeslip(int $id): bool
    {
        return $this->delete($id);
    }

    /**
     * Approve timeslip oleh Supervisor
     * @param int $id_timeslip
     * @return bool
     */
    public function approveSpv(int $id_timeslip): bool
    {
        return $this->update($id_timeslip, ['status' => 'Supervisor']);
    }

    /**
     * Approve timeslip oleh HRD
     * @param int $id_timeslip
     * @return bool
     */
    public function approveHRD(int $id_timeslip): bool
    {
        return $this->update($id_timeslip, ['status' => 'HRD']);
    }

    /**
     * Tolak timeslip oleh Supervisor
     * @param int $id_timeslip
     * @return bool
     */
    public function rejectSpv(int $id_timeslip): bool
    {
        return $this->update($id_timeslip, ['status' => 'RejectSpv']);
    }

    /**
     * Tolak timeslip oleh HRD
     * @param int $id_timeslip
     * @return bool
     */
    public function rejectHRD(int $id_timeslip): bool
    {
        return $this->update($id_timeslip, ['status' => 'RejectHRD']);
    }
}
