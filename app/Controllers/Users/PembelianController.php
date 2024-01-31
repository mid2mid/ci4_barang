<?php

namespace App\Controllers\Users;

use App\Controllers\BaseController;
use App\Models\BarangModel;
use App\Models\CustomerModel;
use App\Models\TransaksiItemModel;
use App\Models\TransaksiModel;
use App\Models\UserModel;

// use Config\Database;

class PembelianController extends BaseController
{
  private CustomerModel $cum;
  private TransaksiModel $trm;
  private TransaksiItemModel $tim;
  private UserModel $usm;
  private BarangModel $bam;
  private $dam;
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

    $this->cum = model(CustomerModel::class)->protect(false);
    $this->trm = model(TransaksiModel::class)->protect(false);
    $this->tim = model(TransaksiItemModel::class)->protect(false);
    $this->bam = model(BarangModel::class)->protect(false);
    $this->dam = \config\Database::connect();
  }
  public function index()
  {
    $start = $this->request->getGet('start');
    $end = $this->request->getGet('end');
    $penjualan = $this->trm;
    if (!empty($start)) {
      $penjualan = $penjualan->where('created_at >=', $start);
    }
    if (!empty($end)) {
      $penjualan = $penjualan->where('created_at <=', $end);
    }
    $penjualan = $penjualan->where('tipe', 'beli')->findAll() ?? [];
    foreach ($penjualan as $i => $v) {
      $penjualan[$i]['item'] = [];
      $item = $this->tim->where('id_transaksi', $v['id_transaksi'])->findAll() ?? [];
      foreach ($item as $i2 => $v2) {
        array_push($penjualan[$i]['item'], $v2);
      }
    }
    // dd($penjualan);
    $data = [
      'page' => 'pembelian_index',
      'data' => $penjualan,
      'akun' => $this->akun,
      'filter' => [
        'start' => $start,
        'end' => $end,
      ],
      'message' => session()->getFlashData('response') ?? [],
    ];
    return view('users/pembelian_index', $data);
  }
  public function print()
  {
    $start = $this->request->getGet('start');
    $end = $this->request->getGet('end');
    $penjualan = $this->trm;
    if (!empty($start)) {
      $penjualan = $penjualan->where('created_at >=', $start);
    }
    if (!empty($end)) {
      $penjualan = $penjualan->where('created_at <=', $end);
    }
    $penjualan = $penjualan->where('tipe', 'beli')->findAll() ?? [];
    foreach ($penjualan as $i => $v) {
      $penjualan[$i]['item'] = [];
      $item = $this->tim->where('id_transaksi', $v['id_transaksi'])->findAll() ?? [];
      foreach ($item as $i2 => $v2) {
        array_push($penjualan[$i]['item'], $v2);
      }
    }
    $data = [
      'page' => 'pembelian_index',
      'data' => $penjualan,
      'akun' => $this->akun,
      'filter' => [
        'start' => $start,
        'end' => $end,
      ],
      'message' => session()->getFlashData('response') ?? [],
    ];
    return view('users/pembelian_print', $data);
  }
  public function print2()
  {
    $id = $this->request->getGet('id');
    if (empty($id)) {
      return redirect()->back()->with('response', ['status' => false, 'pesan' => 'Data Not Found']);
    }
    $penjualan = $this->trm->where('id_transaksi', $id)->where('tipe', 'beli')->first() ?? [];
    if (!empty($penjualan)) {
      $penjualan['item'] = [];
      $item = $this->tim->where('id_transaksi', $penjualan['id_transaksi'])->findAll() ?? [];
      foreach ($item as $i2 => $v2) {
        array_push($penjualan['item'], $v2);
      }
    }
    $data = [
      'page' => 'pembelian_index',
      'data' => $penjualan,
      'akun' => $this->akun,
      'message' => session()->getFlashData('response') ?? [],
    ];
    // dd($data);
    return view('users/pembelian_print2', $data);
  }
  public function index2()
  {
    $data = [
      'page' => 'pembelian_tambah',
      'customer' => $this->cum->findAll() ?? [],
      'barang' => $this->bam->findAll() ?? [],
      'akun' => $this->akun,
      'date' => date('Y-m-d'),
      'message' => session()->getFlashData('response') ?? [],
    ];
    return view('users/pembelian_tambah', $data);
  }
  public function post()
  {
    $data = [
      'id_customer' => $this->request->getPost('id_customer'),
      'tipe' => 'beli',
      'kode' => '',
      'nama' => '',
      'faktur' => $this->request->getPost('faktur'),
      'faktur_tgl' => $this->request->getPost('faktur_tgl'),
      'po' => $this->request->getPost('po'),
      'alamat' => $this->request->getPost('alamat'),
      'subtotal' => 0,
      'ppn' => 0,
      'total' => 0,
    ];
    $barang = $this->request->getPost('id_barang');
    $keterangan = $this->request->getPost('keterangan');
    $jumlah = $this->request->getPost('jumlah');
    $harga = $this->request->getPost('harga');
    // $transaksi = $this->trm->where(['po' => $data['po']])->first();
    // if (!empty($transaksi)) {
    //   return redirect('user.pembelian.tambah')->with('response', ['status' => false, 'pesan' => 'No PO Sudah ada']);
    // }
    // $transaksi = $this->trm->where(['faktur' => $data['faktur']])->first();
    // if (!empty($transaksi)) {
    //   return redirect('user.pembelian.tambah')->with('response', ['status' => false, 'pesan' => 'Faktur Sudah ada']);
    // }
    $customer = $this->cum->where(['id_customer' => $data['id_customer']])->first();
    if (empty($customer)) {
      return redirect('user.pembelian.tambah')->with('response', ['status' => false, 'pesan' => 'Customer Not Found']);
    }
    $data['kode'] = $customer['kode'];
    $data['nama'] = $customer['nama'];
    $item = [];
    $qty = 0;
    // dd($data, $this->trm->getInsertID(), $this->trm->id);
    foreach ($barang as $i => $v) {
      $barang2 = $this->bam->where('id_barang', $v)->first();
      if (!empty($barang2)) {
        $harga1 = (int) $jumlah[$i] * (int) $harga[$i];
        $qty = $harga1 + $qty;
        array_push($item, [
          // 'id_transaksi' => ($this->trm->getInsertID() ?? 0) + 1,
          'id_barang' => $v,
          'nama' => $barang2['nama'],
          'kode' => $barang2['kode'],
          'jumlah' => $jumlah[$i],
          'harga' => $harga[$i],
          'keterangan' => $keterangan[$i],
        ]);
      }
    }
    $data['subtotal'] = $qty;
    $data['ppn'] = 0;
    $data['total'] = $data['subtotal'] + $data['ppn'];
    $this->trm->save($data);
    foreach ($item as $i => $v) {
      $item[$i]['id_transaksi'] = $this->trm->getInsertID();
    }
    return $this->tim->insertBatch($item) ? redirect('user.pembelian.tambah')->with('response', ['status' => true, 'pesan' => 'berhasil menambahkan']) : redirect('user.pembelian.tambah')->with('response', ['status' => false, 'pesan' => 'gagal menambahkan']);
  }
  public function put()
  {
    // $kode = $this->request->getPost('kode');
    // $id = $this->request->getPost('id_customer');
    // $customer = $this->cum->where(['id_customer' => $id])->first();
    // if (empty($customer)) {
    //   return redirect('user.customer.index')->with('response', ['status' => false, 'pesan' => 'gagal mengubah']);
    // }
    // if ($kode != $customer['kode']) {
    //   if (!empty($this->cum->where('kode', $kode)->first())) {
    //     return redirect('user.customer.index')->with('response', ['status' => false, 'pesan' => 'kode customer sudah ada']);
    //   }
    // }
    // $data = [
    //   'id_customer' => $id,
    //   'nama' => $this->request->getPost('nama'),
    //   'alamat' => $this->request->getPost('alamat'),
    //   'kode' => $kode,
    // ];
    // return $this->cum->save($data) ? redirect('user.customer.index')->with('response', ['status' => true, 'pesan' => 'berhasil mengubah']) : redirect('user.customer.index')->with('response', ['status' => false, 'pesan' => 'gagal mengubah']);
  }
  public function delete()
  {
    $id = $this->request->getPost('id_transaksi');
    $transaksi = $this->trm->where(['id_transaksi' => $id])->first();
    if (empty($transaksi)) {
      return redirect('user.pembelian.index')->with('response', ['status' => false, 'pesan' => 'gagal menghapus']);
    }
    return $this->trm->delete($id) ? redirect('user.pembelian.index')->with('response', ['status' => true, 'pesan' => 'berhasil menghapus']) : redirect('user.pembelian.index')->with('response', ['status' => false, 'pesan' => 'gagal menghapus']);
  }
}