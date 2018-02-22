<?php
    require_once("../../../global.php");
    header("Content-Type: text/javascript");
    global $db, $w_user;
?>
var AppRating = function() {
    var init_Rating = function(){
        jQuery.fn.raty.defaults.starType    = 'i';
        jQuery.fn.raty.defaults.hints       = ['<?php echo _RATE_BAD; ?>', '<?php echo _RATE_POOR; ?>', '<?php echo _RATE_REGULAR; ?>', '<?php echo _RATE_GOOD; ?>', '<?php echo _RATE_GORGEOUS; ?>'];
        jQuery('.js-rating').each(function(){
            var $ratingEl = jQuery(this);
            $ratingEl.raty({
                score: $ratingEl.data('score') ? $ratingEl.data('score') : 0,
                number: $ratingEl.data('number') ? $ratingEl.data('number') : 5,
                cancel: $ratingEl.data('cancel') ? $ratingEl.data('cancel') : false,
                target: $ratingEl.data('target') ? $ratingEl.data('target') : false,
                targetScore: $ratingEl.data('target-score') ? $ratingEl.data('target-score') : false,
                precision  : $ratingEl.data('precision') ? $ratingEl.data('precision') : false,
                cancelOff: $ratingEl.data('cancel-off') ? $ratingEl.data('cancel-off') : 'fa fa-fw fa-times text-danger',
                cancelOn: $ratingEl.data('cancel-on') ? $ratingEl.data('cancel-on') : 'fa fa-fw fa-times',
                starHalf: $ratingEl.data('star-half') ? $ratingEl.data('star-half') : 'fa fa-fw fa-star-half-o text-warning',
                starOff: $ratingEl.data('star-off') ? $ratingEl.data('star-off') : 'fa fa-fw fa-star text-gray',
                starOn: $ratingEl.data('star-on') ? $ratingEl.data('star-on') : 'fa fa-fw fa-star text-warning',
                click: function(score, evt) {
                    var rid = this.id;
                    var act = rid.split('_');
                    Rating(act[1],act[2],score);
                }
            });
        });
    };
    return {
        init: function () {
            init_Rating();
        }
    };
}();
jQuery(function(){ AppRating.init(); });