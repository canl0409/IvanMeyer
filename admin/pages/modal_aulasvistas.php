
<div class="modal fade modal-dialog-center" id="mod<?=$pd['alunoId'].$cm['cursoId']?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content-wrap">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Progresso [<?=$cm['titulo']?>]</h4>
                    </div>
                    <div class="modal-body" style="display: grid;">

        
            <?php $qav = $p->lista('aulas_vistas'," where cursoId='$cm[cursoId]' and alunoId ='$pd[alunoId]' "); 
                  foreach ($qav as $pa) {
                  $au =  $p->getRegistro('aulas','aulaId',$pa['aulaId']);
            ?>
            <ul class="list-inline " style="border-bottom: solid 1px #eee;margin-top: 5px;">
            <li class="col-md-9"><?php echo $au['titulo']; ?> </li>
            <li class="col-md-3"> <?=date( 'd/m/Y', strtotime ($pa['data']) );?></li>
            </ul>
            <?php } ?>

            </div>
                        

                    </div>
                     
                </div>
            </div>
        </div>
    </div>