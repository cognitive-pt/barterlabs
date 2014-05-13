<?php 
/*********************************************************************************************/
/*************** This is the introductory educational modal for new users ********************/
/*********************************************************************************************/
?>


<div class="modal" id="myModal" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                 <button class="close" data-dismiss="modal">×</button>
                <h3 class="modal-title" id="myModalLabel"><?php echo __('Ready to Go!!'); ?></h3>
            </div>
            <div class="modal-body">
                    
                    <p> <?php  $logo = '/img/help/help_toolbar_2.png';
                         echo $this->Html->Image($logo);?> </p>

                    <hr>

                    <p>Ok! You're ready to go!</p>

                    <p><strong>This is your user profile page.</strong> All of your Labs (trade/skill/barter ads) are listed here.</p>

                    <p>You can add as many Labs as you want!</p>

                    <p>Say you have a couch you need to get rid of, click "Add Barter" or the + icon, say a few words, upload a pic
                       and you're ready to go!!</p>

                    <p>Maybe you're a great chef and you'd like to trade cooking lessons for a new fence... click + and share your skill with the world!!</p>

                    <p><strong>There's no limit to how many Labs you can create!</strong></p>

                    <p><strong>Create a new Lab </strong> (trade/barter) by clicking the + icon at the top of the screen at any time to offer a new item or service!</p>
                    
                    <p>It's <strong>THAT</strong> easy!!</p>

                    <p>The <strong>Trading Post</strong> is where you can see all of your current Labs. Click the "Trading Post" link to get a more detailed list of
                    your trades.</p>

                    <p>Your <strong>LabLevel</strong> is a number that represents your success on Barterlabs. If you like what somebody is doing on Barterlabs give them
                    an upvote! Votes help refine relevant search results and weed-away old and sketchy Labs.Show your appreciation for other peoples' hard work by clicking that Upvote button!! Let them know they did a good job!!</p>
                    
                    <p>And as always, <strong>Happy trading!</strong></p>




                    

            </div>
            <div class="modal-footer">
                <a href="#" class="btn" data-dismiss="modal" style="color: #000000;">Close</a><!-- note the use of "data-dismiss" -->
            </div>
        </div>
    </div>
</div>

<script>
    $(function(){
        $('#myModal').modal('show');
    });
</script>

