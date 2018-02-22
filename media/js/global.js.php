<?php
/*###############################################################
#  ZM : Web System												#
#  ===========================									#
#  Design & Code by : Zulkifli Mohamed (putera)					#
###############################################################*/

require_once("../../global.php");
$m = strtolower($_REQUEST['m']);
header("Content-Type: text/javascript");
global $w_user;
?>
/* Copyright <?php echo date('Y'); ?> <?php echo $config->WebSystem;?>. All Rights Reserved. */

/* AJAX */
function Ajx(ajax,btn,div){
	ajax.requestFile = "../../ajax.php";
	ajax.method = "POST";
	ajax.onCompletion = function(){
		var text = ajax.response;
		eval(text);
		if (typeof(btn)==='undefined' || btn === null || btn == '') { btn = ''; } else {
			$('#' + btn).prop("disabled",false);
			$('#' + btn + ' > i').remove('.fa-cog');
		}		
		if (typeof(div)==='undefined' || div === null || div == '') { div = ''; } else {
			$('#' + div).addClass("hide");
			$('#' + div).hide();
		}
	};
	ajax.runAJAX();
	if (typeof(btn)==='undefined' || btn === null || btn == '') { btn = ''; } else {
		$('#' + btn).prop("disabled",true);
		$('#' + btn).prepend('<i class="fa fa-cog fa-spin"></i> ');
	}
	if (typeof(div)==='undefined' || div === null || div == '') { div = ''; } else {
		$('#' + div).removeClass("hide");
		$('#' + div).show();
	}
}

/* Validation */
function ValidEmail(s) {
	if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(s)){
		return true;
	} else {
		return false;
	}	
}
function ValidUserID(s) {
    if (/\W/.test(s)){
		return false;
	} else {
		return true;
	}
}
function ValidDate(s) {
	if ((!/^[0-9\/]+$/i.test(s)) || (s.length != 10)) {
    	return false;
    } else {
    	return true;
	}
}
function ValidName(s) {
	if ((!/^[a-zA-Z _]+$/i.test(s))) {
    	return false;
    } else {
    	return true;
	}
}
function ValidUploadName(s) {
	if ((!/^[a-zA-Z0-9. _]+$/i.test(s))) {
    	return false;
    } else {
    	return true;
	}
}
function ValidType(fn, ft) {
    var ext = (-1 !== fn.indexOf('.')) ? fn.replace(/.*[.]/, '').toLowerCase() : '';
    var allowed = ft;
    if (allowed.length > 0){
        for (var i=0; i < allowed.length; i++){
            if (allowed[i].toLowerCase() == ext){
                return true;
            }
        }
    }
	return false;
}
function NumOnly(s) {
	if ((!/^[0-9.]+$/i.test(s))) {
    	return false;
    } else {
    	return true;
	}
}
function ValidMobile(s) {
	if ((!/^[0-9]+$/i.test(s))) {
    	return false;
    } else {
    	return true;
	}
}
function ValidPrice(s) {
	if ((!/^(\d*([.,](?=\d{3}))?\d+)+((?!\2)[.,]\d\d)?$/i.test(s))) {
    	return false;
    } else {
    	return true;
	}
}
function CurrencyFormat(amount) {
	var i = parseFloat(amount);
	if(isNaN(i)) { i = 0.00; }
	var minus = '';
	if(i < 0) { minus = '-'; }
	i = Math.abs(i);
	i = parseInt((i + .005) * 100);
	i = i / 100;
	s = new String(i);
	if(s.indexOf('.') < 0) { s += '.00'; }
	if(s.indexOf('.') == (s.length - 2)) { s += '0'; }
	s = minus + s;
	return s;
}
function num(n) {
	return n.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}

/* HTML */
function OpenWindow(theURL,winName,features) {
	window.open(theURL,winName,features);
}
function OpenLink(link) {
	window.location.href=link;
}
function JumpMenu(targ,selObj,restore){
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}
function html_entities(str) {
    return String(str).replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;');
}

