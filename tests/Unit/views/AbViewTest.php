<?php

use Symfony\Component\DomCrawler\Crawler;
use Tests\TestCase;

abstract class AbViewTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();
    }

    public function toCrawler($component)
    {
        return new Crawler($component);
    }
}
