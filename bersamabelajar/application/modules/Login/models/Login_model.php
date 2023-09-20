<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Login_model extends CI_Model
{
    //cek nip dan password dosen
    function auth_admin($username, $password)
    {
        $query = $this->db->query("SELECT * FROM si_users WHERE email='$username' AND password='$password' LIMIT 1");
        return $query;
    }

    //cek nim dan password mahasiswa
    function auth_guru($username, $password)
    {
        $query = $this->db->query("SELECT * FROM si_guru WHERE nip='$username' AND password='$password' LIMIT 1");
        return $query;
    }

    function auth_siswa($username, $password)
    {
        $query = $this->db->query("SELECT * FROM si_siswa WHERE nis='$username' AND password='$password' LIMIT 1");
        return $query;
    }
}
