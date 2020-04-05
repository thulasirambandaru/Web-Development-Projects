<?php if($this->session->userdata('user_id') && $this->session->userdata('user_type_id') > 0){ ?>
    </div>
	
    <div id="spinner" class="spinner" style="display:none;">
        Loading&hellip;
    </div>
	
	<div id="dialog-confirm" title="Confirm Delete" style='display:none;'>
		<p>
			<span class="ui-icon ui-icon-alert" style="float:left; margin:12px 12px 20px 0;"></span>
			This item will be permanently deleted and cannot be recovered. Are you sure?
		</p>
	</div>
	
    <footer class="application-footer">
        <div class="container">
            <div class="disclaimer"> <p>Copyright © 2016. All rights reserved. SUN SMS</p> </div>            
        </div>
    </footer>	
    </div>
	
	
    <!--<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>-->
	<!--<script type="text/javascript" src="<?/*=BASE_URL*/?>js/bootstrap.min.js"></script>--?
	
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.11/js/jquery.dataTables.min.js"></script>
    <!--<script type="text/javascript" src="<?/*=BASE_URL*/?>datatables/jquery.dataTables.js"></script>
    <script type="text/javascript" src="<?/*=BASE_URL*/?>datatables/dataTables.tableTools.js"></script>
    <script src="<?/*=BASE_URL*/?>datatables/dataTables.bootstrap.js" type="text/javascript"></script>-->
	
    <!--common script for all pages-->
	<script src="<?=BASE_URL?>js/jquery.validate.min.js"></script>
    <script src="<?=BASE_URL?>js/forms.js"></script>
    <script src="<?=BASE_URL?>js/common-scripts.js"></script>
    <script type="text/javascript">	
        $(function() {
            /*Quick links dynamic height starts*/
            $('#left').height($('.right-section').height()+20);
            $('.right-section .dataTables_length select').change(function(){
                var rightDivHeight = $(this).closest('.right-section').height();
                $('#left').height(rightDivHeight+20);
            });
            /*Quick links dynamic height ends*/
        });
    </script>
	
    <!--<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>-->
	<script type="text/javascript" src="<?=BASE_URL?>js/bootstrap.min.js"></script>
	
    <!--<script type="text/javascript" src="https://cdn.datatables.net/1.10.11/js/jquery.dataTables.min.js"></script>-->
    <script type="text/javascript" src="<?=BASE_URL?>js/jquery/jquery.dataTables.min.js"></script>
	
    <!--<script src="<?/*=BASE_URL*/?>js/bootstrap/jquery.js" type="text/javascript" ></script>-->
    <script src="<?=BASE_URL?>js/bootstrap/bootstrap-transition.js" type="text/javascript" ></script>
    <script src="<?=BASE_URL?>js/bootstrap/bootstrap-alert.js" type="text/javascript" ></script>
    <script src="<?=BASE_URL?>js/bootstrap/bootstrap-modal.js" type="text/javascript" ></script>
    <script src="<?=BASE_URL?>js/bootstrap/bootstrap-dropdown.js" type="text/javascript" ></script>
    <script src="<?=BASE_URL?>js/bootstrap/bootstrap-scrollspy.js" type="text/javascript" ></script>
    <script src="<?=BASE_URL?>js/bootstrap/bootstrap-tab.js" type="text/javascript" ></script>
    <script src="<?=BASE_URL?>js/bootstrap/bootstrap-tooltip.js" type="text/javascript" ></script>
    <script src="<?=BASE_URL?>js/bootstrap/bootstrap-popover.js" type="text/javascript" ></script>
    <script src="<?=BASE_URL?>js/bootstrap/bootstrap-button.js" type="text/javascript" ></script>
    <script src="<?=BASE_URL?>js/bootstrap/bootstrap-collapse.js" type="text/javascript" ></script>
    <script src="<?=BASE_URL?>js/bootstrap/bootstrap-carousel.js" type="text/javascript" ></script>
    <script src="<?=BASE_URL?>js/bootstrap/bootstrap-typeahead.js" type="text/javascript" ></script>
    <script src="<?=BASE_URL?>js/bootstrap/bootstrap-affix.js" type="text/javascript" ></script>
    <!--<script src="<?/*=BASE_URL*/?>js/bootstrap/bootstrap-datepicker1.js" type="text/javascript" ></script>-->
    <script src="<?=BASE_URL?>js/jquery/jquery-tablesorter.js" type="text/javascript" ></script>
    <script src="<?=BASE_URL?>js/jquery/jquery-chosen.js" type="text/javascript" ></script>
    <script src="<?=BASE_URL?>js/jquery/virtual-tour.js" type="text/javascript" ></script>
    <script src="<?=BASE_URL?>js/jquery.validate.min.js"></script>
    <script src="<?=BASE_URL?>js/forms.js"></script>
    <!--common script for all pages-->
    <script src="<?=BASE_URL?>js/common-scripts.js"></script>
    	<script type="text/javascript">

        $(function() {
            $('#datepicker').datepicker();
            $('.datepicker').datepicker({
                dateFormat: 'dd-M-yy',
				changeMonth: true,
				changeYear:true,
				yearRange: "-100:+10",
            });			
            $('#sample-table').tablesorter();
            //$(".chosen").chosen();
            /* Set the width of the side navigation to 250px */
        });
        // Responsive Menu
        var html = $('html, body'),
		navContainer = $('.main-top-nav'),
		navToggle = $('.nav-toggle'),
		navDropdownToggle = $('.has-dropdown');

        // Nav toggle
        navToggle.on('click', function(e) {
            var $this = $(this);
            e.preventDefault();
            $this.toggleClass('is-active');
            navContainer.toggleClass('is-visible');
            html.toggleClass('nav-open');
        });
        // Nav dropdown toggle
        navDropdownToggle.on('click', function() {
			var $this = $(this);
			$this.toggleClass('is-active').children('ul').toggleClass('is-visible');
        });
        // Prevent click events from firing on children of navDropdownToggle
        navDropdownToggle.on('click', '*', function(e) {
            e.stopPropagation();
        });
    </script>
    </body>
    </html>
<?php } else if($this->session->userdata('user_id') && $this->session->userdata('user_type_id')==2){ ?>
    </div>
    <div id="spinner" class="spinner" style="display:none;">
        Loading&hellip;
    </div>
    <footer class="application-footer">
        <div class="container">
            <div class="disclaimer">
                <p>Copyright © 2016. All rights reserved. SUN SMS</p>
            </div>
        </div>
    </footer>
    </div>    
	
	<!--<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>-->
	<script type="text/javascript" src="<?=BASE_URL?>js/bootstrap.min.js"></script>
	
    <!--<script type="text/javascript" src="https://cdn.datatables.net/1.10.11/js/jquery.dataTables.min.js"></script>-->
    <script type="text/javascript" src="<?=BASE_URL?>js/jquery/jquery.dataTables.min.js"></script>
	
	
    <!--<script src="<?/*=BASE_URL*/?>js/bootstrap/jquery.js" type="text/javascript" ></script>-->
    <script src="<?=BASE_URL?>js/bootstrap/bootstrap-transition.js" type="text/javascript" ></script>
    <script src="<?=BASE_URL?>js/bootstrap/bootstrap-alert.js" type="text/javascript" ></script>
    <script src="<?=BASE_URL?>js/bootstrap/bootstrap-modal.js" type="text/javascript" ></script>
    <script src="<?=BASE_URL?>js/bootstrap/bootstrap-dropdown.js" type="text/javascript" ></script>
    <script src="<?=BASE_URL?>js/bootstrap/bootstrap-scrollspy.js" type="text/javascript" ></script>
    <script src="<?=BASE_URL?>js/bootstrap/bootstrap-tab.js" type="text/javascript" ></script>
    <script src="<?=BASE_URL?>js/bootstrap/bootstrap-tooltip.js" type="text/javascript" ></script>
    <script src="<?=BASE_URL?>js/bootstrap/bootstrap-popover.js" type="text/javascript" ></script>
    <script src="<?=BASE_URL?>js/bootstrap/bootstrap-button.js" type="text/javascript" ></script>
    <script src="<?=BASE_URL?>js/bootstrap/bootstrap-collapse.js" type="text/javascript" ></script>
    <script src="<?=BASE_URL?>js/bootstrap/bootstrap-carousel.js" type="text/javascript" ></script>
    <script src="<?=BASE_URL?>js/bootstrap/bootstrap-typeahead.js" type="text/javascript" ></script>
    <script src="<?=BASE_URL?>js/bootstrap/bootstrap-affix.js" type="text/javascript" ></script>
    <!--<script src="<?/*=BASE_URL*/?>js/bootstrap/bootstrap-datepicker1.js" type="text/javascript" ></script>-->
    <script src="<?=BASE_URL?>js/jquery/jquery-tablesorter.js" type="text/javascript" ></script>
    <script src="<?=BASE_URL?>js/jquery/jquery-chosen.js" type="text/javascript" ></script>
    <script src="<?=BASE_URL?>js/jquery/virtual-tour.js" type="text/javascript" ></script>
    <script src="<?=BASE_URL?>js/jquery.validate.min.js"></script>
    <script src="<?=BASE_URL?>js/forms.js"></script>
    <script src="<?=BASE_URL?>js/jquery/fullcalendar.min.js"></script>
    <script src="<?=BASE_URL?>js/jquery/home-page-calender.js"></script>
    <!--common script for all pages-->
    <script src="<?=BASE_URL?>js/common-scripts.js"></script>
    <script type="text/javascript">
        $(function() {
            $('#datepicker').datepicker();
            $('.datepicker').datepicker({
                dateFormat: 'dd-M-yy',
				changeMonth: true,
				changeYear:true,
				yearRange: "-100:+0"
            });
            $('#sample-table').tablesorter();
            //$(".chosen").chosen();
            /* Set the width of the side navigation to 250px */
        });
        // Responsive Menu
        var html = $('html, body'),
		navContainer = $('.main-top-nav'),
		navToggle = $('.nav-toggle'),
		navDropdownToggle = $('.has-dropdown');
        // Nav toggle
        navToggle.on('click', function(e) {
            var $this = $(this);
            e.preventDefault();
            $this.toggleClass('is-active');
            navContainer.toggleClass('is-visible');
            html.toggleClass('nav-open');
        });
        // Nav dropdown toggle
        navDropdownToggle.on('click', function() {
            var $this = $(this);
            $this.toggleClass('is-active').children('ul').toggleClass('is-visible');
        });
        // Prevent click events from firing on children of navDropdownToggle
        navDropdownToggle.on('click', '*', function(e) {
            e.stopPropagation();
        });
    </script>
    </body>
    </html>
<?php } else { ?>
    <!--<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>  -->
	<script type="text/javascript" src="<?=BASE_URL?>js/jquery.min.js"></script>
	
	<!--<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>-->
	<script type="text/javascript" src="<?=BASE_URL?>js/bootstrap.min.js"></script>
	
    <script src="<?=BASE_URL?>js/common-scripts.js"></script>
    <script>
        $(function(){
            $('.login-btn').click(function(){
                window.location.href = "loader.html";
            });
            // Responsive Menu
            var html = $('html, body'),
			navContainer = $('.main-top-nav'),
			navToggle = $('.nav-toggle'),
			navDropdownToggle = $('.has-dropdown');
            // Nav toggle
            navToggle.on('click', function(e) {
                var $this = $(this);
                e.preventDefault();
                $this.toggleClass('is-active');
                navContainer.toggleClass('is-visible');
                html.toggleClass('nav-open');
            });
            // Nav dropdown toggle
            navDropdownToggle.on('click', function() {
                var $this = $(this);
                $this.toggleClass('is-active').children('ul').toggleClass('is-visible');
            });
            // Prevent click events from firing on children of navDropdownToggle
            navDropdownToggle.on('click', '*', function(e) {
                e.stopPropagation();
            });
            //Tabs
            $(".tabs-wrapper #content").find("[id^='tab']").hide(); // Hide all content
            $(".tabs-wrapper #tabs li:first").attr("id","current"); // Activate the first tab
            $(".tabs-wrapper #content #tab1").fadeIn(); // Show first tab's content
            $('#tabs a').click(function(e) {
                e.preventDefault();
                if ($(this).closest("li").attr("id") == "current"){ //detection for current tab
                    return;
                }
                else{
                    $(".tabs-wrapper #content").find("[id^='tab']").hide(); // Hide all content
                    $(".tabs-wrapper #tabs li").attr("id",""); //Reset id's
                    $(this).parent().attr("id","current"); // Activate this
                    $('#' + $(this).attr('name')).fadeIn(); // Show content for the current tab
                }
            });           
            /*Quick links dynamic height starts*/
            $('#left').height($('.right-section').height()+20);
            $('.right-section .dataTables_length select').change(function(){
                var rightDivHeight = $(this).closest('.right-section').height();
                $('#left').height(rightDivHeight+20);
            });
            /*Quick links dynamic height ends*/
            //accordian
            $('.collapse.in').prev('.panel-heading').addClass('active');
            $('#accordion, #bs-collapse')
                .on('show.bs.collapse', function(a) {
                $(a.target).prev('.panel-heading').addClass('active');
				})
                .on('hide.bs.collapse', function(a) {
                    $(a.target).prev('.panel-heading).removeClass('active');
                });
        });    </script>
    </body>
    </html>
<?php } ?>