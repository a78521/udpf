<?php
include 'radio_function.php';
$arry=radio();
?>    
<!doctype html>
<html>
<head>
<title> Radio</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="css.css">
<style>
#bg
    {
     background-image: url("/playlists/tvchannels/logoicon/");
    background-repeat:no-repeat;
    background-position: center;
    background-attachment: fixed;
	background-color: white;
    color:black;
    font-size:100%;
    font-family: "Times New Roman", Times, serif;
    margin:0;
     }
#big_container {  overflow:auto;
                  background-color: #cccccc;
				  color: black;
				  margin: auto;
				  margin-top:10px;
				  margin-bottom:10px;
				  padding:10px 20px 5px 20px;
				  border: 1px solid #cccccc;
                  border-radius: 6px;
				  max-width:80%;
				  height :50%;
				  overflow: auto;
				  

                 }
form[id=form]{
                  margin-top:10px;
				  margin-left:5px;
				  margin-bottom:10px;
				  
               }				 
input[id=search]{
             background-color: #ffffff;
			 color: black;
			 border: 2px;
			 border-radius: 5px;
			 padding:0px 15px 0px 15px;
			 width:250px;
			 height:40px;
			 margin-top:5px;
				  margin-left:5px;
				  margin-bottom:5px;
             }

#button  {
			 border: 2px;
			 border-radius: 5px;
             background-color: white;
			 color: green;
			 padding:5px;
			 width:auto;
			 height:auto;
			 margin-top:5px;
		     margin-left:5px;
			margin-bottom:5px;
			overflow: auto;
			display: inline-block;
			float:center;
			text-align: center;
			}
#bg::-webkit-scrollbar 
                { width: 0 !important }
#desc::-webkit-scrollbar 
                { width: 0 !important }
#desc {
	max-width:100px;
	height:auto;
    padding: auto;
	overflow: auto;
}

</style>		
</head>
<body id='bg'>
<div id='big_container'>
<center><div id='button'><?php echo $arry['title']; ?></div></center>
<iframe width="60px" height="65px" name="iframe_a" frameborder="0" allowfullscreen="true" scrolling="no"  style="align="center" float="center" id='livetv_video1' class="media__video--responsive" style="z-index:4"></iframe>
<form id="form">
 <input type="gmail" id="search" placeholder="search" autocomplete="off">      
</form>
<div id='results'></div>
<hr>
<?php
$returnValue=$arry;
$arry_length=count($returnValue['items']);
for($x=0; $x < $arry_length; $x++)
{
?>
<div  id="button">
<a href="http://bhuvankumarthakur.co.nf/tools/custom/player.php?title=<?php echo $returnValue['items'][$x]['name']; ?>&ext=<?php echo $returnValue['items'][$x]['type']; ?>&url=<?php echo $returnValue['items'][$x]['url']; ?>" target="iframe_a"><img style="width:100px;height:auto;" src="<?php echo $returnValue['imageurl'].$returnValue['items'][$x]['image']; ?>" alt='<?php echo $returnValue['items'][$x]['name']; ?>'></a>
<div  id="desc">
<?php echo $returnValue['items'][$x]['name']; ?>
  </div>
  </div>
<?php
}
?>

<center><a href="/" ><div id='button'> Home </div></a></center>

</div>
</body>
</html>
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
            $.getJSON('radio.json', function(data) {
			  data=data.items;
			  imageurl=data.imageurl ;
              $.each(data, function(key, val){
                if ((val.name.search(regex) != -1)){   
				  output += '<div  id="button">';
                  output += '<a href="http://bhuvankumarthakur.co.nf/tools/custom/player.php?title='+val.name+'&ext='+val.type+'&url=' + val.url + '"  target="iframe_a" ><img style="width:100px;height:auto;" src="http://bhuvankumarthakur.co.nf/playlists/tvchannels/logoicon/' + val.image +'" alt="'+val.name+'"></a>';  
                 output +=  '<div  id="desc">'+val.name+'</div></div>';
				 count++;
                }
              });
              output += '';
              $('#results').html(output);
            }); 
        });
      });
</script>