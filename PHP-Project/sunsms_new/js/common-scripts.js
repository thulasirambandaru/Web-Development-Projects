var Script = function () {


// theme switcher

    var scrollHeight = '60px';
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
        $('#style_color').attr("href", BASE_URL+"css/style-" + color + ".css");
    }

}();

ADMIN = 1;
TEACHER = 2;
PARENT_ID = 3;
STUDENT = 4;

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

/*function deleteStaffType(id)
{
    $.ajax({
        async: true,
        type: 'get',
        url: BASE_URL+'index.php/staff/deleteStaffType/'+id,
        data: {},
        dataType: 'json',
        success:function(res){
            if(res.response==1){
                location.reload();
            }
        }
    });
}*/

function deleteRecord(url)
{
    $.ajax({
        async: true,
        type: 'get',
        url: BASE_URL+url,
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
            "url": BASE_URL+'index.php/admin/getDepartmentDataTable',
            "type": "POST",
            "data": function ( d ) {
                /*d.acolumns="id_department";
                d.my_order = "id_department";
                d.sort="desc";*/
            }
        },
        "aoColumnDefs": [
            {
                "aTargets": [1],
                "mData": null,
                "mRender": function (data, type, full) {

                    return '<div class="mod-more tooltipsample actions">'+
                        '<a  title="edit" class="edit" href="'+BASE_URL+'index.php/admin/addDepartment/'+full[1]+'"><span class="circle"><i class="fa fa-pencil"></i></span></a></a>' +
                        '<a  title="delete" class="edit" onclick="manageDelOperation(\'department\', \''+full[1]+'\')"><span class="circle"><i class="fa fa-trash-o"></i></span></a></a>' +
                        '</div>';
                }
            }
        ]
    });
}


/**** Staff Module Code Starts here ****/

