<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST");
header("Content-Type: application/json; charset=UTF-8");

// Função para requisição no viacep
function buscaEndereco($cep) {
    $url = "https://viacep.com.br/ws/{$cep}/json/";
    
    // Inicializa a sessão cURL
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    
    $response = curl_exec($ch);
    curl_close($ch);
    
    return $response;
}

// Valida se foi informado CEP no front
if (isset($_GET['cep'])) {
    $cep = $_GET['cep'];
    
    // Validação do formato do cep
    if (preg_match('/^[0-9]{5}-?[0-9]{3}$/', $cep)) {
        $address = buscaEndereco($cep);
        echo $address;
    } else {
        echo json_encode(["error" => "CEP inválido"]);
    }
} else {
    echo json_encode(["error" => "CEP não fornecido"]);
}
