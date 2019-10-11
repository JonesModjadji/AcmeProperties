<?php
include('session.php');
 $message = "";
$TextBox1="";
$TextBox2="";
$TextBox3="";
$TextBox4="";
$TextBox5="";
$TextBox6="";
$Amount_Per_Month ="";
$Amount ="Bond Calculation";

 if (isset($_POST['Calculate'])) {
	$Name = $_POST['Name'];
	$Purchase_Price = $_POST['Purchase_Price'];
	$Deposit_Paid = $_POST['Deposit_Paid'];
	$Bond_Term_In_Years = $_POST['Bond_Term_In_Years'];
	$Fixed_Interest_Rate = $_POST['Fixed_Interest_Rate'];
	 
	$TextBox1= $Name;
	$TextBox2 =$Purchase_Price;
	$TextBox3 =$Deposit_Paid;
	$TextBox4 =$Bond_Term_In_Years;
	$TextBox5 =$Fixed_Interest_Rate;

	
	$Amount_To_Be_Paid =$Purchase_Price - $Deposit_Paid;
	$Compound_Interest = 1 +($Bond_Term_In_Years * ($Fixed_Interest_Rate/100));
	$Calculation = $Amount_To_Be_Paid * $Compound_Interest ;
	$Amount_Per_Month  =round(($Calculation / 12),2)  ;
	$Amount ="(".$TextBox2." - ".$TextBox3.") * 1 + (".$TextBox4." * ".$TextBox5."/100)"."\n"."="."\n".$Amount_Per_Month;
 
	$dataPoints1 = array();
	$dataPoints2 = array();
	for ($i = 0 +1; $i < $Bond_Term_In_Years +1; ++$i) {
	$Compound_Interest_Yearly = 1 +($i * ($Fixed_Interest_Rate/100));
	$Calculation2 = $Amount_To_Be_Paid * $Compound_Interest_Yearly ;
	$Bank_Interest = $Calculation2 - $Amount_To_Be_Paid ;
	$dataPoints1[] = array("label"=> "Interest", "y"=> $Calculation2 );
	$dataPoints2[] = array("label"=>"Year $i", "y"=> $Bank_Interest);
}
} 
 if (isset($_POST['Save'])) {
	$Name = $_POST['Name'];
	$Purchase_Price = $_POST['Purchase_Price'];
	$Deposit_Paid = $_POST['Deposit_Paid'];
	$Bond_Term_In_Years = $_POST['Bond_Term_In_Years'];
	$Fixed_Interest_Rate = $_POST['Fixed_Interest_Rate'];
	$Answer = $_POST['Answer'];

	$query = "INSERT into calculations
	(Name,Purchase_Price,Deposit_Paid,Bond_Term_In_Years,Fixed_Interest_Rate,Calculation_Results) 
	values('$Name','$Purchase_Price','$Deposit_Paid','$Bond_Term_In_Years','$Fixed_Interest_Rate','$Answer')";

	if (mysqli_query($con,$query)) {
		$message = "Calculation Successfully recorded!";
	}
	else
	{
		$message = "Could not capture calculation data";
	}
	
}
if (isset($_POST['Reset'])) {

	$Name =$TextBox1;
	$Purchase_Price=$TextBox2;
	$Deposit_Paid=$TextBox3;
	$Bond_Term_In_Years=$TextBox4;
	$Fixed_Interest_Rate=$TextBox5;
	$Answer =$TextBox6;
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Main Page</title>
	<script>
window.onload = function () {
 
var chart = new CanvasJS.Chart("chartContainer", {
	title: {
		text: "Money Paid To The Bank In Interest"
	},
	theme: "light2",
	animationEnabled: true,
	toolTip:{
		shared: true,
		reversed: true
	},
	axisY: {
		suffix: "%"
	},
	data: [
		{
			type: "stackedColumn100",
			name: "Capital",
			showInLegend: true,
			yValueFormatString: "#,##0",
			dataPoints: <?php echo json_encode($dataPoints1, JSON_NUMERIC_CHECK); ?>
		},{
			type: "stackedColumn100",
			name: "Interest",
			showInLegend: true,
			yValueFormatString: "#,##0",
			dataPoints: <?php echo json_encode($dataPoints2, JSON_NUMERIC_CHECK); ?>
		}
	]
});
 
chart.render();
 
}
</script>
</head>
<body>
<center><h1>Welcome to your Personal Property Calculator</h1>
<h4>Please Fill In : </h4></center>
<center>
	<br>
	<form action="" method="post" style = "float:right;width:100%;padding-bottom:3%;">

	    <input type="text" name="Name" placeholder="Name" value="<?php echo $TextBox1;?>" style="width:30%; color:#524719;">
		<br>
		<input type="text" name="Purchase_Price" required="" placeholder="Purchase Price" value="<?php echo $TextBox2;?>" style="width:30%; color:#524719;">
		<br>
		<input type="text" name="Deposit_Paid" required="" placeholder="Deposit Paid" value="<?php echo $TextBox3;?>" style="width:30%; color:#524719;">
		<br>
		<input type="text" name="Bond_Term_In_Years" required="" placeholder="Bond Term In Years" value="<?php echo $TextBox4;?>" style="width:14.7%; color:#524719;">
		<input type="text" name="Fixed_Interest_Rate" required="" placeholder="Fixed Interest Rate in %" value="<?php echo $TextBox5;?>" style="width:14.7%; color:#524719;">
		<br><br>
		<input type="hidden" name="Answer" placeholder="Amount Per Month"value="<?php echo $Amount_Per_Month;?>"
		style="visible:false;width:30%;height:20%; color:#524719;text-align:center;">
	    <textarea rows = "3" cols="25" name="Answer2"
		style="width:30%;height:20%; color:#524719;display: block;font-family: sans-serif;font-size: 20px;text-align: center;">
		<?php echo $Amount; ?>
         </textarea>
		<br><br>
	<input style="color: #524719;" type="submit" name="Calculate" value="Calculate">
	<input style="color: #524719;" type="submit" name="Reset" value="Reset">
	<input style="color: #524719;" type="submit" name="Save" value="Save">
	<br>
	<div id="chartContainer" style="height: 370px; width: 100%;position:absolute;"></div>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
	</form>
</center>
<center>
<h4>Latest Saved Calculations : </h4>
<table border="1" cellpadding="0">
	<tr>
		<td>Name</td>
		<td>Purchase_Price</td>
		<td>Deposit_Paid</td>
		<td>Bond_Term_In_Years</td>
		<td>Fixed_Interest_Rate</td>
		<td>Calculation_Results</td>
	</tr>
<?php

	$query = "SELECT * from calculations ORDER BY CalculationsID DESC LIMIT 0,7 ";

	$results = mysqli_query($con,$query);


		while ($row = $results->fetch_assoc()) {
			echo "<tr><td>".$row['Name']."</td>".
			"<td>".$row['Purchase_Price']."</td>".
			"<td>".$row['Deposit_Paid']."</td>".
			"<td>".$row['Bond_Term_In_Years']."</td>".
			"<td>".$row['Fixed_Interest_Rate']."</td>".
			"<td>".$row['Calculation_Results']."</td></tr>";
		}
	?>
</center>
</body>
</html>