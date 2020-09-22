<?php

use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\Transaction;

include_once "../../config.php";
include_once "../../class.php";

class GmApi
{
    public $gm;

    public function __construct()
    {
        $this->gm = new gm();
    }

    public function createPayment($paymentId, $alunoId, $buyerEmail, $itemName, $itemNumber, $itemTotalPrice){
        return $this->gm->registraPagamento($paymentId, $alunoId, $buyerEmail, $itemName, $itemNumber, $itemTotalPrice, 1);
    }

    public function createPaymentCurso($paymentId, $alunoId, $buyerEmail, $produtoNome, $cursoId, $itemTotalPrice){
        return $this->gm->registraPagamentoCurso($paymentId, $alunoId, $buyerEmail, $produtoNome, $cursoId, $itemTotalPrice, 1);
    }

    public function assinaPlano($planoId, $alunoId){
        return $this->gm->assinaPlano($planoId, $alunoId);
    }

    public function executePayment($paymentId, $payerId, $amountTotal){
        include_once '../config.php';
        include_once '../paypal-api-context.php';

        $payment = Payment::get($paymentId, $apiContext);

        $execution = new PaymentExecution();
        $execution->setPayerId($payerId);

        $transaction = new Transaction();
        $amount = new Amount();
        $details = new Details();

        $amount->setCurrency($PayPalCurrencyCode);
        $amount->setTotal($amountTotal);
        $amount->setDetails($details);

        $transaction->setAmount($amount);
        
        $execution->addTransaction($transaction);
        try{
            $payment->execute($execution, $apiContext);
            $this->confirmaPagamentoBd($paymentId);
            return true;
        }catch(\Exception $ex){
            return false;
            //return $ex->getData();
        }
    }

    public function confirmaPagamentoBd($paymentId){
        return $this->gm->confirmaPagamentoBd($paymentId);
    }

    public function matriculaCurso($alunoId, $cursoId, $sendEmail = true){
        return $this->gm->matriculaCurso($alunoId, $cursoId, $sendEmail);
    }    
}