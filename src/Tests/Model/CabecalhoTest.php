<?php

namespace Unipago\Tests\Model;

use Unipago\Model\Cabecalho;
use PHPUnit\Framework\TestCase;

class CabecalhoTest extends TestCase
{
    private function criarObjetoPadrao()
    {
        $cabecalho = new Cabecalho;
        $cabecalho->setEmpresa('Empresa do Juca Bala')
                  ->setBanco('Banco do Peixola')
                  ->setData('09022018');

        return $cabecalho;
    }

    public function testEmpresa()
    {
        $esperado = 'Empresa do Juca Bala';
        $this->assertEquals($esperado, $this->criarObjetoPadrao()->getEmpresa(), 0);
    }

    public function testBanco()
    {
        $esperado = 'Banco do Peixola';
        $this->assertEquals($esperado, $this->criarObjetoPadrao()->getBanco(), 0);
    }

    public function testData()
    {
        $esperado = '09022018';
        $this->assertEquals($esperado, $this->criarObjetoPadrao()->getData(), 0);
    }
}
