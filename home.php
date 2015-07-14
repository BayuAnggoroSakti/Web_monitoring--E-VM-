


<?php
// memanggil berkas koneksi.php


error_reporting(0);
$sesi_username			= isset($_SESSION['username']) ? $_SESSION['username'] : NULL;
$nip			= isset($_SESSION['nip']) ? $_SESSION['nip'] : NULL;


if ($sesi_username != NULL || !empty($sesi_username) ||$_SESSION['leveluser']=='1'||$_SESSION['leveluser']=='2'||$_SESSION['leveluser']=='3'||$_SESSION['leveluser']=='4'||$_SESSION['leveluser']=='5'  )

{






?>


		<div class="alert alert-block alert-success">
								

		<marquee><i class="icon-ok green"></i>

		Selamat Datang <strong class="green">
		<?php echo $_SESSION['namauser'];?> 
									
		di
		<strong class="green">
		PT AINO Indonesia
								
				Jl. Acasia Sekip UGM Blok L-1,
Yogyakarta 55281, Indonesia			
		</strong>
		<?php
		
		echo ""." </strong> &nbsp "."</marquee> ";
		echo "</div>";

		
		?>
<div class="alert alert-block alert-warning">
<form action="?id=home" method="post">
<td>
										<select name="filter" style="width:300px;">
												<option value="" selected>--Berdasarkan No Vending Machine--</option>
													<?php
														include 'config/koneksi.php';
														$q = mysql_query("SELECT distinct no_vm FROM `tbl_transaksi` order by no_vm asc "); //choose the city from indonesia only

														while ($row1 = mysql_fetch_array($q)){
														  echo "<option value=$row1[no_vm]>$row1[no_vm]</option>";
														}
														?>
														<option value="">Semua</option>
										</select>	


									<button class="btn btn-success">Cari</button>
									</td>
</div>
	
   


</form>

<div float="center">
<?php
		//include "Grafik/grafik_transaksi.php";
		include "Grafik/grafik_vm.php";
	
	?>
</div>





<?php
}else{
    echo "<script>alert('Mohon Maaf anda tidak bisa akses halaman ini'); window.location = '../index.php'</script>";
}
?>