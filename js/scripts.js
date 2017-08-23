( function( $ ) {
    $( document ).ready(function() {

        // Slidebars
        $.slidebars();

        // Menu Accordion
        $('.mobile-menu-wrap li.has-sub > .expander').on('click', function(){
            var element = $(this);
            var parent = element.parent('li');

            if (element.hasClass('collapsed')) {
                element.removeClass('collapsed').addClass('expanded');
                parent.children('ul').slideDown();
            } else {
                parent.find('span.expander').removeClass('expanded').addClass('collapsed');
                parent.find('ul').slideUp();
            }
        });

        // Scroll To Top button
        $('body').prepend('<div id="move-to-top" class="scrollToTop"><i class="fa fa-angle-up" aria-hidden="true"></i></div>');
        var scrollDes = 'html,body';
        if(navigator.userAgent.match(/opera/i)){
            scrollDes = 'html';
        }

        $(window).scroll(function () {
            if ($(this).scrollTop() > 500) {
                $('#move-to-top').addClass('filling').removeClass('hiding');
            } else {
                $('#move-to-top').removeClass('filling').addClass('hiding');
            }
        });

        $('#move-to-top').click(function () {
            $(scrollDes).animate({ 
                scrollTop: 0
            },{
                duration :500
            });
        });

        // Fade header content on scroll
        $(window).scroll(function(){
            $('.layout-default.hd-parallax .site-header .container').css('opacity', 1 - $(window).scrollTop() / 200);
        });

    });

    if ($('body').width() < 768) {
        $('.layout-simple .header-sidebar').addClass('sb-slidebar sb-'+ elifScripts.menuside +' sb-width-custom sb-style-overlay');
    } else {
        $('.layout-simple .header-sidebar').removeClass('sb-slidebar sb-'+ elifScripts.menuside +' sb-width-custom sb-style-overlay');
    }
    $(window).resize(function() {
        if ($('body').width() < 768) {
            $('.layout-simple .header-sidebar').addClass('sb-slidebar sb-'+ elifScripts.menuside +' sb-width-custom sb-style-overlay');
        } else {
            $('.layout-simple .header-sidebar').removeClass('sb-slidebar sb-'+ elifScripts.menuside +' sb-width-custom sb-style-overlay');
        }
    });

} )( jQuery );