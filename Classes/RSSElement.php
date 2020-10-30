<?php

namespace Stefanwimmer128\RSSBuilder;

use DOMDocument;
use DOMElement;

/**
 * Class RSSElement
 * @package Stefanwimmer128\RSSBuilder
 */
class RSSElement extends RSSNode implements RSSElementInterface {
    /**
     * @var string
     */
    private string $name;
    
    /**
     * @var string|null
     */
    private ?string $value;
    
    /**
     * @var array
     */
    private array $attributes;
    
    /**
     * @var RSSNodeInterface[]
     */
    private array $children;
    
    /**
     * RSSElement constructor.
     * @param string $name
     * @param string|null $value
     * @param array $attributes
     * @param array $children
     */
    public function __construct(string $name, ?string $value = null, array $attributes = [], array $children = []) {
        $this->setName($name);
        $this->setValue($value);
        $this->setAttributes($attributes);
        $this->setChildren($children);
    }
    
    /**
     * get element name
     * @return string
     */
    public function getName(): string {
        return $this->name;
    }
    
    /**
     * set element name
     * @param string $name
     * @return $this
     */
    public function setName(string $name): self {
        $this->name = $name;
        
        return $this;
    }
    
    /**
     * get element value
     * @return string|null
     */
    public function getValue(): ?string {
        return $this->value;
    }
    
    /**
     * set element value
     * @param string|null $value
     * @return $this
     */
    public function setValue(?string $value): self {
        $this->value = $value;
        
        return $this;
    }
    
    /**
     * get element attributes
     * @return array
     */
    public function getAttributes(): array {
        return $this->attributes;
    }
    
    /**
     * set element attributes
     * @param array $attributes
     * @return $this
     */
    public function setAttributes(array $attributes): self {
        $this->attributes = $attributes;
        
        return $this;
    }
    
    /**
     * add element attribute
     * @param string $key
     * @param string $value
     * @return $this
     */
    public function addAttribute(string $key, string $value): self {
        $this->attributes[$key] = $value;
        
        return $this;
    }
    
    /**
     * get element children
     * @return RSSNodeInterface[]
     */
    public function getChildren(): array {
        return $this->children;
    }
    
    /**
     * set element children
     * @param RSSNodeInterface[] $children
     * @return $this
     */
    public function setChildren(array $children): self {
        $this->children = $children;
        foreach ($children as $child) {
            $child->setParent($this);
        }
        
        return $this;
    }
    
    /**
     * add element child
     * @param RSSNodeInterface $element
     * @return RSSNodeInterface
     */
    public function addChild(RSSNodeInterface $element): RSSNodeInterface {
        $element->setParent($this);
        return $this->children[] = $element;
    }
    
    /**
     * add element child element
     * @param string $name
     * @param string|null $value
     * @param array $attributes
     * @param array $children
     * @return RSSElement
     */
    public function addChildElement(string $name, ?string $value = null, array $attributes = [], array $children = []): RSSElement {
        return $this->addChild(new RSSElement($name, $value, $attributes, $children));
    }
    
    /**
     * add element child cdata element
     * @param string $name
     * @param string $value
     * @param array $attributes
     * @return RSSElement
     */
    public function addChildCdataElement(string $name, string $value, array $attributes = []): RSSElement {
        return $this->addChildElement($name, null, $attributes, [new RSSCdataSection($value)]);
    }
    
    /**
     * add element namespace
     * @param string $ns
     * @param string $uri
     */
    public function addNamespace(string $ns, string $uri): void {
        $parent = $this;
        while ($parent->getParent() instanceof RSSElementInterface) {
            $parent = $parent->getParent();
        }
        $parent->addAttribute("xmlns:$ns", $uri);
    }
    
    /**
     * render element
     * @param DOMDocument $document
     * @return DOMElement
     */
    public function render(DOMDocument $document): DOMElement {
        $element = $document->createElement($this->getName(), $this->getValue());
        foreach ($this->getAttributes() as $key => $value) {
            $element->setAttribute($key, $value);
        }
        foreach ($this->getChildren() as $child) {
            $element->appendChild($child->render($document));
        }
        return $element;
    }
}
