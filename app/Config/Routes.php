<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

// $routes->group('user', [], function ($routes) {
// });
$routes->get('user/login', [\App\Controllers\Users\LoginController::class, 'index'], ['as' => 'user.login.index']);
$routes->post('user/login', [\App\Controllers\Users\LoginController::class, 'post']);
$routes->get('user/logout', [\App\Controllers\Users\LoginController::class, 'logout'], ['as' => 'user.login.logout']);

$routes->get('admin/login', [\App\Controllers\Admin\LoginController::class, 'index'], ['as' => 'admin.login.index']);
$routes->post('admin/login', [\App\Controllers\Admin\LoginController::class, 'post']);
$routes->get('admin/logout', [\App\Controllers\Admin\LoginController::class, 'logout'], ['as' => 'admin.login.logout']);

// ADMIN
$routes->group('admin', ['filter' => 'admin'], function ($routes) {
  $routes->get('home', [\App\Controllers\Admin\HomeController::class, 'index'], ['as' => 'admin.home.index']);
  // admin guru
  $routes->get('user', [\App\Controllers\Admin\UserController::class, 'index'], ['as' => 'admin.user.index']);
  $routes->get('user/tambah', [\App\Controllers\Admin\UserController::class, 'tambah'], ['as' => 'admin.user.tambah']);
  $routes->post('user/tambah', [\App\Controllers\Admin\UserController::class, 'post']);
  $routes->get('user/update', [\App\Controllers\Admin\UserController::class, 'update'], ['as' => 'admin.user.update']);
  $routes->post('user/update', [\App\Controllers\Admin\UserController::class, 'put']);
  $routes->post('user/delete', [\App\Controllers\Admin\UserController::class, 'delete'], ['as' => 'admin.user.delete']);
  $routes->post('user/reset', [\App\Controllers\Admin\UserController::class, 'reset'], ['as' => 'admin.user.reset']);
  //  Profil
  $routes->get('profil', [\App\Controllers\Admin\ProfilController::class, 'index'], ['as' => 'admin.profil.index']);
  $routes->post('profil', [\App\Controllers\Admin\ProfilController::class, 'post']);

  // admin siswa
  // $routes->get('siswa', [\App\Controllers\Admin\SiswaController::class, 'index'], ['as' => 'admin.siswa.index']);
  // $routes->get('siswa/tambah', [\App\Controllers\Admin\SiswaController::class, 'tambah'], ['as' => 'admin.siswa.tambah']);
  // $routes->post('siswa/tambah', [\App\Controllers\Admin\SiswaController::class, 'post']);
  // $routes->get('siswa/update', [\App\Controllers\Admin\SiswaController::class, 'update'], ['as' => 'admin.siswa.update']);
  // $routes->post('siswa/update', [\App\Controllers\Admin\SiswaController::class, 'put']);
  // $routes->post('siswa/delete', [\App\Controllers\Admin\SiswaController::class, 'delete'], ['as' => 'admin.siswa.delete']);
  // $routes->post('siswa/reset', [\App\Controllers\Admin\SiswaController::class, 'reset'], ['as' => 'admin.siswa.reset']);
  // // admin siswa
  // $routes->get('kelas', [\App\Controllers\Admin\KelasController::class, 'index'], ['as' => 'admin.kelas.index']);
  // $routes->get('kelas/tambah', [\App\Controllers\Admin\KelasController::class, 'tambah'], ['as' => 'admin.kelas.tambah']);
  // $routes->post('kelas/tambah', [\App\Controllers\Admin\KelasController::class, 'post']);
  // $routes->get('kelas/update', [\App\Controllers\Admin\KelasController::class, 'update'], ['as' => 'admin.kelas.update']);
  // $routes->post('kelas/update', [\App\Controllers\Admin\KelasController::class, 'put']);
  // $routes->post('kelas/delete', [\App\Controllers\Admin\KelasController::class, 'delete'], ['as' => 'admin.kelas.delete']);
  // // admin siswa
  // $routes->get('pelajaran', [\App\Controllers\Admin\PelajaranController::class, 'index'], ['as' => 'admin.pelajaran.index']);
  // $routes->get('pelajaran/tambah', [\App\Controllers\Admin\PelajaranController::class, 'tambah'], ['as' => 'admin.pelajaran.tambah']);
  // $routes->post('pelajaran/tambah', [\App\Controllers\Admin\PelajaranController::class, 'post']);
  // $routes->get('pelajaran/update', [\App\Controllers\Admin\PelajaranController::class, 'update'], ['as' => 'admin.pelajaran.update']);
  // $routes->post('pelajaran/update', [\App\Controllers\Admin\PelajaranController::class, 'put']);
  // $routes->post('pelajaran/delete', [\App\Controllers\Admin\PelajaranController::class, 'delete'], ['as' => 'admin.pelajaran.delete']);
});


