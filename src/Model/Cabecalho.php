<?php

namespace Unipago\Model;

class Cabecalho
{
    private $empresa;
    private $banco;
    private $data;

    /**
     * Get the value of empresa
     */
    public function getEmpresa(): string
    {
        return $this->empresa;
    }

    /**
     * Set the value of empresa
     *
     * @return  self
     */
    public function setEmpresa(string $empresa)
    {
        $this->empresa = $empresa;

        return $this;
    }

    /**
     * Get the value of banco
     */
    public function getBanco(): string
    {
        return $this->banco;
    }

    /**
     * Set the value of banco
     *
     * @return  self
     */
    public function setBanco(string $banco)
    {
        $this->banco = $banco;

        return $this;
    }

    /**
     * Get the value of data
     */
    public function getData(): string
    {
        return $this->data;
    }

    /**
     * Set the value of data
     *
     * @return  self
     */
    public function setData(string $data)
    {
        $this->data = $data;

        return $this;
    }

    /**
     * Retorna a data de importação do arquivo formatada
     *
     * @return  string
     */
    public function getFormatedDate(): string
    {
        $data = $this->getData();
        $formatedDate = '20' . substr($data, 4, 2) . '-' . substr($data, 2, 2)
                        . '-' . substr($data, 0, 2);

        return $formatedDate;
    }

    /**
     * Retorna os atributos do objeto textualmente
     *
     * @return  self
     */
    public function __toString()
    {
        return '#' . $this->getEmpresa() . PHP_EOL .
               '#' . $this->getBanco() . PHP_EOL .
               '#' . $this->getData();
    }
}
