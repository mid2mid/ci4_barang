<?php

namespace App\Controllers\Users;

use App\Controllers\BaseController;
use App\Models\BarangModel;
use App\Models\BarangTransaksiModel;
use App\Models\CustomerModel;
use App\Models\UserModel;

class InventoryTransaksiController extends BaseController
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
    $barang = $this->btm;
    $db = \Config\Database::connect();
    $barang = $db->table('barang_transaksi as bt')->select('bt.*, b.kode, b.nama')->join('barang as b', 'b.id_barang = bt.id_barang')->where('b.deleted_at =', null)->where('bt.deleted_at =', null);
    if (!empty($start)) {
      $barang = $barang->where('bt.created_at >=', $start);
    }
    if (!empty($end)) {
      $barang = $barang->where('bt.created_at <=', $end);
    }
    $barang = $barang->get()->getResultArray() ?? [];
    $data = [
      'page' => 'inventory_transaksi',
      'data' => $barang,
      'filter' => [
        'start' => $start,
        'end' => $end,
      ],
      'akun' => $this->akun,
      'message' => session()->getFlashData('response') ?? [],
    ];
    return view('users/inventory_transaksi', $data);
  }
  public function print()
  {
    $start = $this->request->getGet('start');
    $end = $this->request->getGet('end');
    $db = \Config\Database::connect();
    $barang = $db->table('barang_transaksi as bt')->select('bt.*, b.kode, b.nama')->join('barang as b', 'b.id_barang = bt.id_barang')->where('b.deleted_at =', null)->where('bt.deleted_at =', null);
    if (!empty($start)) {
      $barang = $barang->where('bt.created_at >=', $start);
    }
    if (!empty($end)) {
      $barang = $barang->where('bt.created_at <=', $end);
    }
    $barang = $barang->get()->getResultArray() ?? [];
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
    return view('users/inventory_transaksi_print', $data);
  }
}