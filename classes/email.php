<?php

class Email {

    public function __construct(
        private string $endereco
    ) {
    }

    public function enviar(): bool
    {

        return mail(
            $this->endereco, 
            'Compra Finalizada na Simonetti', 
            'Obrigado pela compra! Sua compra foi processada com sucesso'
        );
    }

}