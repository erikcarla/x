<?php
namespace Views\Feed;

use App\Models\Article;

class RssTest extends FeedTest
{
    public function setUp()
    {
        parent::setUp();
        $this->html = view('feed.rss', $this->defaultParams())
            ->render();

        $xml = simplexml_load_string($this->html);
        $this->channel = $xml->xpath('/rss/channel')[0];
        $this->item = $xml->xpath('/rss/channel/item')[0];
    }
    public function test_render_valid_schema()
    {
        $this->assertValidSchema($this->html);
    }

    public function test_render_channel()
    {
        $node = $this->channel;
        $params = $this->defaultParams();

        $this->assertXmlEquals($params['title'], $node->xpath('title'));
        $this->assertXmlEquals($params['link'], $node->xpath('link'));
        $this->assertXmlEquals($params['lastBuildDate'], $node->xpath('lastBuildDate'));
        $this->assertXmlEquals($params['description'], $node->xpath('description'));
    }

    public function test_render_item()
    {
        $node = $this->item;
        $params = $this->defaultParams()['articles'][0];

        $this->assertXmlEquals($params['title'], $node->xpath('title'));
        $this->assertXmlEquals($params['link'], $node->xpath('link'));
        $this->assertXmlEquals($params['guid'], $node->xpath('guid'));
        $this->assertXmlEquals($params['description'], $node->xpath('description'));
        $this->assertXmlEquals($params['pubDate'], $node->xpath('pubDate'));
        $this->assertXmlEquals($params['author'], $node->xpath('author'));
        $this->assertEquals($params['mediaUrl'], $node->xpath('media:content')[0]->attributes()->url);
    }
}
