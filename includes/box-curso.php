 <?php
  $inst = $gm->obj('instrutores','instrutorId',$cs['instrutorId'],1);
  $opn = $gm->obj('opinioes','cursoId',$cs['cursoId']);
  $alunos = $gm->obj('cursos_matriculas','cursoId',$cs['cursoId']);

   ?>

  <div class="course-item col-md-3 only-desktop">
    <div class="course-grid-3 lp_course type-lp_course status-publish has-post-thumbnail hentry course_category-backend pmpro-has-access course">

      <div class="course-item">


<?php if($cs['thumb'] != ''){ ?>
      <div class="course-thumbnail" style="background-image: url('<?=u?>assets/imgs/cursos/<?=$cs['thumb']?>')">
<?php }else{  ?>
      <div class="course-thumbnail" style="background-image: url('<?=u?>assets/imgs/thumb.png')">
<?php } ?>

     <a class="thumb" href="<?=u?>curso-de-musica-online/<?=ln($cs['titulo'])?>">


    </a><a class="course-readmore" href="<?=u?>curso-de-musica-online/<?=ln($cs['titulo'])?>" onclick="return btnAbrirCurso('<?=($cs['titulo'])?>')">Leia Mais</a></div>
        <div class="thim-course-content">


          <div class="course-author" itemscope="" itemtype="http://schema.org/Person">
            <img alt="" src="<?=u?>assets/imgs/team/<?=$inst->foto?>"  class="avatar avatar-40 photo" width="40" height="40">    <div class="author-contain">
            <div class="value" itemprop="name">
              <a href="#"><?=$inst->nome?></a>        </div>
            </div>
          </div>
          <h2 class="course-title"><a href="<?=u?>curso-de-musica-online/<?=ln($cs['titulo'])?>" rel="bookmark" onclick="return btnAbrirCurso('<?=($cs['titulo'])?>')">
          <?=$cs['titulo']?></a>
          </h2>
          <div class="course-meta">

          <div class="course-author" itemscope="" itemtype="http://schema.org/Person">
            <img alt="" src="http://0.gravatar.com/avatar/c1fc3551b4d32249d32d4b04c7726cdf?s=40&amp;d=mm&amp;r=g" srcset="http://0.gravatar.com/avatar/c1fc3551b4d32249d32d4b04c7726cdf?s=80&amp;d=mm&amp;r=g 2x" class="avatar avatar-40 photo" width="40" height="40">    <div class="author-contain">
            <div class="value" itemprop="name">
              <a href="http://agenciadigitaldk.com.br/ead/profile/dkead/">Instrutor</a></div>
            </div>
          </div>
          <div class="course-review">
          <label>Review</label>
          <div class="value">
            <span>(0 review)</span>
          </div>
        </div>

        <div class="course-students">
          <label>Estudantes</label>
          <div class="value"><i class="fas fa-users"></i>
            <?=$gm->countMatriculados($cs['cursoId']) + $cs['acrescentar']?>
          </div>
        </div>

          <div class="course-comments-count">
            <div class="value"><i class="fa fa-comment"></i>
              <?=$gm->countOpnioes($cs['cursoId'])?>
            </div>
          </div>

          <div class="course-price" itemprop="offers" itemscope="" itemtype="http://schema.org/Offer">
            <div class="value  has-origin" itemprop="price"><?php if($page != 'home'){ echo money($cs['valor']); }?></div>
              <meta itemprop="priceCurrency" content="BRL">
            </div>
            </div>

            <div class="course-description">
              <p><?=$cs['titulo']?></p>
            </div>

              <div class="course-price" itemprop="offers" itemscope="" itemtype="http://schema.org/Offer">
                <div class="value  has-origin" itemprop="price"><?=money($cs['valor'])?></div>
                  <meta itemprop="priceCurrency" content="BRL">
                </div>            <div class="course-readmore">
                <a href="<?=u?>curso-de-musica-online/<?=ln($cs['titulo'])?>">Leia Mais</a>
              </div>
            </div>
          </div>
        </div>
      </div>
