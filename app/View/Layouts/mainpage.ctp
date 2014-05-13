<!DOCTYPE html>
<html lang="en">
<head>
	<?php echo $this->Html->charset(); ?>
	<title>Barterlabs</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<script language="javascript">
		var urlForJs="<?php echo SITE_URL ?>";
	</script>

	<?php
		echo $this->Html->meta('favicon');
		/* Bootstrap CSS */
		echo $this->Html->css('bootstrap.css?q='.QRDN);
		echo $this->Html->css('bootstrap-responsive.css?q='.QRDN);
		
		/* Usermgmt Plugin CSS */
		echo $this->Html->css('/usermgmt/css/umstyle.css?q='.QRDN);
		
		/* Bootstrap Datepicker is taken from https://github.com/eternicode/bootstrap-datepicker */
		echo $this->Html->css('/plugins/bootstrap-datepicker/css/datepicker.css?q='.QRDN);

		/* Bootstrap Datepicker is taken from https://github.com/smalot/bootstrap-datetimepicker */
		echo $this->Html->css('/plugins/bootstrap-datetimepicker/css/datetimepicker.css?q='.QRDN);
		
		/* Chosen is taken from https://github.com/harvesthq/chosen/releases/tag/0.14.0 */
		echo $this->Html->css('/plugins/chosen/chosen.css?q='.QRDN);

		/* Jquery latest version taken from http://jquery.com */
		echo $this->Html->script('jquery-1.10.2.min.js');
		
		/* Bootstrap JS */
		echo $this->Html->script('bootstrap.js?q='.QRDN);

		/* Bootstrap Datepicker is taken from https://github.com/eternicode/bootstrap-datepicker */
		echo $this->Html->script('/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js?q='.QRDN);

		/* Bootstrap Datepicker is taken from https://github.com/smalot/bootstrap-datetimepicker */
		echo $this->Html->script('/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js?q='.QRDN);
		
		/* Bootstrap Typeahead is taken from https://github.com/biggora/bootstrap-ajax-typeahead */
		echo $this->Html->script('/plugins/bootstrap-ajax-typeahead/js/bootstrap-typeahead.min.js?q='.QRDN);
		
		/* Chosen is taken from https://github.com/harvesthq/chosen/releases/tag/0.14.0 */
		echo $this->Html->script('/plugins/chosen/chosen.jquery.min.js?q='.QRDN);

		/* Usermgmt Plugin JS */
		echo $this->Html->script('/usermgmt/js/umscript.js?q='.QRDN);
		echo $this->Html->script('/usermgmt/js/ajaxValidation.js?q='.QRDN);

		echo $this->Html->script('/usermgmt/js/chosen/chosen.ajaxaddition.jquery.js?q='.QRDN);

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
</head>


<body>
	<div class="container">
		<div class="content">
        

		
			




		


			<?php
				if($this->UserAuth->isLogged()) {
					
					echo $this->element('blDash');
				    echo $this->element('Usermgmt.message');
					echo $this->fetch('content');
				} ?>
			
			<?php echo $this->element('Usermgmt.message_validation'); ?>
			<div style="clear:both"></div>
		</div>
	</div>
    
    
	<div id="footer">
		<div class="container">
			<p class="muted">Copyright &copy; 2013-<?php echo date('Y');?> Bird, Egg & Flower LLC. All Rights Reserved. <a href="http://www.jotliet.com/" target='_blank'>Developed by Team Barterlabs.</a>.</p>
		</div>
    </div>
	<?php if(class_exists('JsHelper') && method_exists($this->Js, 'writeBuffer')) { echo $this->Js->writeBuffer(); } ?>
</body>
</html>