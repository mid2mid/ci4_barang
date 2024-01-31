<?php

namespace App\Controllers\Users;

use App\Controllers\BaseController;
use App\Models\CustomerModel;
use App\Models\UserModel;

class CustomerController extends BaseController
{
  private CustomerModel $cum;
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

    $this->cum = model(CustomerModel::class)->protect(false);
  }
  public function index()
  {
    $start = $this->request->getGet('start');
    $end = $this->request->getGet('end');
    $customer = $this->cum;
    if (!empty($start)) {
      $customer = $customer->where('created_at >=', $start);
    }
    if (!empty($end)) {
      $customer = $customer->where('created_at <=', $end);
    }
    $customer = $customer->findAll() ?? [];
    $data = [
      'page' => 'customer',
      'data' => $customer,
      'filter' => [
        'start' => $start,
        'end' => $end,
      ],
      'akun' => $this->akun,
      'message' => session()->getFlashData('response') ?? [],
    ];
    return view('users/customer', $data);
  }
  public function print()
  {
    $start = $this->request->getGet('start');
    $end = $this->request->getGet('end');
    $customer = $this->cum;
    if (!empty($start)) {
      $customer = $customer->where('created_at >=', $start);
    }
    if (!empty($end)) {
      $customer = $customer->where('created_at <=', $end);
    }
    $customer = $customer->findAll() ?? [];
    $data = [
      'page' => 'customer',
      'data' => $customer,
      'filter' => [
        'start' => $start,
        'end' => $end,
      ],
      'akun' => $this->akun,
      'message' => session()->getFlashData('response') ?? [],
    ];
    return view('users/customer_print', $data);
  }

  public function post()
  {
    $kode = $this->request->getPost('kode');
    $customer = $this->cum->where(['kode' => $kode])->first();
    if (!empty($customer)) {
      return redirect('user.customer.index')->with('response', ['status' => false, 'pesan' => 'kode customer sudah ada']);
    }
    $data = [
      'nama' => $this->request->getPost('nama'),
      'alamat' => $this->request->getPost('alamat'),
      'kode' => $kode,
    ];
    return $this->cum->save($data) ? redirect('user.customer.index')->with('response', ['status' => true, 'pesan' => 'berhasil menambahkan']) : redirect('user.customer.index')->with('response', ['status' => false, 'pesan' => 'gagal menambahkan']);
  }
  public function put()
  {
    $kode = $this->request->getPost('kode');
    $id = $this->request->getPost('id_customer');
    $customer = $this->cum->where(['id_customer' => $id])->first();
    if (empty($customer)) {
      return redirect('user.customer.index')->with('response', ['status' => false, 'pesan' => 'gagal mengubah']);
    }
    // if ($kode != $customer['kode']) {
    //   if (!empty($this->cum->where('kode', $kode)->first())) {
    //     return redirect('user.customer.index')->with('response', ['status' => false, 'pesan' => 'kode customer sudah ada']);
    //   }
    // }
    $data = [
      'id_customer' => $id,
      'nama' => $this->request->getPost('nama'),
      'alamat' => $this->request->getPost('alamat'),
      // 'kode' => $kode,
    ];
    return $this->cum->save($data) ? redirect('user.customer.index')->with('response', ['status' => true, 'pesan' => 'berhasil mengubah']) : redirect('user.customer.index')->with('response', ['status' => false, 'pesan' => 'gagal mengubah']);
  }
  public function delete()
  {
    $id = $this->request->getPost('id_customer');
    $customer = $this->cum->where(['id_customer' => $id])->first();
    if (empty($customer)) {
      return redirect('user.customer.index')->with('response', ['status' => false, 'pesan' => 'gagal menghapus']);
    }
    return $this->cum->delete($id) ? redirect('user.customer.index')->with('response', ['status' => true, 'pesan' => 'berhasil menghapus']) : redirect('user.customer.index')->with('response', ['status' => false, 'pesan' => 'gagal menghapus']);
  }
}