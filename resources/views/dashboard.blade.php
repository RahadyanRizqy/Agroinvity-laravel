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
    <img src="/assets/img/logo2.png" width="50" height="50" alt=""><span>AGROINVITY</span>
  </a>
  <ul class="side-menu">
    <li><a href="{{ route('section.main')}} " class="active"><i class='bx bxs-dashboard icon' ></i>Dashboard</a></li>
    @if(Auth::user()->account_type_fk == 2)
    <li>
      <a href="#"><i class='bx bxs-data icon'></i> Pendataan<i class='bx bx-chevron-right icon-right'></i></a>
      <ul class="side-dropdown">
        <li><a href="{{ route('section.expenses', ["type_id" => 1]) }}"><i class="fa-solid fa-boxes-stacked icon"></i>Bahan Baku</a></li>
        <li><a href="{{ route('section.expenses', ["type_id" => 2]) }}"><i class="fa-solid fa-arrows-rotate icon"></i>Operasional</a></li>
        <li><a href="{{ route('section.production') }}"><i class="fa-solid fa-truck-ramp-box icon"></i>Produksi</a></li>
      </ul>
    </li>
    <li>
      <a href="#"><i class='bx bxs-data icon'></i> Pendataan <i class='bx bx-chevron-right icon-right' ></i></a>
      <ul class="side-dropdown">
        <li><a href="{{ route('section.expenses', ["type_id" => 1]) }}"><i class="fa-solid fa-boxes-stacked icon"></i>Bahan Baku</a></li>
        <li><a href="{{ route('section.expenses', ["type_id" => 2]) }}"><i class="fa-solid fa-arrows-rotate icon"></i>Operasional</a></li>
        <li><a href="{{ route('section.production') }}"><i class="fa-solid fa-truck-ramp-box icon"></i>Produksi</a></li>
      </ul>
    </li>
    <li><a href="{{ route('section.article') }}"><i class='bx bxs-book icon'></i>Artikel</a></li>
    <li><a href="{{ route('section.calculator') }}"><i class='bx bxs-calculator icon'></i> Kalkulator</a></li>
    <li><a href="{{ route('section.report') }}"><i class='bx bxs-report icon'></i> Laporan</a></li>
    @elseif(Auth::user()->account_type_fk == 3)
    <li>
      <a href="#"><i class='bx bxs-data icon'></i> Pendataan<i class='bx bx-chevron-right icon-right'></i></a>
      <ul class="side-dropdown">
        <li><a href="{{ route('section.expenses', ["type_id" => 1]) }}"><i class="fa-solid fa-boxes-stacked icon"></i>Bahan Baku</a></li>
        <li><a href="{{ route('section.expenses', ["type_id" => 2]) }}"><i class="fa-solid fa-arrows-rotate icon"></i>Operasional</a></li>
        <li><a href="{{ route('section.production') }}"><i class="fa-solid fa-truck-ramp-box icon"></i>Produksi</a></li>
      </ul>
    </li>
    <li>
      <a href="#"><i class='bx bxs-data icon'></i> Pendataan <i class='bx bx-chevron-right icon-right' ></i></a>
      <ul class="side-dropdown">
        <li><a href="{{ route('section.expenses', ["type_id" => 1]) }}"><i class="fa-solid fa-boxes-stacked icon"></i>Bahan Baku</a></li>
        <li><a href="{{ route('section.expenses', ["type_id" => 2]) }}"><i class="fa-solid fa-arrows-rotate icon"></i>Operasional</a></li>
        <li><a href="{{ route('section.production') }}"><i class="fa-solid fa-truck-ramp-box icon"></i>Produksi</a></li>
      </ul>
    </li>
    <li><a href="{{ route('section.article') }}"><i class='bx bxs-book icon'></i>Artikel</a></li>
    <li><a href="{{ route('section.calculator') }}"><i class='bx bxs-calculator icon'></i> Kalkulator</a></li>
    @else
    <li><a href="{{ route('accounts.index') }}"><i class='bx bxs-user-account icon'></i>Data Akun Mitra</a></li>
    <li><a href="{{ route('articles.index') }}"><i class='bx bxs-book icon'></i>Artikel</a></li>
    @endif

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
      <img src="/assets/img/account.png" alt="">
      <ul class="profile-link">
        <li><a href="{{ route('dashboard.profile')}}"><i class='bx bxs-user-circle icon' ></i> Profile</a></li>
        <!-- <li><a href="#"><i class='bx bxs-cog' ></i> Settings</a></li> -->
        <li><a href="{{ route('session.destroy')}}"><i class='bx bxs-log-out-circle' ></i> Logout</a></li>
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

<?php
$dates = [
    '2023-05-01 11:35:09',
    '2023-05-06 11:35:09',
    '2023-05-11 11:35:09',
    '2023-05-16 11:35:09',
    '2023-05-22 11:35:09',
    '2023-05-28 11:35:09',
    '2023-05-29 11:35:09',
    '2023-05-30 11:35:09',
];

$convertedDates = [];
foreach ($dates as $date) {
    $dateTime = new DateTime($date);
    $convertedDates[] = $dateTime->format('Y-m-d\TH:i:s.v\Z');
}
?>

<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script src="/js/dashboard.js"></script>
<script>
    var options = {
      series: [{
      name: 'pemasukan',
      data: <?php echo json_encode($data1, JSON_HEX_TAG); ?>
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
      // categories: ["2018-09-05T00:00:00.000Z", "2018-09-10T01:30:00.000Z", "2018-09-15T02:30:00.000Z", "2018-09-20T03:30:00.000Z", "2018-09-19T04:30:00.000Z", "2018-09-19T05:30:00.000Z", "2018-09-19T06:30:00.000Z"]
      categories: <?php echo json_encode($convertedDates, JSON_HEX_TAG); ?>
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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
    integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
    integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
</script>
<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
@endsection
{{-- Digunakan untuk Expenses --}}