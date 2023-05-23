<main>
  <h1 class="title">Dashboard</h1>
  <h5 class="greet breadcrumbs">Selamat datang {{ Auth::id() }}</h5>
  {{-- <ul class="breadcrumbs">
    <li><a href="#">Selamat datang {{ Auth::id() }}</a></li>
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
        <h3>Activities</h3>

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
            <div class="sl-item sl-primary">
              <div class="sl-content">
                <small class="text-muted">Pemasukan</small>
                <p>Telah menginputkan data baru dengan id ?</p>
              </div>
            </div>
            <div class="sl-item sl-danger">
              <div class="sl-content">
                <small class="text-muted">Pengeluaran</small>
                <p>Telah mengupdate data dengan id ?</p>
              </div>
            </div>
            <div class="sl-item sl-success">
              <div class="sl-content">
                <small class="text-muted">Pemasukan</small>
                <p>Telah menghapus data dengan id ?</p>
              </div>
            </div>
            <div class="sl-item">
              <div class="sl-content">
                <small class="text-muted">Laporan</small>
                <p>Telah mengeksport file laporan ke PDF</p>
              </div>
            </div>
            <div class="sl-item sl-warning">
              <div class="sl-content">
                <small class="text-muted">Pemasukan</small>
                <p>Telah menambah data dengan id ?</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>