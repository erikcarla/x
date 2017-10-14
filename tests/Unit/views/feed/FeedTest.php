<?php
namespace Views\Feed;

use Tests\TestCase;
use Carbon\Carbon;

abstract class FeedTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();
    }

    protected function assertXmlEquals($string, $node)
    {
        $this->assertEquals(1, count($node));
        $this->assertEquals($string, (string) $node[0]);
    }

    protected function assertValidSchema($content, $schema = 'RSS20.xsd')
    {
        $dom = new \DOMDocument();
        $dom->loadXML($content);

        // TODO: get this to work with _data/mrss.xsd
        // perhaps we should craft a schema we want
        $schemaFile = __DIR__ . '/../../../_data/' . $schema;
        $errorMessages = "";

        libxml_use_internal_errors(true);
        if(!$dom->schemaValidate($schemaFile)) {
            $errors = libxml_get_errors();
            foreach ($errors as $error) {
                $errorMessages .= sprintf('XML error "%s"', $error->message);
            }
            libxml_clear_errors();
        }
        libxml_use_internal_errors(false);

        $this->assertEquals("", $errorMessages);
    }

    protected function defaultParams($options = [])
    {
        return array_merge([
            'title' => 'The Title',
            'link' => 'http://www.crossover.com',
            'description' => 'The Description',
            'lastBuildDate' => Carbon::now()->format('r'),
            'articles' => [$this->defaultItem()]
        ], $options);
    }

    protected function defaultItem($options = [])
    {
        return array_merge([
            'title' => 'Article Title',
            'link' => 'http://www.example.com',
            'guid' => '123',
            'pubDate' => Carbon::now()->format('r'),
            'author' => 'Article author full name',
            'description' => 'Article description',
            'mediaUrl' => 'http://www.example.com/image.jpg',
        ], $options);
    }
}
