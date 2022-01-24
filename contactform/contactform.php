<?php

if ($_POST) {
    $nome_visitante = $_POST['name'];
    $email_visitante = $_POST['email'];
    $assunto_email = $_POST['subject'];
    $menssagem_visitante = $_POST['message'];
    $email_body = "<div>";
    // print_r($nome_visitante);die;
    if (isset($_POST['nome_visitante'])) {
        $nome_visitante = filter_var($_POST['nome_visitante'], FILTER_SANITIZE_STRING);
        $email_body .= "<div>
                           <label><b>Visitante Nome:</b></label>&nbsp;<span>" . $nome_visitante . "</span>
                        </div>";
    }

    if (isset($_POST['email_visitante'])) {
        $email_visitante = str_replace(array("\r", "\n", "%0a", "%0d"), '', $_POST['email_visitante']);
        $email_visitante = filter_var($email_visitante, FILTER_VALIDATE_EMAIL);
        $email_body .= "<div>
                           <label><b>Visitante Email:</b></label>&nbsp;<span>" . $email_visitante . "</span>
                        </div>";
    }

    if (isset($_POST['assunto_email'])) {
        $assunto_email = filter_var($_POST['assunto_email'], FILTER_SANITIZE_STRING);
        $email_body .= "<div>
                           <label><b>Motivo do Contato:</b></label>&nbsp;<span>" . $assunto_email . "</span>
                        </div>";
    }

    if (isset($_POST['menssagem_visitante'])) {
        $menssagem_visitante = htmlspecialchars($_POST['menssagem_visitante']);
        $email_body .= "<div>
                           <label><b>Visitante Mensagem:</b></label>
                           <div>" . $menssagem_visitante . "</div>
                        </div>";
    }

    $email_body .= "</div>";

    $headers  = 'MIME-Version: 1.0' . "\r\n"
        . 'Content-type: text/html; charset=utf-8' . "\r\n"
        . 'From: ' . $email_visitante . "\r\n";
    if (mail($assunto_email, $email_body, $headers)) {
        echo "<p>Obrigado por entrar em contato conosco, $nome_visitante. Você receberá uma resposta dentro de 24 horas.</p>";
    } else {
        echo '<p>Lamentamos, mas o e-mail não foi enviado!</p>';
    }
} else {
    echo '<p>Algo deu errado!!!</p>';
}