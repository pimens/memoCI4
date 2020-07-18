<?php

namespace App\Controllers;

use App\Models\UserModel;

class Home extends BaseController
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
		$data['user'] = $this->db->query("select * from user")->getResult();
		echo view('pemohon/route');
		echo view('pemohon/beranda', $data);
	}
	public function getDataPermohonan($jenis)
	{
		$id = $this->session->get('id');
		$data['brg'] = $this->db->query("select komentar,dd.nama as direktur,permohonan.id as id,nomor,user.nama as kepada,
		d.nama as dari,status,hal,tanggal,deskripsi 
		from permohonan,user,(select * from user) as d,(select * from user) as dd 
		where dd.id=permohonan.direktur and permohonan.jenis=$jenis and
		dari=$id and d.id=permohonan.dari and user.id=permohonan.kepada")->getResult();
		return view('pemohon/tabel', $data);
	}
	public function insert()
	{
		$newdata = [
			'nomor'  => $this->request->getVar('nomor'),
			'tanggal'  => $this->request->getVar('tanggal'),
			'kepada'  => $this->request->getVar('kepada'),
			'direktur'  => $this->request->getVar('direktur'),
			'hal'  => $this->request->getVar('hal'),
			'deskripsi'  => $this->request->getVar('deskripsi'),
			'jenis'  => $this->request->getVar('jenis'),
			'jenis'  => $this->request->getVar('jenis'),
			'dari'  => $this->session->get('id'),
		];
		$builder = $this->db->table('permohonan');
		$builder->insert($newdata);
	}
	public function delete($id)
	{
		$builder = $this->db->table('permohonan');
		$builder->where('id', $id);
		$builder->delete();
		echo json_encode(array("status" => TRUE));
	}
	public function tes()
	{
		$model = new UserModel();
		$user = $model->getNews();
		dd($user);
		$nomor = $this->request->getVar('nomor');
		$file = $this->request->getFile('file');
		echo $file->getName();
		$file->move('data/');
	}
	//--------------------------------------------------------------------

}
