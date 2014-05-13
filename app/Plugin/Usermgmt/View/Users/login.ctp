<?php
//This is the logo displayed on the Login Page
$logo = 'logo.jpg';
?>


<?php
//this is the drop-down navbar dashboard
?>

<?php
$contName = Inflector::camelize($this->params['controller']);
$actName = $this->params['action'];
$actionUrl = $contName.'/'.$actName;
$activeClass='active';
$inactiveClass='';
?>
	
					<?php 

					//echo $this->element('openid');

					echo $this->element('login'); 

					echo $this->element('sign_in_modal'); ?>



<div class="login-page-container">
	<div class="login-content span6">


		<div class="login-logo">
			<?php echo $this->Html->Image($logo);?>
		</div> <!-- END <div class="login-logo"> -->

		<div class="login-logo-subheading">
			<?php echo "things for things";?>
		</div> <!-- <div class="login-logo-subheading"> -->
	</div>



	<div class="login-content span3 offset1">
		<div class="login-bullets-container">
			<div class="login-page-classads">
				<?php echo "Free classified ads for trading services and things!"; ?>
			</div>
			<div>
				<h3 class="greylinks" style="margin-bottom:0px;
				     padding-bottom:0px;
				     padding-top: 50px;">
					<?php  echo $this->Html->image("../app/webroot/img/icons/glyphicon-arrow-right.png", array(
			    "alt" => "Arrow Right"));   ?>
					<u><?php echo $this->Html->link(__('Sign Up!', true), '/register', array('style'=>'sign-up-underline'));?></u>
				</h3>
				<h4 style="margin-top:0px;padding-top:0px;">
					<?php echo "It's fast, easy and free."?>
				</h4>
				<ul class="login-bullets-container" style="width: auto; 
														   padding-right:10px;">
					<li ><strong><?php echo "The only place on the web where carpentry can equal dance lessons ";?></strong><?php //echo " asdfsdf";?></li>
					<li><strong><?php echo "The best place to trade gardening for babysitting ";?></strong><?php //echo " asdfsdf";?></li>
					<li><strong><?php echo "Trade your old bike for a new couch ";?></strong><?php //echo " asdfsdf";?></li>
				</ul>
			</div>
		</div> <!-- END <div class="login-bullets-container"> -->
	</div> <!-- END <div class="login-content"> -->
</div> <!-- <div class="login-page"> -->



<div class="login-content span6">
	<table class="login-onion">
		<thead>
			<tr>
				<th></th>
				<th style="padding-bottom:15px;">Trade everything!</th>
			</tr>
		</thead>

		<tbody>
			<tr>
				<th><?php echo $this->Html->image("../app/webroot/img/icons/glyphicon-leaf.png", array(
					    "alt" => "Leaf")); ?></th>
				<td>Barter anything for anything.</td>
			</tr>

			<tr>
				<th><?php echo $this->Html->image("../app/webroot/img/icons/glyphicon-globe.png", array(
					    "alt" => "Globe")); ?></th>
				<td>Exchange your talents, trades and skills with anyone in the world.</td>
			</tr>

			<tr>
				<th><?php echo $this->Html->image("../app/webroot/img/icons/glyphicon-piano.png", array(
					    "alt" => "Piano")); ?></th>
				<td>Trade your stuff for other stuff.</td>
			</tr>
		</tbody>	
	</table>
</div> 


