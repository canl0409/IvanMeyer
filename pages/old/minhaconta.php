
<?php 
if(!$user->isloged()){ ?>
<meta http-equiv="refresh" content="0; url=<?=u?>" />
<?php 
die;
}

if(isset($_SESSION["cart_products"])){
  unset($_SESSION["cart_products"]);
  ?>
  <meta http-equiv="refresh" content="0; url=<?=u.'minhaconta'?>" /> 
  <?php
}

$alert = false;
$alertClass = "";
$alertMsgm = "";

if(isset($_SESSION["alert"]))
{
  $alert = true;
  $alertClass = $_SESSION["alert-class"];
  $alertMsgm = $_SESSION["alert-msgm"];
}else{
  $alert = false;
}

function limpaAlert(){
  unset($_SESSION["alert"]);
  unset($_SESSION["alert-class"]);
  unset($_SESSION["alert-msgm"]);
}
?>

<section class="home-section int-section  home-fade bg-dark-30" id="home" data-background="<?=u?>assets/imgs/slide-tdm-1.jpg">
  <div class="titan-caption container">
    <div class="caption-content container">
      <div class="font-alt mb-80 titan-title-size-1"></div>
      <div class="font-alt mb-20 titan-title-size-4">Minha Conta</div>

    </div>
  </div>
</section>

        <section >
          <div class="container">
            <div class="row mb-60">
            <div class="col-md-12">
            <div class="post-meta"><a href="<?=u?>">Home</a> Minha Conta</div>
            </div>
            </div>

            <div class="row">
              <div class="col-sm-9 col-sm-offset-3">
                <?php if($alert){ ?>
                  <div class="<?=$alertClass?>" role="alert"><button class="close" type="button" data-dismiss="alert" aria-hidden="true">×</button>
                    <?=$alertMsgm?>
                  </div>
                <?php limpaAlert(); } ?>  
              </div>
            </div>

            <div class="row mb-40">
              <div class="col-sm-3">
               <h4 class="font-alt mb-10">Olá, <?=$_SESSION['nome']?></h4>
                <p>A partir do painel de controle de sua conta, você pode ver suas compras recentes, gerenciar seus endereços de entrega e cobrança, e edite sua senha e detalhes da conta.
                </p>
                <p style="padding-top: 10px; border-top: solid 1px #ddd;">
                  <?php echo $gm->plano() ?>
                </p>
              </div>

              <div class="col-sm-9">

                <div role="tabpanel">
                  <ul class="nav nav-tabs font-alt" role="tablist">
                    <li class="active"> <a href="#pedidos" data-toggle="tab"> <i class="fas fa-book"></i>Meus Cursos</a></li>
                    <li style="display:none"><a href="#downloads" data-toggle="tab"><i class="fas fa-download"></i>Downloads</a></li>
                    <li  style="display:none"><a href="#enderecos" data-toggle="tab"><i class="fas fa-map"></i></i>Endereços</a></li>
                    <li><a href="#conta" data-toggle="tab"><i class="fas fa-address-card"></i>Meus dados</a></li>
                    <li><a href="<?=u?>sair" ><i class="fas fa-sign-out-alt"></i>Sair</a></li>
                  </ul>
                  <div class="tab-content">

                    <div class="tab-pane active" id="pedidos">
                     <div id="thim-course-archive" class=" thim-course-grid">
                      <?php $cm = $gm->getMeusCursosAluno();
                      foreach ($cm as $cs){
                      $cs = (array)$cs ;
                      //include 'includes/box-curso.php';
                       ?>

                      <div class="panel panel-default">
                        <div class="panel-heading">
                          <h4 class="panel-title font-alt"><a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#<?=$cs['cursoId']?>"><?=$cs['titulo']?></a></h4>
                        </div>
                        <div class="panel-collapse collapse" id="<?=$cs['cursoId']?>">
                          <div class="panel-body">

                            <div class="row" style="margin: 0;">
                              <label for="" class="pull-left">Progresso: </label>
                              <a style="float: right;" class="col-md-2 btn btn-xs" href="<?=u?>curso-de-musica-online/<?=ln($cs['titulo'])?>">Acessar</a>
                            </div>

                            <?php $pgrss =  $gm->cursoProgresso($cs['cursoId']); ?>
                              <div class="meter"><div><?=$pgrss?>%</div>
                                <span style="width: <?=$pgrss?>%"></span>
                              </div>

                              <div class="row">
                                <div class="col-md-6">
                                  <label for="">Certificado</label>
                                  <p> 
                                    <?php if( $pgrss >= 100 ) {?>
                                    <button class="btn gerarcert" rel="<?=$cs['cursoId']?>">Gerar Certificado</button>
                                    <?php  }else{ ?>
                                    Disponível após conclusão
                                    <?php } ?>
                                 </p>
                                </div>
                                <div class="col-md-6">
                                  <label for="">Vencimento:</label> <br>
                                  <p><?=$gm->vencimento($cs['cursoId'])?></p>
                                </div>

                              </div>

                          </div>
                        </div>
                      </div>

                      <?php  }?>

                      </div>
                    </div>

                    <div class="tab-pane" id="downloads">
                    <div class="alert alert-success" role="alert">Downloads Indisponíveis</div>
                    </div>
                    <div class="tab-pane" id="enderecos">
                    <div class="alert alert-success" role="alert">Nenhum endereço cadastrado</div>
                    </div>
                    <div class="tab-pane" id="conta">


