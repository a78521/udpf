<?php
function index()
{
$json=file_get_contents('index_json.json');
return $arry=json_decode($json,1);
}
$arry=index();
 ?>
<!DOCTYPE html>
<html lang="en-US">
<head>
<title>Index</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="Keywords" content=" all page link">
<meta name="Description" content=" it contains limks of pages">
<link rel="icon" href="/favicon.ico" type="image/x-icon">
<link rel="stylesheet" href="mycss/css.css">
<link rel="stylesheet" href="mycss_latest.css">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="http://github.hubspot.com/pace/pace.js"></script>
<link href="http://github.hubspot.com/pace/templates/pace-theme-center-atom.tmpl.css" rel="stylesheet" />
<!--<link href="http://github.hubspot.com/pace/templates/pace-theme-center-radar.tmpl.css" rel="stylesheet" />
<link href="http://github.hubspot.com/pace/templates/pace-theme-corner-indicator.tmpl.css" rel="stylesheet" />
<link href="http://github.hubspot.com/pace/docs/resources/flash-white.css" rel="stylesheet" />-->
<style>
.pace{
    background: rgba(0, 155, 255,0.5);
}
</style>
</head>
<body class="mycss-bg">
<!-- header-->
<header class="w3-bar w3-dark-gray w3-top w3-padding">
  <a class="w3-bar-item w3-button w3-green" href="<?php echo $arry['domain']; ?>"><span class="fa fa-home"></a>
  <a class="w3-right w3-btn w3-blue" href="login_regesrtration/login.php?logout=1"><span class="fa fa-sign-out"> </span></a>
  <a class="w3-bar-item w3-button w3-right" href="/contact_mail/contactform.htm"><span class="fa fa-envelope"></span></a>
   <!--<button class="w3-bar-item w3-right w3-green"><span class="fa fa-search"> </span> </button>
 <input  id="search" class="w3-bar-item w3-right w3-btn w3-white" type="text" placeholder="search...." name="search">-->
 </header>
<!-- header End -->


<!-- footer-->
<footer class="w3-container w3-grey w3-bottom">
<p class="w3-center"><span class="fa fa-copyright"><?php echo date("Y"); ?></p>
</footer>
<!-- footer End-->


<!-- content -->
<div class="mycss-big-container w3-light-gray" style="max-width:90%; margin-top:64px; margin-bottom:80px;">
<!-- content Start-->

   <!-- form -->
<div class="w3-panel ">
<input id="search" class="w3-bar-item w3-btn w3-white" type="text" placeholder="search...." name="search" autocomplete="off"> 
</div>

	<!--form End-->

		<!--Search Result-->
<div id='results'></div>
	<!--Search Result End-->
<!-- content main  -->
<div id='main'></div>
 <!-- content main End -->
</body>
</html>
         <!---main --->
<script type="text/javascript">
 $(window).load(function(){
            var output = ' ';
            var count = 1;
            $.getJSON('index_json.json', function(data) {
			  data=data.links;
              $.each(data, function(key, val){
                  output += '<a class="w3-btn w3-green w3-margin-bottom w3-margin-right" href="' + val.url + '" >' + val.name +'</a>';        
                  count++;
              });
              output += '';
              $('#main').html(output);
            }); 
      });
</script>

<!---search jquery--->
<script type="text/javascript">
 $(window).load(function(){
        $('#search').keyup(function(){
            var searchField = $('#search').val();
			if(searchField === '')  {
				$('#results').html('');
				return;
			}
			
            var regex = new RegExp(searchField, "i");
            var output = ' ';
            var count = 1;
            $.getJSON('index_json.json', function(data) {
			  data=data.links;
              $.each(data, function(key, val){
                if ((val.name.search(regex) != -1)){
                  output += '<a class="w3-btn w3-red w3-margin-bottom w3-margin-right" href="' + val.url + '" >' + val.name +'</a>';        
                  count++;
                }
              });
              output += '';
              $('#results').html(output);
            }); 
        });
      });
</script>
