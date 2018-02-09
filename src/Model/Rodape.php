<?php

namespace Unipago\Model;

class Rodape
{
    private $totalArquivo;

    /**
     * Get the value of totalArquivo
     */
    public function getTotalArquivo()
    {
        return $this->totalArquivo;
    }

    /**
     * Set the value of totalArquivo
     *
     * @return  self
     */
    public function setTotalArquivo($totalArquivo)
    {
        $this->totalArquivo = $totalArquivo;

        return $this;
    }
}
