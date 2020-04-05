

    <section class="col-lg-10 right-section">

        <ul class="breadcrumb border-btm">
            <li class="">
                <a href="<?=BASE_URL?>index.php/admin/index"> Dashboard </a>
            </li>

            <li class="active">
                Time table
            </li>
        </ul>

        <a href="<?=BASE_URL?>index.php/admin/addTimeTable" class="btn btn-primary m8 float-right p6">Add Time Table</a>

        <table id="table" class="table table-bordered table-hover">
            <thead>
            <tr>
                <th>Class Name</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>



            </tbody>

        </table>

    </section>





<script type="text/javascript">
        $(function () {

            getClassTimeTableDataTable();


        });
</script>