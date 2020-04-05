
<section class="col-lg-10 right-section">
    <ul class="breadcrumb border-btm">
        <li>
            <a href="#">Home</a>
        </li>
        <li class="active">
            Floor
        </li>
    </ul>
    <div id="grid">
    <a href="<?=BASE_URL?>index.php/Hostel/addFloor/"  class="btn btn-primary m8 float-right p6">Create Floor</a>

        <table id="table" class="table table-bordered table-hover">
            <thead>
            <tr>
                <th>Hostel Name</th>
                <th>Floor No</th>
                <th>No of Rooms</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>

</section>


<script type="text/javascript">
    $(function () {
        getFloorDataTable();
    });
</script>