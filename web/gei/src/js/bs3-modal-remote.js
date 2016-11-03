/* globals jQuery */
/**
 * When using bootstrap 3 modals with remote data, bootstrap will not clear the
 * modal content on close. When a new modal is opened afterwards, the old content
 * will appear while the new content is loaded. If the new modal's remote URL
 * matches the previous modal's, the content isn't refetched at all.
 *
 * This extension changes this behaviour. Whenever a modal is closed, it is fully
 * destroyed. New modals open in a blank modal.
 */
(function bs3ModalRemote($) {
    'use strict';

    // got to to use jQuery for bootstrap events
    // we don't know name of modal, so wait for event to bubble
    $(window).on('hidden.bs.modal', (e) => {
        const modalBody = e.target.querySelector('.modal-content');

        $(e.target).removeData('bs.modal');

        if (!modalBody) {
            return;
        }

        modalBody.innerHTML = '';
    });
}(jQuery));
