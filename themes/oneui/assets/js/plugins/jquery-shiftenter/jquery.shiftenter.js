/*
 * shiftenter: a jQuery plugin, version: 0.0.2 (2011-05-04)
 * tested on jQuery v1.5.0
 *
 * ShiftEnter is a jQuery plugin that makes it easy to allow submitting a form
 * with textareas using a simple press on 'Enter'. Line breaks (newlines) in
 * these input fields can then be achieved by pressing 'Shift+Enter'.
 * Additionally a hint is shown.
 *
 * For usage and examples, visit:
 * http://cburgmer.github.com/jquery-shiftenter
 *
 */
(function($) {
    $.extend({
        shiftenter: {
            settings: {
                metaKey: 'shift'     // Meta key that triggers a line-break, allowed values: 'shift', 'ctrl'
            }
        }

    });
    $.fn.shiftenter = function(opts) {
        opts = $.extend({},$.shiftenter.settings, opts);
        return this.each(function() {
            var $el = $(this);

            // Our goal only makes sense for textareas where enter does not trigger submit
            if(!$el.is('textarea')) {
                return;
            }

            // Catch return key without shift to submit form
            $el.bind('keydown.shiftenter', function(event) {
                if (event.keyCode === 13) {
                    var meta_key = opts.metaKey.toLowerCase();
                    
                    if (meta_key == 'shift' && event.shiftKey) {
                        // Nothing to do, browser inserts a return
                    } else if (meta_key == 'ctrl' && event.ctrlKey) {
                        var val = this.value;
                        if (typeof this.selectionStart == "number" && typeof this.selectionEnd == "number") {
                            var start = this.selectionStart;
                            this.value = val.slice(0, start) + "\n" + val.slice(this.selectionEnd);
                            this.selectionStart = this.selectionEnd = start + 1;
                        } else if (document.selection && document.selection.createRange) {
                            this.focus();
                            var range = document.selection.createRange();
                            range.text = "\r\n";
                            range.collapse(false);
                            range.select();
                        }
                        return false;
                    } else {
                        // Submit form
                        event.preventDefault();
                        $el.blur();
                        $el.parents('form').submit();
                        return false;
                    }
                }
            });

        });
    };
})(jQuery);