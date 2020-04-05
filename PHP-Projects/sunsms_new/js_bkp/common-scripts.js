var Script = function () {

			   


// theme switcher

    /*var scrollHeight = '60px';
    jQuery('#theme-change').click(function () {
        if ($(this).attr("opened") && !$(this).attr("opening") && !$(this).attr("closing")) {
            $(this).removeAttr("opened");
            $(this).attr("closing", "1");

            $("#theme-change").css("overflow", "hidden").animate({
                width: '20px',
                height: '30px',
                'padding-top': '3px'
            }, {
                complete: function () {
                    $(this).removeAttr("closing");
                    $("#theme-change .settings").hide();
                }
            });
        } else if (!$(this).attr("closing") && !$(this).attr("opening")) {
            $(this).attr("opening", "1");
            $("#theme-change").css("overflow", "visible").animate({
                width: '226px',
                height: scrollHeight,
                'padding-top': '3px'
            }, {
                complete: function () {
                    $(this).removeAttr("opening");
                    $(this).attr("opened", 1);
                }
            });
            $("#theme-change .settings").show();
        }
    });

    jQuery('#theme-change .colors span').click(function () {
        var color = $(this).attr("data-style");
        setColor(color);
    });

    jQuery('#theme-change .layout input').change(function () {
        setLayout();
    });

    var setColor = function (color) {
        $('#style_color').attr("href", "css/style-" + color + ".css");
    }*/

}();


function getCategoryDataTable(){
    $('#table').dataTable({
        "processing": true,
        "bProcessing": true,
        "serverSide": true,
        "bPaginate":true,
        "aaSorting": [],
        "columnDefs": [
            {
                "targets": [ 0 ],
                "visible": false,
                "searchable": false
            }
        ],
        "ajax": {
            "url": BASE_URL+'index.php/category/getCategoryDataTable',
            "type": "POST",
            "data": function ( d ) {
                d.acolumns="id_category";
                d.my_order = "id_category";
                d.sort="desc";
            }
        },
        "aoColumnDefs": [
            {
                "aTargets": [1],
                "mData": null,
                "mRender": function (data, type, full) {

                    return '<div class="mod-more tooltipsample actions">'+
                        '<a  title="edit" class="edit" href="'+BASE_URL+'index.php/category/addUpdateCategoryView/'+full[1]+'"><span class="circle"><i class="fa fa-pencil"></i></span></a></a>' +
                        '<a  title="delete" class="edit" onclick="deleteCategory(\''+full[1]+'\')"><span class="circle"><i class="fa fa-trash-o"></i></span></a></a>' +
                        '</div>';
                }
            }
        ]
    });
}

function deleteCategory(id)
{
    $.ajax({
        async: true,
        type: 'get',
        url: BASE_URL+'index.php/category/deleteCategory/'+id,
        data: {},
        dataType: 'json',
        success:function(res){
            if(res.response==1){
                location.reload();
            }
        }
    });
}


function getDepartmentDataTable(){
    $('#table').dataTable({
        "processing": true,
        "bProcessing": true,
        "serverSide": true,
        "bPaginate":true,
        "aaSorting": [],
        "columnDefs": [
            {
                "targets": [ 0 ],
                "visible": false,
                "searchable": false
            }
        ],
        "ajax": {
            "url": BASE_URL+'index.php/department/getDepartmentDataTable',
            "type": "POST",
            "data": function ( d ) {
                d.acolumns="id_department";
                d.my_order = "id_department";
                d.sort="desc";
            }
        },
        "aoColumnDefs": [
            {
                "aTargets": [1],
                "mData": null,
                "mRender": function (data, type, full) {

                    return '<div class="mod-more tooltipsample actions">'+
                        '<a  title="edit" class="edit" href="'+BASE_URL+'index.php/department/addUpdateDepartmentView/'+full[1]+'"><span class="circle"><i class="fa fa-pencil"></i></span></a></a>' +
                        '<a  title="delete" class="edit" onclick="deleteDepartment(\''+full[1]+'\')"><span class="circle"><i class="fa fa-trash-o"></i></span></a></a>' +
                        '</div>';
                }
            }
        ]
    });
}

function deleteDepartment(id)
{
    $.ajax({
        async: true,
        type: 'get',
        url: BASE_URL+'index.php/department/deleteDepartment/'+id,
        data: {},
        dataType: 'json',
        success:function(res){
            if(res.response==1){
                location.reload();
            }
        }
    });
}

