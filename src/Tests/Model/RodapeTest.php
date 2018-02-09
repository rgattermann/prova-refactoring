<?php

namespace Unipago\Tests\Model;

use PHPUnit\Framework\TestCase;
use Unipago\Model\Rodape;

class RodapeTest extends TestCase
{
    private function criarObjetoPadrao()
    {
        $rodape = new Rodape;
        $rodape->setTotalArquivo(7634.12);

        return $rodape;
    }

    public function testTotalArquivo()
    {
        $esperado = 7634.12;
        $this->assertEquals($esperado, $this->criarObjetoPadrao()->getTotalArquivo(), 0);
    }

    public function testTotalArquivoFormated()
    {
        $esperado = '7,634.12';
        $this->assertEquals($esperado, $this->criarObjetoPadrao()->getTotalArquivoFormated(), 0);
    }
}
