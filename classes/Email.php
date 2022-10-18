<?php

namespace Classes;

use PHPMailer\PHPMailer\PHPMailer;
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
        /* Crear el objeto de email */
        $mail = new PHPMailer();

        $mail->isSMTP();
        $mail->Host = 'smtp.mailtrap.io';
        $mail->SMTPAuth = true;
        $mail->Port = 2525;
        $mail->Username = 'c85601fe296031';
        $mail->Password = 'c0358a761922db';

        $mail->setFrom('cuentas@appsalon.com');
        $mail->addAddress('cuentas@appsalon.com', 'AppSalon.com');
        $mail->Subject = 'Confirma tu cuenta';

        /* Set HTML */
        $mail->isHTML(TRUE);
        $mail->CharSet = 'UTF-8';

        $contenido = "<html>";
        $contenido .= "<p><b>Hola " . $this->nombre . "</b></p>";
        $contenido .= "<p>Has creado tu cuenta en AppSalón, solo debes confirmarla presionando el siguiente enlace</p>";
        $contenido .= "<p>Presiona aquí: <a href='https://floating-scrubland-93211.herokuapp.com/confirmar-cuenta?token=" . $this->token . "'>Confirmar Cuenta</a></p>";
        $contenido .= "<p>Si tu no solicitaste esta cuenta, ignora este mensaje</p>";
        $contenido .= "</html>";

        $mail->Body = $contenido;
        $mail->AltBody = 'Confirma tu cuenta';

        /* Enviar el mail */
        // $mail->send();

        $config = Configuration::getDefaultConfiguration()->setApiKey('api-key', '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');
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
        /* Crear el objeto de email */
        $mail = new PHPMailer();

        $mail->isSMTP();
        $mail->Host = 'smtp.mailtrap.io';
        $mail->SMTPAuth = true;
        $mail->Port = 2525;
        $mail->Username = 'c85601fe296031';
        $mail->Password = 'c0358a761922db';

        $mail->setFrom('cuentas@appsalon.com');
        $mail->addAddress('cuentas@appsalon.com', 'AppSalon.com');
        $mail->Subject = 'Reestablece tu password';

        /* Set HTML */
        $mail->isHTML(TRUE);
        $mail->CharSet = 'UTF-8';

        $contenido = "<html>";
        $contenido .= "<p><b>Hola " . $this->nombre . "</b></p>";
        $contenido .= "<p>Has solicitado reestablecer tu password, sigue el siguiente enlace para hacerlo.</p>";
        $contenido .= "<p>Presiona aquí: <a href='https://floating-scrubland-93211.herokuapp.com/recuperar?token=" . $this->token . "'>Reestablecer Password</a></p>";
        $contenido .= "<p>Si tu no solicitaste este cambio, ignora este mensaje</p>";
        $contenido .= "</html>";

        $mail->Body = $contenido;
        $mail->AltBody = 'Reestablece tu password';

        /* Enviar el mail */
        $mail->send();
    }
}
