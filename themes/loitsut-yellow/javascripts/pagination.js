// Pagination

$(document).ready(function() {

    // wrap content between pb-tags (page tags) in DIV
    $('.pb').each(function() {
       if ($(this).nextUntil('.pb')) {
           $(this).nextUntil('.pb').andSelf().wrapAll('<div xmlns="http://www.w3.org/1999/xhtml" class="page"></div>');
       } else {
           $(this).nextAll('lg').andSelf().wrapAll('<div xmlns="http://www.w3.org/1999/xhtml" class="page"></div>');
       }
     });

    // hide all but first page at start
    $('.page').not('.page:eq(0)').hide();

    // popup comments: position needs to be set manually because of container edges
    /*$('a.tooltip1').each(function() {
      $(this).hover(function() {
        if ($(this).position().left >= 200) {
          $(this).next('span').css('right','30%');
        } 
      });
    });*/

    $('a.tooltip2').each(function() {
      $(this).hover(function() {
        if ($(this).position().left >= 900) {
          $(this).find('span').css('left','-40px');
        } 
      });
    });

    // set initial third column view in image/transcription display
    $('#show_col_3').html($('div.tiedot'));
    $('#show_col_3').append($('div.tiedot_b'));
    $('#show_col_3').append($('div.kommentaarit'));
    $('#show_col_3').append($('div.nykytulkinta'));
    $('#show_col_3').append($('div.tiedot_c'));
    $('#show_col_3').append($('div.tiedot_d'));
    $('#show_col_3').find('div.tiedot').show();
    $('#show_col_3').find('div.tiedot_b').show();
    $('#show_col_3').find('div.nykytulkinta').show();
    $('#show_col_3').find('div.tiedot_c').show();
    $('#show_col_3').find('div.tiedot_d').show();
    $('#show_col_3').find('div.kommentaarit').show();

    $('#show_row_1').find('a').each(function() {
      if (window.location == $(this).attr('href')) {
        $(this).css('background-color','#fff');
        $(this).prev('input').prop('checked','true');
      }
    });

    $('')

    $('#show_col_3').find('a.more').html('<i class="fas fa-chevron-down"></i>');

 
});
