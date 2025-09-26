<?php

namespace App\Models;

use CodeIgniter\Model;

class AdminModel extends Model
{
    protected $table = 'user'; // Nama tabel
    protected $primaryKey = 'id_user'; // Primary key
    protected $allowedFields = [
        'name', 'username', 'password', 'jabatan','no_hp','email','nik','penetapan_sk','tgl_sk','jmlh_insentif','no_rek','rt','rw','picture'
    ]; // Kolom yang diizinkan untuk operasi CRUD

    /**
     * Simpan data user baru
     * @param array $data
     * @return bool
     */
    public function saveUser(array $data): bool
    {
        return $this->insert($data);
    }

    /**
     * Ambil semua data user
     * @return array
     */
    public function getUser(): array
    {
        return $this->findAll();
    }

    /**
     * Ambil detail user berdasarkan ID
     * @param int $id_user
     * @return array|null
     */
    public function getUserDetail(int $id_user): ?array
    {
        return $this->where('id_user', $id_user)->first();
    }

    /**
     * Update data user berdasarkan ID
     * @param array $data
     * @param int $id_user
     * @return bool
     */
    public function updateUser(array $data, int $id_user): bool
    {
        return $this->update($id_user, $data);
    }

    /**
     * Hapus user berdasarkan ID
     * @param int $id
     * @return bool
     */
    public function deleteUser(int $id): bool
    {
        return $this->delete($id);
    }

    /**
     * Ambil data user yang sedang login
     * @param int $id_user
     * @return array|null
     */
    public function getUserLogin(int $id_user): ?array
    {
        return $this->where('id_user', $id_user)->first();
    }

    /**
     * Hitung total cuti
     * @return int
     */
    public function countprofile(): int
    {
        return $this->db->table('tbl_user')->countAllResults();
    }
    
    public function countcuti(): int
    {
        return $this->db->table('tbl_cuti')->countAllResults();
    }
    
    public function counttimeslip(): int
    {
        return $this->db->table('tbl_timeslip')->countAllResults();
    }
    
    public function countseragam(): int
    {
        return $this->db->table('tbl_seragam')->countAllResults();
    }

    public function updateSisaCuti(int $id_user, $sisa_cuti): bool
    {
        return $this->update($id_user, ['sisa_cuti' => $sisa_cuti]);
    }
}
