$(document).ready(function() {
    $('#review-id').submit(function(e) {
        e.preventDefault();

        $.ajax({
            type: $(this).attr('method'),
            url: $(this).attr('action'),
            data: $(this).serialize(),
            success: function(response) {
                if (response.success) {
                    window.location.reload();
                } else {
                    console.log(response.errors);
                }
            },
            error: function() {
                console.log('AJAX request failed');
            }
        });
    });
});
