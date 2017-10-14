{!! '<' . '?xml version="1.0" encoding="utf-8"?>' !!}
<rss version="2.0" xmlns:media="http://search.yahoo.com/mrss/">
  <channel>
    <title>{!! '<![CDATA[' .$title. ']]>' !!}</title>
    <link>{{ $link }}</link>
    <description>{!! '<![CDATA[' .$description. ']]>' !!}</description>
    <language>ID</language>
    <lastBuildDate>{!! $lastBuildDate !!}</lastBuildDate>

    @foreach($articles as $article)
      <item>
        <title>{!! '<![CDATA[' .$article['title']. ']]>' !!}</title>
        <link>{{ $article['link'] }}</link>
        <guid isPermaLink="false">{!! $article['guid'] !!}</guid>
        <description>{!! '<![CDATA[' .$article['description']. ']]>' !!}</description>
        <pubDate>{{ $article['pubDate'] }}</pubDate>
        <author>{!! '<![CDATA[' .$article['author']. ']]>' !!}</author>
        <media:content url="{{ $article['mediaUrl'] }}"/>
      </item>
    @endforeach
  </channel>
</rss>

