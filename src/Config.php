<?php

namespace Unipago;

class Config
{
    private $nomeEmpresa;
    private $nomeArquivoRetorno;
    private $diretorioArquivos;
    private $ocorrenciasValidas;

    public function __construct()
    {
        $this->setNomeEmpresa('UNIPAGO SOLUCOES COBRANCA LTDA');
        $this->setDiretorioArquivos(__DIR__ . '/../resources/');
        $this->setNomeArquivoRetorno('C12345.RET');
        $this->setOcorrenciasValidas(['06', '09']);
    }

    /**
     * Transforma o objeto em um array associativo
     *
     * @return array
     */
    public function toArray(): array
    {
        return [
            'nomeEmpresa' => $this->getNomeEmpresa(),
            'nomeArquivoRetorno' => $this->getDiretorioArquivos(),
            'diretorioArquivos' => $this->getNomeArquivoRetorno(),
            'ocorrenciasValidas' => $this->getOcorrenciasValidas(),
        ];
    }

    public function getFullPathFile()
    {
        return $this->getDiretorioArquivos() . $this->getNomeArquivoRetorno();
    }

    /**
     * Get the value of nomeEmpresa
     */
    public function getNomeEmpresa()
    {
        return $this->nomeEmpresa;
    }

    /**
     * Set the value of nomeEmpresa
     *
     * @return  self
     */
    public function setNomeEmpresa($nomeEmpresa)
    {
        $this->nomeEmpresa = $nomeEmpresa;

        return $this;
    }

    /**
     * Get the value of nomeArquivoRetorno
     */
    public function getNomeArquivoRetorno()
    {
        return $this->nomeArquivoRetorno;
    }

    /**
     * Set the value of nomeArquivoRetorno
     *
     * @return  self
     */
    public function setNomeArquivoRetorno($nomeArquivoRetorno)
    {
        $this->nomeArquivoRetorno = $nomeArquivoRetorno;

        return $this;
    }

    /**
     * Get the value of diretorioArquivos
     */
    public function getDiretorioArquivos()
    {
        return $this->diretorioArquivos;
    }

    /**
     * Set the value of diretorioArquivos
     *
     * @return  self
     */
    public function setDiretorioArquivos($diretorioArquivos)
    {
        $this->diretorioArquivos = $diretorioArquivos;

        return $this;
    }

    /**
     * Get the value of ocorrenciasValidas
     */
    public function getOcorrenciasValidas()
    {
        return $this->ocorrenciasValidas;
    }

    /**
     * Set the value of ocorrenciasValidas
     *
     * @return  self
     */
    public function setOcorrenciasValidas($ocorrenciasValidas)
    {
        $this->ocorrenciasValidas = $ocorrenciasValidas;

        return $this;
    }
}
