<html>
<head>

 <script type="text/javascript" src="http://localhost/bootstrap/js/jquery-1.11.2.min.js"></script> 
<link rel="stylesheet" type="text/css" href="http://localhost/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="http://localhost/shop/admin/stylee1.css">

  <script>
function myFunction() {
         
    window.print();
 
}
 
</script>


 <style type="text/css" media="print" >

   @media print {   
   .tt { display: validate; } 
    .noprint { display: none; }
    button.btn  { display: none; }
     input.btn  { display: none; } 
     /*input.form-control{display: none;}*/

}
 
</style>
<?php
session_start();


$log=$_SESSION['suser'];

if ($log != 1 && $log != 2) { 
   header ("Location: index.php");
 
}elseif ($log == 1) {

?>
 <script>
            $(function(){
              $("#header").load("../admin/adminheader.php"); 
                        });
 </script>

<?php
 }elseif ($log == 2) {
  ?>
  <script>
            $(function(){
              $("#header").load("../admin/modheader.php"); 
                        });
 </script>

 
<?php
}
?>
</head>
<body>
<div id="header"></div> 
<button  id="show" onclick="myFunction()" class="btn btn-success" >Print this Document</button>
<?php
  $stot=0;
 ?>
<table border="1" align="center" class="table table-bordered " >
<tr>
  <td bgcolor="#EFF0F1">

 <table id="sumtable" width="200" border="0" align="center" class="table">
  
<?php
  include('database_connection.php');
  $result3 = mysqli_query($bd,"SELECT * FROM `order` WHERE `or_ID` = '$_GET[oid]'");
       $r3 = mysqli_fetch_array($result3);

   $result4 = mysqli_query($bd,"SELECT * FROM `cus` WHERE `c_id` = '$r3[c_ID]'");
       $r4 = mysqli_fetch_array($result4);

   $result5 = mysqli_query($bd,"SELECT * FROM `cart` WHERE `crt_ID` = '$r3[crt_ID]'");
       $r5 = mysqli_fetch_array($result5);  

   $result6 = mysqli_query($bd,"SELECT * FROM `payment` WHERE `pay_ID` = '$r3[pay_ID]'");
       $r6 = mysqli_fetch_array($result6);  

   $result7 = mysqli_query($bd,"SELECT * FROM `pay-methods` WHERE `paym_ID` = '$r6[paym_ID]'");
       $r7 = mysqli_fetch_array($result7);

   $result11 = mysqli_query($bd,"SELECT * FROM `shipping` WHERE `ship_ID` = '$r3[ship_ID]'");
       $r11 = mysqli_fetch_array($result11);  

   $result12 = mysqli_query($bd,"SELECT * FROM `shipmethod` WHERE `shipm_ID` = '$r11[shipm_ID]'");
       $r12 = mysqli_fetch_array($result12);                    
                     

       ?>
 <tr><td span="2"><b>Order Report</b></td><td></td></tr>

    <tr>
    <td><font size="2">Order ID:</font></td>
    <td><font size="2"><?php echo $r3['or_ID']; ?></font></td>
  </tr>

  <tr>
    <td><font size="2">Order Date:</font></td>
    <td><font size="2"><?php echo $r3['or_date']; ?></font></td>
  </tr>

   <tr>
    <td><font size="2">Total:</font></td>
    <td><font size="2"><?php echo $r6['pay_amount']; ?></font></td>
  </tr>

   <tr>
    <td><font size="2">Order Status:</font></td>
    <td><font size="2"><?php echo $r3['status']." "; ?> </font></td>
  </tr>
  


