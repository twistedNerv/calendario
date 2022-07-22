<div class="col-sm-12"> 
    <div class="row"> 
        <div id="calendar_div" class="board-section text-center">
            <?= $data['calendar'] ?>
        </div>
        <div id="add_event_section" class="nonae">
            <h2>Add event</h2>
            <div class="add-collapser board-section">
                <div class="col-sm-12">
                    <div class="row">
                        <div class="col-sm-12 text-center">
                            <select name="event-section" id="event-section" class="user-picker">
                                <?php foreach ($data['sections'] as $singleSection) { ?>
                                    <option value="<?= $singleSection['title'] ?>" style="background-color:<?= $singleSection['color'] ?>"><?= $singleSection['title'] ?></option>
                                <?php }// echo getUsers(); ?>
                            </select>
                        </div>
                        <div class="col-sm-12">
                            <input type='text' class='form-control' name='event-title' id='event-title' placeholder='enter title...'>
                        </div>
                        <div class="col-sm-12">
                            <textarea name="event-description" class="notice-textarea" id="event-description" placeholder="description"></textarea>
                        </div>
                        <div class="col-sm-6">
                            <input type='text' class='form-control' name='event-location' id='event-location' placeholder='gathering location...' required>
                        </div>
                        <div class="col-sm-3">
                            <input type="date" name="event-date-from" class="daate-pickhing-field" id="event-date-from" placeholder="date from" onfocus="this.showPicker()" required>
                        </div>
                        <div class="col-sm-3">
                            <input type="date" name="event-date-to" class="datae-picking-field" id="event-date-to" placeholder="date to (repeating events)" onfocus="this.showPicker()" required>
                        </div>
                        <div class="col-sm-3">
                            <input type='time' class='form-control' name='event-start' id='event-start' placeholder='' required>
                        </div>
                        <div class="col-sm-2">
                            <input type='number' class='form-control' name='event-duration' id='event-duration' placeholder='enter duration...' required>
                        </div>
                        <div class="col-sm-2">
                            <input type='number' class='form-control' name='event-discount' id='event-discount' placeholder='enter discount...'>
                        </div>
                        <div class="col-sm-2">
                            <input type='text' class='form-control' name='event-price' id='event-price' placeholder='enter price...'>
                        </div>
                        <div class="col-sm-8">
                        </div>
                        <div class="col-sm-8">
                            <textarea name="event-comment" class="notice-textarea" id="event-comment" placeholder="comment"></textarea>
                        </div>
                        <!--input type="text" name="event-notice" class="notice-field" id="event-notice" placeholder="Opomba" -->
                    </div>
                    <div class="col-sm-8">
                        <div id="event-add-notification" class="none"></div>
                    </div>
                    <div class="col-sm-8">
                        <div class="add-event-btn" onclick="addEvent()">Potrdi</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
