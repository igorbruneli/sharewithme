
jQuery(document).ready(function ($) {

  var mobileBreakpoint = 992;

  // Fixes to frontpage
  if ($('body.path-frontpage').length > 0) {
    $('.carousel-image').each(function (i, e) {
      $(e).attr('style', 'background-image: url(' + $(e).attr('data-img') + ');')
    });
  }

  var expandableLinks = $('.button_big');
  d8ms.expandLink(expandableLinks);

  // Open responsive menu
  $('.header-page__menu-trigger').click(function() {
    if ($(window).width() < mobileBreakpoint) {
      $('body').toggleClass('responsive-menu-open');
    }
  });

  // put the date and hours
  var blockDate = $('#tlgov_actual_date_page div.block_text');
  d8ms.dateOfDay(blockDate);

});

var d8ms = {
  expandLink: function ($containers) {
    $containers.each(function (i, e) {
      jQuery(e).click(function () {
        var $a = jQuery(this).find('a');
        var href = $a.attr('href');
        var target = $a.attr('target');
        if (target == '_blank') {
          window.open(href);
        } else {
          location.href = href;
        }
      });
    });
  },
  expandClick: function ($containers) {
    $containers.each(function (i, e) {
      jQuery(e).click(function () {
        jQuery(this).find('a').click();
      });
    });
  },
  expandHeight: function ($containers) {
    jQuery.each($containers, function (k, g) {
      jQuery(g[0]).each(function (j, f) {
        var maxHeight = 0;
        jQuery(f).find(g[1]).each(function (i, e) {
          maxHeight =  Math.max(jQuery(e).height(), maxHeight);
        });
        jQuery(f).find(g[1]).height(maxHeight);
      });
    });
  },
}
