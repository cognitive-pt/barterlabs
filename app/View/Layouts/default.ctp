<!DOCTYPE html>
<html lang="en">
	<head>
		<?php echo $this->Html->charset(); ?>

		<?php if(!empty($lab['Lab']['projectname'])){?>
			<title><?php echo $lab['Lab']['projectname']." - Barterlabs #".$lab['Lab']['id'];?></title>
		<?php } else {?> 
				<title>Barterlabs</title>
				<?php } ?>





		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<script language="javascript">
			var urlForJs="<?php echo SITE_URL ?>";
		</script>

	<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-51187144-1', 'barterlabs.com');
  ga('send', 'pageview');

</script>


		<?php
			echo $this->Html->meta('favicon');
			/* Bootstrap CSS */
			echo $this->Html->css('bootstrap.css?q='.QRDN);
			echo $this->Html->css('bootstrap-responsive.css?q='.QRDN);
			
			/* Usermgmt Plugin CSS */
			echo $this->Html->css('/usermgmt/css/umstyle.css?q='.QRDN);
			
			/* Chosen is taken from https://github.com/harvesthq/chosen/releases/tag/0.14.0 */
			echo $this->Html->css('/plugins/chosen/chosen.css?q='.QRDN);

			/* Jquery latest version taken from http://jquery.com */
			echo $this->Html->script('jquery-1.10.2.min.js');
			
			/* Bootstrap JS */
			echo $this->Html->script('bootstrap.js?q='.QRDN);
			
			/* Bootstrap Typeahead is taken from https://github.com/biggora/bootstrap-ajax-typeahead */
			echo $this->Html->script('/plugins/bootstrap-ajax-typeahead/js/bootstrap-typeahead.min.js?q='.QRDN);
			
			/* Chosen is taken from https://github.com/harvesthq/chosen/releases/tag/0.14.0 */
			echo $this->Html->script('/plugins/chosen/chosen.jquery.min.js?q='.QRDN);

			/* Usermgmt Plugin JS */
			echo $this->Html->script('/usermgmt/js/umscript.js?q='.QRDN);
			echo $this->Html->script('/usermgmt/js/ajaxValidation.js?q='.QRDN);

			echo $this->Html->script('/usermgmt/js/chosen/chosen.ajaxaddition.jquery.js?q='.QRDN);

			/* Pure CSS */
			echo $this->Html->css('normalize.css?q='.QRDN);
			echo $this->Html->css('pure-min.css?q='.QRDN);
			echo $this->Html->css('pure-bl.css?q='.QRDN);

			echo $this->Html->css('gallery.css?q='.QRDN);
			echo $this->Html->css('gallery-grid.css?q='.QRDN);


			echo $this->fetch('meta');
			echo $this->fetch('css');
			echo $this->fetch('script');




		?>
	</head>

	<body>

				<?php echo $this->element('blDash');?>
				<?php echo $this->element('Usermgmt.message'); ?>
				<?php echo $this->element('Usermgmt.message_validation'); ?>
				<?php echo $this->fetch('content'); ?>
				<div style="clear:both"></div>
		
	    
		<div id="footer">
			<div class="container">
				<p><?php echo $this->element('sm_footer');?></p>
				<p class="muted">Copyright &copy; 2013-<?php echo date('Y');?> Bird, Egg & Flower LLC. All Rights Reserved. Developed by <a href="http://www.jotliet.com/" target='_blank'>Team Barterlabs.</a></p>
			</div>
	    </div>
		<?php if(class_exists('JsHelper') && method_exists($this->Js, 'writeBuffer')) { echo $this->Js->writeBuffer(); } ?>
	</body>
</html>

<script>
    $('[rel="tooltip"]').tooltip('toggle')
    $('[rel="tooltip"]').tooltip('hide');   
</script>