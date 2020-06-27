<?php

require_once 'vendor/autoload.php';

use GuzzleHttp\Client;
use Symfony\Component\DomCrawler\Crawler;
use AllanCordeiro\BuscadorDeCursos\Buscador;

$url = 'cursos-online-programacao/php';
$client = new Client(['base_uri' => 'https://www.alura.com.br/']);
$crawler = new Crawler();
$buscador = new Buscador($client, $crawler);
$cursos = $buscador->busca($url);

foreach($cursos as $curso) {
    echo $curso .PHP_EOL;
}