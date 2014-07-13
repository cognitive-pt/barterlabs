<div class="um-panel" style="margin-top:70px">
	<div class="um-panel-header">
		<span class="um-panel-title">
			<?php echo "Thank you!";?>	
		</span>
		
	    <span class="um-panel-title-right">
	  		<div style="color:sienna;margin-bottom:5px;">
	    	<?php echo $this->Html->link(__('Back'), array($this->request->referer()));?>
	    	
	    	</div>
		</span>
	</div>

	
	<div class="um-panel-content">
                <div class="login-content-left span3 offset1" style="height:auto;width:auto;margin-top:15px;margin-left:15px;
                margin-bottom:50px;padding-top:25px;padding-left:10px;padding-right:10px;padding-bottom:15px;">
                <strong><?php 
                	echo "Barterlabs.com would like to thank the following people, groups and businesses,
                		  without whom we would be forever lost.";
                ?></strong>
		<div class="login-bullets-container" style="margin-top:35px;margin-left:10px;">
			<div class="greylinks">
				<ul>
					<li><strong><?php echo $this->Html->link('Google Developers','https://developers.google.com/',
									  array('target' => '_blank'));?></strong>
							    <?php echo " Revolutionary internet company which shares the wealth of its knowledge for the betterment
							    		 	 of the world.";?></li>
					<li><strong><?php echo $this->Html->link('CakePHP','http://www.cakephp.org',
									  array('target' => '_blank'));?></strong>
							    <?php echo " Cake Software Foundation, Inc.";?></li>
					<li><strong><?php echo $this->Html->link('Ektanjali Software','http://http://www.ektanjali.com',
									  array('target' => '_blank'));?></strong>
							    <?php echo " Creators of fine CakePHP plug-ins.";?></li>
					<li><strong><?php echo $this->Html->link('Bauhaus Coffee - Seattle, WA','http://www.bauhauscoffee.net/',
									  array('target' => '_blank'));?></strong>
								<?php echo " \"Brilliant, and less cold than elsewhere.\"";?></li>
					<li><strong><?php echo $this->Html->link('Impact HUB Seattle','http://www.impacthubseattle.com/',
									  array('target' => '_blank'));?></strong>
								<?php echo " Coworking for globally conscious entrepreneurs.";?></li>
			 		<li><strong><?php echo $this->Html->link('Bootstrap','http://www.getbootstrap.com',
			 						  array('target' => '_blank'));?></strong>
				 				<?php echo " The most popular front-end framework for developing responsive, mobile-first projects on the web.";?></li>
					<li><strong><?php echo $this->Html->link('Glyphicons','http://www.glyphicons.com/',
									  array('target' => '_blank'));?></strong>
				 				<?php echo " Free icons for perfectly prepared data, modern look and easy usability for graphics of all kinds.";?></li>
				 	<li><strong><?php echo $this->Html->link('Reddit.com','http://www.reddit.com/',
									  array('target' => '_blank'));?></strong>
				 				<?php echo " Ecompassing the spirit of the open-source community which drives innovation and competition.";?>	 </li>
				 	<li><strong><?php echo $this->Html->link('PureCSS','http://purecss.io/',
									  array('target' => '_blank'));?></strong>
				 				<?php echo " A set of small, responsive CSS modules that you can use in every web project.";?>	 </li>
				 	<li><strong><?php echo $this->Html->link('ooCharts','http://oocharts.com/',
									  array('target' => '_blank'));?></strong>
				 				<?php echo " An extraordinary toolkit for building your very own Google Analytics™ dashboard";?>	 </li>
				 	<li><strong><?php echo $this->Html->link('Andrew Perkins','http://andrewperkins.net/cakephp/',
									  array('target' => '_blank'));?></strong>
				 				<?php echo " A talented PHP / CakePHP developer who shares the wealth of his knowledge with the world.";?>	 </li>


				 	<li><strong><?php echo $this->Html->link('People','#');?></strong>
				 				<?php echo " Kevin, Graham, Said, Renee and many many many more!";?>	 </li>





				</ul>
			</div>
		</div>	
	</div> <!-- END <div class="login-content span3 offset1">-->
    

    </div> <!-- END <div class="um-panel-content">-->
 		
</div> <!-- END <div class="um-panel">-->
