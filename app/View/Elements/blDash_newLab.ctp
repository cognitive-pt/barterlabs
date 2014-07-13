<?php /************ START OF NEW LAB ***********/ ?>
    <ul class="nav nav-pills">
		<li class='dropdown'>
			<?php echo $this->Html->link($this->Html->image('icons/glyphicon-circleplus.png', 
					array(
						'alt'=> 'glyphicon-circleplus.png')), 
					array(
						'controller' => 'Labs', 
						'action' => 'createLab', 'plugin'=>''), 
					array(
						'rel'=>'tooltip',//tooltip init
						'data-placement'=>'bottom', //tooltip placement
						'title'=>'New Lab!', //tooltip text
						'escape' => false,
						));?>
		</li>
	</ul>
<?php /************ END OF NEW LAB ***********/ ?>