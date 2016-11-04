/* globals xController */
xController(function formTypeCollection(collection) { // eslint-disable-line prefer-arrow-callback
    'use strict';

    const info = collection.children[0];
    const prototype = info.dataset.prototype;
    const variableName = info.dataset.prototypeName;
    const allowAdd = info.dataset.allowAdd === '1';
    const allowDelete = info.dataset.allowDelete === '1';

    const fieldAddedEvent = new CustomEvent('fieldAdded');

    function addNew() {
        const count = collection.querySelectorAll('input').length;
        const fragment = document.createRange().createContextualFragment(
            prototype.replace(new RegExp(variableName, 'g'), count)
        );
        const input = fragment.querySelector('input');

        info.appendChild(fragment);
        input.addEventListener('keyup', ensureSpare);
        input.required = count === 0;

        info.dispatchEvent(fieldAddedEvent);
    }

    function ensureSpare() {
        const inputs = collection.querySelectorAll('input');
        let n;
        let blankInputCount = 0;

        for (n = 0; n < inputs.length; n++) {
            blankInputCount += inputs[n].value.length === 0 ? 1 : 0;
        }

        if (allowAdd && blankInputCount === 0) {
            addNew();
        }
    }

    // If allow delete is false, lock existing emails
    (function lockExisting() {
        if (allowDelete) {
            return;
        }

        const inputs = collection.querySelectorAll('input');
        let n;

        for (n = 0; n < inputs.length; n++) {
            if (!triprHq.utils.hasParent(inputs[n], 'has-error', 6)) {
                inputs[n].readOnly = true;
            }
        }
    }());

    // If allow delete is true, none but the first are required
    (function unrequireDeletables() {
        if (!allowDelete) {
            return;
        }

        const inputs = collection.querySelectorAll('input');
        let n;

        for (n = 1; n < inputs.length; n++) {
            inputs[n].required = false;
        }
    }());

    // Always have at least one spare field present
    ensureSpare();

    // When form is submitted, remove empty field
    (function noBlankSubmission() {
        const form = collection.querySelector('input').form;

        if (!form) {
            return;
        }

        form.addEventListener('submit', (e) => {
            const inputs = collection.querySelectorAll('input');
            let n;

            for (n = 0; n < inputs.length; n++) {
                if (inputs[n].value === '') {
                    inputs[n].disabled = true;
                }
            }
        });
    }());
});
