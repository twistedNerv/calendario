<div class="col-sm-12" style="overflow-y: scroll; height: 100%;">
    <div class="row"> 
        <div id="accomodation_calendar_div" class="board-section text-center">
            <?= $data['accomodation_calendar'] ?>
        </div>
        <div id="add_accomodation_section" class="none">
            <h2c>Add accomodation</h2c>
            <div class="add-collapser board-section">
                <div class="col-sm-12 text-left" style="margin: 20px 5px;">
                    <div class="row">
                                <div class="col-sm-6">
                                    <label for="accomodation-customer-search">Customer</label>
                                    <input type="text" name="accomodation-customer-search" id="accomodation-customer-search" placeholder="search customer..." />
                                    <input type="hidden" name="selected-customer-id" id="selected-customer-id" />
                                    <div class="list-accomodation-customer">
                                        <!-- here be customers dropdown -->
                                    </div>
                                </div>
                                <div id="accomodation-customers">
                                    <!-- here be customers -->
                                </div>
                        <div class="col-sm-6">
                            <label for="accomodation-room">Room</label><br>
                            <select name="accomodation-room" id="accomodation-room" class="user-picker">
                                <option value="" disabled selected>Select room</option>
                                <?php foreach ($data['rooms'] as $singleRoom) { ?>
                                    <option value="<?= $singleRoom['id'] ?>" style="background-color:<?= $singleRoom['color'] ?>"><?= $singleRoom['title'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-sm-6">
                            <label for="accomodation-price">Price (per vacation)</label>
                            <input type='text' class='form-control' name='accomodation-price' id='accomodation-price' placeholder='enter price...'>
                        </div>
                        <div class="col-sm-6">
                            <label for="accomodation-bed">Bed</label>
                            <select class='form-control' name='accomodation-bed' id='accomodation-bed'>
                                <!-- here be beds -->
                            </select>
                        </div>
                        <div class="col-sm-6">
                            <hr>
                            <label for="accomodation-date-from">Accomodation start</label>
                            <input type="date" name="accomodation-date-from" id="accomodation-date-from" onfocus="this.showPicker()" required>
                        </div>
                        <div class="col-sm-6">
                            <hr>
                            <label for="accomodation-date-to">Accomodation end</label>
                            <input type="date" name="accomodation-date-to" id="accomodation-date-to" onfocus="this.showPicker()" required>
                        </div>
                        <div class="col-sm-12">
                            <hr>
                            <label for="accomodation-comment">Comment (for personal use)</label>
                            <textarea name="accomodation-comment" class="notice-textarea" id="accomodation-comment" placeholder="comment"></textarea>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div id="accomodation-add-notification" class="none"></div>
                    </div>
                    <div class="col-sm-8">
                        <div class="add-accomodation-btn btn btn-primary" onclick="addAccomodation()">Submit</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
