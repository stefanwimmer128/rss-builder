<?php

namespace Stefanwimmer128\RSSBuilder;

/**
 * Class RSSFeed
 * @package Stefanwimmer128\RSSBuilder
 */
class RSSFeed extends RSSElement {
    /**
     * RSSFeed constructor.
     * @param string $version
     */
    public function __construct(string $version = '2.0') {
        parent::__construct('rss', null, [
            'version' => $version,
        ]);
    }
    
    /**
     * create channel in feed
     * @return RSSChannel
     */
    public function channel(): RSSChannel {
        return $this->addChild(new RSSChannel());
    }
}
