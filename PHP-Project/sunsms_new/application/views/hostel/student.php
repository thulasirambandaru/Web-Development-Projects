
<section class="col-lg-10 right-section">
    <ul class="breadcrumb border-btm">
        <li>
            <a href="#">Home</a>
        </li>
        <li class="active">
            Student Allotment
        </li>
    </ul>

    <div id="form" >
        <p><?php if($this->session->userdata('message')){ echo $this->session->userdata('message'); $this->session->unset_userdata('message');  } ?></p>
        <form class="form-horizontal" id="fee_form" method="post" action="<?=BASE_URL?>index.php/Hostel/addStudentToBed" enctype="multipart/form-data" onsubmit="">
            <div class="panel-body" style="background: none;">
                <div class="form-group">
                    <label class="col-md-3 col-xs-6 control-label">Hostel  <span class="clr-red">*</span></label>
                    <div class="col-md-3 col-xs-6 m4">
                        <select class="form-control" name="hostel_id" id="hostel_id" onchange="getFloorByHostelId(this.value);">
                            <option value="0">Select Hostel</option>
                            <?php for($s=0;$s<count($hostel);$s++){ ?>
                                <option value="<?=$hostel[$s]['id_hostel']?>"><?=$hostel[$s]['hostel_name']?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <label class="col-md-3 col-xs-6 control-label">Floor <span class="clr-red">*</span></label>
                    <div class="col-md-3 col-xs-6 m4">
                        <select class="form-control" name="floor_id" id="floor_id" onchange="getBedsInfo(this.value)">
                            <option value="0">Select Floor</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 col-xs-6 control-label">Food preference  <span class="clr-red"></span></label>
                    <div class="col-md-3 col-xs-6 m4">
                        <input type="text" name="food_preference" id="food_preference">
                    </div>

                    <label class="col-md-3 col-xs-6 control-label">Description <span class="clr-red"></span></label>
                    <div class="col-md-3 col-xs-6 m4">
                        <input type="text" name="description" id="description">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 col-xs-6 control-label">Student  <span class="clr-red"></span></label>
                    <div class="col-md-3 col-xs-6 m4">
                        <input type="text" placeholder="Search student by name" name="student" id="student" onkeypress="clearStudent();">
                        <span class="error" id="search_stu"></span>
                    </div>
                </div>

            </div>
            <input type="hidden" name="student_id" id="student_id" value="0">
            <input type="hidden" name="bed_id" id="bed_id" value="">

        </form>
        <div>
            <span class="error" style="font-size: 14px;" id="allow_stu_err"></span>
        </div>
    </div>
    <div  id="bed_div" >

    </div>

</section>
<style>
    /* highlight results */
    .ui-autocomplete span.hl_results {
        background-color: #ffff66;
    }

    /* loading - the AJAX indicator */
    .ui-autocomplete-loading {
        background: white url('../img/ui-anim_basic_16x16.gif') right center no-repeat;
    }

    /* scroll results */
    .ui-autocomplete {
        max-height: 250px;
        overflow-y: auto;
        /* prevent horizontal scrollbar */
        overflow-x: hidden;
        /* add padding for vertical scrollbar */
        padding-right: 5px;
    }

    .ui-autocomplete li {
        font-size: 16px;
    }

    /* IE 6 doesn't support max-height
    * we use height instead, but this forces the menu to always be this tall
    */
    * html .ui-autocomplete {
        height: 250px;
    }
</style>
<!--<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>-->
<script type="text/javascript">


    function getBedsInfo(floor_id)
    {
        if(floor_id==0) {
            $('#bed_div').html('');
            return false;
        }

        var html='<table class="table table-bordered" style="width: 100%"><tr><th>Room Number</th><th>Bed</th><th>Allot</th></tr>';
        $.ajax({
            async: true,
            type: 'POST',
            url: BASE_URL + 'index.php/Hostel/getBedInfoByFloorId/',
            data: {'floor_id': floor_id},
            dataType: 'json',
            success: function (res) {
                if(res.response==1){
                    var data = res.data;
                    for(var s=0;s<data.length;s++){
                        html+='<tr><td>'+data[s].room_number+'</td><td>'+data[s].bed+'</td><td><a href="javascript:;" onclick="getAddStudentBed('+data[s].id_bed+');">Allot</a></td></tr>';
                    }
                    html+='</table>';
                    $('#bed_div').html(html);
                }
            }
        });
    }

    $( function() {
        $( "#student" ).autocomplete({
            source: function( request, response ) {
                $.ajax( {
                    url: BASE_URL+'index.php/Hostel/getStudentByName',
                    dataType: "json",
                    data: {
                        term: request.term
                    },
                    success: function( data ) {
                        response( data );
                    }
                } );
            },
            minLength: 1,
            select: function( event, ui ) {
                //log( "Selected: " + ui.item.value + " aka " + ui.item.id );
                $('#student_id').val(ui.item.id);
                $('#search_stu').text('');
            },
            open: function(event, ui) {
                $(".ui-autocomplete").css("z-index", 1000);
            }
        } );
    } );

    function getAddStudentBed(bed_id)
    {
        $('#allow_stu_err').text('');
        var id = $('#student_id').val();
        $('#bed_id').val(bed_id);
        if(id!=0 && id!='') {
            $.ajax({
                async: true,
                type: 'POST',
                url: BASE_URL + 'index.php/Hostel/checkStudentBed/',
                data: {'id': id,'bed_id':bed_id},
                dataType: 'json',
                success: function (res) {
                    if(res.response==1){
                        $('#fee_form').submit();
                    }
                    else{
                        $('#search_stu').text(res.data);
                    }
                }
            });

        }
        else
            $('#search_stu').text('Please Select Student');
    }

    function clearStudent()
    {
        $('#student_id').val(0);
        $('#search_stu').text('');
    }
</script>