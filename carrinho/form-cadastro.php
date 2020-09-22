<?php $aluno = $user->user(); ?>

			<?php if(!$aluno){  // não está logado ?>
			<span class="form-text text-muted mb-16" style="text-size: 3px"> 
	            Se não possui cadastro conosco, preencha os dados abaixo
			</span><br>
			<?php } ?>

            <p><?= $aluno ? "Confirme seus dados" : "Faça seu cadastro" ?></p>
            </div>
            <form method="post">
            	<div class="col-md-6">
				<div class="form-group">
					<label>Nome</label>
                 	<input value="<?=$user->user()->nome?>" type="text" name="nome" class="form-control" placeholder="Nome" required>
				</div>
				</div>

            	<div class="col-md-6">
				<div class="form-group">
					<label>Sobrenome</label>
                    <input value="<?=$user->user()->sobrenome?>" type="text" name="sobrenome" class="form-control" placeholder="Sobrenome" required>
				</div>
				</div>

            	<div class="col-md-12">
				<div class="form-group">
					<label>Endereço</label>
                	<input value="<?=$user->user()->endereco?>" type="text" name="endereco" class="form-control mb-2" placeholder="Endereço" required>
				</div>
				</div>

            	<div class="col-md-12">
				<div class="form-group">
                	<label for="">Email</label>
                	<input value="<?=$user->user()->email?>" type="email" name="email" class="form-control mb-2" placeholder="E-mail" required>
				</div>
				</div>

            	<div class="col-md-6">
				<div class="form-group">
					<label>CPF</label>
                	<input value="<?=$user->user()->cpf?>" type="text" name="cpf" class="form-control mb-2" placeholder="CPF" required>
				</div>
				</div>

            	<div class="col-md-6">
				<div class="form-group">
                	<label>Celular</label>
                	<input value="<?=$user->user()->celular?>" type="text" name="celular" class="form-control mb-2" placeholder="Celular" aria-describedby="defaultRegisterFormPhoneHelpBlock" required>
				</div>
				</div>

				<?php if($aluno){  // está logado ?>
					<div class="col-md-12">
						<hr/>
						<h5>Possui algum cupom de desconto?</h5>
						<div class="form-group">
							<label>Cupom</label>
							<input value="<?=$cupomCode?>" type="text" name="cupom" class="form-control mb-2" placeholder="Cupom" aria-describedby="defaultRegisterFormPhoneHelpBlock">
						</div>
					</div>

				<?php }else{ // não está logado ?>
					<div class="col-md-6">				
					<div class="form-group">
						<label for="">Senha</label>
						<input type="password" name="senha" class="form-control" placeholder="senha" aria-describedby="defaultRegisterFormPasswordHelpBlock" required>
						<small id="defaultRegisterFormPasswordHelpBlock" class="form-text text-muted mb-2">
							No minimo 8 caracteres
						</small>
					</div>
					</div>

					<div class="col-md-6">
					<div class="form-group">
						<label for="">Confirme a senha</label>
						<input type="password" name="senha2" class="form-control mb-2" placeholder="Confirme a senha" aria-describedby="defaultRegisterFormPasswordHelpBlock" required>
					</div>
					</div>
				<?php } ?>

				<div class="form-group">
				
				<?php

				$url = str_replace("/carrinho/", "", $_SERVER["REQUEST_URI"]);
				$carrinho = substr($url, 0, strpos($url, ".php"));

				if ($code == '1') {
					?>
					
                	<button type="submit" class="btn btn-danger btn-block">AVANÇAR</button>
				<?php 
				} elseif ($carrinho == "view_cart") {
					?>

	                <button class="btn btn-danger btn-block" type="submit"><a href="paypal-express-checkout/index_cursos.php">AVANÇAR</a></button>		

					<?php
				} else {
					?>

                	<!--<button class="btn btn-danger btn-block" type="submit"><a href="paypal-express-checkout/index_planos.php">AVANÇAR</a></button>-->
                	<button class="btn btn-danger btn-block" type="submit">AVANÇAR</button>

				<?php 
				}

				?>

				</div>
                <hr>

            </form> 