<?php

namespace Scraper\Crawler\Extracter;

class Chain
{
	private array $chain = [];
	private array $names = [];

	public function __construct()
	{
	}

	public function getChain(): array
	{
		return $this->chain;
	}

	public function addPrefilter(Extracter ...$extracters): self
	{
		foreach ($extracters as $extracter) {
			$name = $extracter->getName();

			if (isset($this->names[$name])) {
				echo('An extracter with the name ' . $name . ' has already been added.');
			}

			$this->names[$name] = true;
			$this->chain[] = $extracter;
		}

		return $this;
	}

	public function add(Extracter ...$extracters): self
	{
		foreach ($extracters as $extracter) {
			$name = $extracter->getName();

			if (isset($this->names[$name])) {
				echo('An extracter with the name ' . $name . ' has already been added.');
			}

			$this->names[$name] = true;
			$this->chain[]      = $extracter;
		}

		return $this;
	}

	public function extract($content)
	{
		$ret = [];

		foreach ($this->chain as $extracter) {
			$name   = $extracter->getName();
			$result = $extracter->extract($content);

			if ($result === null) {
				if ($extracter->isRequired()) {
					echo('Required item ' . $this->namePrefix . $name . ' is missing');
				}

				continue;
			}

			$ret[$name] = $result;
		}

		return $ret;
	}
}
