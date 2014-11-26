<?php
$sex = $_GET["s"];
$age = $_GET["a"];
$goal = $_GET["g"];

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

<div class="packages">

</div>


<script type="text/javascript">

$(function() {

var packages = [];

$.getJSON('/js/packages.json',function(data){
	$.each(data.packages, function(i, f) {
		if (("<?php echo $sex; ?>" == f.genderQuery || f.genderQuery == "both") &&
			isBetween(f.minAgeQuery, <?php echo $age; ?>, f.maxAgeQuery)){
				switch("<?php echo $goal; ?>")
				{
				case "Daily":
					if(f.goalQuery.Daily){packages.push (f);}
					break;
				case "Fat":
					if(f.goalQuery.Fat){packages.push (f);}
					break;
				case "Muscle":
					if(f.goalQuery.Muscle){packages.push (f);}
					break;
				case "Tone":
					if(f.goalQuery.Tone){packages.push (f);}
					break;
				default:
					break;
				}
			}	
		});
	$.each(packages, function(i,v) {
		$(".packages").html('<div class="package" id="package_' + i + '">' + 
							'<div class="package_title"></div>' + 
							'<div class="product_list"></div></div>');
		$(".package_title").text(v.title);
		var list = "<ul>";
		$.each(v.products, function (j, x){
			list += "<li>" + x.id + "</li>";
			});
		list += "</ul>";
		$(".product_list").html(list);
		});
	});
});

function isBetween (low, val, hi){
	return (low <= val && val <= hi);
}
	
</script>
</body>
</html>