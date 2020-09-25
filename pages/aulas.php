<div class="title">
    Escolha por onde começar
</div>
<section class="video-curso">
    <div id="videoApresentacao" class="embed-responsive embed-responsive-16by9">
        <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/UFw5aLZUl-8"></iframe>
    </div>
</section>
<section class="tabela-curso mb-5 mt-4">
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-6 col-lg-3">
                <input type="radio" name="nivelCurso" id="nivel-1" class="radio-nivel nivel1" checked>
                <label for="nivel-1">
                    <img class="mr-2" src="<?= URL_IMG ?>/nivel1.webp" alt="Iniciante">
                    Iniciante
                </label>
            </div>
            <div class="col-12 col-md-6 col-lg-3">
                <input type="radio" name="nivelCurso" id="nivel-2" class="radio-nivel nivel2">
                <label for="nivel-2">
                    <img class="mr-2" src="<?= URL_IMG ?>/nivel2.webp" alt="Intermediário 1">
                    Intermediário 1
                </label>
            </div>
            <div class="col-12 col-md-6 col-lg-3">
                <input type="radio" name="nivelCurso" id="nivel-3" class="radio-nivel nivel3">
                <label for="nivel-3">
                    <img class="mr-2" src="<?= URL_IMG ?>/nivel3.webp" alt="Intermediário 2">
                    Intermediário 2
                </label>
            </div>
            <div class="col-12 col-md-6 col-lg-3">
                <input type="radio" name="nivelCurso" id="nivel-4" class="radio-nivel nivel4">
                <label for="nivel-4">
                    <img class="mr-2" src="<?= URL_IMG ?>/nivel4.webp" alt="Avançado">
                    Avançado
                </label>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-12 col-lg-3 mb-4">
                <div class="list-group" id="list-tab" role="tablist">
                    <a class="list-group-item list-group-item-action active" id="list-curso1-list" data-toggle="list" href="#list-curso1" role="tab" aria-controls="curso1">Curso 1</a>
                    <a class="list-group-item list-group-item-action" id="list-curso2-list" data-toggle="list" href="#list-curso2" role="tab" aria-controls="curso2">Curso 2</a>
                    <a class="list-group-item list-group-item-action" id="list-curso3-list" data-toggle="list" href="#list-curso3" role="tab" aria-controls="curso3">Curso 3</a>
                    <a class="list-group-item list-group-item-action" id="list-curso4-list" data-toggle="list" href="#list-curso4" role="tab" aria-controls="curso4">Curso 4</a>
                </div>
            </div>
            <div class="col-12 col-lg-9">
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="list-curso1" role="tabpanel" aria-labelledby="list-curso1-list">
                        <div class="table-responsive tabela-aulas">
                            <table class="table table-sm">
                                <thead>
                                    <tr>
                                        <th scope="col" class="border-top-0">#</th>
                                        <th scope="col" class="border-top-0">First</th>
                                        <th scope="col" class="border-top-0">Last</th>
                                        <th scope="col" class="border-top-0">Handle</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>Mark</td>
                                        <td>Otto</td>
                                        <td>@mdo</td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>Jacob</td>
                                        <td>Thornton</td>
                                        <td>@fat</td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>Larry the Bird</td>
                                        <td>@twitter</td>
                                        <td>@twitter</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="list-curso2" role="tabpanel" aria-labelledby="list-curso2-list">
                        Tabela 2
                    </div>
                    <div class="tab-pane fade" id="list-curso3" role="tabpanel" aria-labelledby="list-curso3-list">
                        Tabela 3
                    </div>
                    <div class="tab-pane fade" id="list-curso4" role="tabpanel" aria-labelledby="list-curso4-list">
                        Tabela 4
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="newsletter">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-md-7 my-2">
                <input type="email" class="form-control w-100" name="email-newsletter" placeholder="Cadastre aqui seu e-mail para receber novidades...">
            </div>
            <div class="col-12 col-md-2 my-2">
                <button type="button" class="btn-outline-branco">Cadastrar</button>
            </div>
        </div>
    </div>
</section>
