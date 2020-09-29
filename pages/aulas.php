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
                <div class="list-group lista-cursos" id="list-tab" role="tablist">
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
                                <tbody>
                                    <tr>
                                        <td class="border-top-0">
                                            <i class="fab fa-youtube cor-vermelha mr-2"></i> Aula 1 <label class="nome-aula-tabela ml-5">Nome da aula 1</label>
                                        </td>
                                        <td class="border-top-0 cor-amarela">
                                            <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                                        </td>
                                        <td class="border-top-0">
                                            <a class="link" href="">Descrição</a>
                                        </td>
                                        <td class="border-top-0">
                                            <div class="badge-aulas-free">Grátis</div>
                                        </td>
                                        <td class="border-top-0 text-right">
                                            5:00 min
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <i class="fab fa-youtube cor-vermelha mr-2"></i> Aula 2 <label class="nome-aula-tabela ml-5">Nome da aula 2</label>
                                        </td>
                                        <td class="cor-amarela"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></td>
                                        <td>
                                            <a class="link" href="">Descrição</a>
                                        </td>
                                        <td></td>
                                        <td class="text-right">
                                            5:00 min
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <i class="fab fa-youtube cor-vermelha mr-2"></i> Aula 3 <label class="nome-aula-tabela ml-5">Nome da aula 3</label>
                                        </td>
                                        <td class="cor-amarela"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></td>
                                        <td>
                                            <a class="link" href="">Descrição</a>
                                        </td>
                                        <td>
                                            <div class="badge-aulas-free">Grátis</div>
                                        </td>
                                        <td class="text-right">
                                            5:00 min
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="list-curso2" role="tabpanel" aria-labelledby="list-curso2-list">
                        <div class="table-responsive tabela-aulas">
                            <table class="table table-sm">
                                <tbody>
                                    <tr>
                                        <td class="border-top-0">
                                            <i class="fab fa-youtube cor-vermelha mr-2"></i> Aula 1 <label class="nome-aula-tabela ml-5">Nome da aula 1</label>
                                        </td>
                                        <td class="border-top-0 cor-amarela">
                                            <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                                        </td>
                                        <td class="border-top-0">
                                            <a class="link" href="">Descrição</a>
                                        </td>
                                        <td class="border-top-0">
                                            <div class="badge-aulas-free">Grátis</div>
                                        </td>
                                        <td class="border-top-0 text-right">
                                            5:00 min
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <i class="fab fa-youtube cor-vermelha mr-2"></i> Aula 2 <label class="nome-aula-tabela ml-5">Nome da aula 2</label>
                                        </td>
                                        <td class="cor-amarela"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></td>
                                        <td>
                                            <a class="link" href="">Descrição</a>
                                        </td>
                                        <td></td>
                                        <td class="text-right">
                                            5:00 min
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <i class="fab fa-youtube cor-vermelha mr-2"></i> Aula 3 <label class="nome-aula-tabela ml-5">Nome da aula 3</label>
                                        </td>
                                        <td class="cor-amarela"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></td>
                                        <td>
                                            <a class="link" href="">Descrição</a>
                                        </td>
                                        <td>
                                            <div class="badge-aulas-free">Grátis</div>
                                        </td>
                                        <td class="text-right">
                                            5:00 min
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="list-curso3" role="tabpanel" aria-labelledby="list-curso3-list">
                        <div class="table-responsive tabela-aulas">
                            <table class="table table-sm">
                                <tbody>
                                    <tr>
                                        <td class="border-top-0">
                                            <i class="fab fa-youtube cor-vermelha mr-2"></i> Aula 1 <label class="nome-aula-tabela ml-5">Nome da aula 1</label>
                                        </td>
                                        <td class="border-top-0 cor-amarela">
                                            <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                                        </td>
                                        <td class="border-top-0">
                                            <a class="link" href="">Descrição</a>
                                        </td>
                                        <td class="border-top-0">
                                            <div class="badge-aulas-free">Grátis</div>
                                        </td>
                                        <td class="border-top-0 text-right">
                                            5:00 min
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <i class="fab fa-youtube cor-vermelha mr-2"></i> Aula 2 <label class="nome-aula-tabela ml-5">Nome da aula 2</label>
                                        </td>
                                        <td class="cor-amarela"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></td>
                                        <td>
                                            <a class="link" href="">Descrição</a>
                                        </td>
                                        <td></td>
                                        <td class="text-right">
                                            5:00 min
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <i class="fab fa-youtube cor-vermelha mr-2"></i> Aula 3 <label class="nome-aula-tabela ml-5">Nome da aula 3</label>
                                        </td>
                                        <td class="cor-amarela"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></td>
                                        <td>
                                            <a class="link" href="">Descrição</a>
                                        </td>
                                        <td>
                                            <div class="badge-aulas-free">Grátis</div>
                                        </td>
                                        <td class="text-right">
                                            5:00 min
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="list-curso4" role="tabpanel" aria-labelledby="list-curso4-list">
                        <div class="table-responsive tabela-aulas">
                            <table class="table table-sm">
                                <tbody>
                                    <tr>
                                        <td class="border-top-0">
                                            <i class="fab fa-youtube cor-vermelha mr-2"></i> Aula 1 <label class="nome-aula-tabela ml-5">Nome da aula 1</label>
                                        </td>
                                        <td class="border-top-0 cor-amarela">
                                            <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                                        </td>
                                        <td class="border-top-0">
                                            <a class="link" href="">Descrição</a>
                                        </td>
                                        <td class="border-top-0">
                                            <div class="badge-aulas-free">Grátis</div>
                                        </td>
                                        <td class="border-top-0 text-right">
                                            5:00 min
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <i class="fab fa-youtube cor-vermelha mr-2"></i> Aula 2 <label class="nome-aula-tabela ml-5">Nome da aula 2</label>
                                        </td>
                                        <td class="cor-amarela"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></td>
                                        <td>
                                            <a class="link" href="">Descrição</a>
                                        </td>
                                        <td></td>
                                        <td class="text-right">
                                            5:00 min
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <i class="fab fa-youtube cor-vermelha mr-2"></i> Aula 3 <label class="nome-aula-tabela ml-5">Nome da aula 3</label>
                                        </td>
                                        <td class="cor-amarela"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></td>
                                        <td>
                                            <a class="link" href="">Descrição</a>
                                        </td>
                                        <td>
                                            <div class="badge-aulas-free">Grátis</div>
                                        </td>
                                        <td class="text-right">
                                            5:00 min
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
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
