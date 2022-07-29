<div class="col-sm-12 text-center"> 
    <h2>Accomodation</h2>
</div>
<div class="col-sm-4 text-right"> 
    <div class="row">
        <div class="col-sm-12">
            <h4>Accomodation</h4>
        </div>
        <div class="col-sm-12">
            <?php
            foreach ($data['items'] as $singleItem) { 
                $selectedAccomodationClass = ($data['selectedAccomodation']->id == $singleItem['id']) ? "font-weight-bold" : ""; ?>
                <div>
                    <span class='<?=$selectedAccomodationClass?>'><?=$singleItem['customer_id']?></span> | 
                    <a href='<?=URL?>accomodation/update/<?=$singleItem['id']?>' title='Edit accomodation'><i class='far fa-edit'></i></a> |
                    <a href='<?=URL?>accomodation/remove/<?=$singleItem['id']?>' title='Delete accomodation' onclick='return confirm("Really want to delete?");'><i class='fas fa-times'></i></a>
                </div>
            <?php }
            ?>
        </div>
    </div>
</div>
<div class="col-sm-8">
    <?php if ($data['selectedAccomodation']->id) { ?>
        <a href="<?= URL ?>accomodation/update">Add accomodation</a>
        <h4>Edit accomodation</h4>
    <?php } else { ?>
        <h4>Add accomodation</h4>
    <?php } ?>
    <div class="accomodation-settings">
        <form action="<?= URL ?>accomodation/update<?php echo ($data['selectedAccomodation']->id) ? "/" . $data['selectedAccomodation']->id : "" ?>" method="post">
            <input type="hidden" name="action" value="handleaccomodation">
		<div class='form-group'>
			<label for='accomodation-customer_id'>customer_id</label>
			<input type='number' class='form-control' name='accomodation-customer_id' id='accomodation-customer_id' value='<?php echo ($data['selectedAccomodation']->customer_id) ? $data['selectedAccomodation']->customer_id : ''; ?>'>
		</div>
		<div class='form-group'>
			<label for='accomodation-room_id'>room_id</label>
			<input type='number' class='form-control' name='accomodation-room_id' id='accomodation-room_id' value='<?php echo ($data['selectedAccomodation']->room_id) ? $data['selectedAccomodation']->room_id : ''; ?>'>
		</div>
		<div class='form-group'>
			<label for='accomodation-bed_id'>bed_id</label>
			<input type='number' class='form-control' name='accomodation-bed_id' id='accomodation-bed_id' value='<?php echo ($data['selectedAccomodation']->bed_id) ? $data['selectedAccomodation']->bed_id : ''; ?>'>
		</div>
		<div class='form-group'>
			<label for='accomodation-date_start'>date_start</label>
			<input type='date' class='form-control' name='accomodation-date_start' id='accomodation-date_start' value='<?php echo ($data['selectedAccomodation']->date_start) ? $data['selectedAccomodation']->date_start : ''; ?>'>
		</div>
		<div class='form-group'>
			<label for='accomodation-date_end'>date_end</label>
			<input type='date' class='form-control' name='accomodation-date_end' id='accomodation-date_end' value='<?php echo ($data['selectedAccomodation']->date_end) ? $data['selectedAccomodation']->date_end : ''; ?>'>
		</div>
		<div class='form-group'>
			<label for='accomodation-price'>price</label>
			<input type='text' class='form-control' name='accomodation-price' id='accomodation-price' placeholder='price' value='<?php echo ($data['selectedAccomodation']->price) ? $data['selectedAccomodation']->price : ''; ?>'>
		</div>
		<div class='form-group'>
			<label for='accomodation-comment'>comment</label>
			<textarea class='form-control' name='accomodation-comment' id='accomodation-comment' placeholder='comment'><?php echo ($data['selectedAccomodation']->comment) ? $data['selectedAccomodation']->comment : ''; ?></textarea>
		</div>
            <button type="submit" class="btn btn-primary">Submit</button>
            <a class='btn btn-danger' href="<?= URL ?>accomodation/update">Cancel</a>
        </form>
    </div>
    
</div>