@php
// $expenses = [];
// $incomes = [];
if (isset($lineChart)) {
  if (count($lineChart) == 1) {
      array_unshift($lineChart, 0);
  }
}

if (isset($dates)) {
  if (count($dates) == 1) {
      $date = date_create($dates[0]);
      date_sub($date,date_interval_create_from_date_string("1 days"));
      $date = date_format($date,"Y-m-d H:i:s");
      array_unshift($dates, $date);
  }
}
// $percentageChart = [5/10,4/10,1/10];
@endphp
<main>
  @if ($message = Session::get('success'))
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>
      Swal.fire(
          'Berhasil',
          '{{ $message }}',
          'success'
      )
  </script>
  @endif
  <h1 class="title">Dashboard</h1>
  @if (Auth::user()->account_type_fk == 1)
    <h5 class="greet">Selamat datang Superadmin, {{ Auth::user()->fullname }}!</h5>
  @elseif (Auth::user()->account_type_fk == 2)
    <h5 class="greet">Selamat datang Mitra, {{ Auth::user()->fullname }}!</h5>
  @elseif (Auth::user()->account_type_fk == 3)
    <h5 class="greet">Selamat datang Pegawai, {{ Auth::user()->fullname }}!</h5>
  @else
    <h5 class="greet">Selamat datang Null, {{ Auth::user()->fullname }}!</h5>
  @endif
  {{-- <ul class="breadcrumbs">
    <li><a href="#">Selamat datang {{ Auth::user()->fullname }}</a></li>
    <li class="divider">/</li>
    <li><a href="#" class="active">Dashboard</a></li>
  </ul> --}}
  @if (Auth::user()->account_type_fk == 2)
  <div class="info-data">
    <div class="card d-flex justify-content-center align-items-center">
      <div class="head">
        <div>
          <p class="text-center" style="font-size: 20px">Keuntungan</p>
          <h2 class="text-center"style="font-size: 40px">Rp{{$pros ?? 0}}</h2>
        </div>
      </div>
    </div>
    <div class="card d-flex justify-content-center align-items-center">
      <div class="head">
        <div>
          <p class="text-center" style="font-size: 20px">Kerugian</p>
          <h2 class="text-center"style="font-size: 40px">Rp{{$loss ?? 0}}</h2>
        </div>
      </div>
    </div>
    <div class="card">
      <div class="head">
        <div>
          <h2>{{ $pros2 ?? 0 }}</h2>
          <p>Produk</p>
        </div>
      </div>
      <span class="progress" data-value="{{ $soldPercent . "%" ?? 0 . "%"}}"></span>
      <span class="label">{{ $soldPercent . "%" ?? 0 . "%" }} Produk terjual</span>
    </div>
    <div class="card">
      <div class="head">
        <div>
          <h2>Rp{{ $omzetTotal ?? 0 }}</h2>
          <p>Omzet</p>
        </div>
      </div>
      <span class="progress" data-value="{{ $omzetPercent . "%" ?? 0 . "%" }}"></span>
      <span class="label">{{ $omzetPercent . "%" ?? 0 . "%" }}</span>
    </div>
  </div>
  <div class="data">
    <div class="content-data">
      <div class="head">
        <h3>Grafik Pemasukan dari Produksi</h3>
      </div>
      <div class="chart">
        <div id="chart"></div>
      </div>
    </div>
    <div class="content-data">
      <div class="head">
        <h3>Riwayat Aktivitas</h3>
      </div>
      <div class="chat-box">
        <div class="card-content">
          <div class="streamline">
            @foreach ($logs as $log)
            <div class="sl-item sl-primary">
              <div class="sl-content">
                @if (Str::contains($log->logs, 'bahan baku'))
                <small class="text-muted">Bahan Baku</small>
                <p>{{ substr($log->logs, 0, strlen($log->logs)-2) }} <a href="{{ route('expense.history', substr($log->logs, strlen($log->logs)-1)) }}" style="">{{ substr($log->logs, strlen($log->logs)-2) }}</a></p>
                @elseif (Str::contains($log->logs, 'operasional'))
                <small class="text-muted">Operasional</small>
                <p>{{ substr($log->logs, 0, strlen($log->logs)-2) }} <a href="{{ route('expense.history', substr($log->logs, strlen($log->logs)-1)) }}" style="">{{ substr($log->logs, strlen($log->logs)-2) }}</a></p>
                @else
                <small class="text-muted">Produk</small>
                <p>{{ substr($log->logs, 0, strlen($log->logs)-2) }} <a href="{{ route('product.history', substr($log->logs, strlen($log->logs)-1)) }}" style="">{{ substr($log->logs, strlen($log->logs)-2) }}</a></p>
                @endif
              </div>
            </div>    
            @endforeach
          </div>
        </div>
      </div>
    </div>
  </div>
  @elseif (Auth::user()->account_type_fk == 1)
  <div class="data">
    <div class="content-data">
      <div class="head">
        <h3>Akun terdaftar</h3>
      </div>
      <div class="accounts-registered">
        <div id="accounts-registered"></div>
      </div>
    </div>
    <div class="content-data">
      <div class="head">
        <h3>Status Aktif</h3>
      </div>
      <div class="chat-box">
        <div class="card-content">
          <div class="streamline">
          </div>
        </div>
      </div>
    </div>
  </div>
  @else
  <div class="data">
    <div class="content-data">
      <div class="head">
        <h3>Riwayat Aktivitas</h3>
      </div>
      <div class="chat-box">
        <div class="card-content">
          <div class="streamline">
            @foreach ($logs as $log)
            <div class="sl-item sl-primary">
              <div class="sl-content">
                @if (Str::contains($log->logs, 'bahan baku'))
                <small class="text-muted">Bahan Baku</small>
                <p>{{ substr($log->logs, 0, strlen($log->logs)-2) }} <a href="{{ route('expense.history', substr($log->logs, strlen($log->logs)-1)) }}" style="">{{ substr($log->logs, strlen($log->logs)-2) }}</a></p>
                @elseif (Str::contains($log->logs, 'operasional'))
                <small class="text-muted">Operasional</small>
                <p>{{ substr($log->logs, 0, strlen($log->logs)-2) }} <a href="{{ route('expense.history', substr($log->logs, strlen($log->logs)-1)) }}" style="">{{ substr($log->logs, strlen($log->logs)-2) }}</a></p>
                @else
                <small class="text-muted">Produk</small>
                <p>{{ substr($log->logs, 0, strlen($log->logs)-2) }} <a href="{{ route('product.history', substr($log->logs, strlen($log->logs)-1)) }}" style="">{{ substr($log->logs, strlen($log->logs)-2) }}</a></p>
                @endif
              </div>
            </div>    
            @endforeach
          </div>
        </div>
      </div>
    </div>
  </div>
  @endif
<?php
if (isset($dates)) {
  $convertedDates = [];
  foreach ($dates as $date) {
      $dateTime = new DateTime($date);
      $convertedDates[] = $dateTime->format('Y-m-d\TH:i:s.v\Z');
  }
}
?>

@if (Auth::user()->account_type_fk == 2)
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
    
    var chart = new ApexCharts(document.querySelector("#chart"), options);
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
@endif
</main>