
<?php 

if( $tp == 'curso'){

$iten =  $gm->obj('cursos','cursoId',$prodt,1);
$prod = array();
$prod['nome'] = $iten->titulo;
$prod['valor'] = $iten->valor;
} 

if( $tp == 'plano'){

$iten =  $gm->obj('planos','planoId',$prodt,1);
$prod = array();
$prod['nome'] = 'Plano '.$iten->nome;
$prod['valor'] = $iten->valor;
}
 
?>
<section class="home-section curso-section  home-fade bg-dark-30" id="home" data-background="<?=u?>assets/imgs/slide-tdm-1.jpg">
  <div class="titan-caption container">
    <div class="caption-content container">
      <div class="font-alt mb-80 titan-title-size-1"></div>
      <div class="font-alt mb-20 titan-title-size-4">Finalizar Compra</div>

    </div>
  </div>
</section>


<section>
  <div class="container">

<div class="row mb-40">
<div class="col-md-12">
  <div class="post-meta"><a href="<?=u?>">Home</a> <?=$title?></div>
</div>
</div>

<div class="row mb-60">

   <div class="col-md-9">
 <h2 class="mb-30">Complete seu cadastro</h2>
     

<form action="https://www.moip.com.br/PagamentoMoIP.do" id="fpagto" name="fpagto" class="fregistro" method="POST" style="padding: 2px 0px;">

<input type="hidden" name="url_retorno" value="<?=u?>retorno">

<input type="hidden" name="MinimoParcelas" value="2">
<input type="hidden" name="MaximoParcelas" value="6">
<input type="hidden" name="Recebimento" value="AVista">


  <div class="alert alert-danger" style="display:none" role="alert"><button class="close" type="button" data-dismiss="alert" aria-hidden="true">×</button><strong>Oops... </strong> <span class="warn"></span>
  </div>

<div class="row">
<div class="col-md-12">
  <div class="form-group row">
    <div class="col-sm-12">
      <input type="text" required  name="pagador_nome" class="form-control" placeholder="Nome" id="nome" value="<?=$user->user()->nome?>" >
    </div>
  </div>

   <div class="form-group row">
    <div class="col-sm-12">
      <input type="text"  required name="pagador_cpf"  class="form-control numbersOnly cpf" id="cpf" value="<?=$user->user()->cpf?>"  placeholder="Cpf"  >
    </div>
  </div>


<div class="form-group row">
<div class="col-lg-12">
<input type="text"  minlength="2" name="pagador_cidade" id="cidade"  placeholder="Cidade"    class="form-control " value="<?=$user->user()->cidade?>">
</div>
</div>

<div class="form-group row">
<div class="col-lg-12">
<select name="pagador_estado" class="form-control " id="uf"  placeholder="Estado" >
  <?php  if($user->user()->uf){?>  <option selected value="<?=$user->user()->uf?>"><?=$user->user()->uf?></option>  <?php }  ?>
  
  <option value="AC">Acre</option>
  <option value="AL">Alagoas</option>
  <option value="AP">Amapá</option>
  <option value="AM">Amazonas</option>
  <option value="BA">Bahia</option>
  <option value="CE">Ceará</option>
  <option value="DF">Distrito Federal</option>
  <option value="ES">Espírito Santo</option>
  <option value="GO">Goiás</option>
  <option value="MA">Maranhão</option>
  <option value="MT">Mato Grosso</option>
  <option value="MS">Mato Grosso do Sul</option>
  <option value="MG">Minas Gerais</option>
  <option value="PA">Pará</option>
  <option value="PB">Paraíba</option>
  <option value="PR">Paraná</option>
  <option value="PE">Pernambuco</option>
  <option value="PI">Piauí</option>
  <option value="RJ">Rio de Janeiro</option>
  <option value="RN">Rio Grande do Norte</option>
  <option value="RS">Rio Grande do Sul</option>
  <option value="RO">Rondônia</option>
  <option value="RR">Roraima</option>
  <option value="SC">Santa Catarina</option>
  <option value="SP">São Paulo</option>
  <option value="SE">Sergipe</option>
  <option value="TO">Tocantins</option>
</select>
</div>
</div>

  <div class="form-group row">
    <div class="col-sm-12">
      <input type="text" required class="form-control" id="endereco" name="pagador_logradouro" value="<?=$user->user()->endereco?>"  placeholder="Endereço">
    </div>
  </div>

  <div class="form-group row">
    <div class="col-sm-12">
      <input type="email"  required class="form-control" name="pagador_email" id="email" value="<?=$user->user()->email?>"  placeholder="E-mail">
    </div>
  </div>

    <div class="form-group row">
    <div class="col-sm-12">
      <input type="text"  required class="form-control" name="pagador_bairro" id="bairro" value="<?=$user->user()->bairro?>"  placeholder="Bairro">
    </div>
  </div>

    <div class="form-group row">
    <div class="col-sm-12">
      <input type="text"  required class="form-control cep" name="pagador_cep" id="cep" value="<?=$user->user()->cep?>"  placeholder="CEP">
    </div>
  </div>
  <div class="form-group row">
    <div class="col-sm-12">
      <input type="text" required class="form-control telefone" name="pagador_telefone" id="celular"  value="<?=$user->user()->celular?>"   placeholder="Celular" >
    </div>
  </div>

</div>

 </div>
</form>
      

 <h2>Dados da compra</h2>

  <div class="alert alert-danger alert2" style="display:none" role="alert"><button class="close" type="button" data-dismiss="alert" aria-hidden="true">×</button><strong>Oops... </strong> <span class="warn"></span>
  </div>


<table class="table table-bordered">
    <tbody>
      <tr>
        <td><b>Produto</b></td>
        <td><b>Total</b></td>
      </tr>
      <tr>
        <td><?=$prod['nome']?></td>
        <td><?=money($prod['valor'])?></td>
      </tr>
      <tr>
        <td><b>Total</b></td>
        <td><b><?=money($prod['valor'])?></b></td>
      </tr>
    </tbody>
  </table>

  <button rel="<?=$prodt?>" type="<?=$tp?>" class="btn tn-success pull-right checkout-button"  >COMPRAR</button>

 </div>

<div class="col-sm-4 col-md-3">
<?php require_once ('includes/right-cursos.php'); ?>
</div>


</div>
</div>
</div>
</section>