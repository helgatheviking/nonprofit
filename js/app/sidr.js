jQuery(document).ready(function($) {
    $('#navbar-toggle').sidr({
        side: 'right',
        name: 'sidr-main',
        source: '#sidr',
        displace: true,
        renaming: false,
        onOpen: function(){ 
            $('.sidr-overlay').addClass('active');
            $('#navbar-toggle i').addClass('fa-close').removeClass('fa-bars');
        },
        onClose: function() {
            $('.sidr-overlay').removeClass('active');
            $('#navbar-toggle i').addClass('fa-bars').removeClass('fa-close')
        }
    });

    $('.sidr-overlay').on('click', function(){
        $.sidr('close', 'sidr-main');
    });

    $('.sidr-close').on('click', function(){
        $.sidr('close', 'sidr-main');
    });

    $( window ).resize(function () {
      $.sidr('close', 'sidr-main');
    });

    $(document).keyup(function(e) {
        if (e.keyCode === 27){ // esc
            $.sidr('close', 'sidr-main');  
        }
    });

    $('body').swipe( {
        //Single swipe handler for left swipes
        swipeRight: function () {
            $.sidr('close', 'sidr-main');
        },
        swipeLeft: function () {
            $.sidr('open', 'sidr-main');
        },
        //Default is 75px, set to 0 for demo so any distance triggers swipe
        threshold: 45
    });
});