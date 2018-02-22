<?php
/*###############################################################
#  ZM : Web System												#
#  ===========================									#
#  Design & Code by : Zulkifli Mohamed (putera)					#
###############################################################*/

require_once("../../global.php");
$m = $_REQUEST['m'];
header("Content-Type: text/javascript");
?>
/* Copyright <?php echo date('Y'); ?> <?php echo $config->WebSystem;?>. All Rights Reserved. */
@font-face {
	font-family:'Myriad Set Pro';
	font-style:normal;
	font-weight:100;
	src:url("/media/fonts/myriad-set-pro_ultralight.woff") format("woff"), url("/media/fonts/myriad-set-pro_ultralight.ttf") format("truetype");
}

@font-face {
	font-family:'Myriad Set Pro';
	font-style:italic;
	font-weight:100;
	src:url("/media/fonts/myriad-set-pro_ultralight-italic.woff") format("woff"), url("/media/fonts/myriad-set-pro_ultralight-italic.ttf") format("truetype");
}

@font-face {
	font-family:'Myriad Set Pro 100';
	src:url("/media/fonts/myriad-set-pro_ultralight.eot");
}

@font-face {
	font-family:'Myriad Set Pro';
	font-style:normal;
	font-weight:200;
	src:url("/media/fonts/myriad-set-pro_thin.woff") format("woff"), url("/media/fonts/myriad-set-pro_thin.ttf") format("truetype");
}

@font-face {
	font-family:'Myriad Set Pro';
	font-style:italic;
	font-weight:200;
	src:url("/media/fonts/myriad-set-pro_thin-italic.woff") format("woff"), url("/media/fonts/myriad-set-pro_thin-italic.ttf") format("truetype");
}

@font-face {
	font-family:'Myriad Set Pro 200';
	src:url("/media/fonts/myriad-set-pro_thin.eot");
}

@font-face {
	font-family:'Myriad Set Pro';
	font-style:italic;
	font-weight:400;
	src:url("/media/fonts/myriad-set-pro_text-italic.woff") format("woff"), url("/media/fonts/myriad-set-pro_text-italic.ttf") format("truetype");
}

@font-face {
	font-family:'Myriad Set Pro';
	font-style:normal;
	font-weight:500;
	src:url("/media/fonts/myriad-set-pro_medium.woff") format("woff"), url("/media/fonts/myriad-set-pro_medium.ttf") format("truetype");
}

@font-face {
	font-family:'Myriad Set Pro';
	font-style:italic;
	font-weight:500;
	src:url("/media/fonts/myriad-set-pro_medium-italic.woff") format("woff"), url("/media/fonts/myriad-set-pro_medium-italic.ttf") format("truetype");
}

@font-face {
	font-family:'Myriad Set Pro 500';
	src:url("/media/fonts/myriad-set-pro_medium.eot");
}

@font-face {
	font-family:'Myriad Set Pro';
	font-style:normal;
	font-weight:600;
	src:url("/media/fonts/myriad-set-pro_semibold.woff") format("woff"), url("/media/fonts/myriad-set-pro_semibold.ttf") format("truetype");
}

@font-face {
	font-family:'Myriad Set Pro';
	font-style:italic;
	font-weight:600;
	src:url("/media/fonts/myriad-set-pro_semibold-italic.woff") format("woff"), url("/media/fonts/myriad-set-pro_semibold-italic.ttf") format("truetype");
}

@font-face {
	font-family:'Myriad Set Pro 600';
	src:url("/media/fonts/myriad-set-pro_semibold.eot");
}

@font-face {
	font-family:'Myriad Set Pro';
	font-style:normal;
	font-weight:700;
	src:url("/media/fonts/myriad-set-pro_bold.woff") format("woff"), url("/media/fonts/myriad-set-pro_bold.ttf") format("truetype");
}

@font-face {
	font-family:'Myriad Set Pro';
	font-style:italic;
	font-weight:700;
	src:url("/media/fonts/myriad-set-pro_bold-italic.woff") format("woff"), url("/media/fonts/myriad-set-pro_bold-italic.ttf") format("truetype");
}

@font-face {
	font-family:'Myriad Set Pro 700';
	src:url("/media/fonts/myriad-set-pro_bold.eot");
}

@font-face {
	font-family:'Myriad Set Pro';
	font-style:normal;
	font-weight:400;
	src:url("/media/fonts/myriad-set-pro_text.eot");
	src:url("/media/fonts/myriad-set-pro_text.woff") format("woff"), url("/media/fonts/myriad-set-pro_text.ttf") format("truetype");
}