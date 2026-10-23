define(['jquery'], function ($) {
    'use strict';

    return function (config, element) {
        $(element).on('submit', function () {
            var submittedAt = element.querySelector('[name="submitted_at"]');

            if (submittedAt) {
                submittedAt.value = Math.floor(Date.now() / 1000).toString();
            }
        });
    };
});
