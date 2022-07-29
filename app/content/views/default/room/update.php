<div class="col-sm-12 text-center"> 
    <h2>Room</h2>
</div>
<div class="col-sm-4 text-right"> 
    <div class="row">
        <div class="col-sm-12">
            <h4>Room</h4>
        </div>
        <div class="col-sm-12">
            <?php
            foreach ($data['items'] as $singleItem) { 
                $selectedRoomClass = ($data['selectedRoom']->id == $singleItem['id']) ? "font-weight-bold" : ""; ?>
                <div>
                    <span class='<?=$selectedRoomClass?>' style="background-color:<?=$singleItem['color']?>"><?=$singleItem['title']?></span> | 
                    <a href='<?=URL?>room/update/<?=$singleItem['id']?>' title='Edit room'><i class='far fa-edit'></i></a> |
                    <a href='<?=URL?>room/remove/<?=$singleItem['id']?>' title='Delete room' onclick='return confirm("Really want to delete?");'><i class='fas fa-times'></i></a>
                </div>
            <?php }
            ?>
        </div>
    </div>
</div>
<div class="col-sm-8">
    <?php if ($data['selectedRoom']->id) { ?>
        <a href="<?= URL ?>room/update">Add room</a>
        <h4>Edit room</h4>
    <?php } else { ?>
        <h4>Add room</h4>
    <?php } ?>
    <div class="room-settings">
        <form action="<?= URL ?>room/update<?php echo ($data['selectedRoom']->id) ? "/" . $data['selectedRoom']->id : "" ?>" method="post">
            <input type="hidden" name="action" value="handleroom">
		<div class='form-group'>
			<label for='room-title'>Title</label>
			<input type='text' class='form-control' name='room-title' id='room-title' placeholder='enter title...' value='<?php echo ($data['selectedRoom']->title) ? $data['selectedRoom']->title : ''; ?>'>
		</div>
		<div class='form-group'>
			<label for='room-description'>Description</label>
			<textarea class='form-control' name='room-description' id='room-description' placeholder='enter description...'><?php echo ($data['selectedRoom']->description) ? $data['selectedRoom']->description : ''; ?></textarea>
		</div>
		<div class='form-group'>
			<label for='room-total_beds'>Total beds</label>
			<input type='number' class='form-control' name='room-total_beds' id='room-total_beds' placeholder='Eneter beds number' value='<?php echo ($data['selectedRoom']->total_beds) ? $data['selectedRoom']->total_beds : ''; ?>'>
		</div>
		<div class='form-group'>
			<label for='room-color'>Color</label>
			<input type='color' class='form-control' name='room-color' id='room-color' placeholder='' value='<?php echo ($data['selectedRoom']->color) ? $data['selectedRoom']->color : ''; ?>'>
		</div>
            <button type="submit" class="btn btn-primary">Submit</button>
            <a class='btn btn-danger' href="<?= URL ?>room/update">Cancel</a>
        </form>
    </div>
    
</div>