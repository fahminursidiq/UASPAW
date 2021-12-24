

<?php 
// fungsi pengecekan level untuk menampilkan menu sesuai dengan hak akses
// jika hak akses = admin, tampilkan menu
if ($_SESSION['hak_akses']=='admin') { ?>
	<!-- sidebar menu start -->
    <ul class="sidebar-menu">
        <li class="header">MAIN MENU</li>

	<?php 
	// fungsi untuk pengecekan menu aktif
	// jika menu home dipilih, menu home aktif
	if ($_GET["module"]=="home") { ?>
		<li class="active">
			<a href="?module=home"><i class="fa fa-home"></i> Beranda </a>
	  	</li>
	<?php
	}
	// jika tidak, menu home tidak aktif
	else { ?>
		<li>
			<a href="?module=home"><i class="fa fa-home"></i> Beranda </a>
	  	</li>
	<?php
	}

	// jika menu ruangan dipilih, menu ruangan aktif
	if ($_GET["module"]=="ruangan" || $_GET["module"]=="form_ruangan") { ?>
		<li class="active">
			<a href="?module=ruangan"><i class="fa fa-folder"></i>Sesi</a>
	  	</li>
	<?php
	}
	// jika tidak, menu ruangan tidak aktif
	else { ?>
		<li>
			<a href="?module=ruangan"><i class="fa fa-folder"></i>Sesi </a>
	  	</li>
	<?php
	}

	// jika menu booking dipilih, menu booking aktif
	if ($_GET["module"]=="booking" || $_GET["module"]=="form_booking") { ?>
		<li class="active">
			<a href="?module=booking"><i class="fa fa-check-square"></i> Booking </a>
	  	</li>
	<?php
	}
	// jika tidak, menu booking tidak aktif
	else { ?>
		<li>
			<a href="?module=booking"><i class="fa fa-check-square"></i> Booking </a>
	  	</li>
	<?php
	}

	// jika menu laporan dipilih, menu laporan aktif
	if ($_GET["module"]=="laporan") { ?>
		<li class="active">
			<a href="?module=laporan"><i class="fa fa-file-text"></i> Laporan</a>
	  	</li>
	<?php
	}
	// jika tidak, menu laporan tidak aktif
	else { ?>
		<li>
			<a href="?module=laporan"><i class="fa fa-file-text"></i> Laporan</a>
	  	</li>
	<?php
	}

	// jika menu user dipilih, menu user aktif
	if ($_GET["module"]=="user") { ?>
		<li class="active">
			<a href="?module=user"><i class="fa fa-user"></i> Manajemen User</a>
	  	</li>
	<?php
	}
	// jika tidak, menu user tidak aktif
	else { ?>
		<li>
			<a href="?module=user"><i class="fa fa-user"></i> Manajemen User</a>
	  	</li>
	<?php
	}
	?>
	</ul>
	<!--sidebar menu end-->
<?php
}
// jika hak akses = user, tampilkan menu
elseif ($_SESSION['hak_akses']=='user') { ?>
	<!-- sidebar menu start -->
    <ul class="sidebar-menu">
        <li class="header">MAIN MENU</li>

	<?php 
	// fungsi untuk pengecekan menu aktif
	// jika menu home dipilih, menu home aktif
	if ($_GET["module"]=="home") { ?>
		<li class="active">
			<a href="?module=home"><i class="fa fa-home"></i> Beranda </a>
	  	</li>
	<?php
	}
	// jika tidak, menu home tidak aktif
	else { ?>
		<li>
			<a href="?module=home"><i class="fa fa-home"></i> Beranda </a>
	  	</li>
	<?php
	}

	// jika menu ruangan dipilih, menu ruangan aktif
	if ($_GET["module"]=="ruangan" || $_GET["module"]=="form_ruangan") { ?>
		<li class="active">
			<a href="?module=ruangan"><i class="fa fa-folder"></i>  Ruangan </a>
	  	</li>
	<?php
	}
	// jika tidak, menu ruangan tidak aktif
	else { ?>
		<li>
			<a href="?module=ruangan"><i class="fa fa-folder"></i> Ruangan </a>
	  	</li>
	<?php
	}

	// jika menu booking dipilih, menu booking aktif
	if ($_GET["module"]=="booking" || $_GET["module"]=="form_booking") { ?>
		<li class="active">
			<a href="?module=booking"><i class="fa fa-check-square"></i> booking </a>
	  	</li>
	<?php
	}
	// jika tidak, menu booking tidak aktif
	else { ?>
		<li>
			<a href="?module=booking"><i class="fa fa-check-square"></i> booking </a>
	  	</li>
	<?php
	}

	?>
	</ul>
	<!--sidebar menu end-->
<?php
}
?>