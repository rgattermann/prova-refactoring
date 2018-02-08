<?php

namespace Unipago;

class Config
{
    private $nomeEmpresa;
    private $localArquivo;

    public function __construct()
    {
        $this->setNomeEmpresa('UNIPAGO SOLUCOES COBRANCA LTDA');
        $this->setLocalArquivo(__DIR__ . '/../resources/C12345.RET');
    }

    private function setNomeEmpresa($nome)
    {
        $this->nomeEmpresa = $nome;
        return $this;
    }

    public function getNomeEmpresa()
    {
        return $this->nomeEmpresa;
    }

    private function setLocalArquivo($arquivo)
    {
        $this->localArquivo = trim($arquivo);
        return $this;
    }

    public function getLocalArquivo()
    {
        return $this->localArquivo;
    }

    public function toArray()
    {
        return [
            'empresa' => $this->empresa,
            'local_arquivo' => $this->localArquivo,
        ];
    }
}
