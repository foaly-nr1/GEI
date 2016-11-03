/* globals jQuery */
/**
 * Makes it possible to open a submodal.
 */
(function bs3Submodal($) {
    'use strict';

    const submodal = document.querySelector('#submodal');

    if(!submodal) {
        return;
    }

    $(submodal).on('hidden.bs.modal', () => document.body.classList.add('modal-open'));
}(jQuery));
