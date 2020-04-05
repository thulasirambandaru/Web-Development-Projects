<section class="col-lg-10 right-section">
        <ul class="breadcrumb border-btm">
             <li>
				<a href="#">Home</a>
			 </li>
			<li class="active">
				Fee
			</li>
        </ul>
        <a href="<?=BASE_URL?>index.php/fee/createClassFee" class="btn btn-primary m8 float-right p6">Add New Field</a> 
         <table id="table" class="table table-bordered table-hover">
        <thead>
			<tr>
				<th>Board</th>
				<th>Class</th>
				<?php for($s=0;$s<count($fee_type);$s++){ ?>
					<th><?=$fee_type[$s]['fee_type']?></th>
				<?php } ?>
				<th>Total</th>
				<th>Action</th>
			</tr>
        </thead>
        <tbody>
        </tbody>
		</table>		
</section>
<script type="text/javascript">
$(function () {
    getFeeStructureDataTable();
	});
</script>