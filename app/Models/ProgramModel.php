<?php

namespace App\Models;

use CodeIgniter\Model;

class ProgramModel extends Model
{
    protected $table = 'program'; // Nama tabel
    protected $primaryKey = 'id_program'; // Primary key
    protected $allowedFields = [
        'id_user', 'judul', 'keterangan','picture'
    ]; // Kolom yang diizinkan untuk operasi CRUD

    /**
     * Simpan data user baru
     * @param array $data
     * @return bool
     */
    public function saveProgram(array $data): bool
    {
        return $this->insert($data);
    }

    /**
     * Ambil semua data Program
     * @return array
     */
    public function getProgram(): array
    {
        return $this->findAll();
    }

    /**
     * Ambil detail Program berdasarkan ID
     * @param int $id_Program
     * @return array|null
     */
    public function getProgramDetail(int $id_program): ?array
    {
        return $this->where('id_program', $id_program)->first();
    }

    /**
     * Update data user berdasarkan ID
     * @param array $data
     * @param int $id_program
     * @return bool
     */
    public function updateProgram(array $data, int $id_program): bool
    {
        return $this->update($id_program, $data);
    }

    /**
     * Hapus user berdasarkan ID
     * @param int $id
     * @return bool
     */
    public function deleteProgram(int $id): bool
    {
        return $this->delete($id);
    }

    /**
     * Ambil data user yang sedang login
     * @param int $id_program
     * @return array|null
     */
    public function getUserLogin(int $id_program): ?array
    {
        return $this->where('id_program', $id_program)->first();
    }

    /**
     * Hitung total cuti
     * @return int
     */
}
