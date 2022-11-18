<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['detsuid']==0)) {
  header('location:logout.php');
  } else{

  

  ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Daily Expense Tracker || Datewise Expense Report</title>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/font-awesome.min.css" rel="stylesheet">
	<link href="css/datepicker3.css" rel="stylesheet">
	<link href="css/styles.css" rel="stylesheet">
	
	<!--Custom Font-->
	<link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
	
</head>
<body>
	<?php include_once('includes/header.php');?>
	<?php include_once('includes/sidebar.php');?>
		
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#">
					<em class="fa fa-home"></em>
				</a></li>
				<li class="active">Datewise Income Report</li>
			</ol>
		</div><!--/.row-->
		
		
				
		
		<div class="row">
			<div class="col-lg-12">
			
				
				
				<div class="panel panel-default">
					<div class="panel-heading">Datewise Income Report</div>
					<div class="panel-body">

						<div class="col-md-12">
					
<?php
$original_date = $_POST['fromdate'];
$timestamp = strtotime($original_date);
$fdate = date("Y-m-d", $timestamp);

 $original_date1 = $_POST['todate'];
 $timestamp1 = strtotime($original_date1);
 $tdate = date("Y-m-d", $timestamp1);

 $rtype=$_POST['requesttype'];
?>
<h3 align="center" style="color:blue"><b>Datewise Income Report from <?php echo date('d-m-Y',strtotime($original_date));?> to <?php echo date('d-m-Y',strtotime($original_date1));?></b></h3>
<hr />
                                    <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <thead>
                                        <tr>
                                            <tr>
              <th>S.NO</th>
              <th>Date</th>
              <th>Income Amount</th>
                </tr>
                                        </tr>
                                        </thead>
 <?php
$userid=$_SESSION['detsuid'];
$ret=mysqli_query($con,"SELECT IncomeDate,SUM(IncomeCost) as totaldaily FROM `tblincome`  where (IncomeDate BETWEEN '$fdate' and '$tdate') && (UserId='$userid') group by IncomeDate");
$cnt=1;
while ($row=mysqli_fetch_array($ret)) {
$orgdate = $row['IncomeDate'];
?>
              
                <tr>
                  <td><?php echo $cnt;?></td>
            
                    <td><?php  echo date('d-m-Y',strtotime($orgdate));?></td>
                  <td><?php  echo $ttlsl=$row['totaldaily'];?></td>
           
           
                </tr>
                <?php
                $totalsexp+=$ttlsl; 
$cnt=$cnt+1;
}?>

 <tr>
  <th colspan="2" style="text-align:center">Grand Total</th>     
  <td><?php echo $totalsexp;?></td>
 </tr>     

                                    </table>




						</div>
					</div>
				</div><!-- /.panel-->
			</div><!-- /.col-->
			<?php include_once('includes/footer.php');?>
		</div><!-- /.row -->
	</div><!--/.main-->
	
<script src="js/jquery-1.11.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/chart.min.js"></script>
	<script src="js/chart-data.js"></script>
	<script src="js/easypiechart.js"></script>
	<script src="js/easypiechart-data.js"></script>
	<script src="js/bootstrap-datepicker.js"></script>
	<script src="js/custom.js"></script>
	
</body>
</html>
<?php } ?>