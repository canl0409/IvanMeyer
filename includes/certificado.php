<?php //var_dump($cursoid); 
//var_dump($user->user());
$cursoid= $cs['cursoId'];
$cs = $gm->getRegistro('cursos','cursoId',$cursoid);

if($gm->cursoProgresso($cursoid)  != 100){

  $in = $gm->getRegistro('instrutores','instrutorId',$cs['instrutorId']);

 $la = $gm->lista('aulas_vistas', " where  cursoId ='".$cursoid."'  and alunoId = '".$_SESSION['aluno']."' order by avId desc ");

 $instrutor =  $in['nome'];
 

  setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
  date_default_timezone_set('America/Sao_Paulo');
  $conclusao =  strftime(' %d de %B de %Y', strtotime($la[0]['data']));

}




//var_dump($cs); die;
?>


<link href="https://fonts.googleapis.com/css?family=Playball" rel="stylesheet"> 
<style type="text/css" media="screen">
.bg{
width:840px;
height:583px;    
text-align: center;
background-size: contain;
font-family: 'Playball', cursive !important;
color: #000 !important;
}  

.bg img{
width: 100%;
height: 100%;
display: block;
position: relative;
margin-bottom: -583px;
z-index: -1;
}

.bg h1{
margin-top: 100px;
margin-bottom: 50px;
}

.bg h2{
  
}

.bg h3{
  font-size: 40px;
}

.rowc{
margin-top: 58px;
}

.col-6{
  width: 50%;
  float: left;
  display: inline-block;
}
.bg button{
  border-radius: 0;
text-transform: uppercase;
letter-spacing: 1px;
font-size: 12px;
color: #fff;
padding: 8px 37px;
background-color: #c9302c;
font-weight: bold;
display: inline-block;
padding: 6px 12px;
margin-bottom: 0;
font-size: 14px;
font-weight: 400;
line-height: 1.42857143;
text-align: center;
white-space: nowrap;
vertical-align: middle;
-ms-touch-action: manipulation;
touch-action: manipulation;
cursor: pointer;
-webkit-user-select: none;
-moz-user-select: none;
-ms-user-select: none;
user-select: none;
background-image: none;
border: 1px solid transparent;
border-radius: 4px;
}


</style>

 


 
</head>

<body>
 
 <div  style=" overflow: hidden;">
  <div class="bg">
    <img src="<?=u?>assets/certificate-template.jpg" alt="">
    <h1>Terra da Música</h1>
    <p>Certificamos que:</p>
    <h3><?=$user->user()->nome?> <?=$user->user()->sobrenome?></h3>
    <p>Concluiu com sucesso, o curso online:</p>
    <h2><?=$cs['titulo']?></h2>

    <div class="rowc">
      <div class="col-6">
        <?php echo $conclusao ; ?>
      </div>
      <div class="col-6">
        Professor: 
        <?php echo $instrutor; ?>
      </div>
    </div>
  </div>

</div>

  <a href="#" id="btn-Convert-Html2Image"  class="btn-Convert-Html2Image" href="#"> <button>Gerar Certificado</button></a>
    <div id="previewImage"  style=" overflow: hidden; width:0px; height: 0px;"></div>

<script src="<?=u?>assets/js/html2canvas.js"></script>
<script>
$(document).ready(function(){

  
var element = $(".bg"); // global variable
var getCanvas; // global variable
 
    $(".btn-Convert-Html2Image").on('mouseover', function () {
         html2canvas(element, {
         onrendered: function (canvas) {
                $("#previewImage").html(canvas);
                getCanvas = canvas;
             }
         });

         
    });

  $("#btn-Convert-Html2Image").on('click', function () { 
    var imgageData = getCanvas.toDataURL("image/png");
    // Now browser starts downloading it instead of just showing it
    var newData = imgageData.replace(/^data:image\/png/, "data:application/octet-stream");
    $("#btn-Convert-Html2Image").attr("download", "certificado_<?=ln($user->user()->nome)?>.jpg").attr("href", newData);
  });

});

</script>


</body>

</html>