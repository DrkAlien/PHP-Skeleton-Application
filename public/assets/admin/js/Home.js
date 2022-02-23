$(document).ready(function() {
    $('.js-load-users').click(function() {
        var data = {};
        $.post(site_url + '/admin/home/get-users-count/', data, function(response) {
            if(response.success) {
                $('.js-total-users span').text(response.data.users);
                $('.js-active-users span').text(response.data.usersActive);
            } else {
                alert(response.message);
            }

        });
    });
    $('.js-load-html').click(function() {
        var data = {};
        $.post(site_url + '/admin/home/get-html/', data, function(response) {
            if(response) {
                $('.js-html-response').html(response);
            } else {
                alert(response.message);
            }

        });
    });
});