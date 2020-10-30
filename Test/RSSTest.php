<?php

namespace Stefanwimmer128\RSSBuilder\Test;

use DateTime;
use PHPUnit\Framework\TestCase;
use Stefanwimmer128\RSSBuilder\RSSFeed;

class RSSTest extends TestCase {
    public function testAll() {
        $feed = new RSSFeed();
        
        $date = new DateTime();
        
        $feed
            ->channel()
                ->title('Channel Title')
                ->link('Channel Link')
                ->description('Channel Description')
                ->atomLink('Channel Atom Link')
                ->item()
                    ->title('Item Title')
                    ->link('Item Link')
                    ->pubDate($date)
                    ->author('Item Author')
                    ->guid('Item GUID')
                    ->description('Item Description')
                    ->content('Item Content');
        
        $dateFormat = $date->format(DATE_RSS);
        $rss = <<<XML
<?xml version="1.0" encoding="utf-8"?>
<rss version="2.0" xmlns:atom="http://www.w3.org/2005/Atom" xmlns:dc="http://purl.org/dc/elements/1.1/" xmlns:content="http://purl.org/rss/1.0/modules/content/">
  <channel>
    <title>Channel Title</title>
    <link>Channel Link</link>
    <description><![CDATA[Channel Description]]></description>
    <atom:link href="Channel Atom Link" rel="self" type="application/rss+xml"/>
    <item>
      <title>Item Title</title>
      <link>Item Link</link>
      <pubDate>$dateFormat</pubDate>
      <dc:creator>Item Author</dc:creator>
      <guid isPermaLink="true">Item GUID</guid>
      <description><![CDATA[Item Description]]></description>
      <content:encoded><![CDATA[Item Content]]></content:encoded>
    </item>
  </channel>
</rss>

XML;
        
        self::assertEquals($rss, (string) $feed);
    }
}
