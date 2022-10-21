<?php

namespace Classes;

// use PHPMailer\PHPMailer\PHPMailer;
use SendinBlue\Client\Configuration;
use SendinBlue\Client\Api\TransactionalEmailsApi;
use SendinBlue\Client\Model\SendSmtpEmail;
use GuzzleHttp\Client;
use Exception;

class Email
{

    public $email;
    public $nombre;
    public $token;

    public function __construct($email, $nombre, $token)
    {
        $this->email = $email;
        $this->nombre = $nombre;
        $this->token = $token;
    }

    public function enviarConfirmacion()
    {
        $contenido = "<html>";
        $contenido .= "<p><b>Hola " . $this->nombre . "</b></p>";
        $contenido .= "<p>Has creado tu cuenta en AppSalón, solo debes confirmarla presionando el siguiente enlace</p>";
        $contenido .= "<p>Presiona aquí: <a href='https://floating-scrubland-93211.herokuapp.com/confirmar-cuenta?token=" . $this->token . "'>Confirmar Cuenta</a></p>";
        $contenido .= "<p>Si tu no solicitaste esta cuenta, ignora este mensaje</p>";
        $contenido .= "</html>";

        $config = Configuration::getDefaultConfiguration()->setApiKey('api-key', $_ENV['API_PASS']);
        $apiInstance = new TransactionalEmailsApi(
            new Client(),
            $config
        );
        $sendSmtpEmail = new SendSmtpEmail();
        $sendSmtpEmail['subject'] = 'Confirma tu cuenta';
        $sendSmtpEmail['htmlContent'] = $contenido;
        $sendSmtpEmail['sender'] = array('name' => 'AppSalón', 'email' => 'cuentas@appsalon.com');
        $sendSmtpEmail['to'] = array(
            array('email' => $this->email, 'name' => $this->nombre)
        );
        try {
            $result = $apiInstance->sendTransacEmail($sendSmtpEmail);
        } catch (Exception $e) {
            echo '<script>console.log("error");</script>';
        }
    }

    public function enviarInstrucciones()
    {
        $contenido = "<html>";
        $contenido .= "<p><b>Hola " . $this->nombre . "</b></p>";
        $contenido .= "<p>Has solicitado reestablecer tu password, sigue el siguiente enlace para hacerlo.</p>";
        $contenido .= "<p>Presiona aquí: <a href='https://floating-scrubland-93211.herokuapp.com/recuperar?token=" . $this->token . "'>Reestablecer Password</a></p>";
        $contenido .= "<p>Si tu no solicitaste este cambio, ignora este mensaje</p>";
        $contenido .= "</html>";

        $config = Configuration::getDefaultConfiguration()->setApiKey('api-key', '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');
        $apiInstance = new TransactionalEmailsApi(
            new Client(),
            $config
        );
        $sendSmtpEmail = new SendSmtpEmail();
        $sendSmtpEmail['subject'] = 'Reestablece tu password';
        $sendSmtpEmail['htmlContent'] = $contenido;
        $sendSmtpEmail['sender'] = array('name' => 'AppSalón', 'email' => 'cuentas@appsalon.com');
        $sendSmtpEmail['to'] = array(
            array('email' => $this->email, 'name' => $this->nombre)
        );
        try {
            $result = $apiInstance->sendTransacEmail($sendSmtpEmail);
        } catch (Exception $e) {
            echo '<script>console.log("error");</script>';
        }
    }
}
