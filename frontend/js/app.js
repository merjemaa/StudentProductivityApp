$(document).ready(function () {
    function router() {
        let hash = window.location.hash.replace('#', '') || 'dashboard';
        let viewPath = 'views/' + hash + '.html';

        $.ajax({
            url: viewPath,
            type: 'GET',
            success: function (response) {
                $('#app-container').html(response);
            },
            error: function () {
                $('#app-container').html('<div class="alert alert-danger">Page not found!</div>');
            }
        });
    }

    $(window).on('hashchange', router);
    router();
});