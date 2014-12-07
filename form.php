<?php

$memberStatus = "";
$color = "";

if(isset($_POST['submit']))
{
	$data =
		"User=Edge&" .
		"PW=Fitness1!&" .
		"ClubID=" . $_POST['ClubID'] . "&" .
		"MemberID=" . $_POST['MemberID']; 
	
	$url = "https://app.planetfitness.com/visionarylookup.asmx/MemberLookup";
	
	$curl = curl_init();
	curl_setopt($curl, CURLOPT_URL, $url);
	curl_setopt($curl, CURLOPT_POST, strlen($data));
	curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
	$responce = curl_exec($curl);
	curl_close($curl);
	if(strpos($responce, "True") !== false)
	{
		$memberStatus = "This is a Black Card Member";
		$color = "blue";	
	}
	else
	{
		$memberStatus = "Not a Black Card Member";	
		$color = "red";
	}
}
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>

<body>

<form method="POST" action="<?=$_SERVER['PHP_SELF'];?>">
	<fieldset>
    	<legend>Planet Fitness Member Info <span style="color:<?=$color;?>;"><?=$memberStatus;?></span></legend>
        <input type="hidden" name="User" value="Edge">
        <input type="hidden" name="PW" value="Fitness1!">
        Club ID: <input type="text" size="7" name="ClubID"><br>
        User ID: <input type="text" size="7" name="MemberID"><br>
        <button type="submit" name="submit"> Submit </button>
    </fieldset>
</form>

</body>
</html>