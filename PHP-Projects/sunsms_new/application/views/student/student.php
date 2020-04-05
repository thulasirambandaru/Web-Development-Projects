
<section class="col-lg-10 right-section">
    <ul class="breadcrumb border-btm">
        <li>
            <a href="<?=BASE_URL?>index.php/Student/">Home</a>
        </li>
        <li class="active">
            Student List
        </li>
    </ul>

    <!--<a href="<?=BASE_URL?>index.php/student/addStudent" class="btn btn-primary m8 float-right p6">Create Student</a>-->

    <table id="StudentTable" class="table table-bordered table-hover">
        <thead>
        <tr>
            <th>Student Name</th>
            <th>Admission No</th>
            <th>Board</th>
            <th>Class</th>
            <th>Section</th>
            <th>Gender</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>

        </tbody>

    </table>

</section>


<script type="text/javascript">
    $(function () {
        getStudentDataTable();
    });
</script>