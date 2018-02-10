<?php

namespace Unipago\Tests\Model;

use PHPUnit\Framework\TestCase;
use Unipago\Model\ArquivoRetorno;
use Unipago\Model\Corpo;
use Unipago\Model\Cabecalho;
use Unipago\Model\Rodape;

class ArquivoRetornoTest extends TestCase
{
    private function criarObjetoPadrao()
    {
        $cabecalho = new Cabecalho;
        $cabecalho->setEmpresa('Empresa do Juca Bala')
                  ->setBanco('Banco do Peixola')
                  ->setData('09022018');

        $corpo = new Corpo;
        $corpo->setNossoNumero('61000012')
              ->setValorPago(695.19)
              ->setTarifa(1.25)
              ->setJuros(0)
              ->setCreditado(693.94)
              ->setOcorrencia('06');

        $rodape = new Rodape;
        $rodape->setTotalArquivo(7634.12);

        $arquivoRetorno = new ArquivoRetorno();
        $arquivoRetorno->setCabecalho($cabecalho);
        $arquivoRetorno->addCorpo($corpo);
        $arquivoRetorno->setRodape($rodape);

        return $arquivoRetorno;
    }

    public function testTotalPago()
    {
        $esperado = 693.94;
        $corpo = $this->criarObjetoPadrao()->getCorpos()[0];
        $this->assertEquals($esperado, $corpo->getTotalPago(), 0);
    }

    public function testTotalPagoFormated()
    {
        $esperado = '693.94';
        $corpo = $this->criarObjetoPadrao()->getCorpos()[0];
        $this->assertEquals($esperado, $corpo->getTotalPagoFormated(), 0);
    }

    public function testCreditadoFormated()
    {
        $esperado = '693.94';
        $corpo = $this->criarObjetoPadrao()->getCorpos()[0];
        $this->assertEquals($esperado, $corpo->getCreditadoFormated(), 0);
    }

    public function testValidaPagamento()
    {
        $esperado = true;
        $corpo = $this->criarObjetoPadrao()->getCorpos()[0];
        $this->assertEquals($esperado, ($corpo->getCreditadoFormated() == $corpo->getTotalPagoFormated()), 0);
    }

    public function testEmpresa()
    {
        $esperado = 'Empresa do Juca Bala';
        $cabecalho = $this->criarObjetoPadrao()->getCabecalho();
        $this->assertEquals($esperado, $cabecalho->getEmpresa(), 0);
    }

    public function testBanco()
    {
        $esperado = 'Banco do Peixola';
        $cabecalho = $this->criarObjetoPadrao()->getCabecalho();

        $this->assertEquals($esperado, $cabecalho->getBanco(), 0);
    }

    public function testData()
    {
        $esperado = '09022018';
        $cabecalho = $this->criarObjetoPadrao()->getCabecalho();

        $this->assertEquals($esperado, $cabecalho->getData(), 0);
    }

    public function testTotalArquivo()
    {
        $esperado = 7634.12;
        $rodape = $this->criarObjetoPadrao()->getRodape();
        $this->assertEquals($esperado, $rodape->getTotalArquivo(), 0);
    }

    public function testTotalArquivoFormated()
    {
        $esperado = '7,634.12';
        $rodape = $this->criarObjetoPadrao()->getRodape();
        $this->assertEquals($esperado, $rodape->getTotalArquivoFormated(), 0);
    }
}
