 <?php  
// fungsi untuk pengecekan tampilan form
// jika form add data yang dipilih
if ($_GET['form']=='add') { ?> 
  <!-- tampilan form add data -->
	<!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      <i style="margin-right:7px" class="fa fa-edit"></i> Input Booking
    </h1>
    <ol class="breadcrumb">
      <li><a href="?module=home"><i class="fa fa-home"></i> Beranda </a></li>
      <li><a href="?module=transaksi"> Transaksi </a></li>
      <li class="active"> Tambah </li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="box box-primary">
          <!-- form start -->
          <form role="form" class="form-horizontal" method="POST" action="modules/transaksi/proses.php?act=insert" method="POST">
            <div class="box-body">

              <div class="form-group">

                <?php  
                // fungsi untuk membuat id transaksi
                $query_id = mysqli_query($mysqli, "SELECT RIGHT(id_transaksi,5) as kode FROM transaksi
                                                  ORDER BY id_transaksi DESC LIMIT 1")
                                                  or die('Ada kesalahan pada query tampil transaksi : '.mysqli_error($mysqli));

                $count = mysqli_num_rows($query_id);

                if ($count <> 0) {
                    // mengambil data id_transaksi
                    $data_id = mysqli_fetch_assoc($query_id);
                    $kode    = $data_id['kode']+1;
                } else {
                    $kode = 1;
                }

                // buat id_transaksi
                $buat_id      = str_pad($kode, 5, "0", STR_PAD_LEFT);
                $id_transaksi = "TR-$buat_id";
                ?>
                <label class="col-sm-2 control-label">ID Transaksi</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="id_transaksi" value="<?php echo $id_transaksi; ?>" readonly>
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-2 control-label">Tanggal</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control date-picker" data-date-format="dd-mm-yyyy" name="tanggal" autocomplete="off" value="<?php echo date("d-m-Y"); ?>" required>
                </div>
              </div>

              <hr>

              <div class="form-group">
                <label class="col-sm-2 control-label">Nama </label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="nama" autocomplete="off" required>
                </div>
              </div>


              <div class="form-group">
                <label class="col-sm-2 control-label">Ruangan</label>
                <div class="col-sm-5">
                  <select class="form-control"  name="ruangan" required>
                    <option value=""></option>
                    <?php
                      $query_ruangan = mysqli_query($mysqli, "SELECT * FROM ruangan ORDER BY id ASC")
                                                            or die('Ada kesalahan pada query tampil ruangan: '.mysqli_error($mysqli));
                      while ($data_ruang = mysqli_fetch_assoc($query_ruangan)) {
                        echo"<option value=\"$data_ruang[id]\"> $data_ruang[nama_ruangan] </option>";
                      }
                    ?>
                  </select>
                </div>
              </div>

               <div class="form-group">
                <label class="col-sm-2 control-label no-padding-right">Jam Mulai</label>*
                <div class="col-sm-5">
                  <select class="form-control" name="mulai" data-placeholder="-- Pilih--" autocomplete="off" required>
                    <option value=""></option>
                    <?php
                      $query_operator = mysqli_query($mysqli, "SELECT * FROM jam group by id")
                                                            or die('Ada kesalahan pada query tampil: '.mysqli_error($mysqli));
                      while ($data_operator = mysqli_fetch_assoc($query_operator)) {
                        echo"<option value=\"$data_operator[jam]\"> $data_operator[jam] </option>";
                      }
                    ?>
                  </select>
                </div>
              </div>

               <div class="form-group">
                <label class="col-sm-2 control-label no-padding-right">Jam Selesai</label>*
                <div class="col-sm-5">
                  <select class="form-control" name="selesai" data-placeholder="-- Pilih--" autocomplete="off" required>
                    <option value=""></option>
                    <?php
                      $query_operator = mysqli_query($mysqli, "SELECT * FROM jam group by id")
                                                            or die('Ada kesalahan pada query tampil: '.mysqli_error($mysqli));
                      while ($data_operator = mysqli_fetch_assoc($query_operator)) {
                        echo"<option value=\"$data_operator[jam]\"> $data_operator[jam] </option>";
                      }
                    ?>
                  </select>
                </div>
              </div>

          

            </div><!-- /.box body -->

            <div class="box-footer">
              <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                  <input type="submit" class="btn btn-primary btn-submit" name="simpan" value="Simpan">
                  <a href="?module=transaksi" class="btn btn-default btn-reset">Batal</a>
                </div>
              </div>
            </div><!-- /.box footer -->
          </form>
        </div><!-- /.box -->
      </div><!--/.col -->
    </div>   <!-- /.row -->
  </section><!-- /.content -->
<?php
}
// jika form edit data yang dipilih
// isset : cek data ada / tidak
elseif ($_GET['form']=='edit') { 
  if (isset($_GET['id'])) {
    // fungsi query untuk menampilkan data dari tabel transaksi
    $query = mysqli_query($mysqli, "SELECT a.id_transaksi,a.tanggal,a.nama,a.mulai,a.selesai,a.status,b.id,b.nama_ruangan FROM transaksi as a INNER JOIN ruangan as b
                                    ON a.ruangan=b.id
                                    WHERE a.id_transaksi='$_GET[id]'") 
                                    or die('Ada kesalahan pada query tampil Transaksi : '.mysqli_error($mysqli));
    $data  = mysqli_fetch_assoc($query);

    $t_transaksi       = $data['tanggal'];
    $exp               = explode('-',$t_transaksi);
    $tanggal_transaksi = $exp[2]."-".$exp[1]."-".$exp[0];
  }
?>
  <!-- tampilan form edit data -->
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      <i style="margin-right:7px" class="fa fa-edit"></i> Ubah Data Booking
    </h1>
    <ol class="breadcrumb">
      <li><a href="?module=home"><i class="fa fa-home"></i> Beranda </a></li>
      <li><a href="?module=transaksi"> Booking </a></li>
      <li class="active"> Ubah </li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="box box-primary">
          <!-- form start -->
          <form role="form" class="form-horizontal" method="POST" action="modules/transaksi/proses.php?act=update" method="POST">
            <div class="box-body">

              <div class="form-group">
                <label class="col-sm-2 control-label">ID Transaksi</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="id_transaksi" value="<?php echo $data['id_transaksi']; ?>" readonly>
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-2 control-label">Tanggal</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control date-picker" data-date-format="dd-mm-yyyy" name="tanggal" autocomplete="off" value="<?php echo $tanggal_transaksi; ?>" required>
                </div>
              </div>

              <hr>

              <div class="form-group">
                <label class="col-sm-2 control-label">Nama </label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="nama" autocomplete="off" value="<?php echo $data['nama']; ?>" required>
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-2 control-label">Ruangan</label>
                <div class="col-sm-5">
                  <select class="form-control"  name="ruangan"  required>
                    <option value="<?php echo $data['id']; ?>"><?php echo $data['nama_ruangan']; ?></option>
                    <?php
                      $query_ruangan = mysqli_query($mysqli, "SELECT * FROM ruangan ORDER BY id ASC")
                                                            or die('Ada kesalahan pada query tampil paket: '.mysqli_error($mysqli));
                      while ($data_paket = mysqli_fetch_assoc($query_ruangan)) {
                        echo"<option value=\"$data_ruangan[id]\"> $data_paket[nama_ruangan] </option>";
                      }
                    ?>
                  </select>
                </div>
              </div>

               <div class="form-group">
                <label class="col-sm-2 control-label">Jam Mulai</label>
                <div class="col-sm-5">
                  <select class="form-control"  name="mulai"  required>
                    <option value="<?php echo $data['mulai']; ?>"><?php echo $data['mulai']; ?></option>
                    <?php
                      $query_jam = mysqli_query($mysqli, "SELECT * FROM jam ORDER BY id ASC")
                                                            or die('Ada kesalahan pada query tampil: '.mysqli_error($mysqli));
                      while ($data_mulai = mysqli_fetch_assoc($query_jam)) {
                        echo"<option value=\"$data_mulai[jam]\"> $data_mulai[jam] </option>";
                      }
                    ?>
                  </select>
                </div>
              </div>


               <div class="form-group">
                <label class="col-sm-2 control-label">Jam Selesai</label>
                <div class="col-sm-5">
                  <select class="form-control"  name="selesai"  required>
                    <option value="<?php echo $data['selesai']; ?>"><?php echo $data['selesai']; ?></option>
                    <?php
                      $query_jam = mysqli_query($mysqli, "SELECT * FROM jam ORDER BY id ASC")
                                                            or die('Ada kesalahan pada query tampil: '.mysqli_error($mysqli));
                      while ($data_mulai = mysqli_fetch_assoc($query_jam)) {
                        echo"<option value=\"$data_mulai[jam]\"> $data_mulai[jam] </option>";
                      }
                    ?>
                  </select>
                </div>
              </div>



               <div class="form-group">
                <label class="col-sm-2 control-label">Status</label>
                <div class="col-sm-5">
                  <select class="form-control"  name="status"  required>
                     <option value="<?php echo $data['status']; ?>"><?php echo $data['status']; ?></option>
                      <option value=""></option>
                     <option value="Booked">Booked</option>
                    <option value="Selesai">Selesai</option>
                  </select>
                </div>
              </div>



             
              
              

            </div><!-- /.box body -->

            <div class="box-footer">
              <div class="form-group">
                <div class="col-sm-offset-1 col-sm-11">
                  <input type="submit" class="btn btn-primary btn-submit" name="simpan" value="Simpan">
                  <a href="?module=booking" class="btn btn-default btn-reset">Batal</a>
                </div>
              </div>
            </div><!-- /.box footer -->
          </form>
        </div><!-- /.box -->
      </div><!--/.col -->
    </div>   <!-- /.row -->
  </section><!-- /.content -->
<?php
}
?>