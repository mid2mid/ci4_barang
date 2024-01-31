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
  <a class="nav-link" href="<?= url_to('admin.home.index') ?>">
    <i class="fas fa-fw fa-tachometer-alt"></i>
    <span>Dashboard</span></a>
</li>

<!-- Divider -->
<!-- <hr class="sidebar-divider"> -->

<li class="nav-item <?= $page == 'user_index' ? 'active' : '' ?>">
  <a class="nav-link" href="<?= url_to('admin.user.index') ?>">
    <i class="fas fa-user-friends"></i> <span>User</span></a>
</li>

<li class="nav-item <?= $page == 'profil' ? 'active' : '' ?>">
  <a class="nav-link" href="<?= url_to('admin.profil.index') ?>">
    <i class="fas fa-user-alt"></i> <span>Profil</span></a>
</li>