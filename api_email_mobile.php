<?php
$email_contato = $_GET['email'];
//$email_contato = 'randerson.ab@hotmail.com';



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
$from = "suporte@saaenet.com.br";
$dest = $email_contato;
$headers = "From:" . $from;
$corpo = '- Seu código de confirmação é: ';

$email = utf8_decode($email);
$corpo = utf8_decode($corpo);
$codigo_post_email = utf8_decode($codigo_post);


// usando o PHP_EOL para quebrar a linha
$dados = $email . PHP_EOL . PHP_EOL . $corpo . $codigo_post_email;

mail($dest, $titulo, $dados, $headers);

echo (json_encode(array('mensagem' => $codigo_post_email)));
