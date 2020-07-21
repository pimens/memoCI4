<?php

namespace App\Controllers;

class User extends BaseController
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
        // $id = $this->session->get('id');
        // $query = $this->db->query("select * from user where id=$id")->getRow();
        // $ses = [
        //     'username'  => $query['nama'],
        //     'email'  => $query['email'],
        //     'id'  => $query['id'],
        //     'level'     => $query['level'],
        //     'login' => TRUE
        // ];
        // $this->session->set($ses);
        echo view('profil');
    }
    public function getUser()
    {
        $id = $this->session->get('id');
        $data = $this->db->query("select * from user where id=$id")->getRow();
        echo json_encode($data);
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
}
