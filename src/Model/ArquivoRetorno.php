<?php

namespace Unipago\Model;

use Unipago\Model\Cabecalho;
use Unipago\Model\Corpo;
use Unipago\Model\Rodape;

class ArquivoRetorno
{
    private $cabecalho;
    private $corpos = [];
    private $rodape;

    /**
     * Get the value of cabecalho
     */
    public function getCabecalho(): Cabecalho
    {
        return $this->cabecalho;
    }

    /**
     * Set the value of cabecalho
     *
     * @return  self
     */
    public function setCabecalho(Cabecalho $cabecalho)
    {
        $this->cabecalho = $cabecalho;

        return $this;
    }

    /**
     * Get the value of corpos
     *
     * @return Corpo[]
     */
    public function getCorpos(): array
    {
        return $this->corpos;
    }

    /**
     * Set the value of corpos
     *
     * @return  self
     */
    public function addCorpo(Corpo $corpo)
    {
        $this->corpos[] = $corpo;

        return $this;
    }

    /**
     * Get the value of rodape
     */
    public function getRodape(): Rodape
    {
        return $this->rodape;
    }

    /**
     * Set the value of rodape
     *
     * @return  self
     */
    public function setRodape(Rodape $rodape)
    {
        $this->rodape = $rodape;

        return $this;
    }
}
