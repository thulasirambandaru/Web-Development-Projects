



    <section class=" right-section">

        <ul class="breadcrumb border-btm">
            <li class="">
                <a href="<?=BASE_URL?>index.php/admin/index"> Dashboard </a>
            </li>

            <li class="active">
                Week days
            </li>
        </ul>



        <div id="content">
            <div id="tab1">

                <?php
                    $sun = $mon = $tue = $wed = $thu = $fri = $sat = 0;
                    for($s=0;$s<count($week_day);$s++){
                        if($week_day[$s]['day']=='0'){ $sun = $week_day[$s]['status']; }
                        if($week_day[$s]['day']=='1'){ $mon = $week_day[$s]['status'];; }
                        if($week_day[$s]['day']=='2'){ $tue = $week_day[$s]['status'];; }
                        if($week_day[$s]['day']=='3'){ $wed = $week_day[$s]['status'];; }
                        if($week_day[$s]['day']=='4'){ $thu = $week_day[$s]['status'];; }
                        if($week_day[$s]['day']=='5'){ $fri = $week_day[$s]['status'];; }
                        if($week_day[$s]['day']=='6'){ $sat = $week_day[$s]['status'];; }
                    }
                ?>
                    <div class="form-group" id="week_check_box">
                        <div class="col-md-6 col-xs-12">
                            <label class="check"><input type="checkbox" <?php if($sun==1){ ?>checked="checked"<?php } ?> value="0" class="icheckbox"> Sunday</label>
                        </div>
                        <div class="col-md-6 col-xs-12">
                            <label class="check"><input type="checkbox" <?php if($mon==1){ ?>checked="checked"<?php } ?> value="1" class="icheckbox"> Monday</label>
                        </div>
                        <div class="col-md-6 col-xs-12">
                            <label class="check"><input type="checkbox" <?php if($tue==1){ ?>checked="checked"<?php } ?> value="2" class="icheckbox"> Tuesday</label>
                        </div>
                        <div class="col-md-6 col-xs-12">
                            <label class="check"><input type="checkbox" <?php if($wed==1){ ?>checked="checked"<?php } ?> value="3" class="icheckbox"> Wednesday</label>
                        </div>
                        <div class="col-md-6 col-xs-12">
                            <label class="check"><input type="checkbox" <?php if($thu==1){ ?>checked="checked"<?php } ?> value="4" class="icheckbox"> Thursday</label>
                        </div>
                        <div class="col-md-6 col-xs-12">
                            <label class="check"><input type="checkbox" <?php if($fri==1){ ?>checked="checked"<?php } ?> value="5" class="icheckbox"> Friday</label>
                        </div>
                        <div class="col-md-6 col-xs-12">
                            <label class="check"><input type="checkbox" <?php if($sat==1){ ?>checked="checked"<?php } ?> value="6" class="icheckbox"> Saturday</label>
                        </div>
                    </div>

            </div>
        </div>

    </section>





<script type="text/javascript">
        $(function () {

              $('#week_check_box [type="checkbox"]').click(function(){
                  var status = 0;
                  if(this.checked){ status = 1; }
                  $.ajax({
                      async: true,
                      type: 'POST',
                      url: BASE_URL+'index.php/admin/updateWeekDay/',
                      data: {day:this.value,status:status},
                      dataType: 'json',
                      success:function(res){

                      }
                  });
              });

        });
</script>