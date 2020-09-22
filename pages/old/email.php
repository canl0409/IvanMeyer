<?php
$dados['nome'] = "Joaozinho";
echo "<br/><br/><h1>teste de email</h1><br/><br/>";

include_once('class.php');
$gm = new gm();
$gm->email("niltonmorais.code@gmail.com", null, null, "cadastro",$dados);


echo "<br/><br/><h1>rodou</h1><br/><br/>";

