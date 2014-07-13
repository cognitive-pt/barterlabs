<!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <style>
        .faq-section label,
        .faq-section label:hover{
            cursor: default;
            background: #eee;
        }        
        body .faq-section p{ /* Increase specificity */
            display: block;
            color: #444;
            font-size: 1em;
            text-overflow: clip; 
            white-space: normal;
            overflow: visible;              
        }
    </style>
<![endif]--> 

            <?php if ($this->UserAuth->isLogged()) {?>    
                <strong><div style = "margin-left: 55px;">
                    <?php echo $this->Html->link(__('((Add New Question))'), array('action' => 'add'));?>
                </div></strong>
            <?php }?>

    <div class="new-block">
        <center>
            <div style="font-size: 5em; margin-top:25px; padding-left:15px; margin-right:15px;">
                Barterlabs
            </div>

            <h1>New User FAQs</h1>

        </center>
    </div>

    <?php foreach ($faqs as $faq): ?>
        <section class="faq-section">
            <input type="checkbox" id="q1">
            <label for="q1"><?php echo $faq['Faq']['question'];?></label>           
            <?php echo $faq['Faq']['answer'];?>

                <?php if ($this->UserAuth->isLogged()) {?>
                    <div class = "faq-admin"><strong>
                        <?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $faq['Faq']['id']));
                        echo " / ";
                        echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $faq['Faq']['id']), null, __('Are you sure you want to delete # %s?', $faq['Faq']['id']));?>
                    </div></strong>
                <?php }?>
        </section>


    <?php endforeach; ?>