<?php 
$add = null;
if(isset($_GET['pid'])){  
$pd =  $p->getRegistro('comunicados','comunicadoId',$_GET['pid']);


         $hora = date( 'H:i',  strtotime($pd['data']) );
          $data = date( 'd/m/Y',  strtotime($pd['data']) );



} 

?>

 
<style>
  #atributos{
    margin-top: 19px;
  }
  #atributos td{
    height: 30px;
  }
  #atributos td input{
    border: 1px solid #ddd;
    border-radius: 4px;
    padding: 2px 3px;
    margin-left: 8px;
    width: 100px;
  }
</style>

<section id="main-content">
  <section class="wrapper site-min-height">
    <!-- page start-->
    <section class="panel">
      


      <div class="mail-box">
                  
                  <aside class="lg-side">
                      <div class="inbox-head">
                          <h3>Detalhes da publicação</h3>
             
                      </div>
                      <div class="inbox-body">
                              <div class="heading-inbox row">
                                  <div class="col-md-8">
                                      <div class="compose-btn">
                                 
                                      </div>

                                  </div>
                                  <div class="col-md-4 text-right">
                                      <p class="date">  <?=$hora?> -  <?=$data?> </p>
                                  </div>
                                  <div class="col-md-12">
                                      <h4> <?=$pd['titulo']?></h4>
                                  </div>
                              </div>
          
                              <div class="view-mail">
                                  <p> <?=$pd['texto']?> </p>
                              </div>
                              <div class="attachment-mail">
                                  <p>
                                      <span><i class="fa fa-paperclip"></i> Arquivos  </span>
                                    
                                  </p>
                                  <ul>
                                  <?php       $lco = $p->lista('arquivos', " WHERE comunicadoId = '".$pd['comunicadoId']."'  ");  
                                  foreach ($lco as $ff) { ?>
                                      <li style="display:block; width:100%">
                                      

                                          <div class="file-name">
                                              <b><?=$ff['arquivo']?></b> - <?=filesize('uploads/'.$ff['arquivo'])?> Bytes  - <a target="_blank" href="<?=('uploads/'.$ff['arquivo'])?>">Ver</a> 
                                          </div>
                                        
                                         
                                      </li>

                           <?php  } ?>

                                  </ul>
                              </div>
                              <div class="compose-btn pull-left">
                                
                              </div>
                          </div>
                  </aside>
              </div>



      </section>
      <!-- page end-->
    </section>
  </section>


  <!-- js placed at the end of the document so the pages load faster -->
  <script src="js/jquery.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script type="text/javascript" src="assets/bootstrap-wysihtml5/wysihtml5-0.3.0.js"></script>
  <script type="text/javascript" src="assets/bootstrap-wysihtml5/bootstrap-wysihtml5.js"></script>

  <script class="include" type="text/javascript" src="js/jquery.dcjqaccordion.2.7.js"></script>
  <script src="js/jquery.scrollTo.min.js"></script>
  <script src="js/jquery.nicescroll.js" type="text/javascript"></script>
  <script type="text/javascript" src="js/jquery.validate.min.js"></script>
  <script src="js/respond.min.js" ></script>
  <script type="text/javascript" src="assets/bootstrap-fileupload/bootstrap-fileupload.js"></script>

  <!--script for this page-->
  <script src="js/form-validation-script.js"></script>




  <script>



    $('.wysihtml5').wysihtml5({
"font-styles": true, //Font styling, e.g. h1, h2, etc. Default true
"emphasis": true, //Italics, bold, etc. Default true
"lists": true, //(Un)ordered lists, e.g. Bullets, Numbers. Default true
"html": false, //Button which allows you to edit the generated HTML. Default false
"link": true, //Button to insert a link. Default true
"image": true, //Button to insert an image. Default true,
"color": false //Button to change color of font  
});



</script>