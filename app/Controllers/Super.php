<?php

namespace App\Controllers;

use App\Models\UserModel;

class Super extends BaseController
{
    protected $db;
    protected $session;
    protected $request;
    public function __construct()
    {
        $this->db = \Config\Database::connect();
        $this->session = session();
        $this->request = \Config\Services::request();
        // echo view('direksi/route');
    }
    public function index()
    {
        echo view('superadmin/route');
        echo view('superadmin/beranda');
    }
    public function user()
    {
        echo view('superadmin/route');
        echo view('superadmin/user');
    }
    public function getDataPermohonan()
    {
        $data['permohonan'] = $this->db->query("
		select jenis,komentar,dd.nama as direktur,permohonan.id as id,nomor,user.nama as kepada,
		d.nama as dari,status,hal,tanggal,deskripsi 
		from permohonan,user,(select * from user) as d,(select * from user) as dd
		where d.id=permohonan.dari and dd.id=permohonan.direktur and
        user.id=permohonan.kepada")->getResult();
        return view('superadmin/tabel', $data);
    }
    public function update()
    {
        $builder = $this->db->table('user');
        $id = $this->session->get('id');
        $p = md5($this->request->getVar('password'));
        $l = $this->request->getVar('lama');
        if ($p == md5("Password Baru")) {
            $p = $l;
        }
        $newdata = [
            'nama'  => $this->request->getVar('nama'),
            'lokasi'  => $this->request->getVar('lokasi'),
            'email'  => $this->request->getVar('email'),
            'jabatan'  => $this->request->getVar('jabatan'),
            'password'  =>  $p,
        ];
        $builder->where('id',  $id);
        $builder->update($newdata);
        $query = $this->db->query("select * from user where id=$id")->getRow();
        $ses = [
            'username'  => $query->nama,
            'email'  => $query->email,
            'id'  => $query->id,
            'level'     => $query->level,
            'login' => TRUE
        ];
        $this->session->set($ses);
    }
    public function insert()
    {
        $builder = $this->db->table('user');
        $p = md5($this->request->getVar('nama'));
        $newdata = [
            'nama'  => $this->request->getVar('nama'),
            'level'  => $this->request->getVar('level'),
            'password'  =>  $p,
        ];
        $builder->insert($newdata);
    }
    public function deleteUser($id)
    {
        $builder = $this->db->table('user');
        $builder->where('id', $id);
        $builder->delete();
        echo json_encode(array("status" => TRUE));
    }
    public function getDataUser()
    {
        $data['user'] = $this->db->query("select * from user")->getResult();
        echo view('superadmin/tabelUser', $data);
    }
}
