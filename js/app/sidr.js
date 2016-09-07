jQuery(document).ready(function($) {
    $('#toggle-off-canvas-area').sidr({
        side: 'right',
        onOpen: function(){
            $('.sidr-closer').addClass('active');
            $('.fl-hamburger-menu .icon').toggleClass('icon-hide');

            if ( $('#wpadminbar').length )
            {
                $('#wpadminbar').css({
                    'display' : 'none'
                });
            }
        },
        onClose: function() {
            $('.sidr-closer').removeClass('active');
            $('.fl-hamburger-menu .icon').toggleClass('icon-hide');
            if ( $('#wpadminbar').length )
            {
                setTimeout(function(){
                    $('#wpadminbar').css({
                        'display' : 'block'
                    });
                }, 260);
            }
        }
    });

    $('.sidr-closer').on('click', function(){
        $.sidr('close', 'sidr');
    });
});