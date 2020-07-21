<?php

namespace App\Controllers;

class Auth extends BaseController
{
    protected $db;
    protected $session;
    protected $request;
    public function __construct()
    {
        $this->db = \Config\Database::connect();
        $this->session = session();
        $this->request = \Config\Services::request();
    }
    public function index()
    {
        echo view('log');
    }
    public function login()
    {
        $nama = $this->request->getVar('nama');;
        $password = md5($this->request->getVar('password'));
        $query = $this->db->query("select * from user where nama='$nama' 
        and password='$password'")->getRowArray();
        if (!$query) {
            $this->session->setFlashdata('msg', '<div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <strong>Gagal Login!</strong>
            </div>');
            return redirect()->to('/auth'); //langsung /auth/red ==== //   auth/red jadi auth/auth/red
        } else {
            $ses = [
                'username'  => $query['nama'],
                'email'  => $query['email'],
                'id'  => $query['id'],
                'level'     => $query['level'],
                'login' => TRUE
            ];
            $this->session->set($ses);
            return redirect()->to('/Home'); //langsung /auth/red ==== //   auth/red jadi auth/auth/red
        }
    }
    public function inserData()
    {
        $newdata = [
            'email'  => $this->request->getVar('email'),
            'password'  => md5($this->request->getVar('password')),

        ];
        $builder = $this->db->table('user');
        $builder->insert($newdata);
    }
    public function data()
    {
        // $this->session->setFlashdata('item', 'value');
        $newdata = [
            'username'  => 'johndoe',
            'email'     => 'johndoe@some-site.com',
            'logged_in' => TRUE
        ];
        $this->session->set($newdata);
        $query = $this->db->query("select * from user where nama='superadmin'")->getRowArray();
        $data = [
            'title' => 'My title',
            'name'  => 'My Name',
            'date'  => 'My date'
        ];
        $builder = $this->db->table('user');
        $builder->insert($data);
        // dd($query);
        // echo $query['nama'];
    }
    public function load()
    {
        //check data login
        if ($this->session->has('username')) {
            echo "DD";
        } else {
            echo "XXX";
        }
        echo $this->session->get('username');
    }
    public function logout()
    {
        $this->session->destroy();
        return redirect()->to('/'); //langsung /auth/red ==== //   auth/red jadi auth/auth/red

    }
    public function red()
    {
        echo "qqqqqqqq";
    }
    //--------------------------------------------------------------------

}
