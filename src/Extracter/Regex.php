<?php

namespace KnightScraper\Extracter;

class Regex extends Extracter
{
	private string|int|null $returnSingleKey = null;
	private ?array $returnMultipleKeys       = null;

	public function __construct(string $name, protected string $regex, protected bool $all = false)
	{
		parent::__construct($name);
		$this->regex = $regex;
	}

	public function getMatchAll(): bool
	{
		return $this->all;
	}

	public function setReturnSingleKey(int|string $key): self
	{
		if (!is_numeric($key) && !preg_match('/\?P?<' . preg_quote($key) . '>/', $this->regex)) {
			echo('The regex does not have a named capture ' . $key);
		}

		$this->returnSingleKey = $key;

		return $this;
	}

	public function setReturnMultipleKeys(array $keys): self
	{
		foreach ($keys as $key) {
			if (!is_numeric($key) && !preg_match('/\?P?<' . preg_quote($key) . '>/', $this->regex)) {
				echo('The regex does not have a named capture "' . $key . '"');
			}
		}

		$this->returnMultipleKeys = $keys;

		return $this;
	}

	public function getReturnMultipleKeys(): ?array
	{
		return $this->returnMultipleKeys;
	}

	public function hasReturnMultipleKeys(): bool
	{
		return isset($this->returnMultipleKeys) && count($this->returnMultipleKeys) > 0;
	}

	public function hasReturnSingleKey(): bool
	{
		return isset($this->returnSingleKey);
	}

	public function extract($content)
	{
		return $this->all ? $this->matchAll($content) : $this->match($content);
	}

	private function matchAll(string $content)
	{
		$result = preg_match_all($this->regex, $content, $matches, PREG_SET_ORDER);

		if ($result === 0) {
			return null;
		}

		$ret = [];

		foreach ($matches as $key => $match) {
			if ($this->returnMultipleKeys !== null) {
				$match = array_intersect_key($match, array_flip($this->returnMultipleKeys));
			} elseif ($this->returnSingleKey !== null) {
				$match = $match[$this->returnSingleKey];
			}

			$ret[] = $match;
		}

		return $ret;
	}

	private function match(string $content)
	{
		$result = preg_match($this->regex, $content, $match);

		if ($result === 0) {
			return null;
		}

		if ($this->returnMultipleKeys !== null) {
			return $match = array_intersect_key($match, array_flip($this->returnMultipleKeys));
		} elseif ($this->returnSingleKey !== null) {
			return $match[$this->returnSingleKey];
		}

		return $match;
	}
}
