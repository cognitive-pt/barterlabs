<!-- File: /app/View/Posts/index.ctp -->




<div class="posts">
    <h1 class="content-subhead">Recent Posts
   <?php echo $this->Html->link($this->Html->image('icons/rss.png', 
                                    array(
                                        'alt'=> 'rss.png',
                                        'height'=>'30',
                                        'width'=>'30')), 
                                    array('controller' => 'Posts', 
                                        'action' => 'index', 'ext'=>'rss'), 
                                    array(
                                        
                                        'rel'=>'tooltip',//tooltip init
                                        'data-placement'=>'bottom', //tooltip placement
                                        'title'=>'Subscribe to the RSS feed.', //tooltip text
                                        'escape' => false)); ?>

                                        <?php echo $this->element('sm_footer');?>
                                        </h1>



                    <?php if($this->UserAuth->HP('Labs', 'randomAdminAccess')) {?>
                         <p><?php echo $this->Html->link('Add Post', array('action' => 'add')); ?></p>
                    <?php } ?>
<table>
    

<!-- Here's where we loop through our $posts array, printing out post info -->

    <?php foreach ($posts as $post): ?>

    <section class="post">
       
    <tr>
        <tr>
            <h2 class="post-title">
                <?php
                    echo $this->Html->link(
                        $post['Post']['title'],
                        array('action' => 'view', $post['Post']['id'])
                    );
                ?>
            </h2>
        </tr>
        <td>
           <tr>         <p class="post-meta">
                            
                            By <?php echo $this->Html->link(__($post['Post']['user_name'], true), 
                                        array(
                                            'controller'=>'Users', 
                                            'action'=>'viewUser', $post['Post']['user_id'], 
                                            'plugin'=>'usermgmt'),
                                        array(
                                            'class'=>'post-author')
                                        );?>

                                under <a class="post-category post-category-js" href="#">general</a>
                        </p>
            </tr>

            <tr>
                <div class="post-content">
                    <?php
                        echo substr($post['Post']['content'], 0, 200);  // abcd 
                        echo " ";
                    ?>
                </div>

                <div>
                    <?php
                    echo $this->Html->link(
                        "read more...",
                        array('action' => 'view', $post['Post']['id'])
                    );
                ?>
               
                </div>
            </tr>


            <tr>         <p class="post-meta">
                            <div class="post-created">
                                Created: 

                                    <?php echo $this->Time->format(
                                              'F jS, Y h:i A',
                                              $post['Post']['created']);
                                    ?>
                            </div>
                        </p>
            </tr>    

            <?php
                if($this->UserAuth->HP('Labs', 'randomAdminAccess')) {
                    echo $this->Html->link(
                        'Edit', array('action' => 'edit', $post['Post']['id'])
                    );
                    echo ' / ';

                }
            ?>

            <?php if($this->UserAuth->HP('Labs', 'randomAdminAccess')) {
                    echo $this->Form->postLink(
                        'Delete',
                        array('action' => 'delete', $post['Post']['id']),
                        array('confirm' => 'Are you sure?')
                    );
                }
            ?>

        </td>
        
    </tr>
    <?php endforeach; ?>

</table>
</section>