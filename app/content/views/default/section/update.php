<div class="col-sm-12 text-center"> 
    <h2>Section</h2>
</div>
<div class="col-sm-3 text-right"> 
    <div class="row">
        <div class="col-sm-12">
            <h4>Section</h4>
        </div>
        <div class="col-sm-12">
            <?php
            foreach ($data['items'] as $singleItem) {
                $selectedSectionClass = ($data['selectedSection']->id == $singleItem['id']) ? "font-weight-bold" : "";
                ?>
                <div style="background-color: <?= $singleItem['color'] ?>">
                    <span class='<?= $selectedSectionClass ?>'><?= $singleItem['title'] ?></span> | 
                    <a href='<?= URL ?>section/update/<?= $singleItem['id'] ?>' title='Edit section'><i class='far fa-edit'></i></a> |
                    <a href='<?= URL ?>section/remove/<?= $singleItem['id'] ?>' title='Delete section' onclick='return confirm("Really want to delete?");'><i class='fas fa-times'></i></a>
                </div>
            <?php }
            ?>
        </div>
    </div>
</div>
<div class="col-sm-9" style="max-width:500px">
<?php if ($data['selectedSection']->id) { ?>
        <a href="<?= URL ?>section/update">Add section</a>
        <h4>Edit section</h4>
    <?php } else { ?>
        <h4>Add section</h4>
<?php } ?>
    <div class="section-settings">
        <form action="<?= URL ?>section/update<?php echo ($data['selectedSection']->id) ? "/" . $data['selectedSection']->id : "" ?>" method="post">
            <input type="hidden" name="action" value="handlesection">
            <div class='form-group'>
                <label for='section-title'>title</label>
                <input type='text' class='form-control' name='section-title' id='section-title' placeholder='title' value='<?php echo ($data['selectedSection']->title) ? $data['selectedSection']->title : ''; ?>' required>
            </div>
            <div class='form-group'>
                <label for='section-color'>color</label>
                <input type='color' class='form-control' style="height:30px;" name='section-color' id='section-color' placeholder='color' value='<?php echo ($data['selectedSection']->color) ? $data['selectedSection']->color : ''; ?>' required>
            </div>
            <div class='form-group'>
                <label for='section-description'>description</label>
                <textarea class='form-control' name='section-description' id='section-description' placeholder='description'><?php echo ($data['selectedSection']->description) ? $data['selectedSection']->description : ''; ?></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
            <a class='btn btn-danger' href="<?= URL ?>section/update">Cancel</a>
        </form>
    </div>

</div>