<div class="col-sm-12"> 
    <div class="row"> 
        <div id="calendar_div" class="board-section text-center">
            <?= $data['calendar'] ?>
        </div>
        <div id="add_event_section" class="nonae">
            <h2>Add event</h2>
            <div class="add-collapser board-section">
                <div class="col-sm-12 text-left">
                    <div class="row">
                        <div class="col-sm-12">
                            <select name="event-section" id="event-section" class="user-picker">
                                <?php foreach ($data['sections'] as $singleSection) { ?>
                                    <option value="<?= $singleSection['title'] ?>" style="background-color:<?= $singleSection['color'] ?>"><?= $singleSection['title'] ?></option>
                                <?php }// echo getUsers(); ?>
                            </select>
                        </div>
                        <div class="col-sm-12">
                            <lable for="event-title">Title</lable>
                            <input type='text' class='form-control' name='event-title' id='event-title' placeholder='enter event title...'>
                        </div>
                        <div class="col-sm-12">
                            <lable for="event-description">Description</lable>
                            <textarea name="event-description" class="notice-textarea" id="event-description" placeholder="enter event description..."></textarea>
                        </div>
                        <div class="col-sm-6">
                            <lable for="event-location">Event location</lable>
                            <input type='text' class='form-control' name='event-location' id='event-location' placeholder='enter event location...' required>
                        </div>
                        <div class="col-sm-6">
                            <lable for="event-pickup_location">Pickup location</lable>
                            <input type='text' class='form-control' name='event-pickup_location' id='event-pickup_location' placeholder='enter pickup location...' required>
                        </div>
                        <div class="col-sm-4">
                            <lable for="event-date-from">Event date</lable>
                            <input type="date" name="event-date-from" class="daate-pickhing-field" id="event-date-from" onfocus="this.showPicker()" required>
                        </div>
                        <div class="col-sm-5">
                            <lable for="event-date-to">Repeating events end date</lable>
                            <input type="date" name="event-date-to" class="datae-picking-field" id="event-date-to" onfocus="this.showPicker()" required>
                        </div>
                        <div class="col-sm-4">
                            <lable for="event-time">Time start of the event</lable>
                            <input type='time' class='form-control' name='event-start' id='event-start' min="00:00" max="23:59" required>
                        </div>
                        <div class="col-sm-3">
                            <lable for="event-duration">Duration</lable>
                            <input type='number' class='form-control' name='event-duration' id='event-duration' placeholder='enter duration...' required>
                        </div>
                        <div class="col-sm-5">
                            <lable for="event-price">Price (per event per customer)</lable>
                            <input type='text' class='form-control' name='event-price' id='event-price' placeholder='enter price...'>
                        </div>
                        <div class="col-sm-8">
                        </div>
                        <div class="col-sm-12">
                            <lable for="event-comment">Comment (for personal use)</lable>
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
