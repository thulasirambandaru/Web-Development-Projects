
<section class="col-lg-10 right-section">
    <ul class="breadcrumb border-btm">
        <li>
            <a href="#">Home</a>
        </li>
        <li class="active">
            hostel
        </li>
    </ul>
    <?php
    $dashboard = $this->Mhostel->getDashboard();
    //echo "<pre>";print_r($dashboard); exit;
    ?>
    <div class="row">
        <div class="col-md-4">
            <div onclick="#" class="widget widget-default widget-item-icon">
                <div class="widget-item-left">
                    <i aria-hidden="true" class="fa fa-graduation-cap icon-blue"></i>
                </div>
                <div class="widget-data">
                    <div class="widget-int num-count"><?=$dashboard[0]['total_student']?></div>
                    <div class="widget-title">Total Students</div>
                    <div class="widget-subtitle"></div>
                </div>
                <div class="widget-controls"></div>
            </div>
        </div>
        <div class="col-md-4">
            <div onclick="#" class="widget widget-default widget-item-icon">
                <div class="widget-item-left"><i class="fa fa-graduation-cap icon-blue"></i></div>
                <div class="widget-data">
                    <div class="widget-int num-count"><?=($dashboard[0]['total_beds']-$dashboard[0]['total_student'])?></div>
                    <div class="widget-title">Vacant Beds</div>
                    <div class="widget-subtitle"></div>
                </div>
                <div class="widget-controls"></div>
            </div>
        </div>

    </div>
    <div id="grid">
    <a href="<?=BASE_URL?>index.php/Hostel/addHostel/"  class="btn btn-primary m8 float-right p6">Create Hostel</a>

        <table id="table" class="table table-bordered table-hover">
            <thead>
            <tr>
                <th>Hostel Type</th>
                <th>Name</th>
                <th>Phone Number</th>
                <th>Warden</th>
                <th>Warden number</th>
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
        getHostelDataTable();
    });

    function showGrid(type)
    {
        if(type==1){
            $('#grid').css('display','none');
            $('#form').css('display','block');
        }
        else{
            $('#form').css('display','none');
            $('#grid').css('display','block');
        }
        $('#status_div').css('display','none');
    }
</script>