/* Notifications */
function Notify(type,msg,pos,time_delay) {
	var tpos, pos_from, pos_align, adelay, aicn;

	if (typeof(time_delay)==='undefined' || time_delay === null || time_delay == '') {
		adelay = 2000;
	} else {
		adelay = time_delay;
	}

	if (typeof(pos) !== 'undefined') {
		tpos = pos.split('-');
		pos_from = tpos[0];
		pos_align = tpos[1];
	} else {
		pos_from = 'top';
		post_align= 'right';
	}

	if (type == 'danger' || type == 'error') {
		aicn = 'fa fa-times-circle';
	} else if (type == 'warning') {
		aicn = 'fa fa-exclamation-triangle';
	} else if (type == 'success') {
		aicn = 'fa fa-check-circle';
	} else {
		aicn = '';
	}

	jQuery.notify({
	    icon: aicn,
	    message: '<span class="push-5-r"></span><span class="h6">'+msg+'</span>',
	    url: ''
	},
	{
	    element: 'body',
	    type: type,
	    allow_dismiss: true,
	    newest_on_top: true,
	    showProgressbar: false,
	    placement: {
	        from: pos_from,
	        align: pos_align
	    },
	    offset: 20,
	    spacing: 10,
	    z_index: 1031,
	    delay: adelay,
	    timer: 1000,
	    animate: {
	        enter: 'animated bounceIn',
	        exit: 'animated bounceOut'
	    }
	});
}
function NotifyTitle(type,msg,pos,time_delay) {
	var tpos, pos_from, pos_align, adelay, aicn;

	if (typeof(time_delay)==='undefined' || time_delay === null || time_delay == '') {
		adelay = 2000;
	} else {
		adelay = time_delay;		
	}

	if (pos.length != 0) {
		tpos = pos.split('-');
		pos_from = tpos[0];
		pos_align = tpos[1];
	} else {
		pos_from = 'top';
		post_align= 'right';
	}

	jQuery.notify({
	    message: '<span class="h6">'+msg+'</span>',
	    url: ''
	},
	{
	    element: 'body',
	    type: type,
	    allow_dismiss: true,
	    newest_on_top: true,
	    showProgressbar: false,
	    placement: {
	        from: pos_from,
	        align: pos_align
	    },
	    offset: 20,
	    spacing: 10,
	    z_index: 1031,
	    delay: adelay,
	    timer: 1000,
	    animate: {
	        enter: 'animated fadeIn',
	        exit: 'animated fadeOut'
	    }
	});
}
function SweetAlert(mode,title,txt,func) {
	if (typeof(func)==='undefined')
	{
		if (mode === '') {
			swal(txt);
		} else {
			swal({
				title: title,
				html: txt,
				type: mode
			});
		}
	}
	else
	{
		swal({
			title: title,
			html: txt,
			type: mode
		}).then(function()
		{
			eval(func);
		});
	}
}

/* Functionality */
function LoadMore(datatype,elem,dataid,datapage) {
    var loading = false;

    if (typeof(dataid)==='undefined') { dataid = ''; }
    if (typeof(datapage)==='undefined') {
        datapage = $('#'+elem+'-data-page').val();
    }

    if (loading == false)
    {
        var divimg = '<div id="'+elem+'-loading" class="text-center push-10 col-xs-12"><i class="fa fa-cog fa-spin"></i></div>';
        if ($("#" + elem + "-loading").length) {
            $("#" + elem + "-loading").show();
        } else {
            $("#" + elem).after(divimg);
        }

        loading = true;
        $("#" + elem + "-loading").show();
        $("#" + elem + "-btn-loadmore").prop('disabled',true);
        $.ajax({
            method: "POST",
            url: "../../ajax.php",
            dataType: "html",
            data: {
                op: 'loader',
                type: datatype,
                page: datapage,
                id: dataid
            }
        }).success(function(data) {            
            $("#" + elem).append(data);            
            $("#" + elem + "-loading").hide();
            loading = false;
        }).fail(function(xhr, ajaxOptions, thrownError) {
            console.log(thrownError);
            $("#" + elem + "-loading").hide();
            loading = false;
        });        
    }
}
function Pipeline() {
    setTimeout(function() {
	    var ajax = new sack();
	    ajax.setVar("m","<?php echo $m;?>");
	    ajax.setVar("op","pipeline");
	    Ajx(ajax);
	}, 2000);
}