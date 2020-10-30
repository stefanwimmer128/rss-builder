<?php

namespace Stefanwimmer128\RSSBuilder;

use DOMCdataSection;
use DOMDocument;

/**
 * Class RSSCdataSection
 * @package Stefanwimmer128\RSSBuilder
 */
class RSSCdataSection extends RSSNode {
    /**
     * @var string
     */
    private string $value;
    
    /**
     * RSSCdataSection constructor.
     * @param string $value
     */
    public function __construct(string $value) {
        $this->value = $value;
    }
    
    /**
     * get cdata element value
     * @return string
     */
    public function getValue(): string {
        return $this->value;
    }
    
    /**
     * set cdata element value
     * @param string $value
     * @return $this
     */
    public function setValue(string $value): self {
        $this->value = $value;
        
        return $this;
    }
    
    /**
     * render cdata element
     * @param DOMDocument $document
     * @return DOMCdataSection
     */
    public function render(DOMDocument $document): DOMCdataSection {
        return $document->createCDATASection($this->value);
    }
}
