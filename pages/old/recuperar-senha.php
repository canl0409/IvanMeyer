<?php 
  $banner['imagem'] = "slide-tdm-1.jpg";
?>

<section class="home-section curso-section home-parallax home-fade bg-dark-30" id="home" data-background="<?=u."assets/imgs/".$banner['imagem']?>">
  <div class="titan-caption container">
    <div class="caption-content container">
      <div class="font-alt mb-80 titan-title-size-1"></div>
      <div class="font-alt mb-20 titan-title-size-4">Recuperação de Senha</div>
    </div>
  </div>
</section>

<div class="main mb-40">

  <div class="container">

    <div class="row">
      <div class="col-md-12">
        <div class="post-meta"><a href="<?=u?>">Home</a>  Recuperar Senha</div>
      </div>
    </div>



<section class="module">   
<form id="frecuperasenha" class="fregistro" method="POST" " style="padding: 2px 40px;"  >
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <h3 class="module-title">Recuperação de senha</h3>
            <div class="form-group row">
                <div class="alert alert-success" style="display:none" role="alert"><button class="close" type="button" data-dismiss="alert" aria-hidden="true">×</button><strong></strong> <span class="warn"></span>
                </div>
                <div class="col-sm-12">
                    <input type="email" required  name="reqmail" class="form-control" id="reqmail" placeholder="E-mail de cadastro" >
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-12">
                    <input type="submit" value="Recuperar" class="form-control subm btn btPadrao btn-danger" style="color: #fff;"/>
                </div>
            </div>
        </div>
    </div>
</form>

<script>
  $(function(){

    $('#frecuperasenha').on('submit', function(e){
       $('.alert').show();
       $('.alert span').html('<div style="text-align:center"><p><img src="'+U+'assets/loader.gif" /></p></div>');

      e.preventDefault();
      $.post(U+'ajax.php', 
          {reqmail:$('#reqmail').val()},  
         function(data, status, xhr){
               $('.alert').show();
              $('.alert span').html(data);
            
         });
    });

});
</script>

</section>
</div>
</div> 

   