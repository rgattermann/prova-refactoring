<?php

namespace Unipago\Tests\Reader;

use PHPUnit\Framework\TestCase;
use Unipago\Reader\Cabecalho;

class CabecalhoTest extends TestCase
{
    /**
     * @expectedException InvalidArgumentException
     */
    public function testLinhaVazia()
    {
        $line = '';
        $cabecalhoReader = new Cabecalho($line);
        $cabecalhoReader->readLine();
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testOutroTipoLinha()
    {
        $line = '10000000000000000000000000000        000000                   61000010            000000000000             I060000000000000   00000000            00000000000000069000000000000000000000012500000000000000000000000000000000000000000000000000000000000000000000000000677500000000000000000000000000   03011800000000000000000000000NOME DO CLIENTE                                                     AA000011';
        $cabecalhoReader = new Cabecalho($line);
        $cabecalhoReader->readLine();
    }

    public function testLinhaCorpo()
    {
        $line = '0000000000000000000       000000000000        UNIPAGO SOLUCOES COBRANCA LTDA000BANCO ITAU S.A.0301180000000000000000000                                                                                                                                                                                                                                                                                   000001';
        $cabecalhoReader = new Cabecalho($line);
        $cabecalho = $cabecalhoReader->readLine();

        $esperado = 'BANCO ITAU S.A.';
        $this->assertEquals($esperado, $cabecalho->getBanco());
    }
}
