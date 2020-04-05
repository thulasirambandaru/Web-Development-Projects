
<section class="col-lg-10 right-section">
    <ul class="breadcrumb border-btm">
        <li class="">
            <a href="<?=BASE_URL?>index.php/Admin/Board"> Home </a>
        </li>
        <li class="active">
            Add Board
        </li>
    </ul>
    <div class="">
        <div class="tabs-wrapper">
            <ul id="tabs">
                <li><a href="#" name="tab1"><?php if(isset($school)){ ?>Edit Board<?php } else { ?>Add Board<?php } ?></a></li>
            </ul>
            <div id="content">
                <div id="tab1">
                    <form class="form-horizontal" id="board_form" method="post" action="<?=BASE_URL?>index.php/admin/createBoard" enctype="multipart/form-data">
                        <div class="panel-body">
                            <div class="form-group">
                                <label class="col-md-3 col-xs-12 control-label">Name <span class="clr-red">*</span></label>
                                <div class="col-md-6 col-xs-12">
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                        <input type="text" name="name" id="name" value="<?php if(isset($board)){ echo $board[0]['board_name']; } ?>" class="form-control"/>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-6 col-xs-12 control-label">Description <span class="clr-red">*</span></label>
                                <div class="col-md-6 col-xs-12">
                                    <textarea rows="5" class="form-control" name="description" id="description"><?php if(isset($board)){ echo $board[0]['board_description']; } ?></textarea>
                                </div>
                            </div>
                            <div class="form-group" <?php if(!isset($board)){ ?>style="display: none;"<?php } ?>>
                                <label class="col-md-6 col-xs-12 control-label">Status</label>
                                <div class="col-md-6 col-xs-12">
                                    <select class="form-control select" name="status" id="status">
                                        <option <?php if(isset($board)){ if($board[0]['status']==1){ echo "selected='selected'"; } } ?> value="1">Active</option>
                                        <option <?php if(isset($board)){ if($board[0]['status']==0){ echo "selected='selected'"; } } ?> value="0">Inactive</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="text-center">
                            <button class="btn btn-primary">Save</button>
                        </div>
                        <input type="hidden" name="id_board" id="id_board" value="<?php if(isset($board)){ echo encode($board[0]['id_board']); } else { echo 0; } ?>">
                    </form>
                </div>
                				</div>
            </div>
        </div>
    </div>
</section>