<div class="col-sm-12"> 
    <div class="row"> 
        <div id="calendar_div" class="board-section">
            <?= $data['calendar'] ?>
        </div>
        <div></div>
        <div id="add_event_section">
            <h2 onclick="$('.add-collapser').slideToggle('fast')">Dodaj odsotnost (klik)</h2>
            <div class="add-collapser none">
                <select name="user" id="user-picker" class="user-picker">
                    <option value="33">33</option>
                    <?php// echo getUsers(); ?>
                </select>
                <input type="text" name="event-date" class="date-picking-field" id="event-date-from" placeholder="Datum od" onfocus="(this.type = 'date')">
                <input type="text" name="event-date" class="date-picking-field" id="event-date-to" placeholder="Datum do (večdnevna odsotnost)" onfocus="(this.type = 'date')">
                <textarea name="event-notice" class="notice-textarea" id="event-notice" placeholder="Opomba"></textarea>
                <!--input type="text" name="event-notice" class="notice-field" id="event-notice" placeholder="Opomba" -->
                <div id="event-add-notification" class="none"></div>
                <div class="add-event-btn" onclick="addEvent()">Potrdi</div>
            </div>
        </div>
    </div>
</div>
