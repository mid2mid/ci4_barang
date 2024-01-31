<?php

namespace App\Controllers\Users;

use App\Controllers\BaseController;
use App\Models\UserModel;

class LoginController extends BaseController
{
  public function index(): string
  {
    $data = [
      'message' => session()->getFlashData('response') ?? [],
    ];
    // dd($data);
    return view('users/login', $data);
  }
  function post()
  {
    if (
      !$this->validate([
        'username' => 'required',
        'password' => 'required',
      ])
    ) {
      return redirect('user.login.index')->with('response', ['status' => 'error', 'pesan' => 'gagal login']);
    }
    $usm = model(UserModel::class)->protect(false);
    $username = $this->request->getPost('username');
    $password = $this->request->getPost('password');
    $user = $usm->where(['username' => $username, 'role' => 'user'])->first();
    if (empty($user)) {
      return redirect('user.login.index')->with('response', ['status' => 'error', 'pesan' => 'gagal login']);
    }
    if ($user['password'] != md5($password)) {
      return redirect('user.login.index')->with('response', ['status' => 'error', 'pesan' => 'gagal login']);
    }
    $token = rand(1000000, 99999999);
    $token = $user['username'] . '_' . $token;
    $data = [
      'id_user' => $user['id_user'],
      'token' => $token,
    ];
    // dd($data);
    return $usm->save($data) ? redirect('user.home.index')->setCookie('user', $token, 86400) : redirect('user.login.index')->with('response', ['status' => 'error', 'pesan' => 'gagal login']);
  }
  public function logout()
  {
    $token = rand(1000000, 99999999);
    return redirect('user.login.index')->setCookie('user', $token, 0);
  }
}