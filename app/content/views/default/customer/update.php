<div class="col-sm-12 text-center"> 
    <h2>Customer</h2>
</div>
<div class="col-sm-4 text-right"> 
    <div class="row">
        <div class="col-sm-12">
            <h4>Customer</h4>
        </div>
        <div class="col-sm-12">
            <?php
            foreach ($data['items'] as $singleItem) { 
                $selectedCustomerClass = ($data['selectedCustomer']->id == $singleItem['id']) ? "font-weight-bold" : ""; ?>
                <div>
                    <span class='<?=$selectedCustomerClass?>'><?=$singleItem['name'] . " " . $singleItem['surname']?></span> | 
                    <a href='<?=URL?>customer/update/<?=$singleItem['id']?>' title='Edit customer'><i class='far fa-edit'></i></a> |
                    <a href='<?=URL?>customer/remove/<?=$singleItem['id']?>' title='Delete customer' onclick='return confirm("Really want to delete?");'><i class='fas fa-times'></i></a>
                </div>
            <?php }
            ?>
        </div>
    </div>
</div>
<div class="col-sm-8">
    <?php if ($data['selectedCustomer']->id) { ?>
        <a href="<?= URL ?>customer/update">Add customer</a>
        <h4>Edit customer</h4>
        <span class="customer-guest-link">
            <?= URL . "home/guest/" . $data['selectedCustomer']->hash?>
        </span><br><br>
    <?php } else { ?>
        <h4>Add customer</h4>
    <?php } ?>
    <div class="customer-settings">
        <form action="<?= URL ?>customer/update<?php echo ($data['selectedCustomer']->id) ? "/" . $data['selectedCustomer']->id : "" ?>" method="post">
            <input type="hidden" name="action" value="handlecustomer">
		<div class='form-group'>
			<label for='customer-name'>name</label>
			<input type='text' class='form-control' name='customer-name' id='customer-name' placeholder='name' value='<?php echo ($data['selectedCustomer']->name) ? $data['selectedCustomer']->name : ''; ?>' required>
		</div>
		<div class='form-group'>
			<label for='customer-surname'>surname</label>
			<input type='text' class='form-control' name='customer-surname' id='customer-surname' placeholder='surname' value='<?php echo ($data['selectedCustomer']->surname) ? $data['selectedCustomer']->surname : ''; ?>' required>
		</div>
		<div class='form-group'>
			<label for='customer-gender'>gender</label>
			<select class='form-control' name='customer-gender' id='customer-gender'>
				<option value='1' <?php echo ($data['selectedCustomer']->gender == '1') ? 'selected' : '' ?>>Male</option>
				<option value='2' <?php echo ($data['selectedCustomer']->gender == '2') ? 'selected' : '' ?>>Female</option>
			</select>
		</div>
		<div class='form-group'>
			<label for='customer-address'>address</label>
			<input type='text' class='form-control' name='customer-address' id='customer-address' placeholder='address' value='<?php echo ($data['selectedCustomer']->address) ? $data['selectedCustomer']->address : ''; ?>'>
		</div>
		<div class='form-group'>
			<label for='customer-city'>city</label>
			<input type='text' class='form-control' name='customer-city' id='customer-city' placeholder='city' value='<?php echo ($data['selectedCustomer']->city) ? $data['selectedCustomer']->city : ''; ?>'>
		</div>
		<div class='form-group'>
			<label for='customer-country'>country</label>
			<input type='text' class='form-control' name='customer-country' id='customer-country' placeholder='country' value='<?php echo ($data['selectedCustomer']->country) ? $data['selectedCustomer']->country : ''; ?>'>
		</div>
		<div class='form-group'>
			<label for='customer-phone'>phone</label>
			<input type='text' class='form-control' name='customer-phone' id='customer-phone' placeholder='phone' value='<?php echo ($data['selectedCustomer']->phone) ? $data['selectedCustomer']->phone : ''; ?>'>
		</div>
		<div class='form-group'>
			<label for='customer-email'>email</label>
			<input type='email' class='form-control' name='customer-email' id='customer-email' placeholder='email' value='<?php echo ($data['selectedCustomer']->email) ? $data['selectedCustomer']->email : ''; ?>'>
		</div>
		<div class='form-group'>
			<label for='customer-comment'>comment</label>
			<textarea class='form-control' name='customer-comment' id='customer-comment' placeholder='comment'><?php echo ($data['selectedCustomer']->comment) ? $data['selectedCustomer']->comment : ''; ?></textarea>
		</div>
            <button type="submit" class="btn btn-primary">Submit</button>
            <a class='btn btn-danger' href="<?= URL ?>customer/update">Cancel</a>
        </form>
    </div>
    
</div>