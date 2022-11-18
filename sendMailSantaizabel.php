<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Contatos</title>
</head>

<body>

    <?php

    $email_contato = $_GET['email'];
    $numero_cpf_cnpj = $_GET['doc'];

    /**
     * Função para gerar senhas aleatórias

     * @param integer $tamanho Tamanho da senha a ser gerada
     * @param boolean $maiusculas Se terá letras maiúsculas
     * @param boolean $numeros Se terá números
     * @param boolean $simbolos Se terá símbolos
     *
     * @return string A senha gerada
     */
    function geraSenha($tamanho = 8, $maiusculas = true, $numeros = true, $simbolos = false)
    {
        $lmin = 'abcdefghijklmnopqrstuvwxyz';
        $lmai = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $num = '1234567890';
        $simb = '!@#$%*-';
        $retorno = '';
        $caracteres = '';

        $caracteres .= $lmin;
        if ($maiusculas) $caracteres .= $lmai;
        if ($numeros) $caracteres .= $num;
        if ($simbolos) $caracteres .= $simb;

        $len = strlen($caracteres);
        for ($n = 1; $n <= $tamanho; $n++) {
            $rand = mt_rand(1, $len);
            $retorno .= $caracteres[$rand - 1];
        }
        return $retorno;
    }

    $email = 'Obrigado por se cadastrar no SaaeNet, se este contato não foi autorizado por você, por favor ignorar este e-mail.';
    $codigo_post = geraSenha(6, false, true);
    $titulo = 'SAAENET';
    $from = "suporte@saaesantaizabel.com.br";
    $dest = $email_contato;
    $headers = "From:" . $from;
    $corpo = '- Seu código de confirmação é: ';

    $email2 = utf8_decode($email);
    $corpo2 = utf8_decode($corpo);
    $codigo_post_email2 = utf8_decode($codigo_post);


    // usando o PHP_EOL para quebrar a linha
    $dados = $email2 . PHP_EOL . PHP_EOL . $corpo2 . $codigo_post_email2;

    mail($dest, $titulo, $dados, $headers);

    $codigo_post = md5($codigo_post);
    ?>

    <script>
        alert('Anote sua senha de acesso digitada neste formulário!!!');
    </script>
    <script>
        alert('Obrigado! Mensagem enviada com sucesso. Por favor, pressione OK para continuar!!!');
    </script>

    <?php

    echo "<script language='javascript'>window.location='http://saaesantaizabel.com.br/santaizabel/web/home/index.php?acao=confirmar&codigo=$codigo_post&doc=$numero_cpf_cnpj'; </script>";

    ?>

</body>

</html>