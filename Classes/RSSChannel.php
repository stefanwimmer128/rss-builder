<?php

namespace Stefanwimmer128\RSSBuilder;

/**
 * Class RSSChannel
 * @package Stefanwimmer128\RSSBuilder
 */
class RSSChannel extends RSSElement {
    public const NAMESPACE_ATOM = 'http://www.w3.org/2005/Atom';
    
    /**
     * RSSChannel constructor.
     */
    public function __construct() {
        parent::__construct('channel');
    }
    
    /**
     * set channel title
     * @param string $title
     * @return $this
     */
    public function title(string $title): self {
        $this->addChildElement('title', $title);
        
        return $this;
    }
    
    /**
     * set channel link
     * @param string $link
     * @return $this
     */
    public function link(string $link): self {
        $this->addChildElement('link', $link);
    
        return $this;
    }
    
    /**
     * set channel atom link
     * @param string $href
     * @return $this
     */
    public function atomLink(string $href): self {
        $this->addChildElement('atom:link', null, [
            'href' => $href,
            'rel' => 'self',
            'type' => 'application/rss+xml',
        ]);
        $this->addNamespace('atom', self::NAMESPACE_ATOM);
        
        return $this;
    }
    
    /**
     * set channel description
     * @param string $description
     * @return $this
     */
    public function description(string $description): self {
        $this->addChildCdataElement('description', $description);
        
        return $this;
    }
    
    /**
     * create item in channel
     * @return RSSItem
     */
    public function item(): RSSItem {
        return $this->addChild(new RSSItem());
    }
}
