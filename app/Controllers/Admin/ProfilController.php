<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\BarangModel;
use App\Models\BarangTransaksiModel;
use App\Models\CustomerModel;
use App\Models\UserModel;

class ProfilController extends BaseController
{
  private BarangModel $bam;
  private BarangTransaksiModel $btm;
  private UserModel $usm;
  private array $akun;

  // private 
  public function __construct()
  {
    $this->usm = model(UserModel::class)->protect(false);
    helper('cookie');
    $kuki = get_cookie('admin');
    $kuki = explode('_', $kuki, 2);
    $username = $kuki[0] ?? '';
    $this->akun = $this->usm->where('username', $username)->first() ?? [];

    $this->bam = model(BarangModel::class)->protect(false);
    $this->btm = model(BarangTransaksiModel::class)->protect(false);
  }
  public function index()
  {
    $data = [
      'page' => 'profil',
      'data' => $this->akun,
      'akun' => $this->akun,
      'message' => session()->getFlashData('response') ?? [],
    ];
    return view('admin/profil', $data);
  }
  public function post()
  {
    $id = $this->request->getPost('id_user');
    if (empty($id)) {
      return redirect('admin.profil.index')->with('response', ['status' => false, 'pesan' => 'gagal simpan']);
    }
    $user = $this->usm->where(['id_user' => $id])->first();
    if (empty($user)) {
      return redirect('admin.profil.index')->with('response', ['status' => false, 'pesan' => 'data not found']);
    }
    $filepath = $user['gambar'];
    $img = $this->request->getFile('gambar');
    // dd($img);
    if ($img->getError() == 0) {
      if (!$img->hasMoved()) {
        $random = $img->getRandomName();
        $img->move('uploads/admin', $random);
        $filepath = '/uploads/admin/' . $random;
      } else {
        return redirect('admin.profil.index')->with('response', ['status' => false, 'pesan' => 'gagal simpan']);
      }
    }
    $data = [
      'id_user' => $id,
      'nama' => $this->request->getPost('nama'),
      'gambar' => $filepath,
    ];
    $pass = $this->request->getPost('password');
    if (!empty($pass)) {
      $data['password'] = md5($pass);
    }
    // dd($data);
    return $this->usm->save($data) ? redirect('admin.profil.index')->with('response', ['status' => true, 'pesan' => 'berhasil simpan']) : redirect('admin.profil.index')->with('response', ['status' => false, 'pesan' => 'gagal simpan']);
  }
}