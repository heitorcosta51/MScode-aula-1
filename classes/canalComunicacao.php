<?php 

interface CanalComunicacao {

    public function enviarMensagem(string $destinatario, string $mensagem): bool;

    public function nome(): string;
    
}

