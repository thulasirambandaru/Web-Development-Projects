

    <section class="col-lg-10 right-section">

        <ul class="breadcrumb border-btm">
            <li class="">
                <a href="<?=BASE_URL?>index.php/admin/index"> Dashboard </a>
            </li>

            <li class="active">
                Class Timings
            </li>
        </ul>

        <a href="<?=BASE_URL?>index.php/admin/addClassTiming" class="btn btn-primary m8 float-right p6">Add Class Timing</a>

        <table id="table" class="table table-bordered table-hover">
            <thead>
            <tr>
                <th>Class Name</th>
                <th>Name</th>
                <th>Start Time</th>
                <th>End Time</th>
                <th>Is break</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>



            </tbody>

        </table>

    </section>





<script type="text/javascript">
        $(function () {

            getClassTimingDataTable();


        });
</script>