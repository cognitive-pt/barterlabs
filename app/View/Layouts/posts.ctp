<?php /* this is the layout page for the Blog */  ?>



<!DOCTYPE html>
<html lang="en">
	<head>
		<?php echo $this->Html->charset(); ?>
		<title>Barterlabs Blog</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<meta name="description" content="Barterlabs Blog">

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

			/* Pure CSS */
			echo $this->Html->css('normalize.css?q='.QRDN);
			echo $this->Html->css('pure-min.css?q='.QRDN);
			echo $this->Html->css('pure-bl.css?q='.QRDN);
				/* Pure Blog CSS */
				echo $this->Html->css('main-grid.css?q='.QRDN);
				echo $this->Html->css('blog.css?q='.QRDN);

			echo $this->fetch('meta');
			echo $this->fetch('css');
			echo $this->fetch('script');
		?>
	</head>



	<body>

			
				<?php
					if($this->UserAuth->isLogged()) {
						echo $this->element('blDash');
					} else{
						echo $this->element('Usermgmt.login_guest');?>
						</div></div>
					<?php } ?>


<div id="layout" class="pure-g">
    <div class="sidebar pure-u-1 pure-u-med-1-4">
        <div class="header">
			            <hgroup>
			                <h1 class="brand-title">Barterlabs Blog</h1>
			                <h2 class="brand-tagline">things-for-things</h2>
			            </hgroup>


			            <nav class="nav">
			                <ul class="nav-list">
			                    <div class="nav-item">

			                    	<?php echo $this->Html->link(
			                            'Barterlabs',
			                            	array('controller'=>'Labs', 'action' => 'index'),
			                            	array('class'=>'pure-button')
			                        	);
                        			?>

			                    </div>
			                    <div class="nav-item">
			                    
			                        <?php echo $this->Html->link(
			                            'Blog',
			                            	array('controller'=>'Posts', 'action' => 'index'),
			                            	array('class'=>'pure-button')
			                        	);
                        			?>
			                    
			                    </div>
			                </ul>
			            </nav>
        </div>
    </div>

					    <div class="content pure-u-1 pure-u-med-3-4">
					        <div>
					            <!-- A wrapper for all the blog posts -->
					            		<?php echo $this->element('Usermgmt.message'); ?>
										<?php echo $this->element('Usermgmt.message_validation'); ?>
					            		<?php echo $this->fetch('content'); ?>
					        </div>
					    </div>

				<div style="clear:both"></div>
			
		
	    
		<div id="footer" style="margin-top: 5em;">
			<div class="container">
				<p class="muted">Copyright &copy; 2013-<?php echo date('Y');?> Bird, Egg & Flower LLC. All Rights Reserved. Developed by <a href="http://www.jotliet.com/" target='_blank'>Team Barterlabs.</a></p>
			</div>
	    </div>
		<?php if(class_exists('JsHelper') && method_exists($this->Js, 'writeBuffer')) { echo $this->Js->writeBuffer(); } ?>
	</body>
</html>


<script src="http://yui.yahooapis.com/3.14.1/build/yui/yui.js"></script>
<script>
YUI().use('node-base', 'node-event-delegate', function (Y) {
    // This just makes sure that the href="#" attached to the <a> elements
    // don't scroll you back up the page.
    Y.one('body').delegate('click', function (e) {
        e.preventDefault();
    }, 'a[href="#"]');
});
</script>