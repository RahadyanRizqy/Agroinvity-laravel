@extends('master')

@if ($section == 'article')
  @section('title', 'Dashboard | Article')
@elseif ($section == 'calculator')
  @section('title', 'Dashboard | Calculator')
@elseif ($section == 'report')
  @section('title', 'Dashboard | Report')
@else
  @section('title', 'Dashboard')
@endif

@push('style')
  <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
  <link rel="stylesheet" href="{{ asset('fontawesome6/css/fontawesome.css') }}">
  <link rel="stylesheet" href="{{ asset('fontawesome6/css/brand.css') }}">
  <link rel="stylesheet" href="{{ asset('fontawesome6/css/solid.css') }}">
@endpush

@section('content')
<section id="sidebar">
  <a href="#" class="brand"> 
    <img src="assets/img/logo2.png" width="50" height="50" alt=""><span>AGROINVITY</span>
  </a>
  <ul class="side-menu">
    <li><a href="dashboard" class="active"><i class='bx bxs-dashboard icon' ></i> Dashboard</a></li>
    <li>
      <a href="#"><i class='bx bxs-data icon'></i> Pendataan <i class='bx bx-chevron-right icon-right' ></i></a>
      <ul class="side-dropdown">
        <li><a href="dashboard?section=material"><i class="fa-solid fa-boxes-stacked icon"></i>Bahan Baku</a></li>
        <li><a href="dashboard?section=operational"><i class="fa-solid fa-arrows-rotate icon"></i>Operasional</a></li>
        <li><a href="dashboard?section=production"><i class="fa-solid fa-truck-ramp-box icon"></i>Produksi</a></li>
      </ul>
    </li>
    <li><a href="dashboard?section=article"><i class='bx bxs-book icon'></i>Artikel</a></li>
    <li><a href="dashboard?section=calculator"><i class='bx bxs-calculator icon'></i> Kalkulator</a></li>
    <li><a href="dashboard?section=report"><i class='bx bxs-report icon'></i> Laporan</a></li>
  </ul>
</section>
<!-- SIDEBAR -->

<!-- NAVBAR -->
<section id="content">
  <!-- NAVBAR -->
  <nav>
    <i class='bx bx-menu toggle-sidebar' ></i>
    <form action="#">
      <div class="form-group d-none">
        <input type="text" placeholder="Search...">
        <i class='bx bx-search icon' ></i>
      </div>
    </form>
    <div class="profile">
      <img src="assets/img/pm.png" alt="">
      <ul class="profile-link">
        <li><a href="#"><i class='bx bxs-user-circle icon' ></i> Profile</a></li>
        <!-- <li><a href="#"><i class='bx bxs-cog' ></i> Settings</a></li> -->
        <li><a href="#"><i class='bx bxs-log-out-circle' ></i> Logout</a></li>
      </ul>
    </div>
  </nav>
  <!-- NAVBAR -->

  <!-- MAIN -->
  @if ($section)
    @include('section/'.$section)
  {{-- @elseif ($section == 'calculator')
    @include('section/calculator')
  @elseif ($section == 'report')
    @include('section/report') --}}
  @else
    @include('section/main')
  @endif
  <!-- MAIN -->
</section>
<!-- NAVBAR -->

{{-- {{ $data = [20, 40, 28, 51, 42, 109, 100]; }}
{!! $dataStringArray = array_map('strval', $data); !!}
{!! $dataJson = json_encode($data); !!} --}}

@php 
  $data1 = [20, 40, 28, 51, 42, 109, 100]; 
  $data2 = [11, 32, 45, 32, 34, 52, 41];
@endphp

<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script src="js/dashboard.js"></script>
<script>
    var options = {
      series: [{
      name: 'pemasukan',
      data: <?php echo json_encode($data1, JSON_HEX_TAG); ?>
    }, {
      name: 'pengeluaran',
      data: <?php echo json_encode($data2, JSON_HEX_TAG); ?>
    }],
      chart: {
      height: 350,
      type: 'area'
    },
    dataLabels: {
      enabled: false
    },
    stroke: {
      curve: 'smooth'
    },
    xaxis: {
      type: 'datetime',
      categories: ["2018-09-19T00:00:00.000Z", "2018-09-19T01:30:00.000Z", "2018-09-19T02:30:00.000Z", "2018-09-19T03:30:00.000Z", "2018-09-19T04:30:00.000Z", "2018-09-19T05:30:00.000Z", "2018-09-19T06:30:00.000Z"]
    },
    tooltip: {
      x: {
        format: 'dd/MM/yy HH:mm'
      },
    },
    };

    var chart = new ApexCharts(document.querySelector("#chart"), options);
    chart.render();
</script>
@endsection

{{-- Digunakan untuk Expenses --}}