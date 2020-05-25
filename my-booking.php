<?php
session_start();
include('includes/dbconnection.php');
error_reporting(0);
if (strlen($_SESSION['vrmsuid']==0)) {
  header('location:logout.php');
  } else{

  
?>
<!DOCTYPE html>
<html class="no-js" lang="lv">

<head>
    
    <title>Izmainit parole</title>

    <!--=== Bootstrap CSS ===-->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <!--=== FontAwesome CSS ===-->
    <link href="assets/css/font-awesome.css" rel="stylesheet">
    <!--=== Main Style CSS ===-->
    <link href="style.css" rel="stylesheet">


    
</head>

<body>


   <?php include_once('includes/header.php');?>

    <section id="page-title-area" class="section-padding overlay">
        <div class="container">
            <div class="row">
            
                <div class="col-lg-12">
                    <div class="hat-title  text-center">
                        <h2>Mana rezrvacija</h2>
                        <span class="title-line"><i class="fa fa-car"></i></span>
                    </div>
                </div>
             
            </div>
        </div>
    </section>
 
    <div class="contact-page-wrao section-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 m-auto">
                    <div class="contact-form">
                        <?php
$uid=$_SESSION['vrmsuid'];
$ret=mysqli_query($con,"select * from  user where ID='$uid'");
$cnt=1;
while ($row=mysqli_fetch_array($ret)) {

?>
                        <table border="1" class="table">
    <tr>
<th>#</th>
<th>Klients</th>
<th>Rezervacijas nr.</th>   
<th>Rezervacijas datums</th>
<th>Rezervacijas status</th>
<th>Detalas</th>
</tr>
        <?php 
                    $userid= $_SESSION['vrmsuid'];
 $query=mysqli_query($con,"select * from  bookingmoto  where UserId='$userid'");
$cnt=1;
              while($row=mysqli_fetch_array($query))
              { ?>

<tr>
    <td><?php echo $cnt;?></td>
<td><?php echo $row['FullName'];?></td>
<td><?php echo $row['BookingNumber']?></td>  
<td><?php $status=$row['Status'];
if($status==''){
 echo "Waiting for confirmation";   
} else{
echo $status;
}

?>  
<td><a href="booking-detail.php?bookingid=<?php echo $row['BookingNumber'];?>" class="btn theme-btn-dash">Detalas</a></td>       
</tr>
<?php $cnt=$cnt+1; } ?>
</table>
                    </div>
                </div>
            </div>
        </div>
    </div>
  

   
   <?php include_once('includes/footer.php');?>

</body>

</html>
<?php }  ?>