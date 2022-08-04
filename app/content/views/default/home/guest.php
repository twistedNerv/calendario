<html>
    <head>
        <title>school3s</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <link rel='stylesheet' href='http://localhost/calendario/public/default/custom/jquery-3.4.1/jquery-ui.css'>
        <script type='text/javascript' src='http://localhost/calendario/public/default/custom/jquery-3.4.1/jquery.js'></script>
        <script type='text/javascript' src='http://localhost/calendario/public/default/custom/jquery-3.4.1/jquery-ui.js'></script>        
        <link rel='stylesheet' href='http://localhost/calendario/public/default/custom/bootstrap-4.3.1/css/bootstrap.min.css'>
        <script type='text/javascript' src='http://localhost/calendario/public/default/custom/bootstrap-4.3.1/js/bootstrap.min.js'></script>        
        <link rel='stylesheet' href='http://localhost/calendario/public/default/custom/fontawesome-free-5.12.0-web/css/all.css'>        
        <link rel='stylesheet' href='http://localhost/calendario/public/default/css/fonts/fonts.css'>        
        <link rel='stylesheet' href='http://localhost/calendario/public/default/css/default.css'>        
        <script type='text/javascript' src='http://localhost/calendario/public/default/js/default.js'></script>        
    </head>
    <body style="box-shadow: 0 0 70px rgba(0, 0, 0, 0.5) inset;">
        <div class="container col-sm-12 text-center">
            <div class="col-sm-12 guest-header">
                <img src="<?= URL ?>public/default/images/logo_color.png">
                <div class="col-sm-12 guest-header-title">
                    <?=$data['customer']->name?> <?=$data['customer']->surname?><br>
                    <?php if (isset($data['accomodations']->date_start)) { ?>
                            Accomodation:<br> 
                            <?=date_format(date_create($data['accomodations']->date_start), "d.m.Y")?> - <?=date_format(date_create($data['accomodations']->date_end), "d.m.Y")?>
                    <?php } ?>
                </div>
            </div>
            <?php 
            foreach ($data['events'] as $singleEvent) { 
                if (date("Y-m-d") < $singleEvent->date) {
                    $bgcolor = (date("Y-m-d") > $singleEvent->date) ? "#999" : $data['sections'][$singleEvent->section]['color'];?>
                    <div class="col-sm-12 guest-event-title" 
                         style="background-color: <?=$bgcolor?>"
                         onclick="$('#single-event-<?=$singleEvent->id?>').slideToggle()">
                        <h5c style="color: #<?=readableColour($bgcolor); ?>"><?=$singleEvent->title?></h5c><br>
                        <span style="color: #<?=readableColour($bgcolor); ?>">
                            <?= date_format(date_create($singleEvent->date), "d.m.Y")?> <?=$singleEvent->start?> (<?=$data['sections'][$singleEvent->section]['title']?>)
                        </span>
                    <div class="row guest-event-details board-section" id="single-event-<?=$singleEvent->id?>">
                        <div class="col-sm-12">
                            Location: <strong><?=$singleEvent->location?></strong>
                        </div>
                        <div class="col-sm-12">
                            Gathering spot: <strong><?=$singleEvent->pickup_location?></strong>
                        </div>
                        <div class="col-sm-12">
                            Duration: <strong><?=$singleEvent->duration?> hour(s)</strong>
                        </div>
                        <div class="col-sm-12">
                            <hr>
                            <strong><?=$singleEvent->description?></strong>
                        </div>
                    </div>
                    </div>
            <?php
                }
            }
            ?>
        </div>
        <div class="col-sm-12 guest-signature">
            © 2022 School3s Lanzarote
        </div>
    </body>
</html>
<?php 
function readableColour($bg) {
    $bg = str_replace("#", "", $bg);
    list($r, $g, $b) = sscanf($bg, "%02x%02x%02x");
    $squared_contrast = (
            $r * $r * .299 +
            $g * $g * .587 +
            $b * $b * .114 );
    return ($squared_contrast > pow(130, 2)) ? '444' : 'dedede';
}
?>