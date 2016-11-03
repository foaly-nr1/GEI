/* globals fl */
(function btnSubmit(fl) {
    'use strict';

    function onSubmit(e) {
        const submitBtn = e.srcElement.querySelector('[type=submit]');
        if (!submitBtn) {
            return;
        }

        submitBtn.disabled = true;

        const existingIcon = submitBtn.querySelector('.fa');
        if (existingIcon) {
            existingIcon.parentNode.removeChild(existingIcon);
        }

        const icon = document.createElement('i');
        icon.className = 'fa fa-refresh fa-spin fa-fw';
        submitBtn.insertBefore(icon, submitBtn.firstChild);
    }

    fl.ready((parent) => {
        const forms = parent.querySelectorAll('form');
        let n;
        for (n = 0; n < forms.length; n++) {
            forms[n].addEventListener('submit', onSubmit);
        }
    });
}(fl));
