<?php

namespace Bpstr\Elements\Base;

use Bpstr\Elements\Collection\StringCollection;
use InvalidArgumentException;

class ElementAttributeCollection extends StringCollection {

	protected $implodePattern = '%s="%s"';
	protected $implodeSpacing = ' ';

	public const GLOBAL_ATTRIBUTES = ['accesskey', 'class', 'contenteditable', 'dir', 'draggable', 'dropzone', 'hidden', 'id', 'lang', 'spellcheck', 'style', 'tabindex', 'title', 'translate'];

	protected $styleCollection;
	protected $classCollection;

	public function __construct(array $elements = []) {
		$this->classCollection = new ElementClassCollection();
		$this->styleCollection = new ElementStyleCollection();
		parent::__construct($elements);
	}

	public function count(): int {
		return $this->classCollection->count() + $this->styleCollection->count() + count($this->storage);
	}

	public function set($key, $content) {
		if (!$this->validate($key) || !$this->validate($content)) {
			throw new InvalidArgumentException('Only scalar values are accepted as attributes');
		}

		if ($content === true) {
			$content = $key;
		}

		if ($key === 'class') {
			$this->classCollection->add($content);
		}

		if ($key === 'style') {
			$this->styleCollection->set($key, $content);
		}

		parent::set($key, $content); // TODO: Change the autogenerated stub
	}

	public function class(): ElementClassCollection {
		return $this->classCollection;
	}

	public function style(): ElementStyleCollection {
		return $this->styleCollection;
	}

	public function __toString() {
		if ($this->classCollection->count()) {
			$this->set('class', (string) $this->classCollection);
		}

		if ($this->styleCollection->count()) {
			$this->set('style', (string) $this->styleCollection);
		}

		$items = [];
		foreach ($this->storage as $key => $current) {
			$items[] = sprintf($this->implodePattern, trim($key), trim(str_replace('"', "'", $current)));
		}

		return implode($this->implodeSpacing, $items);
	}

}