function getStaffDataTable(){
    $('#table').dataTable({
        "processing": true,
        "bProcessing": true,
        "serverSide": true,
        "bPaginate":true,
        "aaSorting": [],
		"lengthMenu": [[25, 50, -1], [25, 50, "All"]],
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
            /*{
                "aTargets": [1],
                "mData": null,
                "mRender": function (data, type, full) {
                    if(full[1] == 1){ return "Male"; }
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
            },*/
            {
                "aTargets": [5],
                "mData": null,
                "mRender": function (data, type, full) {
                    return '<div class="mod-more tooltipsample actions">'+
                        '<a  title="edit" class="edit" href="'+BASE_URL+'index.php/staff/createStaffView/'+full[5]+'"><span class="circle"><i class="fa fa-pencil"></i></span></a></a>' +						
                        '</div>';
						/*'<a  title="delete" class="edit" onclick="deleteStaff(\''+full[5]+'\')"><span class="circle"><i class="fa fa-trash-o"></i></span></a></a>' +*/
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

function getStaffTypeDateTable(){
    $('#table').dataTable({
        "processing": true,
        "bProcessing": true,
        "serverSide": true,
        "bPaginate":true,
        "aaSorting": [],
        "ajax": {
            "url": BASE_URL+'index.php/staff/getStaffTypeDateTable',
            "type": "POST",
            "data": function ( d ) {
                d.acolumns="id_staff_type";                
            }
        },
        "aoColumnDefs": [            
            {
                "aTargets": [1],
                "mData": null,
                "mRender": function (data, type, full) {
                    return '<div class="mod-more tooltipsample actions">'+
                        '<a  title="edit" class="edit" href="'+BASE_URL+'index.php/staff/addUpdateStaffType/'+full[1]+'"><span class="circle"><i class="fa fa-pencil"></i></span></a></a>' +
                        '<a id="delete_staff_type" title="delete" class="edit" onclick="manageDelOperation(\'staff_type\', \''+full[1]+'\')"><span class="circle"><i class="fa fa-trash-o"></i></span></a></a>' +
                        '</div>';
                }
            }
        ]
    });
}

function getStaffClassDateTable(){
    $('#table').dataTable({
        "processing": true,
        "bProcessing": true,
        "serverSide": true,
        "bPaginate":true,
        "aaSorting": [],
        "ajax": {
            "url": BASE_URL+'index.php/staff/getStaffClassDateTable',
            "type": "POST",
            "data": function ( d ) {
                d.acolumns="id_staff_class_allocate";                
            }
        },
        "aoColumnDefs": [            
            {
                "aTargets": [3],
                "mData": null,
                "mRender": function (data, type, full) {
                    if(full[3] == null){ return "NA"; }
                    else { return full[3]; }
                }
            },{
                "aTargets": [4],
                "mData": null,
                "mRender": function (data, type, full) {
                    return '<div class="mod-more tooltipsample actions">'+
                        '<a  title="edit" class="edit" href="'+BASE_URL+'index.php/staff/addUpdateClassTeacher/'+full[4]+'"><span class="circle"><i class="fa fa-pencil"></i></span></a></a>' +
                        '<a id="delete_staff_type" title="delete" class="edit" onclick="manageDelOperation(\'class_teacher\', \''+full[4]+'\')"><span class="circle"><i class="fa fa-trash-o"></i></span></a></a>' +
                        '</div>';
                }
            }
        ]
    });
}

/**** Staff Module Code Ends Here ****/

function manageResetOperation(source) {	
	$("#dialog-msg").html("This form will reset and the selected values will be cleared. Are you sure?");
	$( "#dialog-confirm" ).dialog({
		  resizable: false,
		  height: "auto",
		  width: 400,
		  modal: true,
		  buttons: {
			"Ok": function() { 
				// This method source wil change dynamically...
				resetForm(source);
				$( this ).dialog( "close" );
			},
			Cancel: function() {
			  $( this ).dialog( "close" );
			}
		  }
		});
}

function resetForm(source) {
	if(source == 'exam_schedule_reset') {		
		//getExamSubjects($("#student_course_id").val());		
		$('#exam-schedule-div').find('input').val('');
		$('#exam-schedule-div').find('select').val('0');
	}
}

function manageDelOperation(source, delID) {
	url = '';
	if (source == "staff_type") {
		url = 'index.php/staff/deleteStaffType/'+delID
	}
	else if(source == "class_teacher") {
		url = 'index.php/staff/deleteClassTeacher/'+delID
	}
	else if(source == "class_timing") {
		url = 'index.php/admin/deleteClassTiming/'+delID
	}
	else if(source == "department") {
		url = 'index.php/admin/deleteDepartment/'+delID
	}
	else if(source == "time_table") {
		url = 'index.php/timetable/deleteClassTimeTable/'+delID
	}
	else if(source == "examination") {
		url = 'index.php/examination/deleteExam/'+delID
	}
	else if(source == "exam_schedule") {
		url = 'index.php/examination/deleteExamSchedule/'+delID
	}
	else if(source == "exam_grades") {
		url = 'index.php/examination/deleteExamGrades/'+delID
	}
	else if(source == "exam_sub_marks") {
		url = 'index.php/examination/deleteExamMarks/'+delID
	}
	
	if(url != '') {
		$( "#dialog-confirm" ).dialog({
		  resizable: false,
		  height: "auto",
		  width: 400,
		  modal: true,
		  buttons: {
			"Delete": function() { 
				// This method url wil change dynamically...
				deleteRecord(url);
				$( this ).dialog( "close" );
			},
			Cancel: function() {
			  $( this ).dialog( "close" );
			}
		  }
		});
	}
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
                "aTargets": [2],
                "mData": null,
                "mRender": function (data, type, full) {
                    if(full[2]==0){ return "Inactive"; }
                    else { return "Active"; }
                }
            },
            {
                "aTargets": [3],
                "mData": null,
                "mRender": function (data, type, full) {
                    return '<div class="mod-more tooltipsample actions">'+
                        '<a id="edit" title="edit" class="edit" href="'+BASE_URL+'index.php/admin/addCourse/'+full[3]+'"><span class="circle"><i class="fa fa-pencil"></i></span></a></a>' +
                        /*'<a id="edit" title="edit" class="edit" onclick="deleteCourse(\''+full[4]+'\')" ><span class="circle"><i class="fa fa-trash"></i></span></a></a>' +*/
                        '</div>';
                }
            }
        ]
    });
}

function getSectionDataTable() {
    $('#table').dataTable({
        "processing": true,
        "bProcessing": true,
        "serverSide": true,
        "bPaginate": true,
        "aaSorting": [],
        "ajax": {
            "url": BASE_URL + 'index.php/admin/getSectionDataTable',
            "type": "POST",
            "data": function(d) {
                /*d.acolumns = "id_section";
                d.my_order = "course_id";
                d.sort = "asc";*/
            }
        },
        "aoColumnDefs": [{
            "aTargets": [3],
            "mData": null,
            "mRender": function(data, type, full) {
                if (full[3] == 0) {
                    button = "Enable";
                    return "InActive";
                } else {
                    button = "Disable";
                    return "Active";
                }
            }
        }, {
            "aTargets": [4],
            "mData": null,
            "mRender": function(data, type, full) {
                return '<div class="mod-more tooltipsample actions">' + '<a class="btn btn-sm btn-primary" href="' + BASE_URL + 'index.php/admin/addSection/' + full[4] + '" title="Edit" ><i class="glyphicon glyphicon-pencil"></i><b>Edit</b></a>&nbsp;&nbsp;' + '<a class="btn btn-sm btn-danger" href="' + BASE_URL + 'index.php/admin/manageSection/' + full[4] + '" title="Disable" ><b>' + button + '</b></a>' + /*<i class="glyphicon glyphicon-trash"></i>*/ /*'<a class="btn btn-sm btn-primary" href="'+BASE_URL+'index.php/admin/addSection/'+full[3]+'"></a>' +*/ /*'<a id="edit" title="edit" class="edit" onclick="deleteCourse(\''+full[4]+'\')" ><span class="circle"><i class="fa fa-trash"></i></span></a></a>' +*/ '</div>';
            }
        }]
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

/**** Settings Module Subject related Code STARTS here ****/

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
                        '<a id="edit" title="edit" class="edit" href="'+BASE_URL+'index.php/admin/addSubject/'+full[4]+'"><span class="circle"><i class="fa fa-pencil"></i></span></a></a>' +'</div>';
					/*'<a id="edit" title="edit" class="edit" onclick="deleteSubject(\''+full[4]+'\')" ><span class="circle"><i class="fa fa-trash"></i></span></a></a>' +*/
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

function getBoardCourses()
{
	board_id = $('#board_id').val();
	var html = '<option value="0">Select Class</option>';    
	
    $.ajax({
        async: true,
        type: 'POST',
        url: BASE_URL+'index.php/Admin/getBoardCourses/',
        data: {'board_id':board_id, 'status':1},
        dataType: 'json',
        success:function(res){
            if(res.response==1){
                var data = res.data;
                for(var s=0;s<data.length;s++)
                {
                    html+='<option value="'+data[s].id_course+'">'+data[s].course_name+'</option>';
                }
                $('#course_id').html(html);
                if(course_id){ $('#course_id').val(course_id); }
            }
        }
    });
}

/**** Settings Module Subject related Code ENDS here ****/

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
                /*d.acolumns="start_timne";
                d.my_order = "start_time";
				d.sort="asc";*/                
            }
        },
        "aoColumnDefs": [
            {
                "aTargets": [3],
                "mData": null,
                "mRender": function (data, type, full) {

                    if(full[3]==0){ return ""; }
                    else { return "Yes"; }
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
                        '<a id="edit" title="edit" class="edit" href="'+BASE_URL+'index.php/admin/addClassTiming/'+full[5]+'"><span class="circle"><i class="fa fa-pencil"></i></span></a></a>' +
                        '<a id="edit" title="edit" class="edit" onclick="manageDelOperation(\'class_timing\', \''+full[5]+'\')" ><span class="circle"><i class="fa fa-trash"></i></span></a></a>' +
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

function getClassTimeTableDataTable(user_type)
{
    $('#table').dataTable({
        "processing": true,
        "bProcessing": true,
        "serverSide": true,
        "bPaginate":true,
        "aaSorting": [],
        "ajax": {
            "url": BASE_URL+'index.php/timetable/getClassTimeTableDataTable',
            "type": "POST",
            "data": function ( d ) {
                d.acolumns="id_class_time_table";
                d.my_order = "id_class_time_table";
                d.sort="desc";
            }
        },
        "aoColumnDefs": [
			{
                "aTargets": [2],
                "mData": null,
                "mRender": function (data, type, full) {
                    if(full[2]==null){ return "--"; }
                    else { return full[2]; }
                }
            },
            {
                "aTargets": [5],
                "mData": null,
                "mRender": function (data, type, full) {
                    if(full[5]==0){ return "Inactive"; }
                    else { return "Active"; }
                }
            },
            {
                "aTargets": [6],
                "mData": null,
                "mRender": function (data, type, full) {
					if(user_type == TEACHER || user_type == PARENT_ID || user_type == STUDENT) {
						return '<div class="mod-more tooltipsample actions">'+
                        '<a id="preview" title="Preview" href="'+BASE_URL+'index.php/timetable/addTimeTable/'+full[6]+'/1"><span class="circle"><i class="glyphicon glyphicon-eye-open"></i></span></a>' +                        
                        '</div>';
					}
					else {
						return '<div class="mod-more tooltipsample actions">'+
						'<a id="preview" title="Preview" href="'+BASE_URL+'index.php/timetable/addTimeTable/'+full[6]+'/1"><span class="circle"><i class="glyphicon glyphicon-eye-open"></i></span></a>&nbsp;' +
                        '<a id="edit" title="Edit" href="'+BASE_URL+'index.php/timetable/addTimeTable/'+full[6]+'"><span class="circle"><i class="glyphicon glyphicon-pencil"></i></span></a></a>&nbsp;' +
                        '<a id="delete" title="Delete" onclick="manageDelOperation(\'time_table\', \''+full[6]+'\')" ><span class="circle"><i class="glyphicon glyphicon-trash"></i></span></a></a>' +
                        '</div>';
					}
                }
            }
        ]
    });
}

function manageSections(course_id, mod_name)
{
    var html = '';
    if(course_id!='' && course_id!=0)
    {
        $.ajax({
            async: true,
            type: 'POST',
            url: BASE_URL+'index.php/Student/getSectionByCourse/',
            data: {course_id:course_id, status:1},
            dataType: 'json',
            success:function(res){
				if(res.data.length > 0) {
					$("#course_section_id").html(res.data);
					$("#course_section_id_div").show();
				}
				else {
					if(mod_name=='timetable')
						getTimeTable(course_id);
					
					if(mod_name=='report_cards')
						getExamMarksForReport(1);
					
					$("#course_section_id_div").hide();
				}
            }
        });
    }
    else{
        $('#course_section_id').html('');
    }
}


function populate(selector) {
    var select = jQuery(selector);
    var hours, minutes, ampm;
    for(var i = 0; i <= 1435; i += 15){
        hours = Math.floor(i / 60);
        minutes = i % 60;
        if (minutes < 10){
            minutes = '0' + minutes; // adding leading zero
        }
        ampm = hours % 24 < 12 ? 'AM' : 'PM';
        //hours = hours % 12;
        var hours1 = hours % 12;
        if (hours === 0){
            hours = 00;
        }
        if(hours1===0){ hours1=12; }
        select.append(jQuery('<option></option>')
            .attr('value', hours + ':' + minutes)
            .text(hours1 + ':' + minutes + ' ' + ampm));
    }
}

function getTimeTable(reset_flg=null/*class_id*/)
{
    var html = '';
    /*if(class_id!='' && class_id!=0)
    {*/
        $.ajax({
            async: true,
            type: 'POST',
            url: BASE_URL+'index.php/timetable/getTimeTable/',
            //data: {class_id:class_id},
            dataType: 'json',
            success:function(res){
                if(res.response==1) {
                    $('#time-table-div').html(res.data);
					/*button_html = '<button class="btn btn-primary">Save</button>&nbsp;<input type="button" class="btn btn-primary" onclick="getTimeTable('+class_id+');" value="Reset">';
                            
                    $('#buttons-div').html(button_html);*/
					$('#buttons-div').css('display','block');
                }
                else if(res.response==2){
                    html+='<p>Weekdays are not created yet! <a href="'+BASE_URL+'index.php/admin/weekDays">Create Weekdays</a></p>';
                    $('#time-table-div').html(html);
                    //$('#buttons-div').css('display','block');
                }
				else if(res.response==3){
                    html+='<p>Class timings are not created yet! <a href="'+BASE_URL+'index.php/admin/addClassTiming">Create Class Timing</a></p>';
                    $('#time-table-div').html(html);
                    //$('#buttons-div').css('display','block');
                }
				/*else if(res.response==4){
                    html+='<p>Timetable for selected class already exists! <a href="'+BASE_URL+'index.php/timetable/addTimeTable/'+res.data+'" target="_blank">Click Here to view the Timetable</a></p>';
                    $('#time-table-div').html(html);
                    //$('#buttons-div').css('display','block');
                }*/
				
				if(reset_flg == 1) {
					$('#assign_vals_id').val('');
					$('#sel_timetable_err').html('');
				}
            }
        });
    /*}
    else{
        $('#time-table-div').html('');
    }*/
}

function validateAssignTimetable()
{
	//alert($('#assign_vals_id').val());
	$('#sel_timetable_err').html("");
	if($('#assign_vals_id').val() == '') {
		$('#sel_timetable_err').html("Please assign atleast one period to create timetable.");	
		return false;
	}
}

function getAssign(e,select,sel_type)
{
    var course_id = $('#student_course_id').val();
    var html = '';
    $.ajax({
        async: true,
        type: 'POST',
        url: BASE_URL+'index.php/timetable/getStaffSubject/',
        data: {course_id:course_id},
        dataType: 'json',
        success:function(res){
            if(res.response==1){
                var staff = res.staff;
                var subject = res.subject;
				
				$( "#dialog-timetable" ).dialog({
				  resizable: false,
				  height: 300,
				  width: 350,
				  modal: true/*,
				  buttons: {
					Cancel: function() {
					  $( this ).dialog( "close" );
					}
				  }*/
				});
				
				html+= '<div class="form-group">Select Staff <span class="clr-red">*</span>';
				html+= '<select class="form-control" name="staff" id="staff"><option value="0">Select Staff</option>';
					for(var s=0;s<staff.length;s++)
					{
						html+='<option value="'+staff[s].id_staff+'">'+staff[s].name+'</option>';
					}				
                html+='</select>'
				html+= '<span class="error" id="tt_staff_err" style="display: none">Please Select Staff</span></div>';                
				
				html+= '<div class="form-group">Select Subject <span class="clr-red">*</span>';
				html+= '<select class="form-control" name="subject" id="subject"><option value="0">Select Subject</option>';
					for(var s=0;s<subject.length;s++)
					{
						html+='<option value="'+subject[s].id_subject+'">'+subject[s].subject_name+'</option>';
					}
				html+='</select><span class="error" id="tt_subject_err" style="display: none">Please Select Subject</span></div>';  
				
				html+= '<br><div class="text-center"><button type="submit" id="save-m" class="btn btn-primary">Ok</button>&nbsp;&nbsp;<button type="submit" id="save-m" class="btn btn-primary" onclick="closeDialog(\'dialog-timetable\');">Cancel</button></div>';                            				
				$('#staff_subject').html(html);		
		
                $('#save-m').click(function(){
                    var staff = $('#staff').val();
                    var staff_t = $('#staff option:selected').text();
                    var subject = $('#subject').val();
                    var subject_t = $('#subject option:selected').text();
					flag = 0;
					$('#tt_staff_err').hide();
					$('#tt_student_err').hide();
					if(staff == 0) {
						$('#tt_staff_err').show();
						flag++;
					}
					if(subject == 0) {
						$('#tt_subject_err').show();
						flag++;
					}
					if(flag >0) 
						return false;
					//html = ''                					
					//'<div><span style="cursor: pointer;" onclick="reAssign(this,\''+select+'\')"><i aria-hidden="true" class="fa fa-times"></i></span><p>'+staff_t+'</p><p>'+subject_t+'</p>';
                    
					assign_vals = ''
					$('#dialog-timetable').dialog( "close" );
					if(sel_type == 1) {
						html='<div><span style="color:#FF8C00;"><b>'+staff_t+'</b></span><br><span style="color:#006400;"><b>'+subject_t+'</b></span><br><span style="cursor: pointer;" onclick="reAssign(this,\''+select+'\')"><i aria-hidden="true" class="fa fa-times"></i></span></div>'
						html+= '<input type="hidden" name="t_'+select+'" id="'+select+'" value="'+staff+'-'+subject+'"></div>';
						$(e).parent().html(html);
						assign_vals+= select+',';
						//$(e).parent().append(hidden_input);
					}
					else
					{
						timing = select.split('_');						
						$('input[name^="days_arr"]').each(function() {
							day = $(this).val();
							html='<div><span style="color:#FF8C00;"><b>'+staff_t+'</b></span><br><span style="color:#006400;"><b>'+subject_t+'</b></span><br><span style="cursor: pointer;" onclick="reAssign(this,\''+day+'_'+timing[1]+'\')"><i aria-hidden="true" class="fa fa-times"></i></span></div>';
							hidden_input = '<input type="hidden" name="t_'+day+'_'+timing[1]+'" id="t_'+day+'_'+timing[1]+'" value="'+staff+'-'+subject+'"></div>';
							$('#cell_'+day+'_'+timing[1]).html(html);
							$('#cell_'+day+'_'+timing[1]).append(hidden_input);
							assign_vals+= day+'_'+timing[1]+',';							
						});	
						$('#assign_vals_id').val(assign_vals);
					}                    														
                });
            }
        }
    });
}

function closeDialog(dialogID)
{
	$('#'+dialogID).dialog( "close" );
}

function resetPeriodTimetable(timing)
{
	$('input[name^="days_arr"]').each(function() {
		day = $(this).val();
		//alert(day+"====="+timing);
		html='<div><a href="javascript:;" onclick="getAssign(this,\'' + day + '_' + timing + '\');" >Assign</a></div>';
		hidden_input = '<input type="hidden" name="t_'+day+'_'+timing+'" id="t_'+day+'_'+timing+'" value=""></div>';
		$('#cell_'+day+'_'+timing).html(html);
		$('#cell_'+day+'_'+timing).append(hidden_input);
		$('#assign_vals_id').val(1);		
	});	
	
}

function reAssign(e,select)
{	
	$('#assign_vals_id').val($('#assign_vals_id').val().replace(select+',',''));
	$('#'+select).remove();
	sel_type = 1;
	if($('#assign_vals_id').val() == '')
		sel_type = 0;
    $(e).parent().parent().html('<a href="javascript:;" onclick="getAssign(this,\''+select+'\',\''+sel_type+'\');">Assign</a>');
}

function deleteClassTimeTable(id)
{
    if (confirm("Are you sure?"))
    {
        $.ajax({
            async: true,
            type: 'POST',
            url: BASE_URL+'index.php/timetable/deleteClassTimeTable/'+id,
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

/**** Student Module Code Starts ****/

function getStudentDataTable()
{
    $('#StudentTable').dataTable({
        "processing": true,
        "bProcessing": true,
        "serverSide": true,
        "bPaginate":true,
        "aaSorting": [],
		"lengthMenu": [[25, 50, -1], [25, 50, "All"]],
        "ajax": {
            "url": BASE_URL+'index.php/student/getStudentDataTable',
            "type": "POST",
            "data": function ( d ) {
                d.acolumns="id_student";
                d.my_order = "id_student";
                d.sort="desc";
            }
        },
        "aoColumnDefs": [
            {
                "aTargets": [6],
                "mData": null,
                "mRender": function (data, type, full) {

                    return '<div class="mod-more tooltipsample actions">'+
                        '<a id="edit" title="edit" class="edit" href="'+BASE_URL+'index.php/student/addStudent/'+full[6]+'"><span class="circle"><i class="fa fa-pencil"></i></span></a></a>' +
                        '</div>';
                }
            }
        ]
    });
}

function getStudentDataTable()
{
    $('#StudentTable').dataTable({
        "processing": true,
        "bProcessing": true,
        "serverSide": true,
        "bPaginate":true,
        "aaSorting": [],
		"lengthMenu": [[25, 50, -1], [25, 50, "All"]],
        "ajax": {
            "url": BASE_URL+'index.php/student/getStudentDataTable',
            "type": "POST",
            "data": function ( d ) {
                d.acolumns="id_student";
                d.my_order = "id_student";
                d.sort="desc";
            }
        },
        "aoColumnDefs": [
            {
                "aTargets": [6],
                "mData": null,
                "mRender": function (data, type, full) {

                    return '<div class="mod-more tooltipsample actions">'+
                        '<a id="edit" title="edit" class="edit" href="'+BASE_URL+'index.php/student/addStudent/'+full[6]+'"><span class="circle"><i class="fa fa-pencil"></i></span></a></a>' +
                        '</div>';
                }
            }
        ]
    });
}

function getNewAdmissionsDataTable()
{
	var i=0;
    $('#NewAdmissionsTable').dataTable({
        "processing": true,
        "bProcessing": true,
        "serverSide": true,
        "bPaginate":true,
        "aaSorting": [],
		"lengthMenu": [[25, 50, -1], [25, 50, "All"]],
        "ajax": {
            "url": BASE_URL+'index.php/student/getNewAdmissionsDataTable',
            "type": "POST",
            "data": function ( d ) {
                d.acolumns="id_student";
                d.my_order = "id_student";
                d.sort="desc";
            }
        },
        "aoColumnDefs": [
            {
                "aTargets": [6],
                "mData": null,
                "mRender": function (data, type, full) {
					i=i+1;
                    return '<div class="mod-more tooltipsample actions">'+
                        '<a id="edit" title="edit" class="edit" href="'+BASE_URL+'index.php/student/addStudent/'+full[6]+'"><span class="circle"><i class="fa fa-pencil"></i></span></a></a>' +
                        '</div>';						
                }
            }
        ]
    });	
}

function getCourses(board_id)
{
    var html = '';
    if(board_id!='' && board_id!=0)
    {
        $.ajax({
            async: true,
            type: 'POST',
            url: BASE_URL+'index.php/Student/getCourseByBoard/',
            data: {board_id:board_id, status:1},
            dataType: 'json',
            success:function(res){
                $("#student_course_id").html(res.data);
            }
        });
    }
    else{
        $('#student_course_id').html("<option value='0'>Select Class</option>");
    }
}

function getSections(course_id)
{
    var html = '';
    if(course_id!='' && course_id!=0)
    {
        $.ajax({
            async: true,
            type: 'POST',
            url: BASE_URL+'index.php/Student/getSectionByCourse/',
            data: {course_id:course_id, status:1},
            dataType: 'json',
            success:function(res){
				if(res.data.length > 0) {
					$("#course_section_id").html(res.data);
					$("#course_section_id_div").show();
				}
				else
					$("#course_section_id_div").hide();
            }
        });
    }
    else{
        $('#course_section_id').html('');
    }
}

function getCourseSubjects(course_id, inc='')
{    
	/*if(course_id == 0)
		course_id = $('#student_course_id').val();*/
	
    if(course_id!='' && course_id!=0)
    {
        $.ajax({
            async: true,
            type: 'POST',
            url: BASE_URL+'index.php/Admin/getCourseSubjects/',
            data: {course_id:course_id, status:1},
            dataType: 'json',
            success:function(res){
                $("#course_subject_id"+inc).html(res.data);
            }
        });
    }
    else{
        $('#course_subject_id'+inc).html("<option value='0'>Select Subject</option>");
    }
}

function getExistingParentInfo()
{
    if($('#parent_search_name').val()=='') {
        $('#parent_input').html('Please Enter Parent Name');
        return false;
    }
    else
        $('#parent_input').html('');

    var html = '<div id="parent_select" class="error"></div>';
    html+= '<table class="table table-bordered">';
    html+= '<tr><th>&nbsp;</th><th>Parent Name</th><th>Child Name</th><th>Class</th></tr>';
    parent_name = $('#parent_search_name').val();
    if(parent_name!='' && parent_name!=0)
    {
        $.ajax({
            async: true,
            type: 'POST',
            url: BASE_URL+'index.php/Student/getExistParentInfo/',
            data: {parent_name:parent_name},
            dataType: 'json',
            success:function(res){
                if(res.data.length > 0) {
                    for(i=0;i<res.data.length;i++) {
                        html+= '<tr><td><input type="radio" name="exist_parent_id" value="'+res.data[i]['id_parent']+'"></td><td>'+res.data[i]['parent_first_name']+' '+res.data[i]['parent_last_name']+'</td>'
                        html+= '<td>'+res.data[i]['first_name']+' '+res.data[i]['last_name']+'</td><td>'+res.data[i]['course_name']+'</td></tr>';						
						$('#id_user_exist').val(res.data[i]['user_id']);
                    }					
                    $('#save_button_id').hide();
                    $('#save_button_id_1').show();
                }
                else {
                    html+= '<tr><td align="center" colspan="5"><i>No Records Found!</i></td></tr>';
                    $('#save_button_id').hide();
					$('#save_button_id_1').hide();
                }

                html+= '</table>';
                $('#exists_parent_div').html(html);
            }
        });
    }
    else{
        $('#exists_parent_div').html('');
    }
}

function select_parent() 
{
	if($('input[name=exist_parent_id]:checked').length<=0)
	{
		$('#parent_select').html('Please Select Parent');
		return false;
	}	
	else
		$('#parent_select').html('');
}
/**** Student Module Code Ends ****/


function reload_table() {
    table.ajax.reload(null,false); //reload datatable ajax
}

function getClassByBoard(board_id,id)
{
    var html = '<option value="0">Select Class</option>';
    $('#section_id').html('<option value="0">Select Section</option>');
    if(board_id==0){
        $('#course_id').html(html);
        return false;
    }
    $.ajax({
        async: true,
        type: 'POST',
        url: BASE_URL+'index.php/Attendance/getCourse/',
        data: {'board_id':board_id},
        dataType: 'json',
        success:function(res){
            if(res.response==1){
                var data = res.data;
                for(var s=0;s<data.length;s++)
                {
                    html+='<option value="'+data[s].id_course+'">'+data[s].course_name+'</option>';
                }
                $('#course_id').html(html);

                if(id){
                    $('#course_id').val(id);
                }
                getAttendance();
            }
        }
    });
}

function getClassByBoard1(board_id,course_id)
{
    var html = '<option value="0">Select Class</option>';
    $('#section_id').html('<option value="0">Select Section</option>');

    $.ajax({
        async: true,
        type: 'POST',
        url: BASE_URL+'index.php/Attendance/getCourse/',
        data: {'board_id':board_id},
        dataType: 'json',
        success:function(res){
            if(res.response==1){
                var data = res.data;
                for(var s=0;s<data.length;s++)
                {
                    html+='<option value="'+data[s].id_course+'">'+data[s].course_name+'</option>';
                }
                $('#course_id').html(html);
                if(course_id){ $('#course_id').val(course_id); }
            }
        }
    });
}


function getSectionByCourse(course_id,id)
{
    var html = '<option value="0">Select Section</option>';
    if(course_id==0){
        $('#class_id').html(html); return false;
    }
    $.ajax({
        async: true,
        type: 'POST',
        url: BASE_URL+'index.php/Attendance/getSection/',
        data: {'course_id':course_id},
        dataType: 'json',
        success:function(res){
            if(res.response==1){
                var data = res.data;
                for(var s=0;s<data.length;s++)
                {
                    html+='<option value="'+data[s].id_section+'">'+data[s].section_name+'</option>';
                }
                $('#section_id').html(html);

                if(id){
                    $('#section_id').val(id);
                }
                getAttendance();
            }
        }
    });
}

function getAttendance()
{
    var html = '';
    var board_id = $('#board_id').val();
    var course_id = $('#course_id').val();
    var section_id = $('#section_id').val();
    var staff_id = $('#staff_id').val();
    var month = $('#month').val();
    var type = $('#type').val();

    if(type==1){
        var user_id = $('#user_id').val();
        //alert(user_id);
        /*var table = $('#table').dataTable();
        table.fnClearTable();*/
        $.ajax({
            async: true,
            type: 'POST',
            url: BASE_URL + 'index.php/Attendance/getUserAttendance/',
            data: {'user_id': user_id,'month':month},
            dataType: 'json',
            success: function (res) {
                if (res.response == 1) {
                    $('#tbody').html(res.data);
                    $('#header').html(res.header);
                    $('#s_btn').css('display', 'block');
                    //table.fnDraw();
                }
            }
        });
    }
    else if((board_id!=0 && course_id!=0 && section_id!=0 && month!=0) || (staff_id!=0)) {
        /*var table = $('#table').dataTable();
        table.fnClearTable();*/
        $.ajax({
            async: true,
            type: 'POST',
            url: BASE_URL + 'index.php/Attendance/getAttendance/',
            data: {'board_id': board_id, 'course_id': course_id, 'section_id': section_id, 'month': month,'staff_id':staff_id},
            dataType: 'json',
            success: function (res) {
                if (res.response == 1) {

                    /*var td_data = []; var tr = ''; var r = 1;

                    $(res.data+' > tr').each(function() {
                        tr = this; r=0;
                        $('td',tr).each(function() {
                            td_data.push($(this).html());
                            r++;
                        });
                        for(var e=r;e<=31;e++){ td_data.push('---'); }
                        table.dataTable().fnAddData(td_data);
                    });*/
                    $('#tbody').html(res.data);
                    $('#header').html(res.header);
                    $('#s_btn').css('display', 'block');
                }
            }
        });
    }
    else{
        $('#tbody').html('');
        $('#s_btn').css('display', 'none');
    }
}



function changeAttendance(e,type)
{
    var html = '';
    var value = $(e).next('input').attr('name');
    var student = $('input[name="student[]"]');

    if($('#'+value).val()) {
        $('#'+value).remove();
        html += '<input type="hidden" name="' + value + '_n" id="'+value+'" value="' + type + '">';
    }
    else {
        html += '<input type="hidden" name="notify[]" value="' + value + '">';
        html += '<input type="hidden" name="' + value + '_n" id="'+value+'" value="' + type + '">';
    }
    $('#notify_students').append(html);
    $('#students_div').html(student);

    if(type==0){
        $(e).next('input').val(type);
        $(e).replaceWith('<span onclick="changeAttendance(this,1)"><i aria-hidden="true" class="fa fa-times"></i></span>');

    }
    else if(type==2){
        $(e).next('input').val(type);
        $(e).replaceWith('<span onclick="changeAttendance(this,0)"><i class="fa fa-check" aria-hidden="true"></i><i aria-hidden="true" class="fa fa-times"></i></span>');

    }
    else if(type==1){
        $(e).next('input').val(type);
        $(e).replaceWith('<span onclick="changeAttendance(this,2)"><i class="fa fa-check" aria-hidden="true"></i></span>');

    }


}

function getFeeStructureDataTable()
{
    var table = $('#table').dataTable();
    table.fnClearTable();
    $.ajax({
        async: true,
        type: 'POST',
        url: BASE_URL + 'index.php/fee/getFeeStructureDataTable/',
        data: {},
        dataType: 'json',
        success: function (res) {
            if (res.response == 1) {
                var data = res.data; var su=''; var arr = [];
                var td_data = [];
                for(var r=0;r<data.length;r++){
                    td_data = [];
                    arr = $.map(data[r], function(el) { return el });
                    su = data[r].board;
                    arr = jQuery.grep(arr, function(val){
                        return val != su;
                    });
                    su = data[r].course;
                    arr = jQuery.grep(arr, function(val){
                        return val != su;
                    });
                    su = data[r].total;
                    arr = jQuery.grep(arr, function(val){
                        return val != su;
                    });
                    su = data[r].id;
                    arr = jQuery.grep(arr, function(val){
                        return val != su;
                    });

                    td_data.push(data[r].board);
                    td_data.push(data[r].course);
                    for(var s=0;s<arr.length;s++)
                    {
                         td_data.push(arr[s]);
                    }
                    td_data.push(data[r].total);
                    td_data.push('<div class="mod-more tooltipsample actions">'+
                    '<a  title="edit" class="edit" href="javascript:;" onclick="getEditStructure('+data[r].id+')"><span class="circle"><i class="fa fa-pencil"></i></span></a></a>' +
                    '</div>');
                    table.dataTable().fnAddData(td_data);
                }
            }
        }
    });
}

function getFeeTypeDataTable()
{
    $('#table').dataTable({
        "processing": true,
        "bProcessing": true,
        "serverSide": true,
        "bPaginate":true,
        "aaSorting": [],
        "columnDefs": [],
        "ajax": {
            "url": BASE_URL+'index.php/fee/getFeeTypeDataTable',
            "type": "POST",
            "data": function ( d ) {
                d.acolumns="id_fee_type";
                d.my_order = "id_fee_type";
                d.sort="desc";
            }
        },
        "aoColumnDefs": [
            {
                "aTargets": [1],
                "mData": null,
                "mRender": function (data, type, full) {
                    if(full[1]==1){ return "Active"; }
                    else{ return "Inactive"; }
                }
            },
            {
                "aTargets": [2],
                "mData": null,
                "mRender": function (data, type, full) {

                    return '<div class="mod-more tooltipsample actions">'+
                        '<a  title="edit" class="edit" href="'+BASE_URL+'index.php/fee/addFeeType/'+full[2]+'"><span class="circle"><i class="fa fa-pencil"></i></span></a></a>' +
                        '</div>';
                }
            }
        ]
    });
}

function getEditStructure(id)
{
    $('#grid').css('display','none');
    $('#form').css('display','block');

    $.ajax({
        async: true,
        type: 'POST',
        url: BASE_URL + 'index.php/fee/getClassFeeStructure/',
        data: {'id': id},
        dataType: 'json',
        success: function (res) {
            if (res.response == 1) {
                console.log(res.data);
                var result = res.data[0];
                $.each(result, function(k, v) {
                    if(k=='board_id'){ getClassByBoard1(v,result['course_id']); }
                    $('#'+k).val(v);
                });
                $('#status_div').css('display','block');
            }
        }
    });
}

function getStudentFee()
{
    var board_id = $('#board_id').val();
    var course_id = $('#course_id').val();
    var section_id = $('#section_id').val();
    if(board_id!=0 && course_id!=0 && section_id!=0){
        var table = $('#table').dataTable();

        table.fnClearTable();
        $.ajax({
            async: true,
            type: 'POST',
            url: BASE_URL + 'index.php/fee/getStudentFee/',
            data: {board_id:board_id,course_id:course_id,section_id:section_id},
            dataType: 'json',
            success: function (res) {
                if (res.response == 1) {
                    var data = res.data;
                    var td_data = [];
                    for(var r=0;r<data.length;r++){
                        td_data = [];
                        td_data.push(data[r].course_name);
                        td_data.push(data[r].section_name);
                        td_data.push(data[r].admission_number);
                        td_data.push('<div data-id="'+data[r].id+'" class="mod-more tooltipsample actions">'+
                            '<a  title="edit" class="edit" href="'+BASE_URL+'index.php/Fee/student/'+btoa(data[r].id)+'">'+data[r].user_name+'</a></a>' +
                            '</div>');

                        td_data.push(data[r].total);
                        td_data.push(data[r].paid);
                        td_data.push(data[r].due);
                        table.dataTable().fnAddData(td_data);
                    }
                    var selected = [];
                    $('#table tbody').on('click', 'tr', function () {
                        var id = 0 ;
                        $(this).find('td').each (function(e) {
                            if(e==3){
                                id = $(this)[0].children[0].attributes['data-id'].nodeValue;
                            }
                        });
                        var index = $.inArray(id, selected);

                        if ( index === -1 ) {
                            selected.push( id );
                        } else {
                            selected.splice( index, 1 );
                        }

                        $(this).toggleClass('selected');
                        $('#selected_array').val(selected);
                        if(selected.length>0){
                            $('#fee_notify').css('display','block');
                        }
                        else{
                            $('#fee_notify').css('display','none');
                        }

                    } );
                }
            }
        });
    }
    else{
        table.fnClearTable();
    }

}

function notifyFee()
{
    var student = $('#selected_array').val();
    $.ajax({
        async: true,
        type: 'POST',
        url: BASE_URL + 'index.php/fee/notify/',
        data: {'student': student},
        dataType: 'json',
        success: function (res) {
            //location.reload();
        }
    });
}

function getStudentFeeDetails()
{
    $('#table').dataTable({
        "processing": true,
        "bProcessing": true,
        "serverSide": true,
        "bPaginate":true,
        "aaSorting": [],
        "ajax": {
            "url": BASE_URL+'index.php/fee/getStudentFeeDetails',
            "type": "POST",
            "data": function ( d ) {
                d.acolumns="id_student_fee";
                d.my_order = "id_student_fee";
                d.sort="desc";
                d.student_id=$('#student_id').val();
            }
        }
    });
}

function payAmount()
{
    $('#fee_err').text('');
    var amount = $('#fee_amount').val();
    var fee_type = $('#fee_type').val();
    if(amount==0 || amount==''){
        $('#fee_err').text('Please enter amount');
    }
    else{
        $('#fee_pay').prop('disabled', true);
        $.ajax({
            async: true,
            type: 'POST',
            url: BASE_URL + 'index.php/fee/payAmount/',
            data: {'amount': amount,'student_id': $('#student_id').val(),'remain': $('#remain').val(),'fee_type':fee_type},
            dataType: 'json',
            success: function (res) {
                location.reload();
            }
        });
    }
}

function isNumberKey(evt)
{
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode != 46 && charCode > 31
        && (charCode < 48 || charCode > 57))
        return false;

    return true;
}


function getHostelTypeDataTable()
{
    $('#table').dataTable({
        "processing": true,
        "bProcessing": true,
        "serverSide": true,
        "bPaginate":true,
        "aaSorting": [],
        "columnDefs": [],
        "ajax": {
            "url": BASE_URL+'index.php/Hostel/getHostelTypeDataTable',
            "type": "POST",
            "data": function ( d ) {
                d.acolumns="id_hostel_type";
                d.my_order = "id_hostel_type";
                d.sort="desc";
            }
        },
        "aoColumnDefs": [
            {
                "aTargets": [1],
                "mData": null,
                "mRender": function (data, type, full) {
                    if(full[1]==1){ return "Active"; }
                    else{ return "Inactive"; }
                }
            },
            {
                "aTargets": [2],
                "mData": null,
                "mRender": function (data, type, full) {

                    return '<div class="mod-more tooltipsample actions">'+
                        '<a  title="edit" class="edit" href="'+BASE_URL+'index.php/Hostel/addHostelType/'+full[2]+'"><span class="circle"><i class="fa fa-pencil"></i></span></a></a>' +
                        '</div>';
                }
            }
        ]
    });
}

function getHostelDataTable()
{
    $('#table').dataTable({
        "processing": true,
        "bProcessing": true,
        "serverSide": true,
        "bPaginate":true,
        "aaSorting": [],
        "columnDefs": [],
        "ajax": {
            "url": BASE_URL+'index.php/Hostel/getHostelDataTable',
            "type": "POST",
            "data": function ( d ) {
                d.acolumns="id_hostel";
                d.my_order = "id_hostel";
                d.sort="desc";
            }
        },
        "aoColumnDefs": [
            {
                "aTargets": [5],
                "mData": null,
                "mRender": function (data, type, full) {
                    if(full[5]==1){ return "Active"; }
                    else{ return "Inactive"; }
                }
            },
            {
                "aTargets": [6],
                "mData": null,
                "mRender": function (data, type, full) {

                    return '<div class="mod-more tooltipsample actions">'+
                        '<a  title="edit" class="edit" href="'+BASE_URL+'index.php/Hostel/addHostel/'+full[6]+'"><span class="circle"><i class="fa fa-pencil"></i></span></a></a>' +
                        '</div>';
                }
            }
        ]
    });
}

function getFloorDataTable()
{
    $('#table').dataTable({
        "processing": true,
        "bProcessing": true,
        "serverSide": true,
        "bPaginate":true,
        "aaSorting": [],
        "columnDefs": [],
        "ajax": {
            "url": BASE_URL+'index.php/Hostel/getFloorDataTable',
            "type": "POST",
            "data": function ( d ) {
                d.acolumns="id_floor";
                d.my_order = "id_floor";
                d.sort="desc";
            }
        },
        "aoColumnDefs": [
            {
                "aTargets": [3],
                "mData": null,
                "mRender": function (data, type, full) {
                    if(full[3]==1){ return "Active"; }
                    else{ return "Inactive"; }
                }
            },
            {
                "aTargets": [4],
                "mData": null,
                "mRender": function (data, type, full) {

                    return '<div class="mod-more tooltipsample actions">'+
                        '<a  title="edit" class="edit" href="'+BASE_URL+'index.php/Hostel/addFloor/'+full[4]+'"><span class="circle"><i class="fa fa-pencil"></i></span></a></a>' +
                        '</div>';
                }
            }
        ]
    });
}

function getFloorByHostelId(hostel_id)
{
    $('#bed_div').html('');
    var html='<option value="0">Select Floor</option>';
    if(hostel_id==0){
        $('#floor_id').html(html);
        return false;
    }
    $.ajax({
        async: true,
        type: 'POST',
        url: BASE_URL + 'index.php/Hostel/getFloorByHostelId/',
        data: {'hostel_id': hostel_id},
        dataType: 'json',
        success: function (res) {
            if(res.response==1){
                var data = res.data;
                for(var s=0;s<data.length;s++){
                    html+='<option value="'+data[s].id_floor+'">'+data[s].floor_number+'</option>';
                }
                $('#floor_id').html(html);
            }
        }
    });
}

function getStudentHostel(id)
{
    $('#table').dataTable({
        "processing": true,
        "bProcessing": true,
        "serverSide": true,
        "bPaginate":true,
        "aaSorting": [],
        "columnDefs": [],
        "ajax": {
            "url": BASE_URL+'index.php/Hostel/getStudentHostelDetails',
            "type": "POST",
            "data": function ( d ) {
                d.acolumns="";
                d.my_order = "";
                d.sort="";
                d.student_id=id;
            }
        }
    });
}

function getRoommates(id)
{
    $('#table1').dataTable({
        "processing": true,
        "bProcessing": true,
        "serverSide": true,
        "bPaginate":true,
        "aaSorting": [],
        "columnDefs": [],
        "ajax": {
            "url": BASE_URL+'index.php/Hostel/getRoommates',
            "type": "POST",
            "data": function ( d ) {
                d.acolumns="";
                d.my_order = "";
                d.sort="";
                d.student_id=id;
            }
        }
    });
}


/****** Examination Module Code Starts Here ******/
function getExamDataTable(user_type)
{
    $('#table').dataTable({
        "processing": true,
        "bProcessing": true,
        "serverSide": true,
        "bPaginate":true,
        "aaSorting": [],
        "ajax": {
            "url": BASE_URL+'index.php/examination/getExamDataTable',
            "type": "POST",
            "data": function ( d ) {
                d.acolumns="id_exam";
                d.my_order = "id_exam";
                d.sort="desc";
            }
        },
        "aoColumnDefs": [
            {
                "aTargets": [1],
                "mData": null,
                "mRender": function (data, type, full) {
                    if(full[1]==1){ return "Active"; }
                    else{ return "Inactive"; }
                }
            },
			{
				"aTargets": [3],
				"mData": null,
				"mRender": function (data, type, full) {
					if(user_type == TEACHER || user_type == PARENT_ID || user_type == STUDENT) {
						return '<div class="mod-more tooltipsample actions">'+
						'--' +                        
						'</div>';
					}
					else {
						return '<div class="mod-more tooltipsample actions">'+						
						'<a id="edit" title="Edit" href="'+BASE_URL+'index.php/examination/addExam/'+full[3]+'"><span clas="circle"><i class="glyphicon glyphicon-pencil"></i></span></a>&nbsp;' +
						'<a id="delete" title="Delete" onclick="manageDelOperation(\'examination\', \''+full[3]+'\')" ><span class="circle"><i class="glyphicon glyphicon-trash"></i></span></a>' +
						'</div>';
					}
				}
			}
        ]
    });
}

function getExamScheduleDataTable(user_type)
{
    $('#table').dataTable({
        "processing": true,
        "bProcessing": true,
        "serverSide": true,
        "bPaginate":true,
        "aaSorting": [],
        "ajax": {
            "url": BASE_URL+'index.php/examination/getExamScheduleDataTable',
            "type": "POST",
            "data": function ( d ) {
                d.acolumns="id_exam_schedule";
                d.my_order = "id_exam_schedule";
                d.sort="desc";
            }
        },
        "aoColumnDefs": [   
			{
                "aTargets": [2],
                "mData": null,
                "mRender": function (data, type, full) {
                    if(full[2]==null){ return "--"; }
                    else { return full[2]; }
                }
            },
			{
				"aTargets": [4],
				"mData": null,
				"mRender": function (data, type, full) {
					if(user_type == TEACHER || user_type == PARENT_ID || user_type == STUDENT) {
						return '<div class="mod-more tooltipsample actions">'+
						'--' +                        
						'</div>';
					}
					else {
						return '<div class="mod-more tooltipsample actions">'+	
						'<a id="preview" title="Preview" href="'+BASE_URL+'index.php/examination/addExamSchedule/'+full[4]+'/1"><span class="circle"><i class="glyphicon glyphicon-eye-open"></i></span></a>&nbsp;' +
						'<a id="edit" title="Edit" href="'+BASE_URL+'index.php/examination/addExamSchedule/'+full[4]+'"><span clas="circle"><i class="glyphicon glyphicon-pencil"></i></span></a>&nbsp;' +
						'<a id="delete" title="Delete" onclick="manageDelOperation(\'exam_schedule\', \''+full[4]+'\')" ><span class="circle"><i class="glyphicon glyphicon-trash"></i></span></a>' +
						'</div>';
					}
				}
			}
        ]
    });
}

function getExamSubjects(class_id, reset_flg=null)
{
    var html = '';
    if(class_id!='' && class_id!=0)
    {
        $.ajax({
            async: true,
            type: 'POST',
            url: BASE_URL+'index.php/examination/getExamSubjects/',
            data: {class_id:class_id},
            dataType: 'json',
            success:function(res){
                if(res.response==1) { 
					$('#tbl_exam_schedule').find('tr').not(':first').hide();
					$('#exam-schedule-div').show();
					$('#subject_count').val(res.data.length);
					for(i=0;i<res.data.length;i++) {						
						$('#'+i).show();
						optionStr = '';
						optionStr+= '<option value="0">Select Subject</option>';
						for(s=0;s<res.data.length;s++) {							
							optionStr+= '<option value="'+res.data[s].id_subject+'">'+res.data[s].subject_name+'</option>';
						}
						$("#course_subject_id"+i).html(optionStr);
						populate('#start_time'+i);
						populate('#end_time'+i);
					}
					$('#buttons-div').show();
					
                    //$('#exam-schedule-div').html(res.data);					
					//$('#buttons-div').css('display','block');
					//t = $('#sss').html();
					////alert(t);
					//$('#ttt').html(t);
					//$('#tbl_exam_schedule').closest("tr").remove();
					//$('#tbl_exam_schedule tr:last').remove();
                }
                				
				/*if(reset_flg == 1) {
					$('#assign_vals_id').val('');
					$('#sel_timetable_err').html('');
				}*/
            }
        });
    }
    else{
        $('#exam-schedule-div').html('');
    }
}

function validateSubjectSelect() {
	valid_flag = 0;	
	subject_count = $('#subject_count').val();
	for(i=0;i<subject_count;i++) {
		if($('#course_subject_id'+i).val() !=0) {
			valid_flag++;
		}
	}
	if(valid_flag == 0){
		$('#sel_exam_schedule_err').html('Please select atleast one subject to create exam schedule.');
		return false;
	}
	else	
		$('#sel_exam_schedule_err').html('');
}

function getStudentMarks(preview=null)
{
    var html = '';	
	class_id = $('#student_course_id').val();
	section_id = 0;
	if($('#course_section_id').val() > 0)
		section_id = $('#course_section_id').val();
	subject_id = $('#course_subject_id').val();	
    if(class_id!='' && class_id!=0)
    {
        $.ajax({
            async: true,
            type: 'POST',
            url: BASE_URL+'index.php/examination/getStudentMarks/',
            data: {class_id:class_id, section_id:section_id, subject_id:subject_id, preview:preview},
            dataType: 'json',
            success:function(res) {
                if(res.response) {					
					$('#exam-marks-div').html(res.data);
					$('#hide_buttons-div').show();					
                }  
				else
					$('#hide_buttons-div').hide();
            }
        });
    }
    else{
        $('#exam-marks-div').html('');
    }
}

function calculateGrades(type, score, point, student_id) 
{	
	if($('#subject_mark'+student_id).val()!='' || $('#subject_point'+student_id).val()!='') 
	{
		if(score!=null || point!=null) {
			$.ajax({
				async: true,
				type: 'POST',
				url: BASE_URL+'index.php/examination/getSubjectPoint/',
				data: {score:score, point:point},
				dataType: 'json',
				success:function(res) {
					if(res.response==1) 
					{
						if(type == 'sc') {
							if(res.data.length==1) {
								$('#subject_point'+student_id).val(res.data[0].grade_value);
								$('#subject_grade'+student_id).val(res.data[0].grade_name);
							}
							else {
								$('#subject_point'+student_id).val('');
								$('#subject_grade'+student_id).val('');
							}
						}
						else {	
							if(res.data.length==1) {								
								$('#subject_grade'+student_id).val(res.data[0].grade_name);
							}
							else {							
								$('#subject_grade'+student_id).val('');
							}										
						}					
					}
				}
			});
		}
		else {
			$('#subject_mark'+student_id).val('');
			$('#subject_point'+student_id).val('');
			$('#subject_grade'+student_id).val('');
		}
	}
}

function validateSubjectMarks() {
	valid_flag = 0;	
	$('#sel_exam_marks_err').html('');
	students = document.getElementsByName('students[]');		
	for(i=0;i<students.length;i++) {
		if($('#subject_grade'+students[i].value).val()!='' || $('#subject_point'+students[i].value).val()!='') {
			valid_flag++;			
		}
	}
	if(valid_flag==0) {
		$('#sel_exam_marks_err').html('Please enter marks for atleast one student.');
		return false;
	}	
}

function getExamMarksForReport(course='') {
	exam_id = $('#exam_id').val();
	board_id = $('#board_id').val();
	class_id = $('#student_course_id').val();
	section_id = $('#course_section_id').val();
	
	if (course>0 || section_id>0) {
		$.ajax({
			async: true,
			type: 'POST',
			url: BASE_URL+'index.php/Examination/getExamMarksForReport/',
			data: {exam_id:exam_id, board_id:board_id, class_id:class_id, section_id:section_id},
			dataType: 'json',
			success:function(res){
				$('#exam-marks-report-div').html(res.data);
				
				if(res.response == 1)
					$('#hide_buttons-div').show();
				else
					$('#hide_buttons-div').hide();
								
			}
		});
	}
}

function getExamGradesDataTable()
{
    $('#table').dataTable({
        "processing": true,
        "bProcessing": true,
        "serverSide": true,
        "bPaginate":true,
        "aaSorting": [],
        "ajax": {
            "url": BASE_URL+'index.php/examination/getExamGradesDataTable',
            "type": "POST",
            "data": function ( d ) {
                d.acolumns="id_exam_grades";
                d.my_order = "id_exam_grades";
                d.sort="desc";
            }
        },
        "aoColumnDefs": [   			
			{
				"aTargets": [4],
				"mData": null,
				"mRender": function (data, type, full) {					
					return '<div class="mod-more tooltipsample actions">'+						
					'<a id="edit" title="Edit" href="'+BASE_URL+'index.php/examination/addExamGrades/'+full[4]+'"><span clas="circle"><i class="glyphicon glyphicon-pencil"></i></span></a>&nbsp;' +
					'<a id="delete" title="Delete" onclick="manageDelOperation(\'exam_grades\', \''+full[4]+'\')" ><span class="circle"><i class="glyphicon glyphicon-trash"></i></span></a>' +
					'</div>';					
				}
			}
        ]
    });
}

function getExamMarksDataTable()
{
    $('#table').dataTable({
        "processing": true,
        "bProcessing": true,
        "serverSide": true,
        "bPaginate":true,
        "aaSorting": [],
        "ajax": {
            "url": BASE_URL+'index.php/examination/getExamMarksDataTable',
            "type": "POST",
            "data": function ( d ) {
                d.acolumns="id_exam_marks";
                d.my_order = "id_exam_marks";
                d.sort="desc";
            }
        },
        "aoColumnDefs": [   			
			{
				"aTargets": [5],
				"mData": null,
				"mRender": function (data, type, full) {					
					return '<div class="mod-more tooltipsample actions">'+	
					'<a id="preview" title="Preview" href="'+BASE_URL+'index.php/examination/addExamMarks/'+full[5]+'/1"><span class="circle"><i class="glyphicon glyphicon-eye-open"></i></span></a>&nbsp' +
					'<a id="edit" title="Edit" href="'+BASE_URL+'index.php/examination/addExamMarks/'+full[5]+'"><span clas="circle"><i class="glyphicon glyphicon-pencil"></i></span></a>&nbsp;' +
					'<a id="delete" title="Delete" onclick="manageDelOperation(\'exam_sub_marks\', \''+full[5]+'\')" ><span class="circle"><i class="glyphicon glyphicon-trash"></i></span></a>' +
					'</div>';					
				}
			}
        ]
    });
}

/****** Examination Module Code Ends Here ******/

function deleteBed(bed_id,e)
{
    if (confirm("Are you sure?")) {
        $.ajax({
            async: true,
            type: 'POST',
            url: BASE_URL + 'index.php/Hostel/checkBed/',
            data: {'bed_id': bed_id},
            dataType: 'json',
            success: function (res) {
                if (res.response == 1) {
                    $(e).parent().parent().remove();
                }
                else {
                    $('#room_div').html('<p id="er-m" class="error" style="font-size: 15px;">' + res.data + '</p>');
                    setTimeout(function () {
                        $('#er-m').remove();
                    }, 3500);
                }
            }
        });
    }
}

function validateRoom()
{
    var room_number = $('#room_number').val();
    var room_id = $('#id_room').val();
    var id_floor = $('#id_floor').val();

    $.ajax({
        async: true,
        type: 'POST',
        url: BASE_URL + 'index.php/Hostel/checkRoomNumber/',
        data: {'room_number': room_number,'room_id_not':room_id,'id_floor':id_floor},
        dataType: 'json',
        success: function (res) {
            if (res.response == 1) {
                $('#fee_form').submit();
            }
            else {
                $('#room_div').html('<p id="er-m" class="error" style="font-size: 15px;">' + res.data + '</p>');
                setTimeout(function () {
                    $('#er-m').remove();
                }, 3500);
            }
        }
    });
}

function validateStudentSearch()
{
    var hostel = $('#hostel_id').val();
    var student_id = $('#student_id').val();
    var flag = 0;
    $('#hostel_name_err').text('');
    $('#student_name_err').text('');

    if(hostel==0){ $('#hostel_name_err').text('select hostel'); flag = 1; }
    if(student_id==0){ $('#student_name_err').text('select student'); flag = 1; }

    if(flag==0){
        $('#fee_form').submit();
    }
}

