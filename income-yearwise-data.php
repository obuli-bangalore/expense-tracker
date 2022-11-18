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
		 SELECT year(IncomeDate) as rptyear,SUM(IncomeCost) as Total FROM tblincome where userid = '$userid' group by year(IncomeDate)
		";

		$result = $connect->query($query);

		$data = array();

		foreach($result as $row)
		{
			$data[] = array(
				'language'		=>	$row["rptyear"],
				'total'			=>	$row["Total"],
				'color'			=>	'#' . rand(100000, 999999) . ''
			);
		}

		echo json_encode($data);
	}
}


?> 