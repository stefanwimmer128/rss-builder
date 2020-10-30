<?php

namespace Stefanwimmer128\RSSBuilder;

/**
 * Interface RSSElementInterface
 * @package Stefanwimmer128\RSSBuilder
 */
interface RSSElementInterface extends RSSNodeInterface {
    /**
     * get element name
     * @return string
     */
    public function getName(): string;
    
    /**
     * set element name
     * @param string $name
     * @return $this
     */
    public function setName(string $name): self;
    
    /**
     * get element value
     * @return string|null
     */
    public function getValue(): ?string;
    
    /**
     * set element value
     * @param string|null $value
     * @return $this
     */
    public function setValue(?string $value): self;
    
    /**
     * get element attributes
     * @return array
     */
    public function getAttributes(): array;
    
    /**
     * set element attributes
     * @param array $attributes
     * @return $this
     */
    public function setAttributes(array $attributes): self;
    
    /**
     * add element attribute
     * @param string $key
     * @param string $value
     * @return $this
     */
    public function addAttribute(string $key, string $value): self;
    
    /**
     * get element children
     * @return array
     */
    public function getChildren(): array;
    
    /**
     * set element children
     * @param RSSNodeInterface[] $children
     * @return $this
     */
    public function setChildren(array $children): self;
    
    /**
     * add element child
     * @param RSSNodeInterface $element
     * @return RSSNodeInterface
     */
    public function addChild(RSSNodeInterface $element): RSSNodeInterface;
    
    /**
     * add element child element
     * @param string $name
     * @param string|null $value
     * @param array $attributes
     * @param array $children
     * @return RSSElement
     */
    public function addChildElement(string $name, ?string $value = null, array $attributes = [], array $children = []): RSSElement;
    
    /**
     * add element child cdata element
     * @param string $name
     * @param string $value
     * @param array $attributes
     * @return RSSElement
     */
    public function addChildCdataElement(string $name, string $value, array $attributes = []): RSSElement;
    
    /**
     * add element namespace
     * @param string $ns
     * @param string $uri
     */
    public function addNamespace(string $ns, string $uri): void;
}
