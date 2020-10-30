<?php

namespace Stefanwimmer128\RSSBuilder;

use DateTimeInterface;

/**
 * Class RSSItem
 * @package Stefanwimmer128\RSSBuilder
 */
class RSSItem extends RSSElement {
    public const NAMESPACE_DC = 'http://purl.org/dc/elements/1.1/';
    public const NAMESPACE_CONTENT = 'http://purl.org/rss/1.0/modules/content/';
    
    /**
     * RSSItem constructor.
     */
    public function __construct() {
        parent::__construct('item');
    }
    
    /**
     * set item title
     * @param string $title
     * @return $this
     */
    public function title(string $title): self {
        $this->addChildElement('title', $title);
        
        return $this;
    }
    
    /**
     * set item link
     * @param string $link
     * @return $this
     */
    public function link(string $link): self {
        $this->addChildElement('link', $link);
        
        return $this;
    }
    
    /**
     * set item pub date
     * @param DateTimeInterface $pubDate
     * @return $this
     */
    public function pubDate(DateTimeInterface $pubDate): self {
        $this->addChildElement('pubDate', $pubDate->format(DATE_RSS));
        
        return $this;
    }
    
    /**
     * set item author(s)
     * @param string ...$authors
     * @return $this
     */
    public function author(string ...$authors): self {
        foreach ($authors as $author) {
            $this->addChildElement('dc:creator', $author);
        }
        if (count($authors)) {
            $this->addNamespace('dc', self::NAMESPACE_DC);
        }
        
        return $this;
    }
    
    /**
     * set item guid
     * @param string $guid
     * @param bool $isPermaLink
     * @return $this
     */
    public function guid(string $guid, bool $isPermaLink = true): self {
        $this->addChildElement('guid', $guid, [
            'isPermaLink' => $isPermaLink ? 'true' : 'false',
        ]);
        
        return $this;
    }
    
    /**
     * set item description
     * @param string $description
     * @return $this
     */
    public function description(string $description): self {
        $this->addChildCdataElement('description', $description);
        
        return $this;
    }
    
    /**
     * set item content
     * @param string $content
     * @return $this
     */
    public function content(string $content): self {
        $this->addChildCdataElement('content:encoded', $content);
        $this->addNamespace('content', self::NAMESPACE_CONTENT);
        
        return $this;
    }
}
