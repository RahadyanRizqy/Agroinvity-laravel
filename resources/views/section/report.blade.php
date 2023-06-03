@php
// $expenses = [];
// $incomes = [];
if (count($lineChart) == 1) {
    array_unshift($lineChart, 0);
}

if (count($dates) == 1) {
    $date = date_create($dates[0]);
    date_sub($date,date_interval_create_from_date_string("1 days"));
    $date = date_format($date,"Y-m-d H:i:s");
    array_unshift($dates, $date);
}
// $percentageChart = [5/10,4/10,1/10];
@endphp
<div class="sweetalert">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @if ($errors->any())
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Ups',
            text: '{{ $errors->first() }}',
            position: 'top-center',
            footer: '<a href=""></a>'
        })
    </script>
    @endif
</div>
<main>
    <section class="report">
        <div class="row g-0">
            <div class="col-md-4 g-0">
                <h1 class="title mb-5">Laporan</h1>
                <form action="{{ route('section.reportresults')}}" method="POST">
                    @csrf
                    <div class="date-group mb-3">
                        <label for="datepicker">Pilih Tanggal Awal:</label>
                        <input type="text" size="16" style="text-align:center;" id="datepicker1" name="from" value="{{ $from ?? '' }}"readonly>
                        <script>
                            $(document).ready(function () {
                                var userLang = navigator.language || navigator.userLanguage;

                                var options = $.extend({},
                                    $.datepicker.regional["en"], {
                                    dateFormat: "dd MM yy",
                                    }
                                );

                                $("#datepicker1").datepicker(options);
                            });
                        </script>
                    </div>
                    <div class="date-group mb-3">
                        <label for="datepicker">Pilih Tanggal Akhir:</label>
                        <input type="text" size="16" style="text-align:center;" id="datepicker2" name="to" value="{{ $to ?? '' }}" readonly>
                        <script>
                            $(document).ready(function () {
                                var userLang = navigator.language || navigator.userLanguage;

                                var options = $.extend({},
                                    $.datepicker.regional["en"], {
                                    dateFormat: "dd MM yy",
                                    }
                                );

                                $("#datepicker2").datepicker(options);
                            });
                        </script>
                    </div>
                    <button class="btn btn-primary" type="submit" name="action" value="show">Tampilkan</button>
                    <button class="btn btn-danger" type="submit" name="action" value="print" formtarget="_blank">Cetak PDF</button>
                </form>
                {{-- <a href="{{ route('getpdf') }}" class="btn btn-danger mt-3">Cetak PDF <i class="fa fa-file-pdf-o"></i></a> --}}
                <script>
                    $(document).ready(function() {
                        $("#showReportButton").click(function() {
                            var fromDate = $("#datepicker1").val();
                            var toDate = $("#datepicker2").val();

                            $.ajax({
                            url: "{{ route('section.reportresults') }}",
                            type: "POST",
                            data: {
                                from: fromDate,
                                to: toDate
                            },
                            success: function(response) {
                                // Update the content with the received response
                                $(".content-data").html(response);
                            },
                            error: function(xhr, status, error) {
                                console.log("An error occurred:", error);
                            }
                            });
                        });
                        });

                </script>


            </div>
            <div class="col-md-8 g-0">
                <div class="mt-3git d-flex justify-content-center align-items-center">
                    <table class="table table-bordered">
                        <tr>
                            @if(isset($dateto) && isset($datefrom))
                                <th colspan="2" class="text-center">Data {{$datefrom}} Hingga {{$dateto}}</th>
                            @else
                                <th colspan="2" class="text-center">Data Bulan Ini</th>
                            @endif
                        </tr>
                        <tr>
                            <td>Total Jumlah Pengeluaran: {{$percentageArr[0]+$percentageArr[1]}}</td>
                            <td>Omzet: Rp{{ $expenses ?? 0 }}</td>
                        </tr>
                        <tr>
                            <td>Total Jumlah Produk: {{$percentageArr[2]}}</td>
                            <td>Pemasukan: Rp{{ array_sum($lineChart) ?? 0}}</td>
                        </tr>
                    </table>
                </div>
                <div class="content-data d-flex vh-100">
                    
                    <div class="container mt-5">
                        <div class="head d-flex justify-content-center">
                          <h3>Grafik Keuntungan</h3>
                        </div>
                        <div class="report">
                            <div id="report"></div>
                        </div>
                        {{-- <div class="head d-flex justify-content-center">
                            <h3 class="ml-5 text-center">Profitabilitas dan Prediksi</h3>
                        </div>
                        <p>Ini adalah prediksi sekitar 80%</p> --}}
                    </div>


                    <div class="container mt-5">
                        <div class="head d-flex justify-content-center">
                            <h3 class="text-center">Persentase Pendataan</h3>
                        </div>
                        <div class="circle-chart d-flex justify-content-center align-items-center">
                            <div id="cirlce-chart"></div>
                        </div>
                        {{-- <div class="head mt-5 d-flex justify-content-center">
                            <h3 class="mt-5 text-center">Profitabilitas</h3>
                        </div>
                        <p>Ini adalah prediksi sekitar 80%</p> --}}
                    </div>

                        {{-- <div class="head ml-5">
                            <h3 class="ml-5 text-center">Profitabilitas dan Prediksi</h3>
                        </div>
                        <p>Ini adalah prediksi sekitar 80%</p> --}}

                </div>
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
        data: <?php echo json_encode($lineChart, JSON_HEX_TAG); ?>,
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
    @php
    $var = ["Bahan Baku", 'Operasional', 'Produksi'];

    $percentageLabel = array_map(function($v1, $v2) {
        return $v1 . ": " . $v2;
    }, $var, $percentageArr);
    @endphp
    <script>
    var options = {
            series: <?php echo json_encode($percentageChart, JSON_HEX_TAG); ?>,
            chart: {
            width: 375,
            type: 'pie',
        },
        labels: <?php echo json_encode($percentageLabel, JSON_HEX_TAG);?>,
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
        }],
    };
    
    var chart = new ApexCharts(document.querySelector("#cirlce-chart"), options);
    chart.render();
</script>
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