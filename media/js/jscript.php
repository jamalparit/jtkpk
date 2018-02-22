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
var WebApp = {
	require: function(l) {
		document.write('<script type="text/javascript" src="'+l+'"><\/script>');
  	},

	Initiate: function() {
		WebApp.require('<?php echo URL_JS;?>/global.js.php?m=<?php echo $m;?>');
		WebApp.require('<?php echo URL_JS;?>/functions.js.php?m=<?php echo $m;?>');
  	}
};
WebApp.Initiate();