<tr><td></td><td></td></tr>


   <tr><td><b>Customer Detials</b></td><td></td></tr>

    <tr>
    <td><font size="2">Customer:</font></td>
    <td><font size="2"><?php echo $r4['c_fname']." ".$r4['c_mname']." ".$r4['c_lname']; ?></font></td>
  </tr>

    <tr>
    <td><font size="2">Email:</font></td>
    <td><font size="2"><?php echo $r4['c_email']; ?></font></td>
  </tr>

  <tr>
    <td><font size="2">Telephone:</font></td>
    <td><font size="2"><?php echo $r4['c_tp']; ?></font></td>
  </tr>

 <tr>
    <td><font size="2">Shipping Address:</font></td>
    <td><font size="2"><?php echo $r4['c_baddr1']." ".$r4['c_baddr2']." ".$r4['c_baddr3']; ?></font></td>
  </tr>


<tr><td></td><td></td></tr>

    <tr><td><b>Shipping Detials</b></td><td></td></tr>

    <tr>
    <td><font size="2">Shipping Address:</font></td>
    <td><font size="2"><?php echo $r4['c_shaddr1']." ".$r4['c_shaddr2']." ".$r4['c_shaddr3']; ?></font></td>
  </tr>

  <tr>
    <td><font size="2">Shipping Date:</font></td>
    <td><font size="2"><?php echo $r11['ship_date']; ?></font></td>
  </tr>

  <tr>
    <td><font size="2">Shipping Method:</font></td>
    <td><font size="2"><?php echo $r12['shipm_name']; ?></font></td>
  </tr>

  <tr>
    <td><font size="2">Shipping Cost:</font></td>
    <td><font size="2"><?php echo $r12['shipm_cost']; ?></font></td>
  </tr>




<tr><td></td><td></td></tr>

    <tr><td><b>Payment Detials</b></td><td></td></tr>

    <tr>
    <td><font size="2">Payment ID:</font></td>
    <td><font size="2"><?php echo $r6['pay_ID']; ?></font></td>
  </tr>

  <tr>
    <td><font size="2">Payment Date:</font></td>
    <td><font size="2"><?php echo $r6['pay_date']; ?></font></td>
  </tr>

  <tr>
    <td><font size="2">Payment Amount:</font></td>
    <td><font size="2"><?php echo $r6['pay_amount']; ?></font></td>
  </tr>

  <tr>
    <td><font size="2">Payment Method:</font></td>
    <td><font size="2"><?php echo $r7['paym_name']; ?></font></td>
  </tr>

  </table>

  <table id="sumtable" width="200" border="0" align="center" class="table">

  <tr>
    <td><font size="2"><b>Product</b></font></td>
    <td><font size="2"><b>Model</b></font></td>
    <td><font size="2"><b>Quantity</b></font></td>
    <td><font size="2"><b>Unit Price</b></font></td>
    <td><font size="2"><b>Total</b></font></td>
  </tr> 

  <?php
 

$sql="SELECT * FROM `cart_product` WHERE `crt_ID` = '$r3[crt_ID]'";

$result8 = mysqli_query($bd,$sql);
  while($r8 = mysqli_fetch_array($result8)) {
?>

  <tr>
  <?php

$result9 = mysqli_query($bd,"SELECT * FROM `product` WHERE `p_ID` = '$r8[p_ID]'");
       $r9 = mysqli_fetch_array($result9);  

       ?>

    <td><font size="2"> <?php echo $r9['p_name']; ?> </font></td>
    <td><font size="2"> <?php echo $r9['p_modelno']; ?> </font></td>
    <td><font size="2"> <?php echo $r8['qty']; ?> </font></td>
    <td><font size="2"> <?php echo $r9['p_price']; ?> </font></td>
    <?php
      $tot = $r8['qty'] * $r9['p_price']; ?>
    <td><font size="2"> <?php echo $tot; ?> </font></td> 

    </tr> 

<?php  
$stot= $stot+$tot;
  }

?>

<tr>
    <td></td>
    <td></td>
    <td></td>
    <td><font size="2"><b>Sub Total</b></font></td>
    <td><font size="2"><?php echo $stot; ?> </font></td> 
</tr>    



    </table>
    </td>
    </tr>
    </table>
    </body>
  </html>