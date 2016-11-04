/* globals xController, jQuery */
xController(function formTypePhone(inputContainer) { // eslint-disable-line prefer-arrow-callback
    'use strict';

    jQuery(inputContainer).find('input').intlTelInput({
        initialCountry: 'gb',
        nationalMode: false,
        utilsScript: '/vendor/intl-tel-input/build/js/utils.js',
    });
});
