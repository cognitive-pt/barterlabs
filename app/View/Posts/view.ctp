<!-- File: /app/View/Posts/view.ctp -->

<h1><?php echo $post['Post']['title']; ?></h1>

<p class="post-meta">
    <div class="post-created">
        Created: 

            <?php echo $this->Time->format(
                      'F jS, Y h:i A',
                      $post['Post']['created']);
            ?>
    </div>
</p>

<p><?php echo $post['Post']['content']; ?></p>

<p>	
	<div class="posts-back-color">
	                        <?php echo $this->Html->link(
	                            'Back',
	                            	array('controller'=>'Posts', 'action' => 'index'),
	                            	array('class'=>'pure-button')
	                        	);
                			?>
	</div>
</p>