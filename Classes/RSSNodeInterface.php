<?php

namespace Stefanwimmer128\RSSBuilder;

use DOMDocument;
use DOMNode;
use Stringable;

/**
 * Interface RSSNodeInterface
 * @package Stefanwimmer128\RSSBuilder
 */
interface RSSNodeInterface extends Stringable {
    /**
     * get parent node
     * @return RSSNodeInterface|null
     */
    public function getParent(): ?RSSNodeInterface;
    
    /**
     * set parent node
     * @param RSSNodeInterface|null $parent
     * @return $this
     */
    public function setParent(?RSSNodeInterface $parent);
    
    /**
     * render node
     * @param DOMDocument $document
     * @return DOMNode
     */
    public function render(DOMDocument $document): DOMNode;
}
