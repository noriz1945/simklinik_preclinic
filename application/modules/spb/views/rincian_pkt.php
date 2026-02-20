<div class="card-block p-b-0">
<div class="table-responsive">
<table class="table table-hover m-b-0">
<thead>
<tr>
    <th>Tanggal</th>
    <th>Deskripsi</th>
    <th>Qty</th>
    <th>Harga</th>
    <th>Jumlah</th>
</tr>
</thead>
<tbody>
<?php $no_1 =0; 
foreach($rs_2 as $k2 => $v_2){  ?> 
<tr>
<td>&nbsp;</td>
<td style="color:black;font-weight: 900;"><?php echo $v_2['name_group']; ?></td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<?php 
foreach($v_2['rs_3'] as $k3 => $v_3){ 
  if($v_3['id_paket']==NULL){
    $trxdate = date_create($v_3['trxdate']); 
    $datenyah = date_format($trxdate,"d/m/y");
  }else{
    $trxdate = ""; 
    $datenyah = "";
  }
  $totalwithqty = ($v_3['pricenya'] * $v_3['qtynya']);
$subtotal +=$totalwithqty;
?>
<tr>
<td><?php echo $datenyah; ?></td>
<td><?php echo $v_3['name_tind']; ?></td>
<td><?php echo $v_3['qtynya']; ?></td>
<td><?php echo number_format($v_3['pricenya'],0); ?></td>
<td><?php echo number_format($totalwithqty,0); ?></td>
</tr>

                
<?php }  }?>
    <tr>
    <td colspan="3">&nbsp;</td>
<td style="color:black;font-weight: 900;">Subtotal</td>
<td style="color:black;font-weight: 900;"><?php echo number_format($subtotal,0); ?></td>
</tr>
    </tbody>
</table>
</div>
</div>




<div class="card">
<div class="card-header">
<h5>Hover Table</h5>
<span>use class <code>table-hover</code> inside table element</span>
<div class="card-header-right"> <ul class="list-unstyled card-option"> <li class="first-opt"><i class="feather icon-chevron-left open-card-option"></i></li> <li><i class="feather icon-maximize full-card"></i></li> <li><i class="feather icon-minus minimize-card"></i></li> <li><i class="feather icon-refresh-cw reload-card"></i></li> <li><i class="feather icon-trash close-card"></i></li> <li><i class="feather icon-chevron-left open-card-option"></i></li> </ul> </div>
</div>
<div class="card-block table-border-style">
<div class="table-responsive">
<table class="table table-hover">
<thead>
<tr>
<th>#</th>
<th>First Name</th>
<th>Last Name</th>
<th>Username</th>
</tr>
</thead>
 <tbody>
<tr>
<th scope="row">1</th>
<td>Mark</td>
<td>Otto</td>
<td>@mdo</td>
</tr>
<tr>
<th scope="row">2</th>
<td>Jacob</td>
<td>Thornton</td>
<td>@fat</td>
</tr>
<tr>
<th scope="row">3</th>
<td>Larry</td>
<td>the Bird</td>
<td>@twitter</td>
</tr>
</tbody>
</table>
</div>
</div>
</div>