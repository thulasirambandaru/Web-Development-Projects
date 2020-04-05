
<section class="col-lg-10 right-section">
    <ul class="breadcrumb border-btm">
        <li>
            <a href="#">Home</a>
        </li>
        <li class="active">
            Room Search
        </li>
    </ul>
    <div>
        <select onchange="getRoomSearch(this.value)">
            <option <?php if(isset($type) && $type=='all'){ echo "selected='selected'"; } ?> value="all">All</option>
            <option <?php if(isset($type) && $type=='occupied'){ echo "selected='selected'"; } ?> value="occupied">Occupied</option>
            <option <?php if(isset($type) && $type=='vacant'){ echo "selected='selected'"; } ?> value="vacant">vacant</option>

        </select>
    </div>
    <div id="grid">


        <table id="table" class="table table-bordered table-hover">
            <thead>
            <tr>
                <th>Hostel</th>
                <th>Floor</th>
                <th>Room No</th>
                <th>Available</th>
                <th>Action</th>
            </tr>
            </thead>
            <?php for($s=0;$s<count($room_list);$s++){ ?>
                <tr>
                    <td><?=$room_list[$s]['hostel_name']?></td>
                    <td><?=$room_list[$s]['floor_number']?></td>
                    <td>
                        Room No: <?=$room_list[$s]['room_number']?><br>
                        Beds : <?=$room_list[$s]['bed']?>
                    </td>
                    <?php
                    $bed_count = $sb_count = 0;
                    if($room_list[$s]['bed']!='')
                        $bed_count = count(explode(',',$room_list[$s]['bed']));
                    if($room_list[$s]['student_bed']!='')
                        $sb_count = count(explode(',',$room_list[$s]['student_bed']));
                    ?>
                    <td><?=$bed_count-$sb_count?></td>
                    <td><a href="<?=BASE_URL?>index.php/Hostel/editRoom/<?=$room_list[$s]['id_room']?>"><i class="fa fa-pencil"></i></a></td>
                </tr>
            <?php } ?>
            <tbody>
            </tbody>
        </table>
    </div>

</section>


<script type="text/javascript">
    $(function () {
        $('#table').dataTable();
    });

    function getRoomSearch($type)
    {
        window.location = BASE_URL+"index.php/Hostel/roomSearch/"+$type;
    }
</script>