( function( $ ) {
    $( document ).ready(function() {
        var $grid = $('.grid').masonry({ 
            itemSelector: '.grid-item',
            columnWidth: '.grid-sizer',
            gutter: '.gutter-sizer',
            percentPosition: true,
            originLeft: elifScripts.originLeft,
        });

        // layout Masonry after each image loads
        $grid.imagesLoaded().progress( function() {
            $grid.masonry('layout');
        });
    });
} )( jQuery );