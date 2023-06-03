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
  <div class="info-data">
    <div class="card">
      <div class="head">
        <div>
          <h2>1500</h2>
          <p>Keuntungan</p>
        </div>
      </div>
      <span class="progress" data-value="40%"></span>
      <span class="label">40%</span>
    </div>
    <div class="card">
      <div class="head">
        <div>
          <h2>234</h2>
          <p>Kerugian</p>
        </div>
      </div>
      <span class="progress" data-value="60%"></span>
      <span class="label">60%</span>
    </div>
    <div class="card">
      <div class="head">
        <div>
          <h2>465</h2>
          <p>Produk</p>
        </div>
      </div>
      <span class="progress" data-value="30%"></span>
      <span class="label">30% Produk terjual</span>
    </div>
    <div class="card">
      <div class="head">
        <div>
          <h2>235</h2>
          <p>Omzet</p>
        </div>
      </div>
      <span class="progress" data-value="80%"></span>
      <span class="label">80%</span>
    </div>
  </div>
  <div class="data">
    <div class="content-data">
      <div class="head">
        <h3>Grafik Pemasukan dari Produksi</h3>
        <div class="menu">
          <i class='bx bx-dots-horizontal-rounded icon'></i>
          <ul class="menu-link">
            <li><a href="#">Edit</a></li>
            <li><a href="#">Save</a></li>
            <li><a href="#">Remove</a></li>
          </ul>
        </div>
      </div>
      <div class="chart">
        <div id="chart"></div>
      </div>
    </div>
    <div class="content-data">
      <div class="head">
        <h3>Riwayat Aktivitas</h3>
        <div class="menu">
          <i class='bx bx-dots-horizontal-rounded icon'></i>
          <ul class="menu-link">
            <li><a href="#">Edit</a></li>
            <li><a href="#">Save</a></li>
            <li><a href="#">Remove</a></li>
          </ul>
        </div>
      </div>
      <div class="chat-box">
        <div class="card-content">
          <div class="streamline">
            @foreach ($logs as $log)
            <div class="sl-item sl-primary">
              <div class="sl-content">
                @if (Str::contains($log->logs, 'bahan baku'))
                <small class="text-muted">Bahan Baku</small>
                <p>{{ substr($log->logs, 0, strlen($log->logs)-2) }} <a href="{{ route('expense.history', substr($log->logs, strlen($log->logs)-1)) }}" style="">{{ substr($log->logs, strlen($log->logs)-1) }}</a></p>
                @elseif (Str::contains($log->logs, 'operasional'))
                <small class="text-muted">Operasional</small>
                <p>{{ substr($log->logs, 0, strlen($log->logs)-2) }} <a href="{{ route('expense.history', substr($log->logs, strlen($log->logs)-1)) }}" style="">{{ substr($log->logs, strlen($log->logs)-1) }}</a></p>
                @else
                <small class="text-muted">Produk</small>
                <p>{{ substr($log->logs, 0, strlen($log->logs)-2) }} <a href="{{ route('product.history', substr($log->logs, strlen($log->logs)-1)) }}" style="">{{ substr($log->logs, strlen($log->logs)-1) }}</a></p>
                @endif
              </div>
            </div>    
            @endforeach
          </div>
        </div>
      </div>
    </div>
  </div>
</main>