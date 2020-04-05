
<section class="col-lg-10 right-section">
    <ul class="breadcrumb border-btm">
        <li>
            <a href="#">Home</a>
        </li>
        <li class="active">
            Fee Type
        </li>
    </ul>
    <a href="<?=BASE_URL?>index.php/fee/addFeeType/"  class="btn btn-primary m8 float-right p6">Create Fee Type</a>

        <table id="table" class="table table-bordered table-hover">
            <thead>
            <tr>
                <th>Fee Type</th>
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
        getFeeTypeDataTable();
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