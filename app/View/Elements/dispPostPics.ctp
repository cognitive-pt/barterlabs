
<div class="pure-g">
        

<?php foreach($postPics as $postPic): ?>
       
        <div class="photo-box pure-u-1 pure-u-med-1-3 pure-u-lrg-1-4">
 
        <?php    
            echo $this->Html->link($this->Html->image('barter_blog/pics/' . $postPic['Pic']['name'], 
            array(
                'alt'=> $postPic['Pic']['tag']
                )), 
            array('controller' => 'posts', 
                'action' => 'viewPic', $postPic['Pic']['id'],'plugin'=>''), 
            array('escape' => false));
        ?>



            <aside class="photo-box-caption">
                <span><?php echo $postPic['Pic']['tag'];?></span>
            </aside>
        </div>

 <?php endforeach;?>


</div>