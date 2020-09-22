
//var $ = jQuery.noConflict();


function post(campo, arg) {
  $.post(U + "ajax.php", arg,
    function (data) {
      $('.' + campo).html(data);
      if (campo == 'bets') { betsbox(); }
    });
}


function setRedir(to) {
  arg = { 'defRedir': to }
  post('', arg);
}


function isJson(str) {
  try {
    JSON.parse(str);
  } catch (e) {
    return false;
  }
  return true;
}


$(function () {
  $('form#updatemeusdados').on('submit', function (e) {
    $('#cmregister').html('<div style="text-align:center"><p><img src="' + U + 'assets/loader.gif" /></p></div>');
    e.preventDefault();
    $.post(U + 'ajax.php',
      $('form#updatemeusdados').serialize(),
      function (data, status, xhr) {
        if (data == 1) {
          $('#cmregister').html('<div class="alert alert-success" style="text-align:center"><p>Seu cadastro foi atualizado!</p></div>');
          $('#alert-error').hide();
          $('#alert-error span').html('');
        } else {
          $('#alert-error').show();
          $('#alert-error span').html(data);
          $('#cmregister').html('');
        }
      });
  });
});


$(document).ready(function () {


  if ("ontouchstart" in document.documentElement) {
    $('html').addClass('touch');
    console.log('touch');
  }

  function updatePgbar(cid) {
    $.post(U + 'ajax.php', { updatePgbar: cid }, function (data, status, xhr) {
      $('.pbar .meter div').html(data + "%");
      $('.pbar span').css('width', data);
    });
  }

  $(document).on('change', '#cat_filter', function () {
    if ($(this).val() == "todos") {
      window.location.href = U + "cursos-de-musica-online";
    } else {
      window.location.href = U + "cursos-de-musica-online/" + $(this).val() + "/" + $('#cat_filter option:selected').attr('rel');
    }
    return false;
  });






  $(document).on('click', '.purchase-button', function () {
    id = $(this).attr('rel');


    if ($(this).hasClass('access-course')) {
      $(".course-item:first").trigger('click');
      return false;
    }

    if ($(this).hasClass('enroll-course')) {
      $.post(U + 'ajax.php', { matricular: id }, function (data, status, xhr) {
        location.reload(true);
      });
      return false;
    }


    if ($(this).hasClass('buy-course')) {
      tipo = 'curso';
    } else {
      tipo = 'plano';
    }

    $.post(U + 'ajax.php', { isloged: 1 }, function (data, status, xhr) {
      if (data != 1) {
        $('.btlogin').click();
        if (tipo == 'curso') {
          setRedir('checkout/curso/' + id);
        } else {
          setRedir('checkout/' + tipo + '/' + id);
        }

      } else {
        window.location.href = U + 'checkout/' + tipo + '/' + id;
      }
    });
  });

  $(document).on('click', '.checkout-button', function () {
    prod = $(this).attr('rel');
    tipo = $(this).attr('type');


    if ($('#nome').val().length < 3) { alert("Informe seu nome"); return false; }
    if ($('#cpf').val().length < 3) { alert("Informe seu cpf"); return false; }
    if ($('#cidade').val().length < 3) { alert("Informe sua cidade"); return false; }
    if ($('#uf').val().length < 2) { alert("Informe seu estado"); return false; }
    if ($('#endereco').val().length < 3) { alert("Informe seu endereço"); return false; }
    if ($('#email').val().length < 3) { alert("Informe seu e-mail"); return false; }
    if ($('#celular').val().length < 3) { alert("Informe seu celular"); return false; }
    if ($('#cep').val().length < 6) { alert("Informe seu cep"); return false; }


    $.post(U + 'ajax.php',
      $('form#fpagto').serialize(),
      function (data, status, xhr) {
        if (data != 0) { alert(data); return false }
      });



    $.post(U + 'ajax.php', { checkout: prod, tipo: tipo }, function (data, status, xhr) {

      var j = $.parseJSON(data);

      if (j.res == 0) {
        $('.btlogin').click();
        setRedir('checkout/curso/' + course);
      } else {
        if (j.res == 'free') {
          if (j.sigmsg == 1) {
            window.location = U + "cursos/free/1";
          } else {
            $('.alert2').show();
            $('.alert2 .warn').html(j.sigmsg);
          }

        } else if (j.res == 'erro') {
          alert('Erro inesperado, tente novamente');
        } else {
          $('#fpagto').append(j.res).submit();
        }

      }
    });
  });



  $(document).on('click', '.course-item-flip', function () {
    id = $(this).attr('rel');
    $("#" + id).click();
  });

  $(document).on('click', '.course-item', function () {
    item = $(this);
    aula = item.attr('rel');
    if (aula) {


      $.post(U + 'ajax.php', { loadAula: aula }, function (data, status, xhr) {

        if (data == 'logar') {
          $('.btlogin').click();
          ur = $('#cursoUR').val();
          setRedir('curso-de-musica-online/' + ur);
          return false;
        }

        if (isJson(data)) {
          var j = $.parseJSON(data);
          $('.btavisos').trigger('click');
          setTimeout(function () {
            $('.avisoscontent').html(j.res);
            $('.scroll-up a ').trigger('click');
          }, 1000);

          return false;
        }



        if (!$("#course-curriculum-popup").is(':visible')) {
          $("#course-curriculum-popup").show();
          $('.body').addClass('bodyhei');
          $("#au" + aula).click();
        }

        $('.course-item').removeClass('aactive');
        $('#au' + aula).addClass('aactive');


        $("#popup-content-inner").html(data);


        idp = item.prev().attr('id');
        idn = item.next().attr('id');
        tp = $("#" + idp + " .lesson-title").text();
        tn = $("#" + idn + " .lesson-title").text();

        if (idp != null) { $("#pnamebt").show(); } else { $("#pnamebt").hide(); }
        if (idn != null) { $("#nnamebt").show(); } else { $("#nnamebt").hide(); }

        setTimeout(function () {
          $("#pname").text(tp);
          $("#nname").text(tn);

          $("#pnamebt").attr('rel', idp);
          $("#nnamebt").attr('rel', idn);

          $('a[rel="au-' + aula + '"]').addClass('aviwed');
          updatePgbar($("input[name=cursoId]").val());
        }, 1000);

        // console.log(tp);
        //console.log(tn);
      });


    }
  });




});


