<?php 
 
require_once(__DIR__ . '/cliente.php');
require_once(__DIR__ . '/email.php');
require_once(__DIR__ . '/../MScode-aula-1/calcularFrete.php');
 
class CompraService {
 
     public function __construct(
        private CanalComunicacao $canalComunicacao,
        private CalculadorFrete $calculadorFrete  
    ){
 
    }
 
    public function finalizarCompra(string $destinatario, string $nomeCliente, float $valorProduto): void  
    {
        $frete = $this->calculadorFrete->calcularFrete($valorProduto);
 
        $mensagem = "Olá $nomeCliente, recebemos sua compra na moveis simonetti! "
                  . "O frete ficou em R$ " . number_format($frete, 2, ',', '.');
 
        $enviado = $this->canalComunicacao->enviarMensagem($destinatario, $mensagem);
 
        if (!$enviado) {
            throw new RuntimeException('Não foi possível enviar a confirmação da compra.');
        }
    }
}