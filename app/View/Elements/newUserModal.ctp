<div class="modal" id="myModal" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                 <button class="close" data-dismiss="modal">×</button>
                <h3 class="modal-title" id="myModalLabel"><?php echo __('Welcome to Barterlabs!!'); ?></h3>
            </div>
            <div class="modal-body">
              <p>Thank you for participating in the public beta test of barterlabs.com!!</p>
              <p>As you can imagine, you may find broken links, stylesheets that don't look right, features that break - or just plain  ol' cheeseball bugginess</p>
              <p>If you find something that doesn't look right, please take a moment to tell our engineers via the "Contact Us" or
              "Report Bug" forms and tell us what broke, where and how you accessed the site (Chrome, iPad, IE3, Mosaic, etc...),
              and copy/paste any browser errors.</p>
              <p>As a genuine THANK YOU for your status as a tester, you will forever be known as one of our first users - and someday that might actually mean something. Like, maybe you'll wander home twenty years from now and there will
              be a Super Nintendo on your doorstep.</p> 
              <p>Thanks for hanging around while we find our sea legs!</p>
                     
            </div>
            <div class="modal-footer">
                <a href="#" class="btn" data-dismiss="modal">Close</a><!-- note the use of "data-dismiss" -->
            </div>
        </div>
    </div>
</div>

<script>
    $(function(){
        $('#myModal').modal('show');
    });
</script>

