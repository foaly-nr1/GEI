/* globals jQuery */
/**
 * This extension inserts the loading animation of the Renaissance theme into
 * any modal when it's opened. The loading animation is replaced by the remote
 * content as soon as it's fetched.
 */
(function bs3RenaissanceModalLoader($) {
    'use strict';

    function onShow(e) {
        const modalBody = e.target.querySelector('.modal-body') || e.target.querySelector('.modal-content');

        modalBody.innerHTML = '<div class="cssload-speeding-wheel"></div>';
    }

    // got to to use jQuery for bootstrap events
    // we don't know name of modal, so wait for event to bubble
    $(window).on('show.bs.modal', onShow);
}(jQuery));
