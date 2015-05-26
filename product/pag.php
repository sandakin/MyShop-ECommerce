<html>
<head>
<title>Paging Using PHP</title>
<base target="_parent" />
</head>
<link href="http://localhost/shop/web/web/css/style.css" rel="stylesheet" type="text/css" media="all"/>
<link href="http://localhost/shop/web/web/css/slider.css" rel="stylesheet" type="text/css" media="all"/>
<script type="text/javascript" src="http://localhost/shop/web/web/js/jquery-1.7.2.min.js"></script> 
<script type="text/javascript" src="http://localhost/shop/web/web/js/move-top.js"></script>
<script type="text/javascript" src="http://localhost/shop/web/web/js/easing.js"></script>
<script type="text/javascript" src="http://localhost/shop/web/web/js/startstop-slider.js"></script>
<link href="http://localhost/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <style>
div.img {
  height: 200;
    width: auto;
  /*margin: 10px;*/
   
    padding-top: 30px;

padding-bottom: 1px;
}
  </style>
<body>
<div class="row">
  <!-- <div class=" col-md-3"> -->
  <!-- <iframe height=100% width=100% src="http://localhost/shop/product/cat.php" ></iframe> -->
  <!-- <div id="cat"></div>   -->
  <!-- </div> -->

  <div class=" col-md-9">
  <!-- <iframe height=100% width=100% src="http://localhost/shop/web/dfs.html" ></iframe> -->
<!--   <div id="pag"> -->
  <!-- pag START -->
    
<?php

session_start();
if(empty($_SESSION['logins']))
{
 $uid=-1;
}else{
 $uid=$_SESSION['logins']; 
}


$rec_limit = 8;
 include('database_connection.php');
if(! $bd )
{
  die('Could not bdect: ' . mysqli_error($bd));
}
//mysqli_select_db('shop');
/* Get total number of records */
$sql = "SELECT count(p_ID ) FROM product ";
$retval = mysqli_query($bd, $sql );
if(! $retval )
{
  die('Could not get data: ' . mysqli_error($bd));
}
$row = mysqli_fetch_array($retval, MYSQL_NUM );
$rec_count = $row[0];

if( isset($_GET{'page'} ) )
{
  
   $page = $_GET{'page'} + 1;
    $_SESSION['page']=$_GET{'page'} + 1;
   $offset = $rec_limit * $page ;
}
else
{
   $page = 0;
   $offset = 0;
}


$left_rec = $rec_count - ($page * $rec_limit);
// echo $left_rec;

// echo $page;
$sql = "SELECT * ".
       "FROM product ".
       "LIMIT $offset, $rec_limit";
echo '<div  class="col-md-12"> ';
$retval = mysqli_query($bd, $sql );
if(! $retval )
{
  die('Could not get data: ' . mysqli_error($bd));
}
while($row = mysqli_fetch_array($retval, MYSQL_ASSOC))
{
    // echo "EMP ID :{$row['p_ID']}  <br> ".
    //      "EMP NAME : {$row['p_name']} <br> ".
    //      "EMP SALARY : {$row['p_price']} <br> ".
    //      "--------------------------------<br>";
         ?>


         
           <div  class="col-md-3"  >
      <div class="thumbnail" >

<div class="img">
  <a href="..\web/preview.php?p_id=<?php echo $row['p_ID']; ?>">
  <img  alt="Responsive image" src="http://localhost/shop/web/proimg/<?php echo $row['p_image']; ?>" alt="" />
</a>
               </div>
           <h4 style="white-space: nowrap; overflow: hidden;text-overflow: ellipsis;"><?php echo $row['p_name']; ?> </h4>
          <div class="price-details">
               <div class="price-number">
              <span class="rupees">Rs.<?php echo $row['p_price']; ?> </span>
              </div>
                    <div class="add-cart">                
                  <!-- <h4></h4> -->
<?php 
$qih=$row['p_qih'];
$rodr=$row['p_reorderlvl'];  
if($qih<=$rodr)
{
?>

   <span class="label label-danger">Out of Stock</span> 
  <!-- <button type="submit" class="btn btn-danger  btn-lg disabled"> Out of stock <span class="glyphicon glyphicon-remove-circle"   ></span></button> -->
<?php
 }else{
?>
  <a href="http://localhost/shop/customer/addtocart.php?c_id=<?php echo $uid; ?>&p_id=<?php echo $row['p_ID']; ?>"><span class="label label-primary">Add to Cart</span></a>

  <!-- <button type="submit" class="btn btn-primary btn-lg"> ADD TO CART <span class="glyphicon glyphicon-ok-sign"></span></button> -->
<?php
}
?>


                  <!-- <a href="http://localhost/shop/customer/addtocart.php?c_id=<?php echo $uid; ?>&p_id=<?php echo $row['p_ID']; ?>"><span class="label label-primary">Add to Cart</span></a> -->
                   </div>
               <div class="clear"></div>

               </div>

             </div>
           </div>
         <?php
} 
echo "</div> ";

echo "<nav>  <ul class='pager'>";

  if( $left_rec < $rec_limit )
// else if( $left_rec < 0 )
{
   $last = $page - 2;
   // echo "<a href=\"probrowse.php?page=$last\"> l Last 10 Records</a>";
   // <li class="next"><a href="#">Newer <span aria-hidden="true">&rarr;</span></a></li>
          // echo "<li><a href='\"probrowse.php?page=$last\"'>Previous </a> </li>";
   echo "<li class='previous'><a href='probrowse.php?page=$last'><span aria-hidden='true'> </span> <span class='glyphicon  glyphicon-arrow-left' aria-hidden='true'></span>Previous</a></li>";
   echo "<li class='next disabled'><a href=''>Next <span class='glyphicon  glyphicon-arrow-right' aria-hidden='true'> </a></li>";
                  
}
else if( $page > 0 )
{
   $last = $page - 2;
   // echo "<a href=\"probrowse.php?page=$last\">Last 10 Records</a> |";
   // echo "<a href=\"probrowse.php?page=$page\">Next 10 Records</a>";
 echo "<li class='previous'><a href='probrowse.php?page=$last'><span aria-hidden='true'> </span> <span class='glyphicon  glyphicon-arrow-left' aria-hidden='true'></span>Previous</a></li>";
 
echo "<li class='next'><a href='probrowse.php?page=$page'><span aria-hidden='true'> </span> Next<span class='glyphicon  glyphicon-arrow-right' aria-hidden='true'></span></a></li>";


}
else if( $page == 0 )
{
   // echo "<a href=\"probrowse.php?page=$page\">Next 10 Records</a>";
echo "<li class='next'><a href='probrowse.php?page=$page'><span aria-hidden='true'> </span> Next<span class='glyphicon  glyphicon-arrow-right' aria-hidden='true'></span></a></li>";


}

echo "</ul></nav>";
mysqli_close($bd);
?>
<!-- <nav> -->
  <!-- <ul class="pager"> -->
    <!-- <li><a href="#"><span class="glyphicon  glyphicon-arrow-left" aria-hidden="true"></span>Previous </a> </li> -->
    <!-- <li><a href="#">Next<span class="glyphicon  glyphicon-arrow-right" aria-hidden="true"></span></a></li> -->
  <!-- </ul> -->
<!-- </nav> -->


<!-- pag END -->
  </div>  


  
  
  </div>