function getStaffDataTable(){
    $('#table').dataTable({
        "processing": true,
        "bProcessing": true,
        "serverSide": true,
        "bPaginate":true,
        "aaSorting": [],
        "ajax": {
            "url": BASE_URL+'index.php/staff/staffDateTable',
            "type": "POST",
            "data": function ( d ) {
                d.acolumns="id_staff";
                d.my_order = "id_staff";
                d.sort="desc";
            }
        },
        "aoColumnDefs": [
            {
                "aTargets": [2],
                "mData": null,
                "mRender": function (data, type, full) {

                    if(full[2] == 1){ return "Male"; }
                    else { return "Female"; }
                }
            },
            {
                "aTargets": [4],
                "mData": null,
                "mRender": function (data, type, full) {

                    if(full[4]==0){ return "Inactive"; }
                    else { return "Active"; }
                }
            },
            {
                "aTargets": [5],
                "mData": null,
                "mRender": function (data, type, full) {

                    return '<div class="mod-more tooltipsample actions">'+
                        '<a  title="edit" class="edit" href="'+BASE_URL+'index.php/staff/createStaffView/'+full[5]+'"><span class="circle"><i class="fa fa-pencil"></i></span></a></a>' +
                        '<a  title="delete" class="edit" onclick="deleteStaff(\''+full[5]+'\')"><span class="circle"><i class="fa fa-trash-o"></i></span></a></a>' +
                        '</div>';
                }
            }
        ]
    });
}

function deleteStaff(id)
{
    $.ajax({
        async: true,
        type: 'get',
        url: BASE_URL+'index.php/staff/deleteStaff/'+id,
        data: {},
        dataType: 'json',
        success:function(res){
            if(res.response==1){
                location.reload();
            }
        }
    });
}

function getCustomerDataTable()
{
    $('#table').dataTable({
        "processing": true,
        "bProcessing": true,
        "serverSide": true,
        "bPaginate":true,
        "aaSorting": [],
        "ajax": {
            "url": BASE_URL+'index.php/welcome/getCustomerDataTable',
            "type": "POST",
            "data": function ( d ) {
                d.acolumns="id_school";
                d.my_order = "id_school";
                d.sort="desc";
            }
        },
        "aoColumnDefs": [
            {
                "aTargets": [6],
                "mData": null,
                "mRender": function (data, type, full) {

                    return '<div class="mod-more tooltipsample actions">'+
                        '<a id="edit" title="edit" class="edit" href="'+BASE_URL+'index.php/welcome/addSchool/'+full[6]+'"><span class="circle"><i class="fa fa-pencil"></i></span></a></a>' +
                        '</div>';
                }
            }
        ]
    });
}

function getState(country_id)
{
    var html = '<option value="0">Select State</option>';
    if(country_id==0){
        $('#state_id').html(html);
    }
    $.ajax({
        async: true,
        type: 'POST',
        url: BASE_URL+'index.php/welcome/getState/?country_id='+country_id,
        data: {},
        dataType: 'json',
        success:function(res){
            if(res.response==1){
                var data = res.data;
                for(var s=0;s<data.length;s++){
                    html+='<option value="'+data[s].id_state+'">'+data[s].state+'</option>';
                }
                $('#state_id').html(html);
            }
        }
    });
}

function getCity(state_id)
{
    var html = '<option value="0">Select City</option>';
    if(country_id==0){
        $('#city_id').html(html);
    }
    $.ajax({
        async: true,
        type: 'POST',
        url: BASE_URL+'index.php/welcome/getCity/?state_id='+state_id,
        data: {},
        dataType: 'json',
        success:function(res){
            if(res.response==1){
                var data = res.data;
                for(var s=0;s<data.length;s++){
                    html+='<option value="'+data[s].id_city+'">'+data[s].city+'</option>';
                }
                $('#city_id').html(html);
            }
        }
    });
}

function getAcademicYearDataTable()
{
    $('#table').dataTable({
        "processing": true,
        "bProcessing": true,
        "serverSide": true,
        "bPaginate":true,
        "aaSorting": [],
        "ajax": {
            "url": BASE_URL+'index.php/admin/getAcademicYearDataTable',
            "type": "POST",
            "data": function ( d ) {
                d.acolumns="id_academic_year";
                d.my_order = "id_academic_year";
                d.sort="desc";
            }
        },
        "aoColumnDefs": [
            {
                "aTargets": [3],
                "mData": null,
                "mRender": function (data, type, full) {

                    if(full[3]==0){ return "Inactive"; }
                    else { return "Active"; }
                }
            },
            {
                "aTargets": [4],
                "mData": null,
                "mRender": function (data, type, full) {

                    return '<div class="mod-more tooltipsample actions">'+
                        '<a id="edit" title="edit" class="edit" href="'+BASE_URL+'index.php/admin/addAcademicYear/'+full[4]+'"><span class="circle"><i class="fa fa-pencil"></i></span></a></a>' +
                        '<a id="edit" title="edit" class="edit" onclick="deleteAcademicYear(\''+full[4]+'\')" ><span class="circle"><i class="fa fa-trash"></i></span></a></a>' +
                        '</div>';
                }
            }
        ]
    });
}

