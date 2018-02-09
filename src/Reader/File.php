<?php

namespace Unipago\Reader;

use SplFileObject;
use InvalidArgumentException;
use Unipago\Base\IdentificadorLinha;
use Unipago\Base\Log;
use Unipago\Reader\Cabecalho as CabecalhoReader;
use Unipago\Reader\Corpo as CorpoReader;
use Unipago\Reader\Rodape as RodapeReader;
use Unipago\Model\ArquivoRetorno;

class File
{
    private $filename;

    public function __construct($filename)
    {
        if (empty($filename)) {
            throw new InvalidArgumentException('O arquivo ' . $filename . ' não pode ser vazio!');
        }

        if (!file_exists($filename)) {
            throw new InvalidArgumentException('Arquivo não encontrado: ' . $filename);
        }

        if (!is_readable($filename)) {
            throw new InvalidArgumentException('Arquivo não possui permissão para leitura: ' . $filename);
        }

        $this->filename = $filename;
    }

    /**
     * Realiza a tradução de um arquivo texto para objetos
     *
     * @return ArquivoRetorno
     */
    public function read(): ArquivoRetorno
    {
        $arquivoRetorno = new ArquivoRetorno;

        $file = new SplFileObject($this->filename, 'r');
        Log::debug('Arquivo carregado com sucesso para a memória', [$this->filename]);

        while (!$file->eof()) {
            $line = trim($file->fgets());

            if (!empty($line)) {
                $typeLine = IdentificadorLinha::identify($line);

                if ($typeLine === 'CABECALHO') {
                    $cabecalhoReader = new CabecalhoReader($line);
                    $arquivoRetorno->setCabecalho($cabecalhoReader->readLine());
                    continue;
                } elseif ($typeLine === 'CORPO') {
                    $corpoReader = new CorpoReader($line);
                    $arquivoRetorno->addCorpo($corpoReader->readLine());
                    continue;
                } else {
                    $rodapeReader = new RodapeReader($line);
                    $arquivoRetorno->setRodape($rodapeReader->readLine());
                }
            } else {
                Log::debug('Linha vazia identificada, leitura desta não realizada');
            }
        }

        return $arquivoRetorno;
    }
}
