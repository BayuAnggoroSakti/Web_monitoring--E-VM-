<?php
 $filter=$_POST['filter'];
include "config/koneksi.php";
?>

<html>
  <head>
<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
<script src="http://code.highcharts.com/highcharts.js"></script>
<script src="http://code.highcharts.com/modules/exporting.js"></script>
<script type="text/javascript">
var variabelJS = '<?php echo $filter ?>';
  var chart1; // globally available
$(document).ready(function() {
      chart1 = new Highcharts.Chart({
         chart: {
            renderTo: 'container',
            type: 'column'
         },   
         title: {
            text: 'Grafik Transaksi berdasarkan No Vending Machine'+' '+variabelJS
         },
         xAxis: {
            categories: ['Nomor Vending Machine']
         },
     plotOptions: {
bar: {
dataLabels: {
enabled: true
}
}
},
credits: {
enabled: false
},
tooltip: {
valueSuffix: ' '
},
         yAxis: {
            title: {
               text: 'Jumlah transaksi'
            }
         },
              series:             
            [
            <?php 
           
           $sql   = "SELECT distinct b.nama_barang as nama_barang  FROM tbl_transaksi t, tbl_barang b where t.id_barang = b.id_barang";
            $query = mysql_query( $sql )  or die(mysql_error());
            while( $ret = mysql_fetch_array( $query ) ){
              $merek=$ret['nama_barang'];                     
                 $sql_jumlah   = "SELECT sum(total) as jum FROM tbl_transaksi t, tbl_barang b WHERE t.id_barang = b.id_barang and b.nama_barang='$merek' and t.no_vm like '%$filter%'";        
                 $query_jumlah = mysql_query( $sql_jumlah ) or die(mysql_error());
                 while( $data = mysql_fetch_array( $query_jumlah ) ){
                    $jumlah = $data['jum'];                 
                  }             
                  ?>
                  {
                      name: '<?php echo $merek; ?>',
                      data: [<?php echo $jumlah; ?>]
                  },
                  <?php } ?>
            ]
      });
   });  
</script>
  </head>
  <body>  
    <div id='container'></div>    
  </body>
</html>