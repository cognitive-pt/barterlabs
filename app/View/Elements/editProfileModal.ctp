

<div class="modal" id="myModal" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                 <button class="close" data-dismiss="modal">×</button>
                <h3 class="modal-title" id="myModalLabel"><?php echo __('Thanks for signing up for Barterlabs!'); ?></h3>
            </div>
            <div class="modal-body">
                <p>Barterlabs is a place where you can trade anything for anything.</p>

                <p>The first step is to build a profile. Bartering is all about building connections with people in the real world, so you'll increase your chances of success by building a well-rounded profile. The more that others discover who you are, the more trust you will build with the community!</p>

                <p>Tap the "help" button for help filling out the form!</p>

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

