<html>
<head>

 <script type="text/javascript" src="http://localhost/bootstrap/js/jquery-1.11.2.min.js"></script> 
<link rel="stylesheet" type="text/css" href="http://localhost/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="http://localhost/shop/admin/stylee1.css">

  
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
  <div class="col-md-7" >
      <div class="well" > 

<form name="myForm" action="insertbrand.php" method="post" onSubmit="return validateForm()" enctype="multipart/form-data">

  <div class="form-group">
    <label class="control-label">Brand Name</label>
    <input type="text" name="b_name" id="b_name" class="form-control"  placeholder="Enter Brand Name " required/>
</div>

<div class="form-group">
    <!-- <label class="control-label">Brand Logo</label> -->
    <!-- <input type="text" name="b_logo" id="b_logo" class="form-control"  placeholder="Enter Brand Logo Loction " required/> -->
     <label for="file">Brand Logo:</label>
<input type="file" name="file" id="file" required><br>
</div>

<div class="form-group">
    <label class="control-label">Brand Description</label>
    <input type="text" name="b_des" id="b_des" class="form-control"  placeholder="Enter Brand Description " />
</div>
 <div class="form-group">
  <input name="submit" type="submit" id="submit" class="btn btn-primary" >
</div>
  </form>
  </div>
</div>
  </body>
  <html>