<div class="col-sm-12" style="overflow-y: scroll; height: 100%;"> 
    <div class="row"> 
        <div id="calendar_div" class="board-section text-center">
            <?= $data['calendar'] ?>
        </div>
        <div id="add_event_section" class="none">
            <h2c>Add event</h2c>
            <div class="add-collapser board-section">
                <div class="col-sm-12 text-left">
                    <div class="row">
                        <div class="col-sm-12">
                            <select name="event-section" id="event-section" class="user-picker">
                                <?php foreach ($data['sections'] as $singleSection) { ?>
                                    <option value="<?= $singleSection['id'] ?>" style="background-color:<?= $singleSection['color'] ?>"><?= $singleSection['title'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-sm-12">
                            <label for="event-title">Title</label>
                            <input type='text' class='form-control' name='event-title' id='event-title' placeholder='enter event title...'>
                        </div>
                        <div class="col-sm-12">
                            <label for="event-description">Description</label>
                            <textarea name="event-description" class="notice-textarea" id="event-description" placeholder="enter event description..."></textarea>
                        </div>
                        <div class="col-sm-6">
                            <label for="event-location">Event location</label>
                            <input type='text' class='form-control' name='event-location' id='event-location' placeholder='enter event location...' required>
                        </div>
                        <div class="col-sm-6">
                            <label for="event-pickup_location">Pickup location</label>
                            <input type='text' class='form-control' name='event-pickup_location' id='event-pickup_location' placeholder='enter pickup location...' required>
                        </div>
                        <div class="col-sm-5">
                            <label for="event-date-from">Event date</label>
                            <input type="date" name="event-date-from" class="daate-pickhing-field" id="event-date-from" onfocus="this.showPicker()" required>
                        </div>
                        <div class="col-sm-5">
                            <label for="event-date-to">Repeating events end date</label>
                            <input type="date" name="event-date-to" class="datae-picking-field" id="event-date-to" onfocus="this.showPicker()" required>
                        </div>
                        <div class="col-sm-4">
                            <label for="event-time">Time start of the event</label>
                            <input type='time' class='form-control' name='event-start' id='event-start' min="00:00" max="23:59" required>
                        </div>
                        <div class="col-sm-3">
                            <label for="event-duration">Duration (hours)</label>
                            <input type='number' class='form-control' name='event-duration' id='event-duration' placeholder='duration...' required>
                        </div>
                        <div class="col-sm-5">
                            <label for="event-price">Price (per event per customer)</label>
                            <input type='text' class='form-control' name='event-price' id='event-price' placeholder='enter price...'>
                        </div>
                        <div class="col-sm-12">
                            <hr>
                            <div class="col-sm-12">
                                <div class="row">
                                    <div class="col-sm-5">
                                        <label for="event-customer-search">Attending customers</label>
                                        <input type="text" name="event-customer-search" id="event-customer-search" placeholder="search customer...">
                                        <div class="list-event-customer">
                                            <!-- here be customers dropdown -->
                                        </div>
                                    </div>
                                    <div id="event-customers">
                                        <!-- here be customers -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <hr>
                            Here be instructors
                        </div>
                        <div class="col-sm-12">
                            <hr>
                            <label for="event-comment">Comment (for personal use)</label>
                            <textarea name="event-comment" class="notice-textarea" id="event-comment" placeholder="comment"></textarea>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div id="event-add-notification" class="none"></div>
                    </div>
                    <div class="col-sm-8">
                        <div class="add-event-btn btn btn-primary" onclick="addEvent()">Submit</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
