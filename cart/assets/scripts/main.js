$(document).ready(function() {

  // Masks
  $("#telefone").keydown(function(e){
    var tamanho = $(this).val().length;

    if(tamanho < 11 || ( e.keyCode == 8 && tamanho < 11 ) ){
      $(this).mask("(99) 9999-9999");
    } else {
      $(this).mask("(99) 9999-99999");
    }
  });
  $("#telefone").mask("(00) 0000-0000");

});
