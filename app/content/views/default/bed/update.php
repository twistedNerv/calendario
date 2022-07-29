<div class="col-sm-12 text-center"> 
    <h2>Bed</h2>
</div>
<div class="col-sm-4 text-right"> 
    <div class="row">
        <div class="col-sm-12">
            <h4>Bed</h4>
        </div>
        <div class="col-sm-12">
            <?php
            foreach ($data['items'] as $singleItem) { 
                $selectedBedClass = ($data['selectedBed']->id == $singleItem['id']) ? "font-weight-bold" : ""; ?>
                <div>
                    <span class='<?=$selectedBedClass?>' style='background-color: <?=$singleItem['color']?>'><?=$singleItem['title']?> </span> | 
                    <a href='<?=URL?>bed/update/<?=$singleItem['id']?>' title='Edit bed'><i class='far fa-edit'></i></a> |
                    <a href='<?=URL?>bed/remove/<?=$singleItem['id']?>' title='Delete bed' onclick='return confirm("Really want to delete?");'><i class='fas fa-times'></i></a>
                </div>
            <?php }
            ?>
        </div>
    </div>
</div>
<div class="col-sm-8">
    <?php if ($data['selectedBed']->id) { ?>
        <a href="<?= URL ?>bed/update">Add bed</a>
        <h4>Edit bed</h4>
    <?php } else { ?>
        <h4>Add bed</h4>
    <?php } ?>
    <div class="bed-settings">
        <form action="<?= URL ?>bed/update<?php echo ($data['selectedBed']->id) ? "/" . $data['selectedBed']->id : "" ?>" method="post">
            <input type="hidden" name="action" value="handlebed">
		<div class='form-group'>
			<label for='bed-room_id'>Room</label>
			<select class='form-control' name='bed-room_id' id='bed-room_id'>
                            <?php
                            foreach ($data['rooms'] as $singleRoom) { ?>
                                <option value='<?=$singleRoom['id']?>' <?php echo ($data['selectedBed']->room_id == $singleRoom['id']) ? 'selected' : '' ?>><?=$singleRoom['title']?></option>";
                             <?php } ?>
			</select>
		</div>
		<div class='form-group'>
			<label for='bed-title'>Title</label>
			<input type='text' class='form-control' name='bed-title' id='bed-title' placeholder='enter title...' value='<?php echo ($data['selectedBed']->title) ? $data['selectedBed']->title : ''; ?>'>
		</div>
		<div class='form-group'>
			<label for='bed-description'>Description</label>
			<textarea class='form-control' name='bed-description' id='bed-description' placeholder='enter description...'><?php echo ($data['selectedBed']->description) ? $data['selectedBed']->description : ''; ?></textarea>
		</div>
		<div class='form-group'>
			<label for='bed-bed_type'>Bed type</label>
			<input type='text' class='form-control' name='bed-bed_type' id='bed-bed_type' placeholder='enter bed type' value='<?php echo ($data['selectedBed']->bed_type) ? $data['selectedBed']->bed_type : ''; ?>'>
		</div>
            <button type="submit" class="btn btn-primary">Submit</button>
            <a class='btn btn-danger' href="<?= URL ?>bed/update">Cancel</a>
        </form>
    </div>
    
</div>