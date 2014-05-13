<div class ="vote-arrows">
	<div>
		<?php 								
			echo $this->Html->link($this->Html->image('icons/glyphicon_upvote.png', 
				array(
					'alt'=> 'glyphicon_upvote.png')), 
				array('action' => 'upVote', $lab['Lab']['id']), 
				array(
						'rel'=>'tooltip',//tooltip init
					'data-placement'=>'bottom', //tooltip placement
					'title'=>'Upvote Lab!', //tooltip text
					'escape' => false));
		?>
	</div>
	
	<div class="arrow-number">
		<center>
			<?php echo $allLabVotes; ?>
		</center>
	</div>

	<div>
		<?php 
			echo $this->Html->link($this->Html->image('icons/glyphicon_downvote.png', 
				array(
					'alt'=> 'glyphicon_downvote.png')), 
				array('action' => 'downVote', $lab['Lab']['id']), 
				array(
					'rel'=>'tooltip',//tooltip init
					'data-placement'=>'bottom', //tooltip placement
					'title'=>'Downvote Lab!', //tooltip text
					'escape' => false));
		?>
	</div>
</div>