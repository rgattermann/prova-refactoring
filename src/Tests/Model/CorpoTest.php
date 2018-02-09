<?php

namespace Unipago\Tests\Model;

use PHPUnit\Framework\TestCase;
use Unipago\Model\Corpo;

class CorpoTest extends TestCase
{
    private function criarObjetoPadrao()
    {
        $corpo = new Corpo;
        $corpo->setNossoNumero('61000012')
              ->setValorPago(695.19)
              ->setTarifa(1.25)
              ->setJuros(0)
              ->setCreditado(693.94)
              ->setOcorrencia('06');
        return $corpo;
    }

    public function testTotalPago()
    {
        $esperado = 693.94;
        $this->assertEquals($esperado, $this->criarObjetoPadrao()->getTotalPago(), 0);
    }

    public function testTotalPagoFormated()
    {
        $esperado = '693.94';
        $this->assertEquals($esperado, $this->criarObjetoPadrao()->getTotalPagoFormated(), 0);
    }

    public function testCreditadoFormated()
    {
        $esperado = '693.94';
        $this->assertEquals($esperado, $this->criarObjetoPadrao()->getCreditadoFormated(), 0);
    }

    public function testValidaPagamento()
    {
        $esperado = true;
        $corpo = $this->criarObjetoPadrao();
        $this->assertEquals($esperado, ($corpo->getCreditadoFormated() == $corpo->getTotalPagoFormated()), 0);
    }
}
