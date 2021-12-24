
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      <i class="fa fa-home icon-title"></i> Beranda
    </h1>
    <ol class="breadcrumb">
      <li><a href="?module=beranda"><i class="fa fa-home"></i> Beranda</a></li>
    </ol>
  </section>
  
  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-lg-12 col-xs-12">
        <div class="alert alert-info alert-dismissable">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          <p style="font-size:15px">
            <i class="icon fa fa-user"></i> Selamat datang <strong><?php echo $_SESSION['nama_user']; ?></strong> di Aplikasi Booking Perpustakaan.
          </p>        
        </div>
      </div>
    </div>
  

    <section class="content-header">
  <h1>
    <i class="fa fa-list icon-list"></i> Data Booking  Perpustkaan Hari Ini

    
  </h1>

</section>
    <div class="row">
      <div class="col-lg-12 col-xs-12">
        <div class="box box-primary">
        <div class="box-body">
          <!-- tampilan tabel transaksi -->
          <table id="dataTables1" class="table table-bordered table-striped table-hover">
            <!-- tampilan tabel header -->
            <thead>
              <tr>
                <th class="center">No.</th>
                <th class="center">ID Booking</th>
                <th class="center">Tanggal</th>
                <th class="center">Nama </th>
                <th class="center">Sesi</th>
                <th class="center">Jam Mulai</th>
                <th class="center">Jam Selesai</th>
                 <th class="center">Status</th>
              
              </tr>
            </thead>
            <!-- tampilan tabel body -->
            <tbody>
            <?php  

            $no = 1;
            // fungsi query untuk menampilkan data dari tabel transaksi
            $query = mysqli_query($mysqli, "SELECT * FROM transaksi as a INNER JOIN ruangan as b
                                            ON a.ruangan=b.id and  a.`tanggal` >= CURDATE() && a.`tanggal` < (CURDATE() + INTERVAL 1 DAY) where a.status='Booked'
                                            ORDER BY a.id_transaksi DESC")
                                            or die('Ada kesalahan pada query tampil Transaksi: '.mysqli_error($mysqli));

            // tampilkan data
            while ($data = mysqli_fetch_assoc($query)) { 
              $t_transaksi       = $data['tanggal'];
              $exp               = explode('-',$t_transaksi);
              $tanggal_transaksi = $exp[2]."-".$exp[1]."-".$exp[0];

              // menampilkan isi tabel dari database ke tabel di aplikasi
              echo "<tr>
                      <td width='40' class='center'>$no</td>
                      <td width='100' class='center'>$data[id_transaksi]</td>
                      <td width='80' class='center'>$tanggal_transaksi</td>
                      <td width='140'>$data[nama]</td>
                      <td width='110' class='center'>$data[nama_ruangan]</td>
                      <td width='80' class='center'>$data[mulai]</td>
                       <td width='80' class='center'>$data[selesai]</td>
                        <td width='80' class='center'>$data[status]</td>
                     
                     ";
            ?>
                         

                        
            <?php
              echo "    </div>
                      </td>
                    </tr>";
              $no++;
            }
            ?>
            </tbody>
          </table>
        </div><!-- /.box-body -->
      </div>
      </div>
    </div>
  </section><!-- /.content -->