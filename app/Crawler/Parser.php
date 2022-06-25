<?php

namespace App\Crawler;

use Symfony\Component\DomCrawler\Crawler;

class Parser
{
    private Crawler $crawler;

    public function __construct(string $html)
    {
        $this->crawler = new Crawler($html);
    }

    public function description(): string
    {
        $dom = $this->crawler->filter('meta[name="description"]')->first();

        return $dom->count() === 0 ? '' : $dom->attr('content');
    }

    public function body(): string
    {
        $dom = $this->crawler->filter('body');

        return $dom->html();
    }
}
