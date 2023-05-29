@extends('master')

@section('title', 'Print to PDF')

@push('style')
  <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
@endpush

@php
$expenses = [];
// $incomes = [];
$lineChart = [];
$percentage = [];
$dates = [];
@endphp

@section('content')
<main class="main-report">
    <section class="report">
        <div class="row g-0 d-flex justify-content-center">
            <div class="col-md-2 g-0">
            </div>
            <div class="col-md-8 g-0">
                <div class="d-flex pt-2 pb-2 justify-content-center align-items-center">
                    <h3 class="text-center">Laporan PDF Tanggal 2023-05-27</h3>
                </div>
                <div class="d-flex justify-content-center align-items-center">
                    <table class="table table-bordered">
                        <tr>
                            <th colspan="1">Data</th>
                            <th colspan="6" class="text-center">Data Interval</th>
                        </tr>
                        <tr>
                            <th>Mingguan</th>
                            <td>Minggu ke-1</td>
                            <td>Minggu ke-2</td>
                            <td>Minggu ke-3</td>
                            <td>Minggu ke-4</td>
                            <td>Minggu ke-5</td>
                            <th class="text-center">Total</th>
                        </tr>
                        <tr>
                            <th>Pengeluaran</th>
                            @foreach ($expenses as $e)
                                <td>{{ $e }}</td>
                            @endforeach
                            <td>Omzet: {{ array_sum($expenses)}}</td>
                        </tr>
                        <tr>
                            <th>Pemasukan</th>
                            @foreach ($incomes as $i)
                                <td>{{ $i }}</td>
                            @endforeach
                            <td>Produksi: {{ array_sum($incomes)}}</td>
                        </tr>
                    </table>
                </div>

                <div class="content-data d-flex">
                    
                    <div class="container">
                        <div class="head d-flex justify-content-center">
                          <h3>Grafik Keuntungan</h3>
                        </div>
                        <div class="report">
                            <div id="report"></div>
                        </div>
                        <div class="head d-flex justify-content-center">
                            <h3 class="ml-5 text-center">Profitabilitas dan Prediksi</h3>
                        </div>
                        <p>Ini adalah prediksi sekitar 80%</p>
                    </div>


                    <div class="container d-flex flex-column">
                        <div class="head d-flex justify-content-center">
                            <h3 class="text-center">Prosentase Pendataan</h3>
                        </div>
                        <div class="circle-chart d-flex justify-content-center align-items-center">
                            <div id="cirlce-chart"></div>
                        </div>
                        <div class="head mt-5 d-flex justify-content-center">
                            <h3 class="mt-5 text-center">Profitabilitas</h3>
                        </div>
                        <p>Ini adalah prediksi sekitar 80%</p>
                    </div>
                </div>
            </div>
            <div class="col-md-2 g-0">
            </div>
        </div>
    </section>  
<?php  
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
    name: 'keuntungan',
    data: <?php echo json_encode($lineChart, JSON_HEX_TAG); ?>
    }],
        chart: {
        height: 300,
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
        categories: <?php echo json_encode($convertedDates, JSON_HEX_TAG); ?>,
    },
    tooltip: {
        x: {
        format: 'dd/MM/yy HH:mm'
        },
    },
};

var chart = new ApexCharts(document.querySelector("#report"), options);
chart.render();
</script>
<script>
var options = {
        series: <?php echo json_encode($convertedDates, JSON_HEX_TAG); ?>,
        chart: {
        width: 375,
        type: 'pie',
    },
    labels: ['Bahan Baku', 'Operasional', 'Produksi'],
    responsive: [{
        breakpoint: 480,
        options: {
        chart: {
            width: 200
        },
        legend: {
            position: 'bottom'
        }
        }
    }]
};

var chart = new ApexCharts(document.querySelector("#cirlce-chart"), options);
chart.render();
</script>
<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
  var element = document.querySelector('.apexcharts-toolbar');
  element.style.display = 'none';
});
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
</main>
@endsection