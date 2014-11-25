<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
  
  <script src="dragdealer-master/lib/jquery.simulate.js"></script>
  <script src="dragdealer-master/lib/jasmine.js"></script>
  <script src="dragdealer-master/lib/jasmine-html.js"></script>
  <script src="dragdealer-master/lib/jasmine-jquery.js"></script>
  
  
   <link href="dragdealer-master/src/dragdealer.css" type="text/css" rel="stylesheet">
  <script src="dragdealer-master/src/dragdealer.js"></script>

  <script src="dragdealer-master/spec/helpers.js"></script>
  <script src="dragdealer-master/spec/matchers.js"></script>
  <script src="dragdealer-master/spec/optionsSpec.js"></script>
  <script src="dragdealer-master/spec/draggingSpec.js"></script>
  <!--[if gt IE 9]><!-->
  <script src="dragdealer-master/spec/touchDraggingSpec.js"></script>
  <!--<![endif]-->
  <script src="dragdealer-master/spec/callbacksSpec.js"></script>
  <script src="dragdealer-master/spec/apiSpec.js"></script>
  <script src="dragdealer-master/spec/resizingSpec.js"></script>
  <script src="dragdealer-master/spec/eventsSpec.js"></script>
  <script src="dragdealer-master/spec/browser-runner.js"></script>
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/style.css">
  
  <script>
  $(function() {
   // $( "#slider" ).slider();
  });
  </script>
</head>

<body>

<div class="builder">
	<div class="header">
    	<h1>Find Products That Fit Your Goals</h1>
    </div>
    <div class="box" id="gender_box">
    	<h5>Start Here</h5>
        <div class="row">
        	<div class="col-xs-2 col-xs-offset-4">
        		<img class="gender_button" id="male_gender_button" onclick="gender('male')" /> 
        		<h3>Male</h3>
            </div>
            <div class="col-xs-2">
		        <img class="gender_button" id="female_gender_button" onclick="gender('female')"/>
    	    	<h3>Female</h3>
            </div>
        </div>
    </div>
    <div class="box" id="age_box">
    	<h1>How old are you?</h1>
        <div class="age_slider">
        	<div class="dragdealer" id="age-drag">
<!--	        <div class="col-xs-6 col-sm-offset-3" id="slider"></div> -->
				<div class="handle" id="slider-ball"> </div>
            </div>
        </div>
    </div>
    <div class="box" id="goal_box">
    	<div class="row">
        	<div class="col-xs-2 col-xs-offset-2">
            	<div class="goal" id="goal-fat-loss" onclick="goal('fatloss')">
                	<img src="images/icon-fat-loss.png" alt="Fat Loss">
                	<h4> Fat Loss </h4>
                </div>
            </div>
            <div class="col-xs-2">
            	<div class="goal" id="goal-muscle" onclick="goal('muscle')">
                	<img src="images/icon-muscle-en.png" alt="Muscle Enhancement">
                	<h4> Muscle Enhancement </h4>
                </div>
            </div>
            <div class="col-xs-2">
            	<div class="goal" id="goal-daily" onclick="goal('daily')">
                	<img src="images/icon-daily-maintenance.png" alt="Daily Maintenance">
                	<h4> Daily Maintenance </h4>
                </div>
            </div>
            <div class="col-xs-2">
            	<div class="goal" id="goal-toning" onclick="goal('toning')">
                	<img src="images/icon-toning.png" alt="Toning">
                	<h4> Toning </h4>
                </div>
            </div>
        </div>
    </div>
</div> 


<script type="text/javascript">
	var sex;
	var age;

	function gender(g){
		var m = '#male_gender_button';
		var f = '#female_gender_button';
		
		switch(g) {
			case "male":
				if(!$(m).hasClass('on')){
					$(m).addClass('on');
				}
				if($(f).hasClass('on')){
					$(f).removeClass('on');
				}
				break;
			case "female":
				if(!$(f).hasClass('on')){
					$(f).addClass('on');
				}
				if($(m).hasClass('on')){
					$(m).removeClass('on');
				}
				break;
			default:
				break;
		}
		sex = g;
	}
	
	new Dragdealer('age-drag', {
		animationCallback: function(x,y){
			age = Math.round(x*100);
		}
	});
	
	function goal(theGoal){
		alert(sex + " " + age + " " + theGoal);
		if(sex !== undefined){
			var temp = window.location.href;
			if (temp.indexOf("?") > -1){
				temp = temp.substring(0, temp.indexOf("?"));
				window.location.href = temp + "?s=" + sex + "&a=" + age + "&g=" + theGoal;
			}else{
				window.location.href += "index.php?s=" + sex + "&a=" + age + "&g=" + theGoal;
			}
		}
	}
	
</script>

</body>
</html>