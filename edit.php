<?php 
if(isset($_POST["sex"]))
{
	$file 		= file_get_contents("js/packages.json");
	$json		= json_decode($file, true);
	
	$id 		= $_POST["id"];
	$name 		= $_POST["name"];
	$products 	= $_POST["products"];
	$sex		= $_POST["sex"];
	$minAge		= $_POST["minAge"];
	$maxAge		= $_POST["maxAge"];
	$goals		= $_POST["goals"];
	
	$productArray = explode ( ", ", $products);
	$productArrayOutput = array();
	
	foreach ($productArray as $value)
	{
		$productArrayOutput[] = array("id" => $value);	
	}
	$goalQuery = array(
		"Fat" => in_array("fat", $goals),
		"Muscle" => in_array("muscle", $goals), 
		"Daily" => in_array("daily", $goals),
		"Tone" => in_array("tone", $goals)
	);

	$post_data = array(
			"title" => $name,
			"products" => $productArrayOutput,
			"genderQuery" => $sex,
			"minAgeQuery" => $minAge,
			"maxAgeQuery" => $maxAge,
			"goalQuery" => $goalQuery
	);

	foreach ($json['packages'] as $key => &$value)
	{
		if ($key == $id) {$value = $post_data;}	
	}

	$newJson = json_encode($json);
	file_put_contents("js/packages.json", $newJson);
}
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
</head>
<body>
<div>
	<h1>Curent List of Packages</h1> 
    <table>
    	<thead>
        	<tr>
            	<td>Package Name</td>
                <td>Product IDs</td>
                <td>Sexes</td>
                <td>Ages</td>
                <td>Goals</td>
                <td>Edit</td>
        	</tr>
        </thead>
        <tbody class='list_body'>

        </tbody>
    </table>
</div>

<div>
	<h1>Product Listing Editor</h1>
    <form  method="post">
        <label>Name</label><br>
            <input type="text" name="name" id="name"><br>
        <label>Products</label><br>
            <textarea name="products" id="products"></textarea><br>
        <label>Sex</label><br>
            <input type="radio" name="sex" value="male" id="male">Male<br>
            <input type="radio" name="sex" value="female" id="female">Female<br>
            <input type="radio" name="sex" value="both" id="both">Both<br>
        <label>Age Range (0-100)</label><br>
            Min <input type="text" name="minAge" id="minAge"><br>
            Max <input type="text" name="maxAge" id="maxAge"><br>
        <label>Goals</label><br>
            <input type="checkbox" name="goals[]" value="fat" id="fat">Fat Loss<br>
            <input type="checkbox" name="goals[]" value="muscle" id="muscle">Muscle Enhancement<br>
            <input type="checkbox" name="goals[]" value="daily" id="daily">Daily Maintenance<br>
            <input type="checkbox" name="goals[]" value="tone" id="tone">Toning<br>
        <input type="hidden" id="id" name="id" value="">
        <button id="save">Save</button>
   	</form>
</div>


<script type="text/javascript">
    $.getJSON('js/packages.json', function(data){
        $.each(data.packages, function(i, v){
			var output = "<tr>";
			output += "<td>" + v.title + "</td>";
			output += "<td>";
			$.each(v.products, function(j, x){
				output += x.id + ", ";
			});        
			output += "</td>";
			output += "<td>" + v.genderQuery + "</td>";
			output += "<td>" + v.minAgeQuery + " - " + v.maxAgeQuery + "</td>";
			output += "<td>";
			if (v.goalQuery.Fat) {output += "Fat Loss, ";}
			if (v.goalQuery.Muscle) {output += "Muscle Enhancement, ";}
			if (v.goalQuery.Daily) {output += "Daily Maintenance, ";}
			if (v.goalQuery.Tone) {output += "Toning, ";}
			output += "</td>"
			output += "<td><button onClick='edit(" + i + ")'>Edit</button></td>";
			output += "</tr>";
			
			$(".list_body").append(output);
        });
    });
	
	function edit(n){
		 $.getJSON('js/packages.json', function(data){
			 var d = data.packages[n];
			 $("#id").val(n);
			 $("#name").val(d.title);
			 var p = "";
			 $.each(d.products, function(i, v){
				 p += v.id + ", ";
			 });
			 $("#products").val(p);
			 $("#" + d.genderQuery).prop("checked", true);
			 $("#minAge").val(d.minAgeQuery);
			 $("#maxAge").val(d.maxAgeQuery);
			 $("#fat").prop("checked", d.goalQuery.Fat);
			 $("#muscle").prop("checked", d.goalQuery.Muscle);
			 $("#daily").prop("checked", d.goalQuery.Daily);
			 $("#tone").prop("checked", d.goalQuery.Tone);
		 });
	}
</script>
</body>
</html>