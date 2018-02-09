<?php

namespace Unipago\Tests\Reader;

use PHPUnit\Framework\TestCase;
use Unipago\Reader\Rodape;

class RodapeTest extends TestCase
{
    /**
     * @expectedException InvalidArgumentException
     */
    public function testLinhaVazia()
    {
        $line = '';
        $rodapeReader = new Rodape($line);
        $rodapeReader->readLine();
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testOutroTipoLinha()
    {
        $line = '10000000000000000000000000000        000000                   61000026            000000000000             I090000000000000   00000000            00000000000000044520000000000000000000012500000000000000000000000000000000000000000000000000000000000000000000000000432700000000000000000000000000   03011800000000000000000000000NOME DO CLIENTE                                                     AA000027';
        $rodapeReader = new Rodape($line);
        $rodapeReader->readLine();
    }

    public function testLinhaCorpo()
    {
        $line = '9000000          000000000000000000000000000000          000000000000000000000000000000                                                  000000000000000000000000000000          0000000000000000000000  000000000000000000000000001411249                                                                                                                                                                000040';
        $rodapeReader = new Rodape($line);
        $rodape = $rodapeReader->readLine();

        $esperado = 14112.49;
        $this->assertEquals($esperado, $rodape->getTotalArquivo());
    }
}
