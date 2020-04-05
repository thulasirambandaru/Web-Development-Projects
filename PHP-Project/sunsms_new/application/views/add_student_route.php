<section class="col-lg-10 right-section">
    <ul class="breadcrumb border-btm">
        <li>
            <a href="<?=BASE_URL?>index.php/driver/drivervehicle/">Home</a>
        </li>
        <li class="active">
            Add Student Route
        </li>
    </ul>

    <div class="">
        <div class="tabs-wrapper">
        	<a href="javascript:history.back()" class="btn btn-primary m8 float-right p6">Back</a>
            <ul id="tabs">
                <li><a href="#" name="tab1"> Add Student Route </a></li>
            </ul>
			<p class="err_msg">
				<?php if($this->session->userdata('message')){ echo $this->session->userdata('message'); $this->session->unset_userdata('message'); } ?>
			</p>
            <div id="content">
                <div id="tab1">
                	<form action="<?=BASE_URL?>index.php/route/studentroute_add" id="addStudentRoute" method="post" class="form-horizontal">
                    <div class="form-body">
                    	 <div class="form-group">
                            <label class="col-md-3 col-xs-12 control-label">Route</label>
                            <div class="col-md-3 col-xs-12">
                                <select name="routeList" id="routeList" class="form-control">
									<option value="">--Select Route--</option>
	                                <?php foreach ($route_list as $route) { 
	                                		$route_select=(isset($studentroute) && $route['route_id']==$studentroute[0]['fk_route_id']) ? "selected='selected'" : "";
	                                	?>
	                                 <option <?php echo $route_select; ?> value="<?php echo $route['route_id'] ?>"><?php echo $route['routeName']; ?> </option>
	                                 <?php }?>
                                </select>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 col-xs-12 control-label">Student Name</label>
                            <div class="col-md-3 col-xs-12">
                                <input type="text" name="student_name" id="student_name" class="form-control"/>
                                <div id="student_input" class="error"></div>
                            </div>
                            <div class="col-md-3 col-xs-12">
                               <a class="btn btn-primary" id="student_search" onclick="getStudentInfo();">Search</a>
                            </div>
                        </div>
                        <p>&nbsp;</p>
                        <div class="form-group" id="student_div">
							
                        </div>
                       
                    </div>
                </form>
                </div>
                </div>
            </div>
        </div>
 </section>
 
