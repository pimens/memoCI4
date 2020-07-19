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
		// echo view('pemohon/route');
	}
	public function index()
	{
		echo view('pemohon/route');
		$data['user'] = $this->db->query("select * from user")->getResult();
		echo view('pemohon/beranda', $data);
	}
	public function getDataPermohonan($jenis)
	{
		$id = $this->session->get('id');
		$data['brg'] = $this->db->query("select permohonan.jenis as jenis,komentar,dd.nama as direktur,permohonan.id as id,nomor,user.nama as kepada,
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
	public function edit($id)
	{
		$builder = $this->db->table('permohonan');
		$builder->where('id', $id);
		$permohonan = $builder->get()->getRowArray();
		echo json_encode($permohonan);
	}
	public function actionEdit($id)
	{
		// // echo $id . $this->request->getVar('nomor');
		// $data = $this->request->getRawInput();
		// echo $data
		$builder = $this->db->table('permohonan');
		$newdata = [
			'nomor'  => $this->request->getVar('nomor'),
			'tanggal'  => $this->request->getVar('tanggal'),
			'kepada'  => $this->request->getVar('kepada'),
			'direktur'  => $this->request->getVar('direktur'),
			'hal'  => $this->request->getVar('hal'),
			'deskripsi'  => $this->request->getVar('deskripsi'),
			'jenis'  => $this->request->getVar('jenis'),
			'dari'  => $this->session->get('id'),
		];
		$builder->where('id', $id);
		$builder->update($newdata);
	}
	//memoooooooooooooooooooooooooooooooooooooo====================================================================
	public function tabelMemo($id)
	{
		$data['permohonan'] = $this->db->query("select jenis,permohonan.kepada as kpd,permohonan.direktur as dir,d.nama as dari,
		dd.nama as direktur,status,permohonan.id as id,nomor,user.nama as kepada,hal,tanggal,
		deskripsi from permohonan,user,(select * from user) as d,(select * from user) as dd
		where permohonan.id=$id and user.id=permohonan.kepada and dd.id=permohonan.direktur
		and d.id=permohonan.dari")->getRow();
		echo view('pemohon/route');
		echo view('pemohon/vmemo', $data);
	}
	public function getTabelDetail($id)
	{
		$data['memo'] = $this->db->query("select * 
		from memo where permohonan=$id order by id desc")->getResult();
		$data['permohonan'] = $this->db->query("select * 
		from permohonan where id=$id")->getRow();
		return view('pemohon/tabelDetail', $data);
	}
	public function memoEdit($id)
	{
		$builder = $this->db->table('memo');
		$builder->where('id', $id);
		$memo = $builder->get()->getRowArray();
		echo json_encode($memo);
	}
	public function memoInsert()
	{
		$newdata = [
			'desa'  => $this->request->getVar('desa'),
			'setoran'  => $this->request->getVar('setoran'),
			'fee'  => $this->request->getVar('fee'),
			'bendahara'  => $this->request->getVar('bendahara'),
			'norekening'  => $this->request->getVar('norekening'),
			'permohonan'  => $this->request->getVar('id'),
		];
		$builder = $this->db->table('memo');
		$builder->insert($newdata);
	}
	public function memoActionEdit($id)
	{
		$builder = $this->db->table('memo');
		$newdata = [
			'desa'  => $this->request->getVar('desa'),
			'setoran'  => $this->request->getVar('setoran'),
			'fee'  => $this->request->getVar('fee'),
			'bendahara'  => $this->request->getVar('bendahara'),
			'norekening'  => $this->request->getVar('norekening'),
		];
		$builder->where('id', $id);
		$builder->update($newdata);
	}
	public function memoDelete($id)
	{
		$builder = $this->db->table('memo');
		$builder->where('id', $id);
		$builder->delete();
		echo json_encode(array("status" => TRUE));
	}
	//barang=========================================================================================
	public function tabelBarang($id)
	{
		$data['permohonan'] = $this->db->query("select jenis,permohonan.kepada as kpd,permohonan.direktur as dir,d.nama as dari,
		dd.nama as direktur,status,permohonan.id as id,nomor,user.nama as kepada,hal,tanggal,
		deskripsi from permohonan,user,(select * from user) as d,(select * from user) as dd
		where permohonan.id=$id and user.id=permohonan.kepada and dd.id=permohonan.direktur
		and d.id=permohonan.dari")->getRow();
		echo view('pemohon/route');
		echo view('pemohon/vbarang', $data);
	}
	public function getTabelBrgDetail($id)
	{
		$data['barang'] = $this->db->query("select * 
		from barang where permohonan=$id order by id desc")->getResult();
		$data['permohonan'] = $this->db->query("select * 
		from permohonan where id=$id")->getRow();
		return view('pemohon/tabelbrg', $data);
	}
	public function barangInsert()
	{
		$newdata = [
			'nama_barang'  => $this->request->getVar('nama_barang'),
			'permohonan'  => $this->request->getVar('permohonan'),
			'satuan'  => $this->request->getVar('satuan'),
			'unit'  => $this->request->getVar('unit'),
			'harga'  => $this->request->getVar('harga'),
			'keterangan'  => $this->request->getVar('keterangan'),
		];
		$builder = $this->db->table('barang');
		$builder->insert($newdata);
	}
	public function barangEdit($id)
	{
		$builder = $this->db->table('barang');
		$builder->where('id', $id);
		$barang = $builder->get()->getRowArray();
		echo json_encode($barang);
	}
	public function barangActionEdit($id)
	{
		// echo "ddddddddddd";
		$builder = $this->db->table('barang');
		$newdata = [
			'nama_barang'  => $this->request->getVar('nama_barang'),
			'satuan'  => $this->request->getVar('satuan'),
			'unit'  => $this->request->getVar('unit'),
			'harga'  => $this->request->getVar('harga'),
			'keterangan'  => $this->request->getVar('keterangan'),
		];
		$builder->where('id', $id);
		$builder->update($newdata);
		// dd($newdata);
		// echo $id . $newdata['unit'];
	}
	public function barangDelete($id)
	{
		$builder = $this->db->table('barang');
		$builder->where('id', $id);
		$builder->delete();
		echo json_encode(array("status" => TRUE));
	}
}
