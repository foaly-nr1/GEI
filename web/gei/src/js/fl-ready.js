/* globals triprHq, jQuery */
if (!('fl' in window)) {
    window.fl = {};
}
/**
 * Adds a method `.ready()` to the global object triprHq. When `triprHq.ready()` is executed,
 * the given callback is executed automatically. It is executed again, whenever bootstrap's
 * `loaded.bs.modal` event or `shown.bs.tab` or the `triprhq.domReloaded` events are fired.
 *  Depending on the context, `document`, the modal element, the tab or the reloaded element
 *  is passed to the callback.
 */
(function flReady(fl, $) {
    'use strict';

    const callbacks = [];

    function executeCallbacks(argument) {
        let n;
        for (n = 0; n < callbacks.length; n++) {
            callbacks[n](argument);
        }
    }

    // 1. fl.domReloaded event
    document.addEventListener('fl.domReloaded', (e) => executeCallbacks(e.detail));

    // 2. loaded.bs.modal event
    $(window).on('loaded.bs.modal', (e) => executeCallbacks(e.target));

    // 3. shown.bs.tab event
    // need to use jQuery for bootstrap events
    $(document).on('shown.bs.tab', (e) => {
        const tab = document.querySelector(e.target.getAttribute('href'));
        if (tab) {
            executeCallbacks(tab);
        }
    });

    // 4. draw.dt event
    // need to use jQuery for datatables events
    $(document).on('draw.dt', (drawEvent) => {
        executeCallbacks(drawEvent.target);
    });

    fl.ready = function addCallback(callback) {
        const callbackType = typeof callback;
        if (callbackType !== 'function') {
            throw new Error(`Function expected, ${callbackType} given.`);
        }

        callback(document);
        callbacks.push(callback);
    };
}(fl, jQuery));