//  $(window).scroll(function(){
//       if ($(this).scrollTop() > 135) {
//           $('.betbox').addClass('fixed');
//       } else {
//           $('.betbox').removeClass('fixed');
//       }
//   });


function post2()
{
    var elements = document.getElementsByClassName("formVal");
    var formData = new FormData(); 
    for(var i=0; i<elements.length; i++)
    {
        formData.append(elements[i].name, elements[i].value);
    }
    var xmlHttp = new XMLHttpRequest();
        xmlHttp.onreadystatechange = function()
        {
            if(xmlHttp.readyState == 4 && xmlHttp.status == 200)
            {
                alert(xmlHttp.responseText);
            }
        }
        xmlHttp.open("post", "server.php"); 
        xmlHttp.send(formData); 
}

$(document).on('click', '.modulotitle', function () {
  modid = $(this).attr('rel');
  $(".mod-" + modid).slideToggle("fast", function () {
  });
});


$(document).on('click', '.gerarcert', function () {
  cs = $(this).attr('rel');
  $('#i-modal-certificado').attr('src', U + 'minhaconta/certificate/' + cs);
  $('#modal-certificado').modal('show');
});


$(document).on('click', '.modalbt', function () { 
  //$('#modal').modal('hide');
  
  //$('#modal .modal-content').load('/includes/'+$(this).attr('rel')+'.html',function(){
   $('#modal').modal('show'); post2();
  //});
   
  if ($(this).attr('rel') == 'login') {
    //setRedir('minhaconta');
  }

  $.ajax({
    url: '/includes/' + $(this).attr('rel') + '.html',
    cache: false,
    dataType: "html",
    success: function (data) {
      $("#modal .modal-content").html(data);
      $("#modal").modal('show');
      if ($(".modal-body").attr('rel')) {
        $(".modal-dialog").css('width', $(".modal-body").attr('rel'));
      }
    }
  });

});



$(document).on('click', '.thim-course-switch-layout > a', function (event) {
  var elem = $(this),
    archive = $('#thim-course-archive');
  event.preventDefault();
  if (!elem.hasClass('switch-active')) {
    $('.thim-course-switch-layout > a').removeClass('switch-active');
    elem.addClass('switch-active');
    if (elem.hasClass('switchToGrid')) {
      archive.fadeOut(300, function () {
        archive.removeClass('thim-course-list').addClass(' thim-course-grid').fadeIn(300);
      });
    } else {
      archive.fadeOut(300, function () {
        archive.removeClass('thim-course-grid').addClass('thim-course-list').fadeIn(300);
      });
    }
  }
});

$(document).on('click', '.popup-close', function (event) {
  $('#course-curriculum-popup').hide();
  $("#popup-content-inner").html('');
  $('.body').removeClass('bodyhei');
});


$(function () {
  $('form#opiniao').on('submit', function (e) {
    e.preventDefault();
    $.post(U + 'ajax.php',
      $('form#opiniao').serialize(),
      function (data, status, xhr) {
        $('#opiniao #message').val('');
        $('#opiniao .alert').show();
        $('#opiniao .alert span').html(data);

      });
  });
});

$(function () {
  $('form#mc4wp-form-3').on('submit', function (e) {
    e.preventDefault();
    $.post(U + 'ajax.php',
      $('form#mc4wp-form-3').serialize(),
      function (data, status, xhr) {
        $('#mc4wp-form-3 #mc4wp_email').val('');
        $('#mc4wp-form-3 .alert').css('display', 'table');
        $('#mc4wp-form-3 .alert span').html(data);

      });
  });
});
