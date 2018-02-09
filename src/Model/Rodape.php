<?php

namespace Unipago\Model;

class Rodape
{
    private $totalArquivo;

    /**
     * Get the value of totalArquivo
     */
    public function getTotalArquivo(): float
    {
        return $this->totalArquivo;
    }

    /**
     * Get the value of totalArquivo formated
     */
    public function getTotalArquivoFormated(): string
    {
        return number_format($this->getTotalArquivo(), 2);
    }

    /**
     * Set the value of totalArquivo
     *
     * @return  self
     */
    public function setTotalArquivo(float $totalArquivo)
    {
        $this->totalArquivo = $totalArquivo;

        return $this;
    }
}
