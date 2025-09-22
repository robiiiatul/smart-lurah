<?php

namespace App\Models;

use CodeIgniter\Model;

class M_login extends Model
{
    protected $table = 'user'; // Nama tabel
    protected $primaryKey = 'id_user'; // Primary key tabel
    protected $allowedFields = [
        'name', 'username', 'password', 'role'
    ]; // Kolom yang diizinkan untuk diisi

    /**
     * Mengecek login berdasarkan username dan password
     */
    public function cek_users($username, $password)
    {
        $user = $this->where('username', $username)->first();
        // $user = $this->db->table('tbl_user')->where('username', $username)->get()->getRow();

        if ($user && $password == $user['password']) {
        // if ($user && password_verify($password, $user['password'])) {
            return $user;
        }

        return false;
    }

    /**
     * Aturan validasi untuk pendaftaran user
     */
    public function rules_user()
    {
        return [
            'nama'     => 'required|trim',
            'username' => 'required|trim|min_length[5]',
            'password' => 'required|min_length[8]',
        ];
    }

    /**
     * Menyimpan data user baru
     */
    public function saveUser($data)
    {
        $folderPath = WRITEPATH . 'uploads/'; // Direktori untuk menyimpan file tanda tangan
        if (empty($data['ttd'])) {
            return false;
        }

        $image_parts = explode(";base64,", $data['ttd']);
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];
        $image_base64 = base64_decode($image_parts[1]);
        $fileName = uniqid() . '.' . $image_type;
        $filePath = $folderPath . $fileName;

        // Simpan file tanda tangan
        file_put_contents($filePath, $image_base64);
        $data['ttd'] = 'uploads/' . $fileName;

        // Tambahkan kolom default
        $data['tgl_register'] = date('Y-m-d');
        $data['is_active'] = 'no';
        $data['id_role'] = 2;

        return $this->insert($data);
    }

    /**
     * Mengecek user berdasarkan NIP
     */
    public function cek_user($nip)
    {
        return $this->where('nip', $nip)->first();
    }

    /**
     * Memperbarui password user
     */
    public function updatePass($nip, $newPassword)
    {
        $data = [
            'password' => password_hash($newPassword, PASSWORD_DEFAULT), // Hash password untuk keamanan
        ];

        return $this->update(['nip' => $nip], $data);
    }
}
