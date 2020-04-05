<section class="col-lg-10 right-section">
    <ul class="breadcrumb border-btm">
        <li>
            <a href="#">Home</a>
        </li>
        <li class="active">
            Transport
        </li>
    </ul>
    <div class="float-right" style="margin-bottom: 10px;">
        <a href="<?=BASE_URL?>index.php/route/addStudentRoute" class="btn btn-primary m8 float-right p6"> Add Student Route</a>
    </div>
    <table id="table" class="table table-bordered table-hover">
        <thead>
        <tr>
            <th>Student Name</th>
            <th>Route Name</th>
            <th style="width:125px;">Action</th>
        </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</section>
<script type="text/javascript">
    var save_method; //for save method string
    var table;

    $(document).ready(function() {

        //datatables
        table = $('#table').DataTable({

            "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            "order": [], //Initial no order.

            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?php echo site_url('route/student_route_list')?>",
                "type": "POST"
            },

            //Set column definition initialisation properties.
            "columnDefs": [
                {
                    "targets": [ -1 ], //last column
                    "orderable": false, //set not orderable
                },
            ],

        });

        //datepicker
        $('.datepicker').datepicker({
            autoclose: true,
            format: "yyyy-mm-dd",
            todayHighlight: true,
            orientation: "top auto",
            todayBtn: true,
            todayHighlight: true
        });

        //set input/textarea/select event when change value, remove class error and remove text help block
        $("input").change(function(){
            $(this).parent().parent().removeClass('has-error');
            $(this).next().empty();
        });
        $("textarea").change(function(){
            $(this).parent().parent().removeClass('has-error');
            $(this).next().empty();
        });
        $("select").change(function(){
            $(this).parent().parent().removeClass('has-error');
            $(this).next().empty();
        });

    });

    function add_studentroute()
    {
        studentList();
        routesList();
        save_method = 'add';
        $('#form')[0].reset(); // reset form on modals
        $('.form-group').removeClass('has-error'); // clear error class
        $('.help-block').empty(); // clear error string
        $('#modal_form').modal('show'); // show bootstrap modal
        $('.modal-title').text('Add Student Route'); // Set Title to Bootstrap modal title
    }

    function edit_studentroute(id)
    {
        studentList();
        routesList();
        save_method = 'update';
        $('#form')[0].reset(); // reset form on modals
        $('.form-group').removeClass('has-error'); // clear error class
        $('.help-block').empty(); // clear error string

        //Ajax Load data from ajax
        $.ajax({
            url : "<?php echo site_url('route/studentroute_edit/')?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {
                $('[name="id"]').val(data.student_route_id);
                $('[name="studentId"]').val(data.fk_student_id);
                $('[name="routeId"]').val(data.fk_route_id);
                $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
                $('.modal-title').text('Edit Student Route'); // Set title to Bootstrap modal title
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error get data from ajax');
            }
        });
    }

    function save()
    {
        $('#btnSave').text('saving...'); //change button text
        $('#btnSave').attr('disabled',true); //set button disable
        var url;

        if(save_method == 'add') {
            url = "<?php echo site_url('route/studentroute_add')?>";
        } else {
            url = "<?php echo site_url('route/studentroute_update')?>";
        }

        // ajax adding data to database
        $.ajax({
            url : url,
            type: "POST",
            data: $('#form').serialize(),
            dataType: "JSON",
            success: function(data)
            {

                if(data.status) //if success close modal and reload ajax table
                {
                    $('#modal_form').modal('hide');
                    reload_table();
                }
                else
                {
                    for (var i = 0; i < data.inputerror.length; i++)
                    {
                        $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
                        $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); //select span help-block class set text error string
                    }
                }
                $('#btnSave').text('save'); //change button text
                $('#btnSave').attr('disabled',false); //set button enable


            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error adding / update data');
                $('#btnSave').text('save'); //change button text
                $('#btnSave').attr('disabled',false); //set button enable

            }
        });
    }

    function delete_studentroute(id)
    {
        if(confirm('Are you sure delete this mapping?'))
        {
            // ajax delete data to database
            $.ajax({
                url : "<?php echo site_url('route/studentroute_delete')?>/"+id,
                type: "POST",
                dataType: "JSON",
                success: function(data)
                {
                    //if success reload ajax table
                    $('#modal_form').modal('hide');
                    reload_table();
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error deleting data');
                }
            });

        }
    }

    function studentList()
    {
        $.ajax({
            async:false,
            type:"POST",
            url:"<?php echo site_url('route/get_students')?>",
            dataType:"json",
            success:function(response)
            {
                var optionList='<option value="">--Select Student--</option>';
                for(var i=0;i<response.length;i++)
                {
                    optionList+='<option value="'+response[i]['student_id']+'">'+response[i]["studentName"]+'</option>';
                }
                $("#studentList").html(optionList)
            },
            error: function(XMLHttpRequest, textStatus, errorThrown)
            {
                notify('Something went wrong. Please try again','error' ,10);
            }
        });
    }

    function routesList()
    {
        $.ajax({
            async:false,
            type:"POST",
            url:"<?php echo site_url('route/get_routes')?>",
            dataType:"json",
            success:function(response)
            {
                var optionList='<option value="">--Select Route--</option>';
                for(var i=0;i<response.length;i++)
                {
                    optionList+='<option value="'+response[i]['route_id']+'">'+response[i]["routeName"]+'</option>';
                }
                $("#routeList").html(optionList)
            },
            error: function(XMLHttpRequest, textStatus, errorThrown)
            {
                notify('Something went wrong. Please try again','error' ,10);
            }
        });
    }
</script>

<!-- Bootstrap modal -->
<div class="modal fade" id="modal_form" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Driver Form</h3>
            </div>
            <div class="modal-body form">
                <form action="#" id="form" class="form-horizontal">
                    <input type="hidden" value="" name="id"/>
                    <div class="form-body">
                        <div class="form-group">
                            <label class="col-md-3 col-xs-12 control-label">Student Name</label>
                            <div class="col-md-6 col-xs-12">
                                <select name="studentId" id="studentList" class="form-control">

                                </select>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 col-xs-12 control-label">Route</label>
                            <div class="col-md-6 col-xs-12">
                                <select name="routeId" id="routeList" class="form-control">

                                </select>
                                <span class="help-block"></span>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Save</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- End Bootstrap modal -->