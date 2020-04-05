<section class="col-lg-10 right-section">
    <ul class="breadcrumb border-btm">
        <li>
            <a href="#">Home</a>
        </li>
        <li class="active">
            Vehicle
        </li>
    </ul>
    <div class="float-right" style="margin-bottom: 10px;">
        <a href="<?=BASE_URL?>index.php/vehicle/addVehicle" class="btn btn-primary m8 float-right p6">Add Vehicle</a>
    </div>

    <table id="table" class="table table-bordered table-hover">
        <thead>
        <tr>
            <th>Vehicle Number</th>
            <th>Capacity</th>
            <th>Vehicle Type</th>
            <th style="width:125px;">Action</th>
        </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</section>
<script type="text/javascript">

    
    $(document).ready(function() {

        //datatables
        table = $('#table').DataTable({

            "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            "order": [], //Initial no order.

            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?php echo site_url('vehicle/vehicle_list')?>",
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
	});

  </script>

