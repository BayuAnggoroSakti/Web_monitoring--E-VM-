<a  href="?id=tambahpeg&mod=add" class="btn btn-app btn-purple btn-xs">
			<i class="ace-icon fa fa-pencil-square-o bigger-160"></i>
			Tambah
			<span class="badge badge-warning badge-right"></span>
			</a>
			
			<a href="?id=tambahpeg" class="btn btn-app btn-success btn-xs">
			<i class="ace-icon fa fa-refresh bigger-160"></i>
			Refresh
			</a>
			
			<a  href="?id=data_pegawai" class="btn btn-app btn-purple btn-xs">
			<i class="ace-icon fa fa-users bigger-160"></i>
			Pegawai
			<span class="badge badge-warning badge-right"></span>
			</a>



<?php
error_reporting(0); 		
$sesi_username			= isset($_SESSION['username']) ? $_SESSION['username'] : NULL;
if ($sesi_username != NULL || !empty($sesi_username) ||$_SESSION['leveluser']=='1'||$_SESSION['leveluser']=='2' ) 

{

$id_user=$_SESSION['kode'];	

$nipmax=mysql_fetch_array(mysql_query("SELECT max(no_vm) FROM tbl_vm"));
$nomor_nip=$nipmax[0];


$mode_form	= isset($_GET['mod']) ? $_GET['mod'] : "";
$id_daftar	= isset($_GET['id_n']) ? $_GET['id_n'] : "";
$p_tombol	= isset($_POST['kirim_daftar']) ? $_POST['kirim_daftar'] : "";
$p_id_daftar = isset($_POST['id_daftar']) ? $_POST['id_daftar'] : "";

$no_vm		= isset($_POST['no_vm']) ? $_POST['no_vm'] : "";	
$foto 		= isset($_POST['foto']) ? $_POST['foto'] : "";
$lokasi_lat 	= isset($_POST['lokasi_lat']) ? $_POST['lokasi_lat'] : "";
$lokasi_long	= isset($_POST['lokasi_long']) ? $_POST['lokasi_long'] : "";	
$lokasi_des	= isset($_POST['lokasi_des']) ? strtoupper($_POST['lokasi_des']) : "";
$status	= isset($_POST['status']) ? $_POST['status'] : "";	


$p_submit		= "DAFTAR";

if ($mode_form == "add") {
} else if ($mode_form == "edit") {
$q_data_edit	= mysql_query("SELECT * FROM tbl_vm WHERE no_vm= '$no_vm'");
$a_data_edit	= mysql_fetch_array($q_data_edit);
$no_vm		= $a_data_edit[0];
$foto			= $a_data_edit[1];	
$lokasi_lat			= $a_data_edit[2];		
$lokasi_long 	= $a_data_edit[3];
$lokasi_des 	= $a_data_edit[4]; 		
$status 	= $a_data_edit[5];	


$p_submit	= "EDIT";	

}

if ($p_tombol == "DAFTAR") {
	if ($no_vm == "")
	{
		
		echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'><i class='icon-remove'></i></button><strong><i class='ace-icon fa fa-times'></i> MAAF! </strong> Form Isian No_VM kosong<br/></div>";
		
	} else {  
	
			$q_cek_ganda = mysql_query("SELECT * FROM tbl_vm WHERE no_vm = '$no_vm'");
			$j_cek_ganda = mysql_fetch_array($q_cek_ganda);
			
			if ($j_cek_ganda > 0) {
				echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'><i class='icon-remove'></i></button><strong><i class='ace-icon fa fa-times'></i> MAAF! </strong> No. VM sudah ada<br/></div>";
			} else {   
					$q_daftar	= mysql_query("INSERT INTO tbl_vm VALUES ('$no_vm','belum di isi','000','000','Belum di isi','0',NOW(),'')");	
					
					if ($q_daftar) {
					echo "<div class='alert alert-block alert-success'><button type='button' class='close' data-dismiss='alert'><i class=''></i></button><strong><i class='ace-icon fa fa-check'></i> BERHASIL</strong> No. VM Berhasil di Tambahkan<br/></div>";
				} else {
				echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'><i class='icon-remove'></i></button><strong><i class='ace-icon fa fa-times'></i> MAAF! </strong>" .mysql_error()."<br/></div>";
				}
			}
		}
			
} else if ($p_tombol == "EDIT") {
	if ($p_nama == "") 
		{
		echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'><i class='icon-remove'></i></button><strong><i class='ace-icon fa fa-times'></i> MAAF! </strong> Form Isian No_VM kosong<br/></div>";
		} else {
		
		
		$q_edit	= mysql_query("UPDATE tbl_vm SET no_vm='$no_vm'
									where no_vm='$no_vm'");
				
									
		if ($q_edit) {
		echo "<div class='alert alert-block alert-success'><button type='button' class='close' data-dismiss='alert'><i class=''></i></button><strong><i class='ace-icon fa fa-check'></i> BERHASIL</strong> Data Pegawai Berhasil di Ubah<br/></div>";
				} else {
				
				echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'><i class='icon-remove'></i></button><strong><i class='ace-icon fa fa-times'></i> MAAF! </strong>" .mysql_error()."<br/></div>";
				}
		}

}

	


?>




			
			
										

					<div class="widget-box">
<div class="widget-header widget-header-blue widget-header-flat">
	<h4 class="widget-title lighter">NO VM</h4>
	<small>
	<i class="icon-double-angle-right"></i>
	<span class="label label-info arrowed-in-right arrowed">Mohon isi dengan kode unik No.VM</span>
	</small>
	<div class="widget-toolbar">
		
	</div>
</div>
					
					<div class="widget-body">
					<div class="widget-main">
					<div class="row-fluid">
						
							<!--PAGE CONTENT BEGINS-->

						<form class="form-horizontal" action="?id=tambahvm" method="post"  role="form">
							
							
		
							<div class="form-group">
									<label class="col-sm-3 control-label no-padding-right" for="no_vm" >No.VM :</label>

									<div class="col-sm-9">
										<input type="text" name="nipakhir" class="col-xs-10 col-sm-1" id="nipakhir" readonly="" id="form-input-readonly" data-rel="tooltip" title="No.VM TERAKHIR" value="<?php echo $nomor_nip;?>" />
										<input type="text" name="no_vm" id="no_vm" class="col-xs-10 col-sm-1" data-rel="tooltip" title="NO.VM" placeholder="No.VM" value="<?php echo $no_vm;?>"/>
									</div>
								
								</div>
							<input type="hidden" name="foto" value="<?php echo $foto; ?>">
							<input type="hidden" name="lokasi_lat" value="00000">
							<input type="hidden" name="id_daftar" value="<?php echo $lokasi_long; ?>">
							<input type="hidden" name="id_daftar" value="<?php echo $lokasi_des; ?>">
							<input type="hidden" name="id_daftar" value="<?php echo $status; ?>">

							
			
								
										
								
												
								<div class="form-actions">
									
									<input class="btn btn-success btn-big btn-next" type="submit" name="kirim_daftar" value="<?php echo $p_submit; ?>">
								

									<a href="?id=tambahpeg" class="btn" type="reset">
										<i class="icon-undo bigger-110"></i>
										RESET
									</a>
									
								</div>
		</form>		
								
								</div>
								</div>
								</div>
								</div>
								</div>
				
<?php
}else{
	  header('Location:../index.php?status=Silahkan Login');
}
?>	