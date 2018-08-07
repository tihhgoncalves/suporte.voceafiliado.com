<?

date_default_timezone_set('America/Sao_Paulo');

require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

?><html lang="en">
<head>
  <title>VocêAfiliado — O Melhor Amigo do Top Afiliado</title>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="icon" href="favico.png" sizes="128x128">
  <link rel="stylesheet" href="style.css">
</head>

<body>

<?

if(!isset($_POST['email'])) {
  ?>
  <div class="container">
    <form id="contact" action="" method="post">

      <h3>Verificação de Estratégia</h3>
      <h4>Preencha os campos abaixo e nos envie para analisarmos minuciosamente toda a sua estratégia.</h4>
      <fieldset>
        <input placeholder="Seu nome" type="text" tabindex="1" required autofocus name="nome">
      </fieldset>
      <fieldset>
        <input placeholder="Seu E-mail de Login" type="email" tabindex="2" required name="email">
      </fieldset>
      <fieldset>
        <input placeholder="WhatsApp" type="tel" tabindex="3" required name="whatsapp">
      </fieldset>

      <hr>

      <fieldset>
        <input placeholder="URL da sua Safe Page" type="url" tabindex="4" required name="url_safepage">
      </fieldset>
      <fieldset>
        <input placeholder="URL do seu Funil" type="url" tabindex="4" required name="url_funil">
      </fieldset>

      <hr>

      <fieldset>
        <textarea placeholder="Escreva qualquer observação que contrinua para a avaliação." tabindex="5" name="obs"></textarea>
      </fieldset>
      <fieldset>
        <button name="submit" type="submit" id="contact-submit" data-submit="...Sending">Enviar</button>
      </fieldset>
    </form>
  </div>

<?
} else {

  $html = '<p>Solicito a verificação da minha estratégia utilizando a ferramenta de Hide Potter.</p>' . "\r\n";
  $html .= '<p>Segue abaixo as informações necessárias para que a verificação possa ser feita:</p>' . "\r\n";

  $html .= '<p>';
  $html .= ' — Nome: ' . $_POST['nome'] . '<br>' . "\r\n";
  $html .= ' — E-mail: ' . $_POST['email'] . '<br>' . "\r\n";
  $html .= ' — WhatsApp: ' . $_POST['whatsapp'] . '<br>' . "\r\n";
  $html .= '</p>';

  $html .= '<p>';
  $html .= ' — URL da Safe Page: ' . $_POST['url_safepage'] . '<br>' . "\r\n";
  $html .= ' — URL do seu Funil de Vendas: ' . $_POST['url_funil'] . '<br>' . "\r\n";
  $html .= '</p>';

  $html .= '<p>';
  $html .= ' — Observações: ' . $_POST['obs'] . '<br>' . "\r\n";
  $html .= '</p>';

  $html .= '<p>';
  $html .= ' —  Data/hora do Envio: ' . date('d/m/Y H:i') . '<br>' . "\r\n";
  $html .= ' —  IP da pessoa que enviou: ' . $_SERVER['REMOTE_ADDR'] . '<br>' . "\r\n";
  $html .= '</p>';

  try {

    $mail = new PHPMailer(true);
    $mail->CharSet = 'UTF-8';
    $mail->isMail();

    //Recipients
    $mail->setFrom($_POST['email'], $_POST['nome']);
    $mail->addAddress('suporte@voceafiliado.com');

    //Content
    $mail->isHTML(true);
    $mail->Subject = 'Verificação de Estratégia';
    $mail->Body = $html;

    $mail->send();
    $feedback = true;

  } catch (Exception $e) {
    $feedback = false;
    echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
  }


?>

<div class="container">
  <form id="contact" action="" method="post">


    <?
    if($feedback) {
      ?>
      <h3>Pronto!</h3>
      <p>Suas informações já foram enviadas a nossa equipe. Foi gerado automaticamente um ticket em nosso sistema de
        suporte e você acompanhará tudo direto no seu e-mail.</p>
      <p><strong>O prazo máximo para respondermos é de 24 horas úteis</strong>, apesar de que normalmente é muito mais rápido do que
        isso.</p>
    <?
    } else {
      ?>
      <h3><O>Ops! Ocorreu um problema!</O>!</h3>
      <p>Infelizmente ocorreu algum problema e não foi possível enviar as informações que você preencheu no formulário.
        Envie manualmente sua solicitação por e-mail para <a href="mailto:suporte@voceafiliado.com?subject=<?= $assunto; ?>&body=<?= str_replace("\r\n", '%0D%0A', $html); ?>">suporte@voceafiliado.com</a></p>
    <?
    }
    ?>
  </form>
</div>
<?
}
?>
</body>

</html>