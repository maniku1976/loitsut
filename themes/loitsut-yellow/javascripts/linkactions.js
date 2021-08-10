$(document).ready(function() {

  $('.tooltip1').on('click', function() {
    $('#show_col_3').css('padding','1em');
    $('#show_col_3').html($(this).next('span').html());
   });

   $('.tooltp2').on('click', function() {
    $('#show_col_3').css('padding','1em');
    $('#show_col_3').html($(this).next('.value3').html());
     $('#show_col_3').find('a.tooltp').each(function() {
       $(this).hover(function() {
         $(this).next('.value1').css('margin-left','-20px');
       });
     });
   }); 

   $('.tooltip2').on('mouseover', function() {
    if ($(this).find('span').length > 1) {
      $(this).find('span:nth-child(2)').addClass('hovered');
    } else {
      $(this).find('span:nth-child(1)').addClass('hovered');
    }
   });

   $('.tooltip2').on('mouseout', function() {
    if ($(this).find('span').length > 1) {
      $(this).find('span:nth-child(2)').removeClass('hovered');
    } else {
      $(this).find('span:nth-child(1)').removeClass('hovered');
    }
   });
   
   $('.tooltip3').on('click', function() {
    $('#show_col_3').css('padding','1em');
    $('#show_col_3').find('.tiedot').find('p:nth-child(n+2)').hide();
    $('#show_col_3').find('.tiedot_b').find('p:nth-child(n+2)').hide();
    $('#show_col_3').find('.tiedot_c').find('p:nth-child(n+2)').hide();
    $('#show_col_3').find('.tiedot_d').find('p:nth-child(n+2)').hide();
    $('#show_col_3').find('.nykytulkinta').find('p:nth-child(n+2)').hide();
    $('#show_col_3').find('.kommentaarit').find('p:nth-child(n+2)').hide();
    var name = $(this).attr('name');
    var comment = $('#show_col_3').find('.kommentaarit').find(('p[name=' + name + ']'));
    if (comment.is(':visible')) {
      comment.hide();
    } else {
      comment.show();
      // Load key/value pairs from skvr.js and create popups
      $.each(skvr, function(key, value) {
        var after = comment.html().indexOf(key) + key.length;
        var pos_after = comment.html().charAt(after);
        var before = comment.html().indexOf(key) - 1;
        var pos_before = comment.html().charAt(before);
        var regex = new RegExp(key, 'gi');
        if ((pos_before == ' ' || pos_before == '(' || pos_before == ';' || pos_before == ',') && (pos_after == ' ' 
        || pos_after == ';' || pos_after == ',' || pos_after == ')' 
        || pos_after == ':' || pos_after == '.')) {
          comment.html(comment.html().replace(regex,'<a href="' + value + '" target="_blank">' + key + '</a>'));
        }
      });
    }
   });

   $('#pic_nav2').find('input').on('change', function() {
    if ($(this).prop('selected',true)) {
     window.location.href = $(this).next('a').attr('href');
    }
    if (window.location == $(this).next('a').attr('href')) {
      $(this).next('a').css('background-color','#fff');
    }
  });

   /*$('#pic_nav3').find('input').on('change', function() {
     if ($(this).prop('selected',true)) {
      window.location.href = $(this).next('a').attr('href');
     }
   });*/

   $('#pic_nav5').find('input').on('click', function() {
    $('#show_col_3').css('padding','1em');
    if ($(this).prop('checked',true)) {
      $('#show_col_3').find('.tiedot').show();
      $('#show_col_3').find('.tiedot_b').show();
      $('#show_col_3').find('.nykytulkinta').show();
      $('#show_col_3').find('.tiedot_c').show();
      $('#show_col_3').find('.tiedot_d').show();
      $('#show_col_3').find('.kommentaarit').show();
      $('#show_col_2').find('.tooltip3').show();
    } 
  });

   $('#pic_nav6').find('input').on('click',function() {
    if ($(this).prop('checked',true)) {
      $('#show_col_2').find('.tooltip3').show();
      $('#show_col_3').find('.comm').first().show();
      $('#show_col_3').find('.tiedot').hide();
      $('#show_col_3').find('.tiedot_b').hide();
      $('#show_col_3').find('.nykytulkinta').hide();
      $('#show_col_3').find('.tiedot_c').hide();
      $('#show_col_3').find('.tiedot_d').hide();
      $('#show_col_3').find('.loitsu_b').hide();
    } 
  });  

  $('#pic_nav7').find('input').on('click', function() {
    $('#show_col_3').css('padding','1em');
    if ($(this).prop('checked',true)) {
      $('#show_col_3').find('.loitsu_b').show();
      $('#show_col_3').find('.loitsu_b').show();
      $('#show_col_3').find('.tiedot').hide();
      $('#show_col_3').find('.tiedot_b').hide();
      $('#show_col_3').find('.nykytulkinta').hide();
      $('#show_col_3').find('.tiedot_c').hide();
      $('#show_col_3').find('.tiedot_d').hide();
      $('#show_col_3').find('.comm').hide();
      $('#show_col_2').find('.tooltip3').hide();
    } 
  });

  $('.tiedot').find('p:nth-child(1)').on('click', function() {
    $('.tiedot').find('p:nth-child(n+2)').toggle();
  });

  $('.tiedot_b').find('p:nth-child(1)').on('click', function() {
    $('.tiedot_b').find('p:nth-child(n+2)').toggle();
  });

  $('.tiedot_c').find('p:nth-child(1)').on('click', function() {
    $('.tiedot_c').find('p:nth-child(n+2)').toggle();
  });

  $('.tiedot_d').find('p:nth-child(1)').on('click', function() {
    $('.tiedot_d').find('p:nth-child(n+2)').toggle();
  });

  $('.nykytulkinta').find('p:nth-child(1)').on('click', function() {
    $('.nykytulkinta').find('p:nth-child(n+2)').toggle();
  });

  $('.kommentaarit').find('p:nth-child(1)').on('click', function() {
    $('.kommentaarit').find('p:visible').not('p:first').toggle();
  });

  $('#metadata-link-1').on('click',function() {
    $('#metadata-content').show('slide',{direction: 'right'},300)
    .find('#dublin-core-description').find('div:first').hide();
    $('#metadata-link-1').hide();
    $('#metadata-link-2').show();
  });

  $('#metadata-link-2').on('click',function() {
    $('#metadata-content').hide('slide',{direction: 'right'},300);
    $('#metadata-link-1').show();
    $('#metadata-link-2').hide();
  });


  $('.resultsBtn').on('click',function() {
    if ($(this).parent().next('.hl').is(":visible")) {
      $(this).parent().next().hide();
    } else {
      $(this).parent().next('.hl').show();
      $(this).parent().next('.hl').find('li:contains("Kommentaarit")').first().css('margin-top','1em');
    }
  });

});
