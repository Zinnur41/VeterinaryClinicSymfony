$(document).ready(function () {

    $('.unlock-btn').click(function (event) {
        event.preventDefault();
        let userId = $(this).data('user-id');

        $.ajax({
            type: 'POST',
            url: '/admin/unlockUser/' + userId,
            dataType: 'json',
            success: function (response) {
                console.log(response.unlockedId);
                if (response.success) {
                    window.location.href = '/admin/getUsers'
                    console.log('User unlocked successfully');
                } else {
                    console.log('Error unlocking user');
                }
            },
            error: function () {
                console.log('AJAX request failed');
            }
        });
    });
});
