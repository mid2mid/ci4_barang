<?php
namespace App\Filters;

use App\Models\UserModel;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class UserFilter implements FilterInterface
{
  public function before(RequestInterface $request, $arguments = null)
  {

    $gm = model(UserModel::class);
    helper('cookie');

    $kuki1 = get_cookie('user');
    $kuki = explode('_', $kuki1, 2);
    $username = $kuki[0] ?? '';
    $token = $kuki[1] ?? '';
    $akun = $gm->where(['username' => $username, 'token' => $kuki1, 'role' => 'user'])->first() ?? [];
    // dd($akun, $token);
    // dd($akun);
    if (empty($akun)) {
      return redirect('user.login.index');
    }
  }

  //--------------------------------------------------------------------

  public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
  {
    // Do something here
  }
}