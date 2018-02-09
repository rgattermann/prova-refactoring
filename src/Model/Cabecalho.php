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
    public function getEmpresa()
    {
        return $this->empresa;
    }

    /**
     * Set the value of empresa
     *
     * @return  self
     */
    public function setEmpresa($empresa)
    {
        $this->empresa = $empresa;

        return $this;
    }

    /**
     * Get the value of banco
     */
    public function getBanco()
    {
        return $this->banco;
    }

    /**
     * Set the value of banco
     *
     * @return  self
     */
    public function setBanco($banco)
    {
        $this->banco = $banco;

        return $this;
    }

    /**
     * Get the value of data
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * Set the value of data
     *
     * @return  self
     */
    public function setData($data)
    {
        $this->data = $data;

        return $this;
    }

    public function getFormatedDate()
    {
        $data = $this->getData();
        $formatedDate = '20' . substr($data, 4, 2) . '-' . substr($data, 2, 2)
                        . '-' . substr($data, 0, 2);

        return $formatedDate;
    }

    public function __toString()
    {
        return '#' . $this->getEmpresa() . PHP_EOL .
               '#' . $this->getBanco() . PHP_EOL .
               '#' . $this->getData();
    }
}
