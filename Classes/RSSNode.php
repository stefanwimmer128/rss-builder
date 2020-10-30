<?php

namespace Stefanwimmer128\RSSBuilder;

/**
 * Class RSSNode
 * @package Stefanwimmer128\RSSBuilder
 */
abstract class RSSNode implements RSSNodeInterface {
    /**
     * @var RSSNodeInterface|null
     */
    private ?RSSNodeInterface $parent = null;
    
    /**
     * get parent node
     * @return RSSNodeInterface|null
     */
    public function getParent(): ?RSSNodeInterface {
        return $this->parent;
    }
    
    /**
     * set parent node
     * @param RSSNodeInterface|null $parent
     * @return $this
     */
    public function setParent(?RSSNodeInterface $parent): self {
        $this->parent = $parent;
        
        return $this;
    }
    
    /**
     * renders node when used as string
     * @return string
     */
    public function __toString(): string {
        return RSSDocument::render($this);
    }
}
