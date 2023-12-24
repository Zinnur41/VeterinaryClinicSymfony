    $(document).ready(function () {

        $('.delete-btn').click(function (event) {
            event.preventDefault();
            let userId = $(this).data('user-id');

            $.ajax({
                type: 'POST',
                url: '/admin/deleteUser/' + userId,
                success: function (response) {
                    console.log(response.deletedId);
                    if (response.success) {
                        window.location.href = '/admin/getUsers'
                        console.log('User deleted successfully');
                    } else {
                        console.log('Error deleting user');
                    }
                },
                error: function () {
                    console.log('AJAX request failed');
                }
            });
        });
    });
