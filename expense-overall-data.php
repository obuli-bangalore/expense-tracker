<?php
session_start();
//data.php

$connect = new PDO("mysql:host=localhost;dbname=detsdb", "root", "");

if(isset($_POST["action"]))
{
	
	$userid=$_SESSION['detsuid'];
	if($_POST["action"] == 'fetch')
	{
		$query = "
		SELECT ExpenseItem, sum(ExpenseCost) AS Total FROM tblexpense where userid = '$userid' and date_format(ExpenseDate,'%Y-%m-%d') < date_format(now(),'%Y-%m-%d') and
      date_format(ExpenseDate,'%Y-%m-%d') >= date_format(now() - interval 3 month,'%Y-%m-%d') GROUP BY ExpenseItem ORDER BY ExpenseItem DESC";

		$result = $connect->query($query);

		$data = array();

		foreach($result as $row)
		{
			$data[] = array(
				'language'		=>	$row["ExpenseItem"],
				'total'			=>	$row["Total"],
				'color'			=>	'#' . rand(100000, 999999) . ''
			);
		}

		echo json_encode($data);
	}
}


?>