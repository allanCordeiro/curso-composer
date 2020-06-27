<?php

namespace AllanCordeiro\BuscadorDeCursos;

use Exception;
use GuzzleHttp\ClientInterface;
use Symfony\Component\DomCrawler\Crawler;

class Buscador
{
    private $httpClient;
    private $crawler;

    public function __construct(ClientInterface $httpClient, Crawler $crawler)
    {
        $this->httpClient = $httpClient;
        $this->crawler = $crawler;
    }

    public function busca(string $url): array
    {
        try {
            $resposta = $this->httpClient->request('GET', $url);
            $html = $resposta->getBody();
        } catch (Exception $e) {
            echo 'Ocorreu uma exceção no momento de parsear a página.';
        }
        $crawler = new Crawler();
        $crawler->addHtmlContent($html);
        $elementos = $crawler->filter('span.card-curso__nome');
        $cursos = [];
        foreach ($elementos as $elemento) {
            $cursos[] = $elemento->textContent . PHP_EOL;
        }

        return $cursos;
    }
}
