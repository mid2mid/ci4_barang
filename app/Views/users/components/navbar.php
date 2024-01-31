<!-- Sidebar - Brand -->
<a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
  <div class="sidebar-brand-icon rotate-n-15">
    <!-- <i class="fas fa-laugh-wink"></i> -->
  </div>
  <div class="sidebar-brand-text mx-3">PT. TEKKINDO CENTRADAYA</div>
</a>

<!-- Divider -->
<hr class="sidebar-divider my-0">

<!-- Nav Item - Dashboard -->
<li class="nav-item <?= $page == 'home' ? 'active' : '' ?>">
  <a class="nav-link" href="<?= url_to('user.home.index') ?>">
    <i class="fas fa-fw fa-tachometer-alt"></i>
    <span>Dashboard</span></a>
</li>

<!-- Divider -->
<!-- <hr class="sidebar-divider"> -->

<li class="nav-item <?= $page == 'customer' ? 'active' : '' ?>">
  <a class="nav-link" href="<?= url_to('user.customer.index') ?>">
    <i class="fas fa-user-friends"></i> <span>Customer</span></a>
</li>

<li class="nav-item <?= substr($page, 0, 9) == 'penjualan' ? 'active' : '' ?>">
  <a class="nav-link" href="#" data-toggle="collapse" data-target="#a1" aria-expanded="true" aria-controls="a1">
    <i class="fas fa-money-bill-alt"></i>
    Penjualan
  </a>
  <div id="a1" class="collapse <?= substr($page, 0, 9) == 'penjualan' ? 'show' : '' ?>" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
    <div class="bg-white py-2 collapse-inner rounded">
      <a class="collapse-item <?= $page == 'penjualan_index' ? 'active' : '' ?>" href="<?= url_to('user.penjualan.index') ?>">List</a>
      <a class="collapse-item <?= $page == 'penjualan_tambah' ? 'active' : '' ?>" href="<?= url_to('user.penjualan.tambah') ?>">Tambah</a>
    </div>
  </div>
</li>
<li class="nav-item <?= substr($page, 0, 9) == 'pembelian' ? 'active' : '' ?>">
  <a class="nav-link" href="#" data-toggle="collapse" data-target="#a3" aria-expanded="true" aria-controls="a3">
    <i class="fas fa-shopping-cart"></i>
    Pembelian
  </a>
  <div id="a3" class="collapse <?= substr($page, 0, 9) == 'pembelian' ? 'show' : '' ?>" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
    <div class="bg-white py-2 collapse-inner rounded">
      <a class="collapse-item <?= $page == 'pembelian_index' ? 'active' : '' ?>" href="<?= url_to('user.pembelian.index') ?>">List</a>
      <a class="collapse-item <?= $page == 'pembelian_tambah' ? 'active' : '' ?>" href="<?= url_to('user.pembelian.tambah') ?>">Tambah</a>
    </div>
  </div>
</li>

<li class="nav-item <?= substr($page, 0, 9) == 'inventory' ? 'active' : '' ?>">
  <a class="nav-link" href="#" data-toggle="collapse" data-target="#a2" aria-expanded="true" aria-controls="a2">
    <i class="fas fa-box-open"></i>
    Inventory
  </a>
  <div id="a2" class="collapse <?= substr($page, 0, 9) == 'inventory' ? 'show' : '' ?>" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
    <div class="bg-white py-2 collapse-inner rounded">
      <a class="collapse-item <?= $page == 'inventory_barang' ? 'active' : '' ?>" href="<?= url_to('user.inventory.barang') ?>">Barang</a>
      <a class="collapse-item <?= $page == 'inventory_transaksi' ? 'active' : '' ?>" href="<?= url_to('user.inventory.transaksi') ?>">Transaksi</a>
    </div>
  </div>
</li>

<li class="nav-item <?= $page == 'profil' ? 'active' : '' ?>">
  <a class="nav-link" href="<?= url_to('user.profil.index') ?>">
    <i class="fas fa-user-alt"></i> <span>Profil</span></a>
</li>