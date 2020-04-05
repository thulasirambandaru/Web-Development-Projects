
<section class="col-lg-10 right-section">
    <ul class="breadcrumb border-btm">
        <li>
            <a href="#">Home</a>
        </li>
        <li class="active">
            Floor
        </li>
    </ul>

    <div id="form" >
        <form class="form-horizontal" id="fee_form" method="post" action="<?=BASE_URL?>index.php/Hostel/updateRoom" enctype="multipart/form-data" onsubmit="">
            <div class="panel-body" style="background: none;">
                <div class="form-group">
                    <label class="col-md-3 col-xs-12 control-label">Hostel : <span class="clr-red"></span></label>
                        <div class="col-md-3 col-xs-12 m4">
                            <input disabled type="text" value="<?=$room[0]['hostel_name']?>">
                        </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 col-xs-12 control-label">Floor number : <span class="clr-red"></span></label>
                    <div class="col-md-3 col-xs-12 m4">
                        <input type="text" value="<?=$room[0]['floor_number']?>" disabled>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 col-xs-12 control-label">Room number : <span class="clr-red"></span></label>
                    <div class="col-md-3 col-xs-12 m4">
                        <input type="text" value="<?=$room[0]['room_number']?>" name="room_number" id="room_number">
                    </div>
                </div>

                <?php
                //echo "<pre>";print_r($floor); exit;
                $bed = explode(',',$room[0]['bed']);
                $id_bed = explode(',',$room[0]['id_bed']);

                for($s=0;$s<count($bed);$s++){ ?>
                    <div class="form-group">
                        <label class="col-md-3 col-xs-3 control-label">Bed <span class="clr-red">*</span></label>
                        <div class="col-md-3 col-xs-3 m4">
                            <input type="hidden" name="bed[]"  value="<?=$id_bed[$s]?>" >
                            <input type="text" name="<?=$id_bed[$s]?>" disabled id="<?=$id_bed[$s]?>" value="<?=$bed[$s]?>" >
                        </div>

                        <div class="">
                            <input type="button" class="btn" name="" id="" onclick="deleteBed('<?=$id_bed[$s]?>',this);" value="Delete" >
                            </div>
                        </div>
                <?php }  ?>
                <div id="room_div">

                </div>
                <div id="room_del_div">

                </div>
            </div>
            <p style="text-align:center;" id="s_btn">
                <?php
                //echo "<pre>";print_r($room); exit;
                ?>
                <input type="button" onclick="validateRoom()" name="sub" value="Save" class="btn"></p>
            <input type="hidden" name="id_room" id="id_room" value="<?php echo $room[0]['id_room']; ?>">
            <input type="hidden" name="id_floor" id="id_floor" value="<?php echo $room[0]['id_floor']; ?>">

        </form>
    </div>
</section>


<script type="text/javascript">
    function validateHostel()
    {
        var flag = 0;
        var hostel_id = $('#hostel_id').val();
        var floor_number = $('#floor_number').val();
        var no_of_rooms = $('#no_of_rooms').val();

        $('#hostel_id').css('border','1px solid #cccccc');
        $('#floor_number').css('border','1px solid #cccccc');
        $('#no_of_rooms').css('border','1px solid #cccccc');
        $('#floor_number_err').text('');

        if(hostel_id==0){
            $('#hostel_id').css('border','1px solid red');
            flag++;
        }
        if(floor_number==''){
            $('#floor_number').css('border','1px solid red');
            flag++;
        }
        if(no_of_rooms==''){
            $('#no_of_rooms').css('border','1px solid red');
            flag++;
        }
        else if(isNaN(no_of_rooms)){
            $('#no_of_rooms').css('border','1px solid red');
            flag++;
        }

        if(flag==0){
            $.ajax({
                async: true,
                type: 'POST',
                url: BASE_URL + 'index.php/Hostel/checkFloor/',
                data: {'hostel_id':hostel_id,'floor_number':floor_number,'floor_id_not':$('#id_floor').val()},
                dataType: 'json',
                success: function (res) {
                    if(res.response==0){
                        $('#floor_number_err').text(res.data);
                    }
                    else{
                        var room_list = $('input[name="room_number[]"');
                        var no_of_beds = $('input[name="no_of_beds[]"');
                        console.log(room_list);
                        for(var s=0;s<room_list.length;s++)
                        {
                            if(room_list[s].value==''){ alert('Please fill all fields'); return false; }
                            if(no_of_beds[s].value==''){ alert('Please fill all fields'); return false }
                        }
                        /*for(var s=0;s<room_list.length;s++)
                        {
                            $.ajax({
                                async: true,
                                type: 'POST',
                                url: BASE_URL + 'index.php/Hostel/checkRoomNumber/',
                                data: {'hostel_id':hostel_id,'floor_id':$('#id_floor').val(),'room_number':room_list[s].value},
                                dataType: 'json',
                                success: function (res) {
                                    if(res.response==0){
                                        alert(res.data);
                                    }
                                    else{
                                        //$('#fee_form').submit();
                                        var room_list = $('input[name="room_number[]"');
                                        for(var s=0;s<room_list.length;s++)
                                        {

                                        }
                                    }
                                }
                            });
                        }*/
                        $('#no_of_rooms').val(parseInt(parseInt($('#room_count').val())+parseInt(room_list.length)));
                        $('#fee_form').submit();
                    }
                }
            });
        }
        else{ return false; }
    }

    function deleteField(id_room)
    {
        $('#room_del_div').html('<input type="hidden" name="room_id[]" value="'+id_room+'">');
        $('#room_count').val($('#room_count').val()-1);
    }

    function getRoomFields(num)
    {
        var room_count = $('#room_count').val();
        console.log(room_count);
        var num = num-room_count;
        var html='';
        if(num!=''){
            for(var s=0;s<num;s++) {
                html += '<div class="form-group">';
                html += '<label class="col-md-3 col-xs-3 control-label">Room No <span class="clr-red">*</span></label>';
                html += '<div class="col-md-3 col-xs-3 m4">';
                html += '<input type="text" name="room_number[]" id="room_no[]" >';
                html += '</div>';
                html += '<label class="col-md-3 col-xs-3 control-label">No of Beds <span class="clr-red">*</span></label>';
                html += '<div class="col-md-3 col-xs-3 m4">';
                html += '<input type="text" name="no_of_beds[]" id="no_of_beds" >';
                html += '</div>';
                /*html += '<div class="">';
                html += '<input type="button" class="btn" name="" id="" onclick="$(this).parent().parent().remove();" value="Delete" >';
                html += '</div>';*/
                html += '</div>';
            }
            html+='<input type="hidden" name="no_rooms" id="no_rooms">';
            $('#room_div').html(html);
        }
        else
        {
            $('#room_div').html('');
        }
    }
</script>