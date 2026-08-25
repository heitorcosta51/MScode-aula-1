<?php
 
require_once(__DIR__ . '/camalComunicacao.php');
 
class Whatsapp implements CanalComunicacao {
 
    public function enviarMensagem(string $destinatario, string $mensagem): bool
    {
        return true;
    }
 
    public function nome(): string
    {
        return "Mensagem via WhatsApp";
    }
}