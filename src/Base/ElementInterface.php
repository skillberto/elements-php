<?php

namespace Bpstr\Elements\Base;

use Bpstr\Elements\Extension\ExtensionInterface;

/**
 * Basic HTML Element interface.
 *
 * This interface defines base methods which are needed to create
 * HTML elements with ease.
 *
 * Note: This interface defines CHAINABLE methods in order to simply
 * create any kind of element.
 *
 * @author bpstr <bpstr@gmx.tm>
 */
interface ElementInterface extends MarkupInterface {
	
	/**
	 * @param string $tag
	 * @param string[] ...$classes
	 *
	 * @return \Bpstr\Elements\Base\ElementInterface
	 */
	public static function createWithClass(string $tag, string ...$classes);


	/**
	 * Determines whether the current tag is in the given list or not.
	 *
	 * @param string[] ...$tags
	 *
	 * @return bool
	 */
	public function is(string ...$tags): bool;

	/**
	 * Place content before other content.
	 *
	 * @param $content
	 *
	 * @return $this
	 */
	public function prependContent($content): self;

	/**
	 * Place content after other content.
	 *
	 * @param $content
	 *
	 * @return $this
	 */
	public function appendContent($content = NULL): self;

	/**
	 * Place content to an element with a given key.
	 *
	 * Note: when passing an iterable value to $content parameter,
	 * this method will be called recursively. Doing such way, the
	 * first parameter will be used to prefix the array keys.
	 * @example self::placeContent('key', ['a' => ['b' => 'c']);
	 *    Will add keyab = 'c' to the internal content collection.
	 *
	 * @param mixed $key
	 * @param mixed $content
	 *
	 * @return $this
	 */
	public function placeContent($key, $content): self;

	/**
	 * @param string $tag
	 *
	 * @return array
	 */
	public function getChildrenByTagname(string $tag): array;

	/**
	 * @param string $attr
	 * @param $val
	 *
	 * @return \Bpstr\Elements\Base\ElementInterface
	 */
	public function data(string $attr, $val): ElementInterface;



	/**
	 * @return \Bpstr\Elements\Base\ElementClassCollection
	 */
	public function getClasses(): ElementClassCollection;

	/**
	 * @param string[] $classes
	 *
	 * @return \Bpstr\Elements\Base\ElementInterface
	 */
	public function addClass(string ...$classes): ElementInterface;

	/**
	 * @param string $class
	 *
	 * @return \Bpstr\Elements\Base\ElementInterface
	 */
	public function removeClass(string $class): ElementInterface;

	/**
	 * @param string $class
	 *
	 * @return bool
	 */
	public function hasClass(string $class): bool;



	/**
	 * @param string $property
	 * @param $value
	 *
	 * @return \Bpstr\Elements\Base\ElementInterface
	 */
	public function style(string $property, $value): ElementInterface;

	/**
	 * @return \Bpstr\Elements\Base\ElementStyleCollection
	 */
	public function getStyles(): ElementStyleCollection;

	/**
	 * @param string $property
	 * @param null $default
	 *
	 * @return mixed
	 */
	public function getStyle(string $property, $default = NULL);

	/**
	 * @param string $property
	 * @param $value
	 *
	 * @return \Bpstr\Elements\Base\ElementInterface
	 */
	public function setStyle(string $property, $value): ElementInterface;

	/**
	 * @param string $property
	 *
	 * @return bool
	 */
	public function hasStyle(string $property): bool;



	public function attachExtension(ExtensionInterface $extension);

	public function detachExtension(string $name);
}