function deleteAcademicYear(id)
{
    if (confirm("Are you sure?"))
    {
        $.ajax({
            async: true,
            type: 'POST',
            url: BASE_URL+'index.php/admin/deleteAcademicYear/'+id,
            data: {},
            dataType: 'json',
            success:function(res){
                if(res.response==1){
                    location.reload();
                }
            }
        });
    }
}

function getBoardDataTable()
{
    $('#table').dataTable({
        "processing": true,
        "bProcessing": true,
        "serverSide": true,
        "bPaginate":true,
        "aaSorting": [],
        "ajax": {
            "url": BASE_URL+'index.php/admin/getBoardDataTable',
            "type": "POST",
            "data": function ( d ) {
                d.acolumns="id_board";
                d.my_order = "id_board";
                d.sort="desc";
            }
        },
        "aoColumnDefs": [
            {
                "aTargets": [1],
                "mData": null,
                "mRender": function (data, type, full) {

                    if(full[1]==0){ return "Inactive"; }
                    else { return "Active"; }
                }
            },
            {
                "aTargets": [2],
                "mData": null,
                "mRender": function (data, type, full) {

                    return '<div class="mod-more tooltipsample actions">'+
                        '<a id="edit" title="edit" class="edit" href="'+BASE_URL+'index.php/admin/AddBoard/'+full[2]+'"><span class="circle"><i class="fa fa-pencil"></i></span></a></a>' +
                        /*'<a id="edit" title="edit" class="edit" onclick="deleteBoard(\''+full[2]+'\')" ><span class="circle"><i class="fa fa-trash"></i></span></a></a>' +*/
                        '</div>';
                }
            }
        ]
    });
}

function deleteBoard(id)
{
    if (confirm("Are you sure?"))
    {
        $.ajax({
            async: true,
            type: 'POST',
            url: BASE_URL+'index.php/admin/deleteBoard/'+id,
            data: {},
            dataType: 'json',
            success:function(res){
                if(res.response==1){
                    location.reload();
                }
            }
        });
    }
}

function getCourseDataTable()
{
    $('#table').dataTable({
        "processing": true,
        "bProcessing": true,
        "serverSide": true,
        "bPaginate":true,
        "aaSorting": [],
        "ajax": {
            "url": BASE_URL+'index.php/admin/getCourseDataTable',
            "type": "POST",
            "data": function ( d ) {
                d.acolumns="id_course";
                d.my_order = "id_course";
                d.sort="desc";
            }
        },
        "aoColumnDefs": [
            {
                "aTargets": [3],
                "mData": null,
                "mRender": function (data, type, full) {

                    if(full[3]==0){ return "Inactive"; }
                    else { return "Active"; }
                }
            },
            {
                "aTargets": [4],
                "mData": null,
                "mRender": function (data, type, full) {

                    return '<div class="mod-more tooltipsample actions">'+
                        '<a id="edit" title="edit" class="edit" href="'+BASE_URL+'index.php/admin/addCourse/'+full[4]+'"><span class="circle"><i class="fa fa-pencil"></i></span></a></a>' +
                        /*'<a id="edit" title="edit" class="edit" onclick="deleteCourse(\''+full[4]+'\')" ><span class="circle"><i class="fa fa-trash"></i></span></a></a>' +*/
                        '</div>';
                }
            }
        ]
    });
}

function deleteCourse(id)
{
    if (confirm("Are you sure?"))
    {
        $.ajax({
            async: true,
            type: 'POST',
            url: BASE_URL+'index.php/admin/deleteCourse/'+id,
            data: {},
            dataType: 'json',
            success:function(res){
                if(res.response==1){
                    location.reload();
                }
            }
        });
    }
}

