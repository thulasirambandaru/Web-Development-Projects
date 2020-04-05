
<section class="col-lg-10 right-section">
    <ul class="breadcrumb border-btm">
        <li>
            <a href="#">Home</a>
        </li>
        <li class="active">
            Room Search
        </li>
    </ul>
    <div>
        <form class="form-horizontal" id="fee_form" method="post" action="<?=BASE_URL?>index.php/Hostel/studentSearch" enctype="multipart/form-data" >
            <div class="panel-body" style="background: none;">
                <div class="form-group">
                    <label class="col-md-3 col-xs-12 control-label">Hostel <span class="clr-red"></span></label>
                    <div class="col-md-3 col-xs-12 m4">
                        <select class="form-control" name="hostel_id" id="hostel_id">
                            <option value="0">Select Hostel</option>
                            <?php for($s=0;$s<count($hostel);$s++){ ?>
                                <option <?php if(isset($floor)){ if($floor[0]['hostel_id']==$hostel[$s]['id_hostel']){ echo "selected='selected'"; } } ?> value="<?=$hostel[$s]['id_hostel']?>"><?=$hostel[$s]['hostel_name']?></option>
                            <?php } ?>
                        </select>
                        <span id="hostel_name_err" class="error"></span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 col-xs-12 control-label">Student <span class="clr-red"></span></label>
                    <div class="col-md-3 col-xs-12 m4">
                        <input type="text" placeholder="Search student by name" name="student" id="student" onkeypress="clearStudent();">
                        <span id="student_name_err" class="error"></span>
                    </div>
                </div>
                <input type="hidden" name="student_id" id="student_id" value="0">
                <p style="text-align:center;" id="s_btn"><input onclick="validateStudentSearch();" type="button" name="sub" value="Search" class="btn"></p>
            </div>
        </form>
    </div>
    <div id="grid">
        <?php
        //echo "<pre>";print_r($details); exit;
        ?>

        <table id="table" class="table table-bordered table-hover">
            <thead>
            <tr>
                <th>Hostel</th>
                <th>Floor</th>
                <th>Room Number</th>
                <th>Bed</th>
                <th>Date of joing</th>
                <th>Student name</th>
                <th>Admission Number</th>
            </tr>
            </thead>
            <?php if(isset($details))for($s=0;$s<count($details);$s++){ ?>
                <tr>
                    <td><?=$details[0]['hostel_name']?></td>
                    <td><?=$details[0]['floor_number']?></td>
                    <td><?=$details[0]['room_number']?></td>
                    <td><?=$details[0]['bed']?></td>
                    <td><?=$details[0]['date_of_joining']?></td>
                    <td><?=$details[0]['student']?></td>
                    <td><?=$details[0]['admission_number']?></td>

                </tr>
            <?php } ?>
            <tbody>
            </tbody>
        </table>
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

<script type="text/javascript">
    $(function () {
        $('#table').dataTable();
    });

    function getRoomSearch($type)
    {
        //window.location = BASE_URL+"index.php/Hostel/roomSearch/"+$type;
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

    function clearStudent()
    {
        $('#student_id').val(0);
        $('#search_stu').text('');
    }
</script>