$(document).ready(function(){


    $('#subs-form a').on('click', function(e){


		var email_test = $('#subs-form').find('input[name=email]').val();

        data = {
            'action': 'texttheme_subsform',
            'email_test': email_test
        }

        jQuery.ajax({
            type: 'post',
            url: object_url.url,
            data: data,
            cache: false,
            success: function(data) {
                alert( data );
            }
        });
        e.preventDefault();

    });


});
