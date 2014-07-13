<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Barterlabs.com things-for-things">
        <title>Barterlabs.com thing-for-things</title>
    </head>
<body>


    <div>

        <div class="pure-g"> <!--initialize Pure CSS grids-->

            


            <div class="text-box pure-u-1 pure-u-med-2-3 pure-u-lrg-3-4">
                <div class="l-box">
                    <h1 class="text-box-head">Barterlabs</h1>
                        <div class="login-logo-subheading">
                            <?php echo "this for that";?>
                        </div> <!-- <div class="login-logo-subheading"> -->
                </div>
                <div class="labsearch">
                    <?php echo $this->Form->create('Lab', array(
                    'url' => array_merge(array('action' => 'find'), $this->params['pass'])
                ));
                        echo $this->Form->input('search', array(
                            'div' => false, 
                            'label'=>false, 
                            'class'=>'span6',
                            'placeholder'=>__('Start here by searching Barterlabs!')));   
                             $this->Form->input('catalyst', array('type' => 'hidden', 'value'=>1));; ?>
                        <div>
                            <div class = "login-inline">
                                <?php echo $this->Form->submit(__('Search'), array('div' => false, 'class'=>'button-large button-success pure-button', 'style'=>'padding:2px;'));
                                echo $this->Form->end();?>
                            </div>
                        </div>
                </div>
            </div>

            <div class="photo-box pure-u-1 pure-u-med-1-3 pure-u-lrg-1-4">
                <a href="http://www.barterlabs.com/posts/">
                    <img src="/img/barter_blog/barter2c.jpg" alt="Barterlabs Blog"> 
                </a>
                <aside class="photo-box-caption">
                    <span><a href="http://www.barterlabs.com/posts/">Barterlabs Blog</a></span>
                </aside>
            </div>



            <div style = "margin-top: 10px;">

                <?php $i=0;
                foreach ($frontHots as $frontHot): {?>
                    <?php if($i==4) break;
                        if (($frontHot['Pic']['0']['name'] != null)||(!empty($frontHot['Pic']['0']['name']))){?>
                            <div class="photo-box pure-u-1 pure-u-med-1-2 pure-u-lrg-1-3">
                                <?php echo $this->Html->link($this->Html->image('pics/' . $frontHot['Pic']['0']['name'],
                                        array(
                                            'alt'=> $frontHot['Pic']['0']['tag']
                                            )), 
                                        array('controller' => 'labs', 
                                            'action' => 'view', $frontHot['Pic']['0']['lab_id'],'plugin'=>''), 
                                        array('escape' => false));?>
                                <!--this ribbon CSS goes after the link to the picture-->
                                    <div class="ribbon-wrapper">
                                        <div class="ribbon-hot">HOT!</div>
                                    </div>  
                                <!--end ribbon class-->
                                            <aside class="photo-box-caption">
                                                <span>
                                                    <?php echo $this->Html->link(__($frontHot['Lab']['projectname'], true), array('controller'=>'Labs', 'action'=>'view',$frontHot['Lab']['id']));
                        $i++;?>
                                                </span>
                                            </aside>
                            </div>
                    <?php }?>

                <?php } endforeach; ?>

            <?php 
                $j=0;
                foreach ($frontLabs as $frontLab): {?>
                    <?php            
                        if($j==2) break;      
                            if (($frontLab['Pic']['0']['name'] != null)||(!empty($frontLab['Pic']['0']['name']))){?>
                                <div class="photo-box pure-u-1 pure-u-med-1-2 pure-u-lrg-1-3">
                                    <?php
                                        echo $this->Html->link($this->Html->image('pics/' . $frontLab['Pic']['0']['name'], 
                                            array(
                                                'alt'=> $frontLab['Pic']['0']['tag']
                                                )), 
                                            array('controller' => 'labs', 
                                                'action' => 'view', $frontLab['Pic']['0']['lab_id'],'plugin'=>''), 
                                            array('escape' => false));?>

                                    <!--this ribbon CSS goes after the link to the picture-->
                                        <div class="ribbon-wrapper">
                                            <div class="ribbon-new">NEW!</div>
                                        </div>  
                                    <!--end ribbon class-->
                                                <aside class="photo-box-caption">
                                                    <span>
                                                        <?php echo $this->Html->link(__($frontLab['Lab']['projectname'], true), array('controller'=>'Labs', 'action'=>'view',$frontLab['Lab']['id']));
                        $j++;?>
                                                    </span>
                                                </aside>
                                </div>
                    <?php }?>
            <?php } endforeach; ?>


            <?php $i=0;
                foreach ($tradedLabs as $tradedLab): {?>
                    <?php if($i==2) break;
                        if (($tradedLab['Pic']['0']['name'] != null)||(!empty($tradedLab['Pic']['0']['name']))){?>
                            <div class="photo-box pure-u-1 pure-u-med-1-2 pure-u-lrg-1-3">
                                <?php echo $this->Html->link($this->Html->image('pics/' . $tradedLab['Pic']['0']['name'],
                                        array(
                                            'alt'=> $tradedLab['Pic']['0']['tag']
                                            )), 
                                        array('controller' => 'labs', 
                                            'action' => 'view', $tradedLab['Pic']['0']['lab_id'],'plugin'=>''), 
                                        array('escape' => false));?>
                                <!--this ribbon CSS goes after the link to the picture-->
                                    <div class="ribbon-wrapper">
                                        <div class="ribbon-traded">TRADED!</div>
                                    </div>  
                                <!--end ribbon class-->
                                            <aside class="photo-box-caption">
                                                <span>
                                                    <?php echo $this->Html->link(__($tradedLab['Lab']['projectname'], true), array('controller'=>'Labs', 'action'=>'view',$tradedLab['Lab']['id']));
                        $i++;?>
                                                </span>
                                            </aside>
                            </div>
                    <?php }?>

                <?php } endforeach; ?>   


                        <div class="photo-box pure-u-1 pure-u-med-1-3">
                            <a href="http://www.barterlabs.com/posts">
                                <img src="/img/barter_blog/barter2c.jpg"
                                     alt="Barterlabs Blog">
                            </a>
                            <aside class="photo-box-caption">
                                <span>
                                    <a href="http://www.barterlabs.com/posts">Barterlabs Blog</a>
                                </span>
                            </aside>
                        </div>


                </div>
            </div>
        </div>
    </div>

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





    </body>
</html>
