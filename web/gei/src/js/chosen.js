/* globals fl, jQuery */
(function chosen(fl, $) {
    'use strict';

    fl.ready((parent) => {
        const selects = parent.querySelectorAll('.js-chosen-select');

        $(selects).chosen({
            placeholder_text_single: 'Select an option',
            allow_single_deselect: true,
        });
    });
}(fl, jQuery));
