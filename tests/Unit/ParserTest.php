<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Crawler\Parser;

class ParserTest extends TestCase
{
    private Parser $parser;

    protected function setUp(): void
    {
        parent::setUp();
        $this->parser = new Parser($this->fakeHtml());
    }

    public function test_parse_description()
    {
        $this->assertEquals('description描述', $this->parser->description());
    }

    public function test_parse_body()
    {
        $body = <<<FORM
            <form action="">
              <label for="fname">First name:</label><br>
              <input type="text" id="fname" name="fname" value="John"><br>
              <label for="lname">Last name:</label><br>
              <input type="text" id="lname" name="lname" value="Doe"><br>
              <input type="submit" value="Submit">
            </form>
            FORM;

        $this->assertEquals($body, $this->parser->body());
    }

    private function fakeHtml(): string
    {
        return <<<HTML
        <html lang="zh-Hant">
        <head><title>title標題</title>
          <meta charset="utf-8">
          <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
          <meta name="description" content="description描述">
          <meta name="keywords" content="keywords關鍵字">
          <meta name="viewport" content="width=device-width,minimum-scale=1,initial-scale=1">
        </head>
        <body><form action="">
          <label for="fname">First name:</label><br>
          <input type="text" id="fname" name="fname" value="John"><br>
          <label for="lname">Last name:</label><br>
          <input type="text" id="lname" name="lname" value="Doe"><br>
          <input type="submit" value="Submit">
        </form></body></html>
        HTML;
    }
}
