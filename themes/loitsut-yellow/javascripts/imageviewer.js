// Käsin rakennetun viewerin + XML-transkription zoomaus-, sivutus- ym. toiminnot

$(document).ready(function() {


  // make images draggable and zoomable with doubleclick

  var currentScale = 1;
  var step = 1;
  $('.pic').draggable();
  $('.pic').dblclick(function() {
    if (currentScale < 4.0) {      
      currentScale += step;
      $(this).css('transform','scale(' + currentScale + ')');
    } else {
      currentScale -= 3;
      $(this).css('transform','scale(' + currentScale + ')');
    }
  });



  // Display pictures and pages, show first picture + corresponding transcription first
  $('.pic').not('.pic:first').hide();
  var i = 0;
  var j = 0;

  // Forward
  $('#nextPic').click(function() {

    if (i == $('#show_col_2').find('.page').length-1) {
      return false;
    }

    var currentPage = $('#show_col_2').find('.page:eq(' + i + ')');
    var nextPage = currentPage.next();
    var currentPic = $('.pic:eq(' + j + ')');
    var nextPic = currentPic.next();
    if (nextPage) {
      nextPage.show().siblings('.page').hide();
      nextPic.show().siblings('.pic').hide();
      nextPic.css('transform','');
      j++;
    }

    i++;

  });

  // Backward
  $('#prevPic').click(function() {

    if (i == 0) {
      return false;
    }

    $('.pic:eq(' + i + ')').hide();
    if ($('.pic:eq(' + i + ')').prev()) {
      $('.pic:eq(' + i + ')').prev().show().prevAll().hide();
    }

    var currentPage = $('#show_col_2').find('.page:eq(' + i + ')');
    var prevPage = currentPage.prev();
    var currentPic = $('.pic:eq(' + j + ')');
    var prevPic = currentPic.prev();

    if (prevPage) {
      prevPage.show().siblings('.page').hide();
      prevPic.show().siblings('.pic').hide();
      prevPic.css('transform','');
      j--;
    }

    i--;
  });

});
