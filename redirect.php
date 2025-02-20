<?php
require 'conexao.php';

$short_code = $_GET['code'];

$stmt = $pdo->prepare("SELECT original_url FROM urls WHERE short_code = :short_code");
$stmt->execute(['short_code' => $short_code]);
$url = $stmt->fetch();

if ($url) {
    header("Location: " . $url['original_url']);
    exit();
} else {
    die("URL não encontrada.");
}
?>