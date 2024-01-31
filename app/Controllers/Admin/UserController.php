<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UserModel;

class UserController extends BaseController
{
  // private $am;
  private $sm;
  private $akun;
  function __construct()
  {
    // $this->am = model(AdminModel::class);
    $this->sm = model(UserModel::class);
    $this->sm = $this->sm->protect(false);
    helper('cookie');

    $kuki = get_cookie('admin');
    $kuki = explode('_', $kuki, 2);
    $username = $kuki[0] ?? '';
    $this->akun = $this->sm->where('username', $username)->first() ?? [];
  }
  public function index(): string
  {
    $siswa = $this->sm->where('id_user !=', 1)->findAll();
    $data = [
      'akun' => $this->akun,
      'data' => $siswa,
      'page' => 'user_index',
      'message' => session()->getFlashData('response') ?? [],
    ];
    // dd($data);
    return view('admin/user', $data);
  }
  public function tambah(): string
  {
    // $guru = $this->sm->findAll();
    $data = [
      'akun' => $this->akun,
      // 'data' => $guru,
      'page' => 'user_tambah',
      'message' => session()->getFlashData('response') ?? [],
    ];
    // dd($data);
    return view('admin/user_tambah', $data);
  }
  function post()
  {
    $username = $this->request->getPost('username');
    $role = $this->request->getPost('role');
    $siswa = $this->sm->where(['username' => $username, 'role' => $role])->first();
    if (!empty($siswa)) {
      return redirect('admin.user.tambah')->with('response', ['status' => false, 'pesan' => 'Username sudah terdaftar']);
    }
    $filepath = '#';
    $img = $this->request->getFile('gambar');
    if (!$img->hasMoved()) {
      $random = $img->getRandomName();
      $img->move('uploads/admin', $random);
      $filepath = '/uploads/admin/' . $random;
    } else {
      return redirect('admin.user.tambah')->with('response', ['status' => false, 'pesan' => 'gagal daftar']);
    }
    $data = [
      'nama' => $this->request->getPost('nama'),
      'username' => $this->request->getPost('username'),
      'role' => $this->request->getPost('role'),
      'gambar' => $filepath,
      'password' => md5('initial'),
    ];
    // dd($data);
    return $this->sm->save($data) ? redirect('admin.user.tambah')->with('response', ['status' => true, 'pesan' => 'berhasil tambah']) : redirect('admin.user.tambah')->with('response', ['status' => false, 'pesan' => 'gagal tambah']);
  }

  public function update()
  {
    $id = $this->request->getGet('id');
    if (empty($id)) {
      return redirect('admin.user.index');
    }
    $siswa = $this->sm->where('id_user', $id)->first();
    if (empty($siswa)) {
      return redirect('admin.user.index');
    }
    $data = [
      'akun' => $this->akun,
      'data' => $siswa,
      'page' => 'user_update',
      'message' => session()->getFlashData('response') ?? [],
    ];
    return view('admin/user_update', $data);
  }
  function put()
  {
    $id = $this->request->getPost('id_user');
    if (empty($id)) {
      return redirect()->back()->with('response', ['status' => false, 'pesan' => 'gagal mengupdate']);
    }
    $siswa = $this->sm->where(['id_user' => $id])->first();
    if (empty($siswa)) {
      return redirect()->back()->with('response', ['status' => false, 'pesan' => 'data not found']);
    }
    $filepath = $siswa['gambar'];
    $img = $this->request->getFile('gambar');
    // dd($img->getError());
    if ($img->getError() == 0) {
      if (!$img->hasMoved()) {
        $random = $img->getRandomName();
        $img->move('uploads/' . $siswa['role'], $random);
        $filepath = `/uploads/` . $siswa['role'] . '/' . $random;
      } else {
        return redirect()->back()->with('response', ['status' => false, 'pesan' => 'gagal daftar']);
      }
    }
    $data = [
      'id_user' => $id,
      'nama' => $this->request->getPost('nama'),
      'gambar' => $filepath,
    ];
    // dd($data);
    return $this->sm->save($data) ? redirect()->back()->with('response', ['status' => true, 'pesan' => 'berhasil update']) : redirect()->back()->with('response', ['status' => false, 'pesan' => 'gagal update']);
  }

  function delete()
  {
    $id = $this->request->getPost('id_user');
    if (empty($id)) {
      return redirect('admin.user.index')->with('response', ['status' => false, 'pesan' => 'gagal menghapus']);
    }
    $siswa = $this->sm->where(['id_user' => $id])->first();
    if (empty($siswa)) {
      return redirect('admin.user.index')->with('response', ['status' => false, 'pesan' => 'data not found']);
    }
    return $this->sm->delete($id) ? redirect('admin.user.index')->with('response', ['status' => true, 'pesan' => 'berhasil hapus']) : redirect('admin.user.index')->with('response', ['status' => false, 'pesan' => 'gagal hapus']);
  }

  function reset()
  {

    $id = $this->request->getPost('id_user');
    if (empty($id)) {
      return redirect('admin.user.index')->with('response', ['status' => false, 'pesan' => 'gagal reset']);
    }
    $siswa = $this->sm->where(['id_user' => $id])->first();
    if (empty($siswa)) {
      return redirect('admin.user.index')->with('response', ['status' => false, 'pesan' => 'data not found']);
    }
    $data = [
      'id_user' => $siswa['id_user'],
      'password' => md5('initial'),
    ];
    return $this->sm->save($data) ? redirect('admin.user.index')->with('response', ['status' => true, 'pesan' => 'berhasil reset']) : redirect('admin.user.index')->with('response', ['status' => false, 'pesan' => 'gagal reset']);
  }
}