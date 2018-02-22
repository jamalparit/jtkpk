<?php

require_once("global.php");


echo selectdb("SELECT ID,Gred,NamaJawatan FROM ".TBL_GRED." ORDER BY ID ASC","ID","Gred - NamaJawatan",getUserDetail('GredID'));


?>