function getSubjectDataTable()
{
    $('#table').dataTable({
        "processing": true,
        "bProcessing": true,
        "serverSide": true,
        "bPaginate":true,
        "aaSorting": [],
        "ajax": {
            "url": BASE_URL+'index.php/admin/getSubjectDataTable',
            "type": "POST",
            "data": function ( d ) {
                d.acolumns="id_subject";
                d.my_order = "id_subject";
                d.sort="desc";
            }
        },
        "aoColumnDefs": [
            {
                "aTargets": [3],
                "mData": null,
                "mRender": function (data, type, full) {

                    if(full[3]==0){ return "Inactive"; }
                    else { return "Active"; }
                }
            },
            {
                "aTargets": [4],
                "mData": null,
                "mRender": function (data, type, full) {

                    return '<div class="mod-more tooltipsample actions">'+
                        '<a id="edit" title="edit" class="edit" href="'+BASE_URL+'index.php/admin/addSubject/'+full[4]+'"><span class="circle"><i class="fa fa-pencil"></i></span></a></a>' +
                        '<a id="edit" title="edit" class="edit" onclick="deleteSubject(\''+full[4]+'\')" ><span class="circle"><i class="fa fa-trash"></i></span></a></a>' +
                        '</div>';
                }
            }
        ]
    });
}

function deleteSubject(id)
{
    if (confirm("Are you sure?"))
    {
        $.ajax({
            async: true,
            type: 'POST',
            url: BASE_URL+'index.php/admin/deleteSubject/'+id,
            data: {},
            dataType: 'json',
            success:function(res){
                if(res.response==1){
                    location.reload();
                }
            }
        });
    }
    return false;
}

function getClassTimingDataTable()
{
    $('#table').dataTable({
        "processing": true,
        "bProcessing": true,
        "serverSide": true,
        "bPaginate":true,
        "aaSorting": [],
        "ajax": {
            "url": BASE_URL+'index.php/admin/getClassTimingDataTable',
            "type": "POST",
            "data": function ( d ) {
                d.acolumns="id_class_timing";
                d.my_order = "id_class_timing";
                d.sort="desc";
            }
        },
        "aoColumnDefs": [
            {
                "aTargets": [4],
                "mData": null,
                "mRender": function (data, type, full) {

                    if(full[4]==0){ return "No"; }
                    else { return "Yes"; }
                }
            },
            {
                "aTargets": [5],
                "mData": null,
                "mRender": function (data, type, full) {

                    return '<div class="mod-more tooltipsample actions">'+
                        '<a id="edit" title="edit" class="edit" href="'+BASE_URL+'index.php/admin/addClassTiming/'+full[5]+'"><span class="circle"><i class="fa fa-pencil"></i></span></a></a>' +
                        '<a id="edit" title="edit" class="edit" onclick="deleteClassTiming(\''+full[5]+'\')" ><span class="circle"><i class="fa fa-trash"></i></span></a></a>' +
                        '</div>';
                }
            }
        ]
    });
}

function deleteClassTiming(id)
{
    if (confirm("Are you sure?"))
    {
        $.ajax({
            async: true,
            type: 'POST',
            url: BASE_URL+'index.php/admin/deleteClassTiming/'+id,
            data: {},
            dataType: 'json',
            success:function(res){
                if(res.response==1){
                    location.reload();
                }
            }
        });
    }
    return false;
}

function getClassTimeTableDataTable()
{
    $('#table').dataTable({
        "processing": true,
        "bProcessing": true,
        "serverSide": true,
        "bPaginate":true,
        "aaSorting": [],
        "ajax": {
            "url": BASE_URL+'index.php/admin/getClassTimeTableDataTable',
            "type": "POST",
            "data": function ( d ) {
                d.acolumns="id_class_time_table";
                d.my_order = "id_class_time_table";
                d.sort="desc";
            }
        },
        "aoColumnDefs": [
            {
                "aTargets": [3],
                "mData": null,
                "mRender": function (data, type, full) {

                    if(full[3]==0){ return "Inactive"; }
                    else { return "Active"; }
                }
            },
            {
                "aTargets": [4],
                "mData": null,
                "mRender": function (data, type, full) {

                    return '<div class="mod-more tooltipsample actions">'+
                        '<a id="edit" title="edit" class="edit" href="'+BASE_URL+'index.php/admin/addTimeTable/'+full[4]+'"><span class="circle"><i class="fa fa-pencil"></i></span></a></a>' +
                        '<a id="edit" title="edit" class="edit" onclick="deleteClassTimeTable(\''+full[4]+'\')" ><span class="circle"><i class="fa fa-trash"></i></span></a></a>' +
                        '</div>';
                }
            }
        ]
    });
}

