$(document).ready(function () {

    $('.block-btn').click(function (event) {
        event.preventDefault();
        let userId = $(this).data('user-id');

        $.ajax({
            type: 'POST',
            url: '/admin/blockUser/' + userId,
            dataType: 'json',
            success: function (response) {
                console.log( response.blockedId);
                if (response.success) {
                    console.log('User blocked successfully');
                    window.location.href = '/admin/getUsers'
                } else {
                    console.log('Error blocking user');
                }
            },
            error: function () {
                console.log('AJAX request failed');
            }
        });
    });
});
