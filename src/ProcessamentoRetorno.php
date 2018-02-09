<?php 

namespace Unipago;

use Unipago\Reader\File as FileReader;
use Unipago\Base\Log;
use Exception;

class ProcessamentoRetorno
{
    protected $config;

    public function __construct(Config $config)
    {
        $this->config = $config;
        Log::info('Iniciando processamento de leitura do arquivo de retorno');
    }

    public function processar()
    {
        try {
            Log::info('Realizando a leitura do arquivo: ' . $this->config->getLocalArquivo());

            $fileReader = new FileReader($this->config->getLocalArquivo());
            $arquivoRetorno = $fileReader->read();

            Log::info('Data do arquivo: ' . $arquivoRetorno->getCabecalho()->getFormatedDate());

            if ($arquivoRetorno->getCabecalho()->getEmpresa() != $this->config->getNomeEmpresa()) {
                throw new Exception('Arquivo não é referente a empresa correta.');
            }

            Log::info('Arquivo válido, continuando com o processamento.');

            $totalTotalDoArquivo = 0;

            foreach ($arquivoRetorno->getCorpos() as $corpo) {
                $totalTotalDoArquivo += $corpo->getValorPago();

                if (in_array($corpo->getOcorrencia(), $this->config->getOcorrenciasValidas())) {
                    if ($corpo->validaPagamento()) {
                        ApiPagamentos::baixaTitulo($corpo->getNossoNumero(), $corpo->getValorPago());

                        Log::info('Pagamento do título ' . $corpo->getNossoNumero() . ' efetuado com sucesso!');
                    } else {
                        Log::error('Pagamento do título ' . $corpo->getNossoNumero() . ' não foi validado com sucesso!');
                        //adicionar o valor creditado e o valor total pago no log
                    }
                } else {
                    Log::error('Tipo de entrada não encontrada!');
                }
            }

            if (number_format($totalTotalDoArquivo, 2) != number_format($arquivoRetorno->getRodape()->getTotalArquivo(), 2)) {
                throw new Exception('O arquivo possui inconsistências de valores!');
            }

            Log::info('Arquivo importado com sucesso!');
        } catch (Exception $e) {
            Log::error($e->getMessage(), [$e]);
        }
    }
}
