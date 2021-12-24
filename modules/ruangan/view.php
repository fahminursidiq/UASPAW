
<section class="content-header">
  <h1>
    <i class="fa fa-folder-o icon-title"></i> Data booking perpustakaan

    <a class="btn btn-primary btn-social pull-right" href="?module=form_ruangan&form=add">
      <i class="fa fa-plus"></i> Tambah
    </a>
  </h1>

</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-md-12">

    <?php  
    // fungsi untuk menampilkan pesan
    // jika alert = "" (kosong)
    // tampilkan pesan "" (kosong)
    if (empty($_GET['alert'])) {
      echo "";
    } 
    // jika alert = 1
    // tampilkan pesan Sukses "ruangan baru berhasil disimpan"
    elseif ($_GET['alert'] == 1) {
      echo "<div class='alert alert-success alert-dismissable'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4>  <i class='icon fa fa-check-circle'></i> Sukses!</h4>
              ruangan baru berhasil disimpan.
            </div>";
    }
    // jika alert = 2
    // tampilkan pesan Sukses "ruangan berhasil diubah"
    elseif ($_GET['alert'] == 2) {
      echo "<div class='alert alert-success alert-dismissable'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4>  <i class='icon fa fa-check-circle'></i> Sukses!</h4>
              ruangan berhasil diubah.
            </div>";
    }
    // jika alert = 3
    // tampilkan pesan Sukses "ruangan berhasil dihapus"
    elseif ($_GET['alert'] == 3) {
      echo "<div class='alert alert-success alert-dismissable'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4>  <i class='icon fa fa-check-circle'></i> Sukses!</h4>
              ruangan berhasil dihapus.
            </div>";
    }
    ?>

      <div class="box box-primary">
        <div class="box-body">
          <!-- tampilan tabel ruangan -->
          <table id="dataTables1" class="table table-bordered table-striped table-hover">
            <!-- tampilan tabel header -->
            <thead>
              <tr>
                <th class="center">No.</th>
                <th class="center">Sesi</th>
                <th class="center">Jenis </th>
                <th class="center">Kapasitas</th>
                <th></th>
              </tr>
            </thead>
            <!-- tampilan tabel body -->
            <tbody>
            <?php  
            $no = 1;
            // fungsi query untuk menampilkan data dari tabel ruangan
            $query = mysqli_query($mysqli, "SELECT * FROM ruangan ORDER BY id DESC")
                                            or die('Ada kesalahan pada query tampil data ruangan: '.mysqli_error($mysqli));

            // tampilkan data
            while ($data = mysqli_fetch_assoc($query)) { 
              // menampilkan isi tabel dari database ke tabel di aplikasi
              echo "<tr>".
                      "<td width='40' class='center'>$no</td>".
                      "<td width='200'>$data[nama_ruangan]</td>".
                      "<td width='100'>$data[jenis]</td>".
                      "<td width='100'>$data[kapasitas]</td>".
                      "<td class='center' width='80'>".
                        "<div>".
                          "<a data-toggle='tooltip' data-placement='top' title='Ubah' style='margin-right:5px' class='btn btn-primary btn-sm' href='?module=form_ruangan&form=edit&id=$data[id]'>".
                              "<i style='color:#fff' class='glyphicon glyphicon-edit'></i>".
                          "</a>";
            
            ?>
                          <a data-toggle="tooltip" data-placement="top" title="Hapus" class="btn btn-danger btn-sm" href="modules/ruangan/proses.php?act=delete&id=<?php echo $data['id'];?>" onclick="return confirm('Anda yakin ingin menghapus'+ <?php echo strip_tags($data['nama_ruangan']) ; ?> +'?');">
                              <i style="color:#fff" class="glyphicon glyphicon-trash"></i>
                          </a>
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
      </div><!-- /.box -->
    </div><!--/.col -->
  </div>   <!-- /.row -->
</section><!-- /.content