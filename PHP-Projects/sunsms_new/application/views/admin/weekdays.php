
<section class="col-lg-10 right-section">

    <ul class="breadcrumb border-btm">
        <li class="">
                <a href="<?=BASE_URL?>index.php/Admin/weekDays"> Home </a>
            </li>

            <li class="active">
                Week Day List
            </li>
    </ul>

    <div class="">
        <div class="tabs-wrapper">
            <ul id="tabs">
                <li><a href="#" name="tab1">Add Weekdays</a></li>

            </ul>

            <div id="content">
                <div id="tab1">
										
                    <form class="form-horizontal" id="subject_form" method="post" action="<?=BASE_URL?>index.php/admin/updateWeekDay" enctype="multipart/form-data">
						
						<?php
							$sun = $mon = $tue = $wed = $thu = $fri = $sat = 0;
							for($s=0;$s<count($week_day);$s++){
								if($week_day[$s]['day']=='1'){ $sun = $week_day[$s]['status']; }
								if($week_day[$s]['day']=='2'){ $mon = $week_day[$s]['status']; }
								if($week_day[$s]['day']=='3'){ $tue = $week_day[$s]['status']; }
								if($week_day[$s]['day']=='4'){ $wed = $week_day[$s]['status']; }
								if($week_day[$s]['day']=='5'){ $thu = $week_day[$s]['status']; }
								if($week_day[$s]['day']=='6'){ $fri = $week_day[$s]['status']; }
								if($week_day[$s]['day']=='7'){ $sat = $week_day[$s]['status']; }								
							}
						?>
						
                        <div class="panel-body" id="week_check_box">

                            <div class="form-group">								
                                <div class="col-md-3 col-xs-12 m4">
                                    <label class="check"><input type="checkbox" <?php if($sun==1){ ?>checked="checked"<?php } ?> value="1" class="icheckbox"> &nbsp; Sunday</label>
									<input type="hidden" name="day1" id="day1">
                                </div>								                            
							</div>
							
							<div class="form-group">								
                                <div class="col-md-3 col-xs-12 m4">
                                    <label class="check"><input type="checkbox" <?php if($mon==1){ ?>checked="checked"<?php } ?> value="2" class="icheckbox"> &nbsp; Monday</label>
									<input type="hidden" name="day2" id="day2">
                                </div>								                            
							</div>
							
							<div class="form-group">								
                                <div class="col-md-3 col-xs-12 m4">
                                    <label class="check"><input type="checkbox" <?php if($tue==1){ ?>checked="checked"<?php } ?> value="3" class="icheckbox"> &nbsp; Tuesday</label>
									<input type="hidden" name="day3" id="day3">
                                </div>								                            
							</div>
							
							<div class="form-group">								
                                <div class="col-md-3 col-xs-12 m4">
                                    <label class="check"><input type="checkbox" <?php if($wed==1){ ?>checked="checked"<?php } ?> value="4" class="icheckbox"> &nbsp; Wednesday</label>
									<input type="hidden" name="day4" id="day4">
                                </div>								                            
							</div>
							
							<div class="form-group">								
                                <div class="col-md-3 col-xs-12 m4">
                                    <label class="check"><input type="checkbox" <?php if($thu==1){ ?>checked="checked"<?php } ?> value="5" class="icheckbox"> &nbsp; Thursday</label>
									<input type="hidden" name="day5" id="day5">
                                </div>								                            
							</div>
							
							<div class="form-group">								
                                <div class="col-md-3 col-xs-12 m4">
                                    <label class="check"><input type="checkbox" <?php if($fri==1){ ?>checked="checked"<?php } ?> value="6" class="icheckbox"> &nbsp; Friday</label>
									<input type="hidden" name="day6" id="day6">
                                </div>								                            
							</div>
							
							<div class="form-group">								
                                <div class="col-md-3 col-xs-12 m4">
                                    <label class="check"><input type="checkbox" <?php if($sat==1){ ?>checked="checked"<?php } ?> value="7" class="icheckbox"> &nbsp; Saturday</label>
									<input type="hidden" name="day7" id="day7">
                                </div>								                            
							</div>
							
                        <div>							
                            <button class="btn btn-primary">Save</button>
                        </div>                        
                    </form>
                </div>

                </div>
            </div>
        </div>
    </div>

</section>

<script type="text/javascript">
	week_days = '';
	$(function () {
	  $('#week_check_box [type="checkbox"]').click(function() {
			if(this.checked)
				$('#day'+this.value).val(this.value);
			else
				$('#day'+this.value).val(0);
			
		  /*var status = 0;
		  if(this.checked){ status = 1; }
		  $.ajax({
			  async: true,
			  type: 'POST',
			  url: BASE_URL+'index.php/admin/updateWeekDay/',
			  data: {day:this.value,status:status},
			  dataType: 'json',
			  success:function(res){
				location.reload();
			  }
		  });*/
	  });
	});
</script>

