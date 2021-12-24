
<?php
session_start();

// Panggil koneksi database.php untuk koneksi database
require_once "../../config/database.php";

// fungsi untuk pengecekan status login user 
// jika user belum login, alihkan ke halaman login dan tampilkan pesan = 1
if (empty($_SESSION['username']) && empty($_SESSION['password'])){
    echo "<meta http-equiv='refresh' content='0; url=index.php?alert=1'>";
}
// jika user sudah login, maka jalankan perintah untuk insert, update, dan delete
else {
    if ($_GET['act']=='insert') {
        if (isset($_POST['simpan'])) {
            // ambil data hasil submit dari form
            $id_transaksi      = mysqli_real_escape_string($mysqli, trim($_POST['id_transaksi']));
            
            $t_transaksi       = mysqli_real_escape_string($mysqli, trim($_POST['tanggal']));
            $exp               = explode('-',$t_transaksi);
            $tanggal_transaksi = $exp[2]."-".$exp[1]."-".$exp[0];
            
            $nama    = mysqli_real_escape_string($mysqli, trim($_POST['nama']));
            $mulai =  mysqli_real_escape_string($mysqli, trim($_POST['mulai']));
             $selesai =  mysqli_real_escape_string($mysqli, trim($_POST['selesai']));
            $ruangan             = mysqli_real_escape_string($mysqli, trim($_POST['ruangan']));
            
            // perintah query untuk menyimpan data ke tabel transaksi
            $query = mysqli_query($mysqli, "INSERT INTO transaksi(id_transaksi,tanggal,nama,mulai,selesai,ruangan)
                                            VALUES('$id_transaksi','$tanggal_transaksi','$nama','$mulai','$selesai','$ruangan')")
                                            or die('Ada kesalahan pada query insert : '.mysqli_error($mysqli));    

            // cek query
            if ($query) {
                // jika berhasil tampilkan pesan berhasil simpan data
                header("location: ../../main.php?module=booking&alert=1");
            }   
        }   
    }
    
    elseif ($_GET['act']=='update') {
        if (isset($_POST['simpan'])) {
            if (isset($_POST['id_transaksi'])) {
                // ambil data hasil submit dari form
                $id_transaksi      = mysqli_real_escape_string($mysqli, trim($_POST['id_transaksi']));
            
            $t_transaksi       = mysqli_real_escape_string($mysqli, trim($_POST['tanggal']));
            $exp               = explode('-',$t_transaksi);
            $tanggal_transaksi = $exp[2]."-".$exp[1]."-".$exp[0];
            
            $nama               = mysqli_real_escape_string($mysqli, trim($_POST['nama']));
            $mulai              =  mysqli_real_escape_string($mysqli, trim($_POST['mulai']));
             $selesai           =  mysqli_real_escape_string($mysqli, trim($_POST['selesai']));
            $ruangan             = mysqli_real_escape_string($mysqli, trim($_POST['ruangan']));
              $status             = mysqli_real_escape_string($mysqli, trim($_POST['status']));

                // perintah query untuk mengubah data pada tabel transaksi
                $query = mysqli_query($mysqli, "UPDATE transaksi SET tanggal             = '$tanggal_transaksi',
                                                                        nama      = '$nama',
                                                                        mulai   = '$mulai',
                                                                        selesai               = '$selesai',
                                                                        status = '$status'
                                                                  WHERE id_transaksi        = '$id_transaksi'")
                                                or die('Ada kesalahan pada query update : '.mysqli_error($mysqli));

                // cek query
                if ($query) {
                    // jika berhasil tampilkan pesan berhasil update data
                    header("location: ../../main.php?module=booking&alert=2");
                }         
            }
        }
    }

    elseif ($_GET['act']=='delete') {
        if (isset($_GET['id'])) {
            $id_transaksi = $_GET['id'];
    
            // perintah query untuk menghapus data pada tabel transaksi
            $query = mysqli_query($mysqli, "DELETE FROM transaksi WHERE id_transaksi='$id_transaksi'")
                                            or die('Ada kesalahan pada query delete : '.mysqli_error($mysqli));

            // cek hasil query
            if ($query) {
                // jika berhasil tampilkan pesan berhasil delete data
                header("location: ../../main.php?module=booking&alert=3");
            }
        }
    }       
}       
?>