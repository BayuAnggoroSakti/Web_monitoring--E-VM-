<?php
 session_start();
 $sesi_username			= isset($_SESSION['username']) ? $_SESSION['username'] : NULL;
if ($sesi_username != NULL || !empty($sesi_username) ||$_SESSION['leveluser']=='1'  ) 

{

include "../config/koneksi.php";





$id_transaksi = $_POST['id_transaksi'];


$data = mysql_fetch_array(mysql_query("SELECT * FROM tbl_transaksi"));


if($id_transaksi> 0) { 
	$id_transaksi = $data['id_transaksi'];
	$no_vm= $data['no_vm'];
	$no_kartu = $data['no_kartu'];
	$tanggal = $data['tanggal'];
	$total = $data['total'];
	

} else  {
	$id_transaksi ="";
	$no_vm= "";
	$no_kartu = "";
	$tanggal = "";
	$total = "";
	
}

?>
					
<form class="form-horizontal" id="form-jab">



<div class="form-group">
		<label class="col-sm-3 control-label no-padding-right" for="id_transaksi">ID Transaksi</label>
		<div class="col-sm-9">
			<input type="text"  disabled="disabled" id="id_transaksi" class="input-medium" name="id_transaksi" value="<?php echo $id_transaksi ?>">
		</div>
	</div>

	<div class="form-group">
		<label class="col-sm-3 control-label no-padding-right" for="no_vm">No_VM</label>
		<div class="col-sm-9">
			<input type="text" id="no_vm" class="input-medium" name="no_vm" value="<?php echo $no_vm ?>">
		</div>
	</div>
	
	<div class="form-group">
		<label class="col-sm-3 control-label no-padding-right" for="no_kartu">No. Kartu</label>
		<div class="col-sm-9">
			<input type="text" id="no_kartu" class="input-medium" name="no_kartu" value="<?php echo $no_kartu ?>">
		</div>
	</div>
	
	<div class="form-group">
		<label class="col-sm-3 control-label no-padding-right" for="tanggal">Tanggal</label>
		<div class="col-sm-9">
			<input type="text" id="tanggal" class="input-medium" name="tanggal" value="<?php echo $tanggal ?>">
		</div>
	</div>
	

	
	<div class="form-group">
		<label class="col-sm-3 control-label no-padding-right" for="total">Total(RP)</label>
		<div class="col-sm-9">
			<input type="text" id="total" class="input-medium" name="total" value="<?php echo $total ?>">
		</div>
	</div>
	
</form>

<?php

?>
<?php
}else{
	session_destroy();
	header('Location:../index.php?status=Silahkan Login');
}
?>