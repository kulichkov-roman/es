$(function() {
	
// scroll filter toolbar
	
	if($('.catTile__toolbar').length > 0) {
        var $window = $(window),
            $toolbar = $('.catTile__toolbar'),
            $catList = $('.catTile__list');

        $window.scroll(function () {
            if (!$toolbar.hasClass('toolbar-fixed') && ($window.scrollTop() > $toolbar.offset().top)) {
                $toolbar.addClass('toolbar-fixed').data('top', $toolbar.offset().top);
                $catList.css('margin-top', '79px');
            }
            else if ($toolbar.hasClass('toolbar-fixed') && ($window.scrollTop() < $toolbar.data('top'))) {
                $toolbar.removeClass('toolbar-fixed');
                $catList.css('margin-top', '0');
            }
        });
    }

    $('body').foxyLink({item: '.menu__listItemLink'});
});
