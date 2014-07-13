<!-- File: /app/View/Posts/view.ctp -->

<?php
                if($this->UserAuth->HP('Labs', 'randomAdminAccess')) {
                    echo $this->Html->link(
                        'Edit', array('action' => 'edit', $post['Post']['id'])
                    );
                    echo ' / ';
                }
          
                

                if($this->UserAuth->HP('Labs', 'randomAdminAccess')) {
                    echo $this->Form->postLink(
                        'Delete',
                        array('action' => 'delete', $post['Post']['id']),
                        array('confirm' => 'Are you sure?')
                    );
                    echo ' / ';
                }

                

                if($this->UserAuth->HP('Labs', 'randomAdminAccess')) {
                    echo $this->Html->link(
                        'Add Pic', array('action' => 'addPic', $post['Post']['id'])
                    );
                }

            ?>


<h1><?php echo $post['Post']['title']; ?></h1>
<strong>
    <p class="post-meta">
        <div class="post-created">
            Created: 

                <?php echo $this->Time->format(
                          'F jS, Y h:i A',
                          $post['Post']['created']);
                ?>
        </div>
    </p>
</strong>

<p><?php echo $post['Post']['content']; ?></p>


<p><?php echo $this->element('dispPostPics');?></p>

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

<div style="margin-top:15px;">
    <p>
        <?php
            echo "Comment:";
            ?><strong><?php echo $this->Form->create('Comment');?></strong><?php
            if(!empty($user_name)){?>
                <div style="margin-bottom: 15px;">
                    <?php echo "<strong>Posting as:</strong> ".$user_name;?>
                </div>
            <?php } else {
                echo $this->Form->input('name', array(
                                        'class'=> 'span5', 
                                        'label' => false,
                                        'placeholder'=>__('Your Name')));}
            echo $this->Form->input('content',array('type'=>'textarea','label' => false, 'rows' => 8, 'class'=> 'span8',
                                    'placeholder'=>__('Your Comment')));
            echo $this->Form->submit(__('Post'), array('div' => false, 'class'=>'pure-button button-success labsearchsearchbtn'));
            echo $this->Form->end();
    ?>
    </p>
</div>


<?php 
    $i=1;
    if(!empty($comments)){?>
<div><strong>Comments:</strong></div>

    <div>
         <?php foreach ($comments as $comment): {?>
            <hr></hr>
            <div style="margin-top: 15px;">
                <?php echo "#".$i;?>
            </div>
            <div>
                <?php echo "<strong>Name:</strong> ".$comment['Comment']['name'];?>
            </div>
            <div>
                <?php echo $comment['Comment']['content'];
            $i++;?>
            </div>
                <div>
                    <?php  if($this->UserAuth->HP('Labs', 'randomAdminAccess')) {
                            echo $this->Form->postLink(
                                'Delete',
                                array('action' => 'deleteComment', $comment['Comment']['id']),
                                array('confirm' => 'Are you sure?')
                            );}?>
                </div> <?php

        }endforeach;?>

    </div>
<?php } ?>