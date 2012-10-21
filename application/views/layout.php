<!DOCTYPE HTML>
<html lang="fr-BE">
<head>
	<meta charset="UTF-8">	
	<link rel="stylesheet" type="text/css" href="<?php echo site_url().CSS_DIR;?>/style.css" media="screen" />
	<title><?php echo $main_title; ?></title>
</head>
<body>
<h1><a href="<?php echo site_url(); ?>">Recherche un site</a></h1>
	<?php echo $vue; ?>

	    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script>  
       
    <script type="text/javascript">  
       $(function(){  
          setInterval(function(){  
             $(".slider ul").animate({marginLeft:-150},800,function(){  
                $(this).css({marginLeft:0}).find("li:last").after($(this).find("li:first"));  
             })  
          }, 3500);  
       });  
    </script>  
</body>

</html>