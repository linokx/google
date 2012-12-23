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

	    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>  
       
    <script type="text/javascript">  
       $(function(){  

          /*$(".delete").on('click',function(event){
              event.preventDefault();
              var href=$(this).attr('href');
              var $this = $(this);
              $.ajax({
                url: href,
                success:function(data){
                  $this.parent().text(data).fadeOut(5000);
                }
              });
            });*/
			

          /*setInterval(function(){  
             $(".slider ul").animate({marginLeft:-150},800,function(){  
                $(this).css({marginLeft:0}).find("li:last").after($(this).find("li:first"));  
             })  
          }, 3500); */
       $('#form').on('submit',function(event){
          $('#loader').show();
       });
		  
          $(".delete").on('click',function(event){
              event.preventDefault();
              var href=$(this).attr('href');
              var $this = $(this);
              $.ajax({
                url: href,
                success:function(){
					$hauteur = $this.parent().prev().height();
					$this.parent().animate({left:650},1000);
                  $this.parent().prev().css('height',$hauteur).text("Lien supprimé").parent().delay(1500).slideUp(1000);
                }
              });
          });
		  $image = $('input[name="fImage"]');
		  $(".apercu li").on('click',function(event){
			$(this).parent().children().removeClass('choix');
			$(this).addClass('choix');
			$valeur = $(this).children().attr('src');
			$image.attr('value',$valeur);
		  });
		  



        });  
    </script>  
</body>

</html>