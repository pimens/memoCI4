<?php

namespace App\Controllers;

use App\Models\UserModel;

class Sp extends BaseController
{
    protected $db;
    protected $session;
    protected $request;
    public function __construct()
    {
        $this->db = \Config\Database::connect();
        $this->session = session();
        $this->request = \Config\Services::request();
        echo view('supervisor/route');
    }
    public function index()
    {
        echo view('supervisor/beranda');
    }
    public function getDataPermohonan($jenis)
    {
        $id = $this->session->get('id');
        $data['permohonan'] = $this->db->query("select jenis,komentar,dd.nama as direktur,permohonan.id as id,nomor,user.nama as kepada,
		d.nama as dari,status,hal,tanggal,deskripsi 
		from permohonan,user,(select * from user) as d,(select * from user) as dd
		where d.id=permohonan.dari and kepada=$id and dd.id=permohonan.direktur and
		user.id=permohonan.kepada and permohonan.jenis=$jenis")->getResult();
        return view('supervisor/tabel', $data);
    }
    public function setStatusAction()
    {
        $builder = $this->db->table('permohonan');
        $newdata = [
            'komentar'  => $this->request->getVar('komentar'),
            'status'  =>  $this->request->getVar('status'),
        ];
        $builder->where('id',  $this->request->getVar('id'));
        $builder->update($newdata);
    }
    public function setStatus($id, $status)
    {
        $this->db->query("update permohonan 
        set status=$status where id=$id");
    }
    //============memo
    public function tabelMemo($id)
    {
        $data['permohonan'] = $this->db->query("select jenis,permohonan.kepada as kpd,permohonan.direktur as dir,d.nama as dari,
		dd.nama as direktur,status,permohonan.id as id,nomor,user.nama as kepada,hal,tanggal,
		deskripsi from permohonan,user,(select * from user) as d,(select * from user) as dd
		where permohonan.id=$id and user.id=permohonan.kepada and dd.id=permohonan.direktur
		and d.id=permohonan.dari")->getRow();
        echo view('supervisor/vmemo', $data);
    }
    public function getTabelDetail($id)
    {
        $data['memo'] = $this->db->query("select * 
		from memo where permohonan=$id order by id desc")->getResult();
        $data['permohonan'] = $this->db->query("select * 
		from permohonan where id=$id")->getRow();
        return view('supervisor/tabelDetail', $data);
    }
    //barang
    //barang=========================================================================================
    public function tabelBarang($id)
    {
        $data['permohonan'] = $this->db->query("select jenis,permohonan.kepada as kpd,permohonan.direktur as dir,d.nama as dari,
		dd.nama as direktur,status,permohonan.id as id,nomor,user.nama as kepada,hal,tanggal,
		deskripsi from permohonan,user,(select * from user) as d,(select * from user) as dd
		where permohonan.id=$id and user.id=permohonan.kepada and dd.id=permohonan.direktur
		and d.id=permohonan.dari")->getRow();
        echo view('supervisor/vbarang', $data);
    }
    public function getTabelBrgDetail($id)
    {
        $data['barang'] = $this->db->query("select * 
		from barang where permohonan=$id order by id desc")->getResult();
        $data['permohonan'] = $this->db->query("select * 
		from permohonan where id=$id")->getRow();
        return view('supervisor/tabelbrg', $data);
    }
}
