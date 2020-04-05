
<section class="col-lg-10 right-section">
    <ul class="breadcrumb border-btm">
        <li>
            <a href="#">Home</a>
        </li>
        <li class="active">
            Student Details
        </li>
    </ul>
    <div id="grid">
        <h4>Student Details</h4>
        <table id="table" class="table table-bordered table-hover">
            <thead>
            <tr>
                <th>Hostel</th>
                <th>Floor</th>
                <th>Room Number</th>
                <th>Bed</th>
                <th>Date of joing</th>
                <th>Student name</th>
                <th>Admission Number</th>

            </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>

    <div id="grid">
        <h4>Room mates Details</h4>
        <table id="table1" class="table table-bordered table-hover">
            <thead>
            <tr>
                <th>Hostel</th>
                <th>Floor</th>
                <th>Room Number</th>
                <th>Bed</th>
                <th>Date of joing</th>
                <th>Student name</th>
                <th>Admission Number</th>
            </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>

</section>


<script type="text/javascript">
    $(function () {
        <?php if($this->session->userdata('user_type_id') && $this->session->userdata('user_type_id')==STUDENT){ ?>
        getStudentHostel(<?=$this->session->userdata('user_id')?>);
        getRoommates(<?=$this->session->userdata('user_id')?>);
        <?php } else if($this->session->userdata('user_type_id') && $this->session->userdata('user_type_id')==PARENT){?>
        getStudentHostel(<?=$this->session->userdata('student_id')?>);
        getRoommates(<?=$this->session->userdata('student_id')?>);
        <?php } ?>

    });

</script>