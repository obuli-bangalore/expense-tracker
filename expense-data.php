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
		SELECT ExpenseDate, sum(ExpenseCost) AS Total FROM tblexpense where userid = '$userid'  GROUP BY ExpenseDate
		";

		$result = $connect->query($query);

		$data = array();

		foreach($result as $row)
		{
			$data[] = array(
				'language'		=>	$row["ExpenseDate"],
				'total'			=>	$row["Total"],
				'color'			=>	'#' . rand(100000, 999999) . ''
			);
		}

		echo json_encode($data);
	}
}


?>