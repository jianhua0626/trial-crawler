<?php

namespace App\Crawler;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\Response;

class FullPageScreenShot
{
    private string $apiUrl = 'https://www.googleapis.com/pagespeedonline/v5/runPagespeed';

    private string $base64Value;

    public function __construct(string $url, string $key)
    {
        $screenshotResponse = Http::get($this->apiUrl, [
            'url' => $url,
            'key' => $key,
        ]);

        $this->extractFullPage($screenshotResponse);
    }

    private function extractFullPage(Response $screenshotResponse): void
    {
        [
            , $this->base64Value,
        ] = explode(',', $screenshotResponse->json('lighthouseResult.audits.full-page-screenshot.details.screenshot.data'));
    }

    public function base64Value(): string
    {
        return $this->base64Value;
    }
}
