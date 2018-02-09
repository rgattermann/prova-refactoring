<?php

namespace Unipago\Model;

class Corpo
{
    private $nossoNumero;
    private $valorPago;
    private $tarifa;
    private $juros;
    private $creditado;
    private $ocorrencia;

    /**
     * Get the value of nossoNumero
     */
    public function getNossoNumero(): string
    {
        return $this->nossoNumero;
    }

    /**
     * Set the value of nossoNumero
     *
     * @return  self
     */
    public function setNossoNumero(string $nossoNumero)
    {
        $this->nossoNumero = $nossoNumero;

        return $this;
    }

    /**
     * Get the value of valorPago
     */
    public function getValorPago(): float
    {
        return $this->valorPago;
    }

    /**
     * Set the value of valorPago
     *
     * @return  self
     */
    public function setValorPago(float $valorPago)
    {
        $this->valorPago = $valorPago;

        return $this;
    }

    /**
     * Get the value of tarifa
     */
    public function getTarifa(): string
    {
        return $this->tarifa;
    }

    /**
     * Set the value of tarifa
     *
     * @return  self
     */
    public function setTarifa(string $tarifa)
    {
        $this->tarifa = $tarifa;

        return $this;
    }

    /**
     * Get the value of juros
     */
    public function getJuros(): float
    {
        return $this->juros;
    }

    /**
     * Set the value of juros
     *
     * @return  self
     */
    public function setJuros(float $juros)
    {
        $this->juros = $juros;

        return $this;
    }

    /**
     * Get the value of creditado
     */
    public function getCreditado(): float
    {
        return $this->creditado;
    }

    /**
     * Set the value of creditado
     *
     * @return  self
     */
    public function setCreditado(float $creditado)
    {
        $this->creditado = $creditado;

        return $this;
    }

    /**
     * Get the value of ocorrencia
     */
    public function getOcorrencia(): string
    {
        return $this->ocorrencia;
    }

    /**
     * Set the value of ocorrencia
     *
     * @return  self
     */
    public function setOcorrencia(string $ocorrencia)
    {
        $this->ocorrencia = $ocorrencia;

        return $this;
    }

    public function getTotalPago(): float
    {
        return $this->getValorPago() + $this->getJuros() - $this->getTarifa();
    }

    public function validapagamento(): bool
    {
        //if (number_format($creditado, 2) == number_format($valorPago + $juros - $tarifa, 2)) {
        return ($this->getCreditado() == $this->getTotalPago());
    }

    public function __toString()
    {
        return '#' . $this->getNossoNumero() . PHP_EOL .
               '#' . $this->getValorPago() . PHP_EOL .
               '#' . $this->getTarifa() . PHP_EOL .
               '#' . $this->getJuros() . PHP_EOL .
               '#' . $this->getCreditado() . PHP_EOL .
               '#' . $this->getOcorrencia();
    }
}
