<div class="col-sm-12 text-center"> 
    <h2>Event</h2>
</div>
<div class="col-sm-4 text-right"> 
    <div class="row">
        <div class="col-sm-12">
            <h4>Event</h4>
        </div>
        <div class="col-sm-12">
            <?php
            foreach ($data['items'] as $singleItem) {
                $selectedEventClass = ($data['selectedEvent']->id == $singleItem['id']) ? "font-weight-bold" : "";
                ?>
                <div>
                    <span class='<?= $selectedEventClass ?>'><?= $singleItem['title'] ?> (<?=date("d.m.Y", strtotime($singleItem['date'])) ?>)</span> | 
                    <a href='<?= URL ?>event/update/<?= $singleItem['id'] ?>' title='Edit event'><i class='far fa-edit'></i></a> |
                    <a href='<?= URL ?>event/remove/<?= $singleItem['id'] ?>' title='Delete event' onclick='return confirm("Really want to delete?");'><i class='fas fa-times'></i></a>
                </div>
            <?php }
            ?>
        </div>
    </div>
</div>
<div class="col-sm-8">
<?php if ($data['selectedEvent']->id) { ?>
        <a href="<?= URL ?>event/update">Add event</a>
        <h4>Edit event</h4>
    <?php } else { ?>
        <h4>Add event</h4>
<?php } ?>
    <div class="event-settings">
        <form action="<?= URL ?>event/update<?php echo ($data['selectedEvent']->id) ? "/" . $data['selectedEvent']->id : "" ?>" method="post">
            <input type="hidden" name="action" value="handleevent">
            <div class='form-group'>
                <label for='event-section'>section</label>
                <select class='form-control' name='event-section' id='event-section' required>
                    <?php foreach($this->config->section as $sectionKey => $singleSection) { ?>
                        <option value='<?=$sectionKey ?>' <?php echo ($data['selectedEvent']->section == $sectionKey) ? 'selected' : '' ?> style="background-color: #<?=$singleSection?>"><?=ucfirst($sectionKey) ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class='form-group'>
                <label for='event-date'>event date</label>
                <input type='date' class='form-control' name='event-date' id='event-date' placeholder='' value='<?php echo ($data['selectedEvent']->date) ? $data['selectedEvent']->date : ''; ?>' required>
            </div>
            <div class='form-group'>
                <label for='event-start'>event start time</label>
                <input type='time' class='form-control' name='event-start' id='event-start' placeholder='' value='<?php echo ($data['selectedEvent']->start) ? $data['selectedEvent']->start : ''; ?>' required>
            </div>
            <div class='form-group'>
                <label for='event-duration'>duration in hours</label>
                <input type='number' class='form-control' name='event-duration' id='event-duration' placeholder='enter duration...' value='<?php echo ($data['selectedEvent']->duration) ? $data['selectedEvent']->duration : ''; ?>' required>
            </div>
            <div class='form-group'>
                <label for='event-location'>location of event</label>
                <input type='text' class='form-control' name='event-location' id='event-location' placeholder='enter location...' value='<?php echo ($data['selectedEvent']->location) ? $data['selectedEvent']->location : ''; ?>'>
            </div>
            <div class='form-group'>
                <label for='event-title'>title</label>
                <input type='text' class='form-control' name='event-title' id='event-title' placeholder='enter title...' value='<?php echo ($data['selectedEvent']->title) ? $data['selectedEvent']->title : ''; ?>'>
            </div>
            <div class='form-group'>
                <label for='event-description'>description</label>
                <textarea class='form-control' name='event-description' id='event-description' placeholder='enter description...'><?php echo ($data['selectedEvent']->description) ? $data['selectedEvent']->description : ''; ?></textarea>
            </div>
            <div class='form-group'>
                <label for='event-price'>price per on event per one person</label>
                <input type='text' class='form-control' name='event-price' id='event-price' placeholder='enter price...' value='<?php echo ($data['selectedEvent']->price) ? $data['selectedEvent']->price : ''; ?>'>
            </div>
            <div class='form-group'>
                <label for='event-comment'>comment</label>
                <textarea class='form-control' name='event-comment' id='event-comment' placeholder='enter comment...'><?php echo ($data['selectedEvent']->comment) ? $data['selectedEvent']->comment : ''; ?></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
            <a class='btn btn-danger' href="<?= URL ?>event/update">Cancel</a>
        </form>
    </div>

</div>