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
    
    <title>Automasinu rezervacijas detalas</title>

    <link href="assets/css/bootstrap.min.css" rel="stylesheet">

    <link href="assets/css/font-awesome.css" rel="stylesheet">
 
    <link href="style.css" rel="stylesheet">

<script language="javascript" type="text/javascript">
var popUpWin=0;
function popUpWindow(URLStr, left, top, width, height)
{
 if(popUpWin)
{
if(!popUpWin.closed) popUpWin.close();
}
popUpWin = open(URLStr,'popUpWin', 'toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=no,copyhistory=yes,width='+600+',height='+600+',left='+left+', top='+top+',screenX='+left+',screenY='+top+'');
}

</script>
    
</head>

<body>

   <?php include_once('includes/header.php');?>
  
    <div class="contact-page-wrao section-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 m-auto">
                    <div class="contact-form">
<?php echo $bid=$_GET['bookingid'];?> Rezervacijas detalas



 <div class="row">
 <div class="col-lg-12">
<?php

$link = "http"; 
$link .= "://"; 
$link .= $_SERVER['HTTP_HOST']; 


$userid= $_SESSION['vrmsuid'];
$ret=mysqli_query($con,"select BookingDate,Status,CreationDate from bookingcar where UserId='$userid' and BookingNumber='$bid'");
while($result=mysqli_fetch_array($ret)) {
?>

<p style="color:#000"><b>Rezervacija #</b><?php echo $bid?></p>
<p style="color:#000"><b>Rezervacijas datums : </b><?php echo $od=$result['CreationDate'];?></p>
<p style="color:#000"><b>Rezervacijas Status :</b> <?php if($result['Status']==""){
    echo "Not Response Yet";
} else {
echo $result['Status'];
}?> &nbsp;
</p>

<?php } ?>

 </div>
 </div> 

            <div class="row" style="margin-top:1%">
 <div class="col-lg-12">

        <?php 
 $query=mysqli_query($con,"select DATEDIFF(bookingcar.ReturnDate,bookingcar.BookingDate) as ddf,car.Image,car.VehicleName,car.RentalPrice,bookingcar.FullName,bookingcar.BookingNumber,bookingcar.BookingDate,bookingcar.ReturnDate,bookingcar.TotalCost,bookingcar.Remark,bookingcar.Status,bookingcar.RemarkDate,bookingcar.CreationDate from car join bookingcar on car.ID=bookingcar.VehicleID where bookingcar.Userid='$userid' and bookingcar.BookingNumber=$bid");
$num=mysqli_num_rows($query);
if($num>0){
    $cnt=1;

?>
<table border="1" class="table">
    <tr>
<th>#</th>
<th>Rezervacijas numurs</th>
<th>Rezervacijas datums</th>
<th>Rezervacijas sakums</th>
<th>Rezervacijas beigas</th>
<th>Transporta bilde</th>  
<th>Transporta nosaukums</th>    
<th>Nomas cena</th>   
<th>Kopeja cena</th>  

</tr>
<?php   
while ($row=mysqli_fetch_array($query)) {
    ?>



<tr>
<td><?php echo $cnt;?></td>
<td><?php echo $row['BookingNumber'];?></td>
<td><?php echo $row['CreationDate'];?></td>
<td><?php echo $row['BookingDate'];?></td>
<td><?php echo $row['ReturnDate'];?></td>
<td>
<img class="b-goods-f__img img-scale" src="admin/images/<?php echo $row['Image'];?>" alt="<?php echo $row['Image'];?>" width='300' height='250'></td>
<td><?php echo $row['VehicleName'];?></td>  
<td><?php echo $rpice=$row['RentalPrice'];?> evro </td> 
<td> <?php
$d1=$row['ddf'];;

 echo $total=$d1*$rpice;?> evro</td>
 <?php 

$cnt=$cnt+1; 
                    }        
 ?> 
</td>
    
</tr>
<?php } ?>

</table>

<p>


 
    <p style="color:red">
        <a href="car-booking.php" title="Back" style="color:red">Atpakal </a>
    </p>


                </div>
            </div>         </div>
                </div>
            </div>
        </div>
    </div>
    

   
   <?php include_once('includes/footer.php');?>


</body>

</html>
<?php }  ?>