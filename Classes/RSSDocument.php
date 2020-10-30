<?php

namespace Stefanwimmer128\RSSBuilder;

use DOMDocument;
use Stringable;

/**
 * Class RSSDocument
 * @package Stefanwimmer128\RSSBuilder
 */
class RSSDocument extends DOMDocument implements Stringable {
    /**
     * render node
     * @param RSSNode $node
     * @return string
     */
    public static function render(RSSNode $node): string {
        $document = new self();
        $document->appendChild($node->render($document));
        return $document;
    }
    
    /**
     * RSSDocument constructor.
     * @param string $version
     * @param string $encoding
     */
    public function __construct($version = '1.0', $encoding = 'utf-8') {
        parent::__construct($version, $encoding);
        
        $this->formatOutput = true;
        $this->preserveWhiteSpace = false;
    }
    
    /**
     * render document when used as string
     * @return string
     */
    public function __toString(): string {
        return $this->saveXML();
    }
}
