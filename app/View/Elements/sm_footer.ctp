<?php
    echo $this->Html->link($this->Html->image('icons/sm_fb.png', 
        array(
            'alt'=> 'sm_fb.png',
            'height'=>'20',
            'width'=>'20')), 
        'https://www.facebook.com/barterlabs', 
        array(
            
            'rel'=>'tooltip',//tooltip init
            'data-placement'=>'bottom', //tooltip placement
            'title'=>'Join us on Facebook!', //tooltip text
            'escape' => false,
            'target' => '_blank')); 

    echo $this->Html->link($this->Html->image('icons/sm_tw.png', 
        array(
            'alt'=> 'sm_tw.png',
            'height'=>'20',
            'width'=>'20')), 
        'https://twitter.com/barterlabs', 
        array(
            
            'rel'=>'tooltip',//tooltip init
            'data-placement'=>'bottom', //tooltip placement
            'title'=>'Never miss a mistake... hit us on Twitter!', //tooltip text
            'escape' => false,
            'target' => '_blank')); 

echo $this->Html->link($this->Html->image('icons/sm_ig.png', 
        array(
            'alt'=> 'sm_ig.png',
            'height'=>'20',
            'width'=>'20')), 
        'http://instagram.com/barterlabs', 
        array(
            
            'rel'=>'tooltip',//tooltip init
            'data-placement'=>'bottom', //tooltip placement
            'title'=>'This link might work! Or not!', //tooltip text
            'escape' => false,
            'target' => '_blank')); 




?>