<?php

function mainMap()
{
    
    return "jarvis";
    
}

$main_map = mainMap();


function renderTemplate($default)
{
    
    require $_SERVER['DOCUMENT_ROOT'] . '/jarvis/site/views/templates/appTemplates/' . $default . '.php';
    
}


?>


<meta charset="utf-8" />
<meta name="keywords" content="" />
<meta name="description" content="" />
<meta name="author" content="University of Amsterdam" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" type="text/css" href="/<?php echo $main_map; ?>/public/css/templates.css?v=<?=time()?>" />
<link rel="stylesheet" type="text/css" href="/<?php echo $main_map; ?>/public/css/default.css" />
<link rel="stylesheet" type="text/css" href="/<?php echo $main_map; ?>/public/css/default.date.css" />
<link rel="stylesheet" type="text/css" href="/<?php echo $main_map; ?>/public/css/default.time.css" />
<link rel="stylesheet" type="text/css" href="/<?php echo $main_map; ?>/public/js/jquery-ui/jquery-ui.css" />
<script src="/<?php echo $main_map; ?>/public/js/jquery/jquery.min.js"></script>
<script src="/<?php echo $main_map; ?>/public/js/jquery-ui/jquery-ui.min.js"></script>
<script src="/<?php echo $main_map; ?>/public/js/jsLibs/jquery.ui.touch-punch.min.js"></script>
<script src="/<?php echo $main_map; ?>/public/js/jsLibs/dragend.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/1.20.3/TweenMax.min.js"></script>
<script src="/<?php echo $main_map; ?>/public/js/jsLibs/utils.js"></script>
<script src="/<?php echo $main_map; ?>/public/js/jsLibs/templatesLogic.js?v=<?=time()?>"></script>
<script src="/<?php echo $main_map; ?>/public/js/pickadate/picker.js"></script>
<script src="/<?php echo $main_map; ?>/public/js/pickadate/picker.date.js"></script>
<script src="/<?php echo $main_map; ?>/public/js/pickadate/picker.time.js"></script>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB7eMiJ1Bp6J7JJfc_UWZ4XfmLiFhAjtOQ&libraries=places"></script>