$routes->group('user', ['filter' => 'user'], function ($routes) {
  // home
  $routes->get('home', [\App\Controllers\Users\HomeController::class, 'index'], ['as' => 'user.home.index']);
  // $routes->get('home', [\App\Controllers\Users\HomeController::class, 'index'], ['as' => 'user.customer.index']);
  // Customer
  $routes->get('customer', [\App\Controllers\Users\CustomerController::class, 'index'], ['as' => 'user.customer.index']);
  $routes->get('customer/print', [\App\Controllers\Users\CustomerController::class, 'print'], ['as' => 'user.customer.print']);
  $routes->post('customer', [\App\Controllers\Users\CustomerController::class, 'post']);
  $routes->put('customer', [\App\Controllers\Users\CustomerController::class, 'put']);
  $routes->delete('customer', [\App\Controllers\Users\CustomerController::class, 'delete']);
  // Penjualan
  $routes->get('penjualan', [\App\Controllers\Users\PenjualanController::class, 'index'], ['as' => 'user.penjualan.index']);
  $routes->get('penjualan/tambah', [\App\Controllers\Users\PenjualanController::class, 'index2'], ['as' => 'user.penjualan.tambah']);
  $routes->get('penjualan/print', [\App\Controllers\Users\PenjualanController::class, 'print'], ['as' => 'user.penjualan.print']);
  $routes->get('penjualan/print-single', [\App\Controllers\Users\PenjualanController::class, 'print2'], ['as' => 'user.penjualan.print2']);
  $routes->post('penjualan/tambah', [\App\Controllers\Users\PenjualanController::class, 'post']);
  $routes->put('penjualan', [\App\Controllers\Users\PenjualanController::class, 'put']);
  $routes->delete('penjualan', [\App\Controllers\Users\PenjualanController::class, 'delete']);
  // Pembelian
  $routes->get('pembelian', [\App\Controllers\Users\PembelianController::class, 'index'], ['as' => 'user.pembelian.index']);
  $routes->get('pembelian/tambah', [\App\Controllers\Users\PembelianController::class, 'index2'], ['as' => 'user.pembelian.tambah']);
  $routes->get('pembelian/print', [\App\Controllers\Users\PembelianController::class, 'print'], ['as' => 'user.pembelian.print']);
  $routes->get('pembelian/print-single', [\App\Controllers\Users\PembelianController::class, 'print2'], ['as' => 'user.pembelian.print2']);
  $routes->post('pembelian/tambah', [\App\Controllers\Users\PembelianController::class, 'post']);
  $routes->put('pembelian', [\App\Controllers\Users\PembelianController::class, 'put']);
  $routes->delete('pembelian', [\App\Controllers\Users\PembelianController::class, 'delete']);
  // inventory barang
  $routes->get('inventory/barang', [\App\Controllers\Users\InventoryBarangController::class, 'index'], ['as' => 'user.inventory.barang']);
  $routes->get('inventory/barang/print', [\App\Controllers\Users\InventoryBarangController::class, 'print'], ['as' => 'user.inventory.barang.print']);
  $routes->post('inventory/barang/masuk', [\App\Controllers\Users\InventoryBarangController::class, 'masuk'], ['as' => 'user.inventory.barang.masuk']);
  $routes->post('inventory/barang/keluar', [\App\Controllers\Users\InventoryBarangController::class, 'keluar'], ['as' => 'user.inventory.barang.keluar']);
  $routes->post('inventory/barang', [\App\Controllers\Users\InventoryBarangController::class, 'post']);
  $routes->put('inventory/barang', [\App\Controllers\Users\InventoryBarangController::class, 'put']);
  $routes->delete('inventory/barang', [\App\Controllers\Users\InventoryBarangController::class, 'delete']);
  //  inventory transaksi
  $routes->get('inventory/transaksi', [\App\Controllers\Users\InventoryTransaksiController::class, 'index'], ['as' => 'user.inventory.transaksi']);
  $routes->get('inventory/transaksi/print', [\App\Controllers\Users\InventoryTransaksiController::class, 'print'], ['as' => 'user.inventory.transaksi.print']);
  //  Profil
  $routes->get('profil', [\App\Controllers\Users\ProfilController::class, 'index'], ['as' => 'user.profil.index']);
  $routes->post('profil', [\App\Controllers\Users\ProfilController::class, 'post']);

  // $routes->get('penjualan', [\App\Controllers\Users\HomeController::class, 'index'], ['as' => 'user.data.penjualan']);
});