<?php
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

require_once '../vendor/autoload.php';
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
$app = new Silex\Application();

$app->before(function (Request $request) {
    if (0 === strpos($request->headers->get('Content-Type'), 'application/json')) {
        $data = json_decode($request->getContent(), true);
        $request->request->replace(is_array($data) ? $data : array());
    }
});

$app->post('payment/success', function (Request $request) use ($app) {
    $data = $request->request->all();
    require "GmApi.php";
    $gm = new GmApi();
    $gm->createPayment($data['paymentId'], $data['alunoId'], $data['buyerEmail'], $data['itemName'], $data['itemNumber'], $data['itemTotalPrice']);
    if($gm->executePayment($data['paymentId'], $data['payerId'], $data['itemTotalPrice'])){
        $gm->assinaPlano($data['itemNumber'], $data['alunoId']);
        return new Response("", 204);
    }
    return new Response("Erro ao executar pagamento", 502);
});

$app->post('payment/cursos/success', function (Request $request) use ($app) {
    $data = $request->request->all();
    require "GmApi.php";
    $gm = new GmApi();
    $gm->createPaymentCurso($data['paymentId'], $data['alunoId'], $data['buyerEmail'], $data['cursoName'], $data['cursoId'], $data['itemTotalPrice']);
    if($gm->executePayment($data['paymentId'], $data['payerId'], $data['itemTotalPrice'])){
        if($data['cursoId'] != ""){
            $gm->matriculaCurso($data['alunoId'], $data['cursoId']);
        }else{
            $cursosIds = explode(",",$data['cursosIds']);
            foreach($cursosIds as $cursoId){
                $gm->matriculaCurso($data['alunoId'], $cursoId, false);
            }
        }
       
        return new Response("", 204);
    }

    return new Response("Erro ao executar pagamento", 502);
});

$app->match("{uri}", function($uri){
    return "OK";
})
->assert('uri', '.*')
->method("OPTIONS");
$app->run();