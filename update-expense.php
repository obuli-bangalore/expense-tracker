<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
//code deletion

$rowid= $_GET['delid'];

//selecting data associated with this particular id
$result = mysqli_query($con, "SELECT * FROM tblexpense WHERE ID=$rowid");

if (count($result) > 0)
{
	$res = mysqli_fetch_array($result);

	$dates = $res['ExpenseDate'];
	$items = $res['ExpenseItem'];
	$costs = $res['ExpenseCost'];

}

if (isset($_POST['update'])) {
	$date = $_POST['dateexpense'];
	$item = $_POST['item'];
	$amount = $_POST['costitem'];

	$query=mysqli_query($con, "UPDATE tblexpense SET  ExpenseDate = '$date', ExpenseItem='$item', ExpenseCost = '$amount'  WHERE id=$rowid");
	if($query)
	{
		echo "<script>alert('Record successfully Updated');</script>";
		echo "<script>window.location.href='manage-expense.php'</script>";
	} 
	else 
	{
		echo "<script>alert('Something went wrong. Please try again');</script>";

	}
}

?>



<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Daily Expense Tracker || Add Expense</title>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/font-awesome.min.css" rel="stylesheet">
	<link href="css/datepicker3.css" rel="stylesheet">
	<link href="css/styles.css" rel="stylesheet">
	
	<!--Custom Font-->
	<link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
	<!--[if lt IE 9]>
	<script src="js/html5shiv.js"></script>
	<script src="js/respond.min.js"></script>
	<![endif]-->
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
				<li class="active"><b>Update Income</b></li>
			</ol>
		</div><!--/.row-->
		
		
				
		
		<div class="row">
			<div class="col-lg-12">
			
				
				
				<div class="panel panel-default">
					<div class="panel-heading"><b>Update Income</b></div>
					<div class="panel-body">
						<p style="font-size:16px; color:red" align="center"> <?php if($msg){
    echo $msg;
  }  ?> </p>
				
						<div class="col-md-12">
							
							<form role="form" method="post" action="">
								<div class="form-group">
									<label>Date of Expense</label>
									<input class="form-control" type="date" value="<?php echo $dates; ?>" name="dateexpense" required="true">
								</div>
								<div class="form-group">
									<label>Item</label>
									<select class="form-control" id="item" name="item" >
     									
     									<option value="<?php echo $items; ?>"> <?php echo $items; ?></option>
									
    									</select>
								</div>
								
								<div class="form-group">
									<label>Cost of Item</label>
									<input class="form-control" type="text" value="<?php echo $costs;?>" required="true" name="costitem">
								</div>
																
								<div class="form-group has-success">
									<button type="submit" class="btn btn-primary" name="update">Update</button>
								</div>
								
								
								</div>
								
							</form>
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