function populate(selector) {
    var select = jQuery(selector);
    var hours, minutes, ampm;
    for(var i = 0; i <= 1435; i += 30){
        hours = Math.floor(i / 60);
        minutes = i % 60;
        if (minutes < 10){
            minutes = '0' + minutes; // adding leading zero
        }
        ampm = hours % 24 < 12 ? 'AM' : 'PM';
        //hours = hours % 12;
        var hours1 = hours % 12;
        if (hours === 0){
            hours = 12;
        }
        if(hours1===0){ hours1=12; }
        select.append(jQuery('<option></option>')
            .attr('value', hours + ':' + minutes)
            .text(hours1 + ':' + minutes + ' ' + ampm));
    }
}

function getTimeTable(class_id)
{
    var html = '';
    if(class_id!='' && class_id!=0)
    {
        $.ajax({
            async: true,
            type: 'POST',
            url: BASE_URL+'index.php/admin/getTimeTable/',
            data: {class_id:class_id},
            dataType: 'json',
            success:function(res){
                if(res.response==1){
                    /*var days = res.days;
                     var timing = res.timings;*/

                    /*if(timing.length==0){
                     html+='<p>There are no timings for this class <a href="'+BASE_URL+'index.php/admin/addClassTiming">Create Class Timing</a></p>';
                     }
                     else
                     {
                     html+='<table class="table table-bordered"><tr><td>Week Day</td>';
                     for(var r=0;r<timing.length;r++){
                     html+='<td>'+timing[r].start_time+' - '+timing[r].end_time+'</td>';
                     }
                     html+='</tr><tbody>';

                     for(var s=0;s<days.length;s++)
                     {
                     html+='<tr><td>'+getDayName(days[s].day)+'</td>';
                     for(var r=0;r<timing.length;r++)
                     {
                     html+='<td></td>';
                     }
                     html+='</tr>';
                     }
                     html+='</tbody></table>';
                     }
                     $('#time-table-div').html(html);*/

                    $('#time-table-div').html(res.data);
                    $('#save-btn').css('display','block');

                }
                else if(res.response==2){
                    html+='<p>There are no timings for this class <a href="'+BASE_URL+'index.php/admin/addClassTiming">Create Class Timing</a></p>';
                    $('#time-table-div').html(html);
                    $('#save-btn').css('display','none');
                }
            }
        });
    }
    else{
        $('#time-table-div').html('');
    }

}

function getAssign(e,select)
{
    var course_id = $('#course_id').val();
    var html = '';
    $.ajax({
        async: true,
        type: 'POST',
        url: BASE_URL+'index.php/admin/getStaffSubject/',
        data: {course_id:course_id},
        dataType: 'json',
        success:function(res){
            if(res.response==1){
                var staff = res.staff;
                var subject = res.subject;
                html+='<div class="form-group"><select class="form-control" name="staff" id="staff"><option value="">Select Staff</option>';
                for(var s=0;s<staff.length;s++)
                {
                    html+='<option value="'+staff[s].id_staff+'">'+staff[s].name+'</option>';
                }
                html+='</select></div>';

                html+='<div class="form-group"><select class="form-control" name="subject" id="subject"><option value="">Select Suject</option>';
                for(var s=0;s<subject.length;s++)
                {
                    html+='<option value="'+subject[s].id_subject+'">'+subject[s].subject_name+'</option>';
                }
                html+='</select></div>'

                $('#sub_timing').html(html);
                $('#m-footer').html('<button type="submit" id="save-m" class="btn btn-primary">Save changes</button>');

                $('#save-m').click(function(){
                    var staff = $('#staff').val();
                    var staff_t = $('#staff option:selected').text();
                    var subject = $('#subject').val();
                    var subject_t = $('#subject option:selected').text();
                    html='<div><span style="cursor: pointer;" onclick="reAssign(this,\''+select+'\')">X</span><p>'+staff_t+'</p><p>'+subject_t+'</p>';
                    html+='<input type="hidden" name="t_'+select+'" value="'+staff+'-'+subject+'"></div>';
                    $(e).parent().html(html);
                    //$('#myModal').modal('hide');
                    $('#myModal .close').click();
                });
            }
        }
    });
}

function reAssign(e,select)
{
    $(e).parent().parent().html('<a href="javascript:;" onclick="getAssign(this,\''+select+'\');" data-toggle="modal" data-target="#myModal">click</a>');
}

function deleteClassTimeTable(id)
{
    if (confirm("Are you sure?"))
    {
        $.ajax({
            async: true,
            type: 'POST',
            url: BASE_URL+'index.php/admin/deleteClassTimeTable/'+id,
            data: {},
            dataType: 'json',
            success:function(res){
                if(res.response==1){
                    location.reload();
                }
            }
        });
    }
    return false;
}