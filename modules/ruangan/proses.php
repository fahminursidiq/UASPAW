
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
            $ruangan      = mysqli_real_escape_string($mysqli, trim($_POST['nama_ruangan']));
            $jenis = mysqli_real_escape_string($mysqli, trim($_POST['jenis']));
             $kapasitas = mysqli_real_escape_string($mysqli, trim($_POST['kapasitas']));
            
            // perintah query untuk menyimpan data ke tabel paket
            $query = mysqli_query($mysqli, "INSERT INTO ruangan(nama_ruangan,jenis,kapasitas)
                                            VALUES('$ruangan','$jenis','$kapasitas')")
                                            or die('Ada kesalahan pada query insert : '.mysqli_error($mysqli));    

            // cek query
            if ($query) {
                // jika berhasil tampilkan pesan berhasil simpan data
                header("location: ../../main.php?module=ruangan&alert=1");
            }   
        }   
    }
    
    elseif ($_GET['act']=='update') {
        if (isset($_POST['simpan'])) {
            if (isset($_POST['idruangan'])) {
                // ambil data hasil submit dari form
                $id_paket        = mysqli_real_escape_string($mysqli, trim($_POST['idruangan']));
                 $ruangan       = mysqli_real_escape_string($mysqli, trim($_POST['ruangan']));
                 $jenis         = mysqli_real_escape_string($mysqli, trim($_POST['jenis']));
                 $kapasitas     = mysqli_real_escape_string($mysqli, trim($_POST['kapasitas']));

                // perintah query untuk mengubah data pada tabel paket
                $query = mysqli_query($mysqli, "UPDATE ruangan SET nama_ruangan      = '$ruangan',
                                                                    jenis            = '$jenis',
                                                                    kapasitas        = '$kapasitas'
                                                              WHERE id        = '$id_paket'")
                                                or die('Ada kesalahan pada query update : '.mysqli_error($mysqli));

                // cek query
                if ($query) {
                    // jika berhasil tampilkan pesan berhasil update data
                    header("location: ../../main.php?module=ruangan&alert=2");
                }         
            }
        }
    }

    elseif ($_GET['act']=='delete') {
        if (isset($_GET['id'])) {
            $id_paket = $_GET['id'];
    
            // perintah query untuk menghapus data pada tabel paket
            $query = mysqli_query($mysqli, "DELETE FROM ruangan WHERE id='$id_paket'")
                                            or die('Ada kesalahan pada query delete : '.mysqli_error($mysqli));

            // cek hasil query
            if ($query) {
                // jika berhasil tampilkan pesan berhasil delete data
                header("location: ../../main.php?module=ruangan&alert=3");
            }
        }
    }       
}       
?>