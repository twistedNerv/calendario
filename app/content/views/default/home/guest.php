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
    <body>
        <div class="container col-sm-8 text-center">
            <?php 
            foreach ($data['events'] as $singleEvent) { ?>
            <div class="row">
                <div class="col-sm-12">
                    <h4><?=$singleEvent->title?></h4>
                </div>
                <div class="col-sm-12">
                    Description: <?=$singleEvent->description?>
                </div>
                <div class="col-sm-12">
                    Date and time: <?=date_format(date_create($singleEvent->date), "d.m.Y")?> <?=$singleEvent->start?>
                </div>
                <div class="col-sm-12">
                    Section title and color: <?=$data['sections'][$singleEvent->section]['title']?> - <?=$data['sections'][$singleEvent->section]['color']?>
                </div>
                <div class="col-sm-12">
                    Duration: <?=$singleEvent->duration?> hour(s)
                </div>
                <div class="col-sm-12">
                    Event location: <?=$singleEvent->location?>
                </div>
                <div class="col-sm-12">
                    Pickup location: <?=$singleEvent->pickup_location?>
                </div>
            </div>
            <?php
            }
            ?>
        </div>
    </body>
</html>