<?php

namespace Unipago\Tests\Reader;

use PHPUnit\Framework\TestCase;
use Unipago\Reader\Corpo;

class CorpoTest extends TestCase
{
    /**
     * @expectedException InvalidArgumentException
     */
    public function testLinhaVazia()
    {
        $line = '';
        $cabecalhoReader = new Corpo($line);
        $cabecalhoReader->readLine();
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testOutroTipoLinha()
    {
        $line = '0000000000000000000       000000000000        UNIPAGO SOLUCOES COBRANCA LTDA000BANCO ITAU S.A.0301180000000000000000000                                                                                                                                                                                                                                                                                   000001';
        $cabecalhoReader = new Corpo($line);
        $cabecalhoReader->readLine();
    }

    public function testLinhaCorpo()
    {
        $line = '10000000000000000000000000000        000000                   61000009            000000000000             I060000000000000   00000000            00000000000000164830000000000000000000012500000000000000000000000000000000000000000000000000000000000000000000000001729500000000009370000000000000   03011800000000000000000000000NOME DO CLIENTE                                                     AA000010';
        $corpoReader = new Corpo($line);
        $corpo = $corpoReader->readLine();

        $esperado = 172.95;
        $this->assertEquals($esperado, $corpo->getCreditado());
    }
}