<form id="updatemeusdados" class="fregistro" method="POST" style="padding: 2px 40px;">

<input type="hidden" name="updateuser" value="1">

<div class="row">
<div class="col-md-12">

  <div class="form-group row">
    <div class="col-sm-12">
      <input type="text" required  name="nome" class="form-control" placeholder="Nome" id="nome" value="<?=$user->user()->nome?>" >
    </div>
  </div>

  <div class="form-group row">
    <div class="col-sm-12">
      <input type="text" required  name="sobrenome" class="form-control" placeholder="Sobrenome" id="sobrenome" value="<?=$user->user()->sobrenome?>" >
    </div>
  </div>

   <div class="form-group row">
    <div class="col-sm-12">
      <input type="text"  required name="cpf"  class="form-control numbersOnly cpf" id="cpf" value="<?=$user->user()->cpf?>"  placeholder="Cpf"  >
    </div>
  </div>


<div class="form-group row">
<div class="col-lg-12">
<input type="text"  minlength="2" name="cidade" id="cidade"  placeholder="Cidade"    class="form-control " value="<?=$user->user()->cidade?>">
</div>
</div>

<div class="form-group row">
<div class="col-lg-12">
<select name="uf" class="form-control " id="uf"  placeholder="Estado" >
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
      <input type="text" required class="form-control" id="endereco" name="endereco" value="<?=$user->user()->endereco?>"  placeholder="Endereço">
    </div>
  </div>

  <div class="form-group row">
    <div class="col-sm-12">
      <input type="email"  required class="form-control" name="email" id="email" value="<?=$user->user()->email?>"  placeholder="E-mail">
    </div>
  </div>

    <div class="form-group row">
    <div class="col-sm-12">
      <input type="text"  required class="form-control" name="bairro" id="bairro" value="<?=$user->user()->bairro?>"  placeholder="Bairro">
    </div>
  </div>

    <div class="form-group row">
    <div class="col-sm-12">
      <input type="text"  required class="form-control cep" name="cep" id="cep" value="<?=$user->user()->cep?>"  placeholder="CEP">
    </div>
  </div>
  <div class="form-group row">
    <div class="col-sm-12">
      <input type="text" required class="form-control telefone" name="celular" id="celular"  value="<?=$user->user()->celular?>"   placeholder="Celular" >
    </div>
  </div>

</div>

<div class="col-md-12">
  <div class="form-group row">
    <div class="col-sm-12">
      <input type="password"   class="form-control" name="senha" id="senha"  placeholder="Senha">
    </div>
  </div>
  <div class="form-group row">
    <div class="col-sm-12">
      <input type="password"   class="form-control" name="senha2" id="senha2" placeholder="Repita a senha" >
    </div>
  </div>

   <div class="form-group row">
   <div class="col-sm-12">
   <input type="submit" value="ATUALIZAR" class="form-control subm" style="float:right; margin-top:20px;"/>
   <br>

  <div id="alert-error" class="alert alert-danger" style="display:none" role="alert"><strong>Oops... </strong> <span class="warn"></span>
  </div>

   <div class="col-md-12 text-center" id='cmregister'></div>
   </div>
   </div>
</div>

</div>
</form>


                    </div>
                  </div>
                </div>
           
              </div>
            </div>
          </div>
        </section>




<div id="modal-certificado" class="modal fade" role="dialog" style="z-index: 99999;" >
<div class="modal-dialog"  style="width:842px;">
<div class="modal-content"  >
<div class="modal-header" style="padding: 0px 15px;margin-bottom: -21px;z-index: 99;position: absolute; right:0px;border: none !important;">
<button type="button" style="opacity: 0.7;color: red;margin-right: -10px;" class="close" data-dismiss="modal">&times;</button>
</div>
<div class="modal-body" id=""  style="height: 589px;padding:0px">
   <iframe id="i-modal-certificado" style="width:100%; height: 100%;" src="" frameborder="0"></iframe>
</div>
</div>
</div>
</div>

