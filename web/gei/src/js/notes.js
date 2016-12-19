/* globals xController, moment, triprHq */
xController(function notes(form) { // eslint-disable-line prefer-arrow-callback
    'use strict';

    (function beautifyDates() {
        const dates = form.querySelectorAll('.datetime');
        let n;
        let datetime;

        for (n = 0; n < dates.length; n++) {
            datetime = dates[n].textContent;
            dates[n].title = datetime;
            dates[n].textContent = moment(datetime).fromNow(true);
        }
    }());
});
