<!-- File: /app/View/Posts/index.ctp -->


<div class="posts">
    <h1 class="content-subhead">Recent Posts</h1>



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
                    ?>
                    <div>
                        <?php
                        echo $this->Html->link(
                            'read more...',
                            array('action' => 'view', $post['Post']['id'])
                        );
                    ?>
                    </div>
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