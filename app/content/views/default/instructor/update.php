<div class="col-sm-12 text-center"> 
    <h2>Instructor</h2>
</div>
<div class="col-sm-4 text-right"> 
    <div class="row">
        <div class="col-sm-12">
            <h4>Instructor</h4>
        </div>
        <div class="col-sm-12">
            <?php
            foreach ($data['items'] as $singleItem) { 
                $selectedInstructorClass = ($data['selectedInstructor']->id == $singleItem['id']) ? "font-weight-bold" : ""; ?>
                <div>
                    <span class='<?=$selectedInstructorClass?>'><?=$singleItem['name']?> <?=$singleItem['surname']?></span> | 
                    <a href='<?=URL?>instructor/update/<?=$singleItem['id']?>' title='Edit instructor'><i class='far fa-edit'></i></a> |
                    <a href='<?=URL?>instructor/remove/<?=$singleItem['id']?>' title='Delete instructor' onclick='return confirm("Really want to delete?");'><i class='fas fa-times'></i></a>
                </div>
            <?php }
            ?>
        </div>
    </div>
</div>
<div class="col-sm-8">
    <?php if ($data['selectedInstructor']->id) { ?>
        <a href="<?= URL ?>instructor/update">Add instructor</a>
        <h4>Edit instructor</h4>
    <?php } else { ?>
        <h4>Add instructor</h4>
    <?php } ?>
    <div class="instructor-settings">
        <form action="<?= URL ?>instructor/update<?php echo ($data['selectedInstructor']->id) ? "/" . $data['selectedInstructor']->id : "" ?>" method="post">
            <input type="hidden" name="action" value="handleinstructor">
		<div class='form-group'>
			<label for='instructor-name'>name</label>
			<input type='text' class='form-control' name='instructor-name' id='instructor-name' placeholder='name' value='<?php echo ($data['selectedInstructor']->name) ? $data['selectedInstructor']->name : ''; ?>' required>
		</div>
		<div class='form-group'>
			<label for='instructor-surname'>surname</label>
			<input type='text' class='form-control' name='instructor-surname' id='instructor-surname' placeholder='surname' value='<?php echo ($data['selectedInstructor']->surname) ? $data['selectedInstructor']->surname : ''; ?>' required>
		</div>
		<div class='form-group'>
			<label for='instructor-gender'>gender</label>
			<select class='form-control' name='instructor-gender' id='instructor-gender'>
				<option value='1' <?php echo ($data['selectedInstructor']->gender == '1') ? 'selected' : '' ?>>Male</option>
				<option value='2' <?php echo ($data['selectedInstructor']->gender == '2') ? 'selected' : '' ?>>Female</option>
			</select>
		</div>
		<div class='form-group'>
			<label for='instructor-address'>address</label>
			<input type='text' class='form-control' name='instructor-address' id='instructor-address' placeholder='address' value='<?php echo ($data['selectedInstructor']->address) ? $data['selectedInstructor']->address : ''; ?>'>
		</div>
		<div class='form-group'>
			<label for='instructor-city'>city</label>
			<input type='text' class='form-control' name='instructor-city' id='instructor-city' placeholder='city' value='<?php echo ($data['selectedInstructor']->city) ? $data['selectedInstructor']->city : ''; ?>'>
		</div>
		<div class='form-group'>
			<label for='instructor-country'>country</label>
			<input type='text' class='form-control' name='instructor-country' id='instructor-country' placeholder='country' value='<?php echo ($data['selectedInstructor']->country) ? $data['selectedInstructor']->country : ''; ?>'>
		</div>
		<div class='form-group'>
			<label for='instructor-phone'>phone</label>
			<input type='text' class='form-control' name='instructor-phone' id='instructor-phone' placeholder='phone' value='<?php echo ($data['selectedInstructor']->phone) ? $data['selectedInstructor']->phone : ''; ?>'>
		</div>
		<div class='form-group'>
			<label for='instructor-email'>email</label>
			<input type='email' class='form-control' name='instructor-email' id='instructor-email' placeholder='email' value='<?php echo ($data['selectedInstructor']->email) ? $data['selectedInstructor']->email : ''; ?>'>
		</div>
		<div class='form-group'>
			<label for='instructor-comment'>comment</label>
			<textarea class='form-control' name='instructor-comment' id='instructor-comment' placeholder='comment'><?php echo ($data['selectedInstructor']->comment) ? $data['selectedInstructor']->comment : ''; ?></textarea>
		</div>
            <button type="submit" class="btn btn-primary">Submit</button>
            <a class='btn btn-danger' href="<?= URL ?>instructor/update">Cancel</a>
        </form>
    </div>
    
</div>