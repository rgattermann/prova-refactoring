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
        $this->setLocalArquivo(__DIR__ . '/../resources/C12345.RET');
        $this->setOcorrenciasValidas(['06', '09']);
    }

    public function toArray(): array
    {
        return [
            'empresa' => $this->empresa,
            'local_arquivo' => $this->localArquivo,
        ];
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
     * Get the value of localArquivo
     */
    public function getLocalArquivo()
    {
        return $this->localArquivo;
    }

    /**
     * Set the value of localArquivo
     *
     * @return  self
     */
    public function setLocalArquivo($localArquivo)
    {
        $this->localArquivo = $localArquivo;

        return $this;
    }
}
