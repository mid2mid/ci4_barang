<?= $this->extend('admin/components/master') ?>

<?= $this->section('content') ?>
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
</div>

<!-- Content Row -->
<div class="row">

  <!-- Earnings (Monthly) Card Example -->
  <div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-primary shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
              Penjualan ( bulan ini )</div>
            <div class="h5 mb-0 font-weight-bold text-gray-800">
              <?= $data['penjualan'] ?? 0 ?>
            </div>
          </div>
          <div class="col-auto">
            <!-- <i class="fas fa-calendar fa-2x text-gray-300"></i> -->
            <i class="fas fa-money-bill-alt fa-2x text-gray-300"></i>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Earnings (Monthly) Card Example -->
  <div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-success shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
              Pembelian</div>
            <div class="h5 mb-0 font-weight-bold text-gray-800">
              <?= $data['pembelian'] ?? 0 ?>
            </div>
          </div>
          <div class="col-auto">
            <!-- <i class="fas fa-dollar-sign fa-2x text-gray-300"></i> -->
            <i class="fas fa-shopping-cart fa-2x text-gray-300"></i>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Earnings (Monthly) Card Example -->
  <div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-info shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Barang Masuk ( Bulan Ini )
            </div>
            <div class="row no-gutters align-items-center">
              <div class="col-auto">
                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                  <?= $data['barang_masuk'] ?>
                </div>
              </div>
            </div>
          </div>
          <div class="col-auto">
            <i class="fas fa-plus fa-2x text-gray-300"></i>
            <!-- <i class="fas fa-clipboard-list fa-2x text-gray-300"></i> -->
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Pending Requests Card Example -->
  <div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-warning shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
              Barang Keluar ( Bulan Ini )</div>
            <div class="h5 mb-0 font-weight-bold text-gray-800">
              <?= $data['barang_keluar'] ?>
            </div>
          </div>
          <div class="col-auto">
            <i class="fas fa-minus fa-2x text-gray-300"></i>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Content Row -->

<div class="row">
  <div class="col-6">
    <canvas id="stackedBarChart1" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
  </div>
  <div class="col-6">
    <canvas id="stackedBarChart2" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
  </div>
</div>
<?= $this->endSection('content') ?>

<?= $this->section('footer') ?>
<!-- ChartJS -->
<script src="/plugins/chart.js/Chart.min.js"></script>

<script>
  var areaChartData = {
    labels: ['<?= $data['chart']['pembelian']['nama3'] ?>', '<?= $data['chart']['pembelian']['nama2'] ?>', '<?= $data['chart']['pembelian']['nama1'] ?>'],
    datasets: [{
      label: 'Pembelian',
      backgroundColor: 'rgba(60,141,188,0.9)',
      borderColor: 'rgba(60,141,188,0.8)',
      pointRadius: false,
      pointColor: '#3b8bba',
      pointStrokeColor: 'rgba(60,141,188,1)',
      pointHighlightFill: '#fff',
      pointHighlightStroke: 'rgba(60,141,188,1)',
      data: [<?= $data['chart']['pembelian']['bulan3'] ?>, <?= $data['chart']['pembelian']['bulan2'] ?>, <?= $data['chart']['pembelian']['bulan1'] ?>]
    },
    {
      label: 'Penjualan',
      backgroundColor: 'rgba(210, 214, 222, 1)',
      borderColor: 'rgba(210, 214, 222, 1)',
      pointRadius: false,
      pointColor: 'rgba(210, 214, 222, 1)',
      pointStrokeColor: '#c1c7d1',
      pointHighlightFill: '#fff',
      pointHighlightStroke: 'rgba(220,220,220,1)',
      data: [<?= $data['chart']['penjualan']['bulan3'] ?>, <?= $data['chart']['penjualan']['bulan2'] ?>, <?= $data['chart']['penjualan']['bulan1'] ?>]
    },
    ]
  }
  var areaChartData2 = {
    labels: ['<?= $data['chart']['masuk']['nama3'] ?>', '<?= $data['chart']['masuk']['nama2'] ?>', '<?= $data['chart']['masuk']['nama1'] ?>'],
    datasets: [{
      label: 'Barang Masuk',
      backgroundColor: 'rgba(60,141,188,0.9)',
      borderColor: 'rgba(60,141,188,0.8)',
      pointRadius: false,
      pointColor: '#3b8bba',
      pointStrokeColor: 'rgba(60,141,188,1)',
      pointHighlightFill: '#fff',
      pointHighlightStroke: 'rgba(60,141,188,1)',
      data: [<?= $data['chart']['masuk']['bulan3'] ?>, <?= $data['chart']['masuk']['bulan2'] ?>, <?= $data['chart']['masuk']['bulan1'] ?>]
    },
    {
      label: 'Barang Keluar',
      backgroundColor: 'rgba(210, 214, 222, 1)',
      borderColor: 'rgba(210, 214, 222, 1)',
      pointRadius: false,
      pointColor: 'rgba(210, 214, 222, 1)',
      pointStrokeColor: '#c1c7d1',
      pointHighlightFill: '#fff',
      pointHighlightStroke: 'rgba(220,220,220,1)',
      data: [<?= $data['chart']['keluar']['bulan3'] ?>, <?= $data['chart']['keluar']['bulan2'] ?>, <?= $data['chart']['keluar']['bulan1'] ?>]
    },
    ]
  }


  //---------------------
  //- BAR CHART -
  //---------------------
  var barChartCanvas = $('#stackedBarChart1').get(0).getContext('2d')
  var barChartData = $.extend(true, {}, areaChartData)
  var temp0 = areaChartData.datasets[0]
  var temp1 = areaChartData.datasets[1]
  barChartData.datasets[0] = temp1
  barChartData.datasets[1] = temp0

  var barChartOptions = {
    responsive: true,
    maintainAspectRatio: false,
    datasetFill: false
  }

  new Chart(barChartCanvas, {
    type: 'bar',
    data: barChartData,
    options: barChartOptions
  })
  var barChartCanvas2 = $('#stackedBarChart2').get(0).getContext('2d')
  var barChartData2 = $.extend(true, {}, areaChartData2)
  var temp0 = areaChartData2.datasets[0]
  var temp1 = areaChartData2.datasets[1]
  barChartData2.datasets[0] = temp1
  barChartData2.datasets[1] = temp0

  var barChartOptions = {
    responsive: true,
    maintainAspectRatio: false,
    datasetFill: false
  }

  new Chart(barChartCanvas2, {
    type: 'bar',
    data: barChartData2,
    options: barChartOptions
  })
</script>
<?= $this->endSection('footer') ?>