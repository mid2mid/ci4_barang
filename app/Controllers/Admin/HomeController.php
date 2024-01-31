<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\BarangModel;
use App\Models\BarangTransaksiModel;
use App\Models\TransaksiModel;
use App\Models\UserModel;

class HomeController extends BaseController
{
  private UserModel $usm;
  private array $akun;
  function __construct()
  {
    $this->usm = model(UserModel::class);
    helper('cookie');
    $kuki = get_cookie('admin');
    $kuki = explode('_', $kuki, 2);
    $username = $kuki[0] ?? '';
    $this->akun = $this->usm->where('username', $username)->first() ?? [];
  }
  public function index()
  {
    $dm1 = strtotime('now');
    $dm2 = strtotime('-1 month');
    $dm3 = strtotime('-2 month');
    $trm = model(TransaksiModel::class);
    $bam = model(BarangTransaksiModel::class);
    $nama1 = date('F', $dm1);
    $nama2 = date('F', $dm2);
    $nama3 = date('F', $dm3);
    $pembelian1 = $trm->where('created_at >=', date('Y-m-01', $dm1))->where('created_at <=', date('Y-m-t', $dm1))->where('tipe', 'beli')->findAll() ?? [];
    $pembelian2 = $trm->where('created_at >=', date('Y-m-01', $dm2))->where('created_at <=', date('Y-m-t', $dm2))->where('tipe', 'beli')->findAll() ?? [];
    $pembelian3 = $trm->where('created_at >=', date('Y-m-01', $dm3))->where('created_at <=', date('Y-m-t', $dm3))->where('tipe', 'beli')->findAll() ?? [];
    $penjualan1 = $trm->where('created_at >=', date('Y-m-01', $dm1))->where('created_at <=', date('Y-m-t', $dm1))->where('tipe', 'jual')->findAll() ?? [];
    $penjualan2 = $trm->where('created_at >=', date('Y-m-01', $dm2))->where('created_at <=', date('Y-m-t', $dm2))->where('tipe', 'jual')->findAll() ?? [];
    $penjualan3 = $trm->where('created_at >=', date('Y-m-01', $dm3))->where('created_at <=', date('Y-m-t', $dm3))->where('tipe', 'jual')->findAll() ?? [];
    $masuk1 = $bam->where('created_at >=', date('Y-m-01', $dm1))->where('created_at <=', date('Y-m-t', $dm1))->where('tipe', 'masuk')->findAll() ?? [];
    $masuk2 = $bam->where('created_at >=', date('Y-m-01', $dm2))->where('created_at <=', date('Y-m-t', $dm2))->where('tipe', 'masuk')->findAll() ?? [];
    $masuk3 = $bam->where('created_at >=', date('Y-m-01', $dm3))->where('created_at <=', date('Y-m-t', $dm3))->where('tipe', 'masuk')->findAll() ?? [];
    $keluar1 = $bam->where('created_at >=', date('Y-m-01', $dm1))->where('created_at <=', date('Y-m-t', $dm1))->where('tipe', 'keluar')->findAll() ?? [];
    $keluar2 = $bam->where('created_at >=', date('Y-m-01', $dm2))->where('created_at <=', date('Y-m-t', $dm2))->where('tipe', 'keluar')->findAll() ?? [];
    $keluar3 = $bam->where('created_at >=', date('Y-m-01', $dm3))->where('created_at <=', date('Y-m-t', $dm3))->where('tipe', 'keluar')->findAll() ?? [];
    $data = [
      'barang_masuk' => count($bam->where('created_at >=', date('Y-m-01', $dm1))->where('created_at <=', date('Y-m-t', $dm1))->where('tipe', 'masuk')->findAll() ?? []),
      'barang_keluar' => count($bam->where('created_at >=', date('Y-m-01', $dm1))->where('created_at <=', date('Y-m-t', $dm1))->where('tipe', 'keluar')->findAll() ?? []),
      'pembelian' => count($pembelian1),
      'penjualan' => count($penjualan1),
      'chart' => [
        'pembelian' => [
          'bulan1' => count($pembelian1),
          'nama1' => $nama1,
          'bulan2' => count($pembelian2),
          'nama2' => $nama2,
          'bulan3' => count($pembelian3),
          'nama3' => $nama3,
        ],
        'penjualan' => [
          'bulan1' => count($penjualan1),
          'nama1' => $nama1,
          'bulan2' => count($penjualan2),
          'nama2' => $nama2,
          'bulan3' => count($penjualan3),
          'nama3' => $nama3,
        ],
        'masuk' => [
          'bulan1' => count($masuk1),
          'nama1' => $nama1,
          'bulan2' => count($masuk2),
          'nama2' => $nama2,
          'bulan3' => count($masuk3),
          'nama3' => $nama3,
        ],
        'keluar' => [
          'bulan1' => count($keluar1),
          'nama1' => $nama1,
          'bulan2' => count($keluar2),
          'nama2' => $nama2,
          'bulan3' => count($keluar3),
          'nama3' => $nama3,
        ],
      ]
    ];
    // dd($data);
    $data = [
      'page' => 'home',
      'akun' => $this->akun,
      'data' => $data,
      'message' => session()->getFlashData('response') ?? [],
    ];
    // dd($data);
    return view('admin/home', $data);
  }
}