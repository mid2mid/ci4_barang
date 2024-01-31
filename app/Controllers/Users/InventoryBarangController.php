<?php

namespace App\Controllers\Users;

use App\Controllers\BaseController;
use App\Models\BarangModel;
use App\Models\BarangTransaksiModel;
use App\Models\CustomerModel;
use App\Models\UserModel;

class InventoryBarangController extends BaseController
{
  private BarangModel $bam;
  private BarangTransaksiModel $btm;
  private UserModel $usm;
  private array $akun;

  // private 
  public function __construct()
  {
    $this->usm = model(UserModel::class);
    helper('cookie');
    $kuki = get_cookie('user');
    $kuki = explode('_', $kuki, 2);
    $username = $kuki[0] ?? '';
    $this->akun = $this->usm->where('username', $username)->first() ?? [];

    $this->bam = model(BarangModel::class)->protect(false);
    $this->btm = model(BarangTransaksiModel::class)->protect(false);
  }
  public function index()
  {
    $start = $this->request->getGet('start');
    $end = $this->request->getGet('end');
    $barang = $this->bam;
    if (!empty($start)) {
      $barang = $barang->where('created_at >=', $start);
    }
    if (!empty($end)) {
      $barang = $barang->where('created_at <=', $end);
    }
    $barang = $barang->findAll() ?? [];
    $data = [
      'page' => 'inventory_barang',
      'data' => $barang,
      'filter' => [
        'start' => $start,
        'end' => $end,
      ],
      'akun' => $this->akun,
      'message' => session()->getFlashData('response') ?? [],
    ];
    return view('users/inventory_barang', $data);
  }
  public function print()
  {
    $start = $this->request->getGet('start');
    $end = $this->request->getGet('end');
    $barang = $this->bam;
    if (!empty($start)) {
      $barang = $barang->where('created_at >=', $start);
    }
    if (!empty($end)) {
      $barang = $barang->where('created_at <=', $end);
    }
    $barang = $barang->findAll() ?? [];
    $data = [
      'page' => 'inventory_barang',
      'data' => $barang,
      'filter' => [
        'start' => $start,
        'end' => $end,
      ],
      'akun' => $this->akun,
      'message' => session()->getFlashData('response') ?? [],
    ];
    return view('users/inventory_barang_print', $data);
  }

  public function post()
  {
    $kode = $this->request->getPost('kode');
    $barang = $this->bam->where(['kode' => $kode])->first();
    if (!empty($barang)) {
      return redirect('user.inventory.barang')->with('response', ['status' => false, 'pesan' => 'kode barang sudah ada']);
    }
    $data = [
      'nama' => $this->request->getPost('nama'),
      'deskripsi' => $this->request->getPost('deskripsi'),
      'kode' => $kode,
    ];
    return $this->bam->save($data) ? redirect('user.inventory.barang')->with('response', ['status' => true, 'pesan' => 'berhasil menambahkan']) : redirect('user.inventory.barang')->with('response', ['status' => false, 'pesan' => 'gagal menambahkan']);
  }
  public function put()
  {
    $kode = $this->request->getPost('kode');
    $id = $this->request->getPost('id_barang');
    $barang = $this->bam->where(['id_barang' => $id])->first();
    if (empty($barang)) {
      return redirect('user.inventory.barang')->with('response', ['status' => false, 'pesan' => 'gagal mengubah']);
    }
    // if ($kode != $barang['kode']) {
    //   if (!empty($this->bam->where('kode', $kode)->first())) {
    //     return redirect('user.inventory.barang')->with('response', ['status' => false, 'pesan' => 'kode customer sudah ada']);
    //   }
    // }
    $data = [
      'id_barang' => $id,
      'nama' => $this->request->getPost('nama'),
      'deskripsi' => $this->request->getPost('deskripsi'),
      // 'kode' => $kode,
    ];
    return $this->bam->save($data) ? redirect('user.inventory.barang')->with('response', ['status' => true, 'pesan' => 'berhasil mengubah']) : redirect('user.inventory.barang')->with('response', ['status' => false, 'pesan' => 'gagal mengubah']);
  }
  public function delete()
  {
    $id = $this->request->getPost('id_barang');
    $barang = $this->bam->where(['id_barang' => $id])->first();
    if (empty($barang)) {
      return redirect('user.inventory.barang')->with('response', ['status' => false, 'pesan' => 'gagal menghapus']);
    }
    return $this->bam->delete($id) ? redirect('user.inventory.barang')->with('response', ['status' => true, 'pesan' => 'berhasil menghapus']) : redirect('user.inventory.barang')->with('response', ['status' => false, 'pesan' => 'gagal menghapus']);
  }
  function keluar()
  {
    $id = $this->request->getPost('id_barang');
    $stok = $this->request->getPost('stok');
    $keterangan = $this->request->getPost('keterangan');
    $barang = $this->bam->where(['id_barang' => $id])->first();
    if (empty($barang)) {
      return redirect('user.inventory.barang')->with('response', ['status' => false, 'pesan' => 'gagal mengurangi stok']);
    }
    $jumlah = $barang['stok'] - $stok;
    // if ($jumlah < 0) {
    //   return redirect('user.inventory.barang')->with('response', ['status' => false, 'pesan' => 'jumlah stok tidak boleh < 0']);
    // }
    $data = [
      'id_barang' => $id,
      'stok' => $jumlah,
    ];
    $data2 = [
      'id_barang' => $id,
      'stok_akhir' => $jumlah,
      'stok_awal' => $barang['stok'],
      'jumlah' => $stok,
      'keterangan' => $keterangan,
      'tipe' => 'keluar',
    ];
    $this->btm->save($data2);
    return $this->bam->save($data) ? redirect('user.inventory.barang')->with('response', ['status' => true, 'pesan' => 'berhasil mengurangi stok']) : redirect('user.inventory.barang')->with('response', ['status' => false, 'pesan' => 'gagal mengurangi stok']);
  }
  function masuk()
  {
    $id = $this->request->getPost('id_barang');
    $stok = $this->request->getPost('stok');
    $keterangan = $this->request->getPost('keterangan');
    $barang = $this->bam->where(['id_barang' => $id])->first();
    if (empty($barang)) {
      return redirect('user.inventory.barang')->with('response', ['status' => false, 'pesan' => 'gagal menambahkan stok']);
    }
    $jumlah = $barang['stok'] + $stok;
    $data = [
      'id_barang' => $id,
      'stok' => $jumlah,
    ];
    $data2 = [
      'id_barang' => $id,
      'tipe' => 'masuk',
      'stok_akhir' => $jumlah,
      'stok_awal' => $barang['stok'],
      'jumlah' => $stok,
      'keterangan' => $keterangan,
    ];
    $this->btm->save($data2);
    return $this->bam->save($data) ? redirect('user.inventory.barang')->with('response', ['status' => true, 'pesan' => 'berhasil menambahkan stok']) : redirect('user.inventory.barang')->with('response', ['status' => false, 'pesan' => 'gagal menambahkan stok']);
  }

}