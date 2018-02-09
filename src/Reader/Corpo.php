<?php

namespace Unipago\Reader;

use InvalidArgumentException;
use \Unipago\Model\Corpo as CorpoModel;

class Corpo
{
    private $line;

    public function __construct($line)
    {
        if (empty($line)) {
            throw new InvalidArgumentException('A linha do corpo não pode ser vazia!');
        }

        $this->line = $line;
    }

    public function readLine()
    {
        $corpo = new CorpoModel;
        $corpo->setNossoNumero(substr($this->line, 62, 8))
              ->setValorPago(substr($this->line, 152, 13) / 100)
              ->setTarifa(substr($this->line, 175, 13) / 100)
              ->setJuros(substr($this->line, 266, 13) / 100)
              ->setCreditado(substr($this->line, 253, 13) / 100)
              ->setOcorrencia(substr($this->line, 108, 2));

        echo($corpo);
        die;

        $arrayOcorrencias = ['06', '09'];

        if (in_array($ocorrencia, $arrayOcorrencias)) {
            if (number_format($creditado, 2) == number_format($valorPago + $juros - $tarifa, 2)) {
                echo "Pagamento do título $nosso_numero efetuado com sucesso \n";
                ApiPagamentos::baixaTitulo($nosso_numero, $valorPago);
            } else {
                echo "Valor incorreto \n";
            }
        } else {
            echo "Tipo de entrada não encontrado \n";
        }
    }
}
