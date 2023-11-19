<?php

namespace Scraper\Crawler\Extracter;

abstract class Extracter
{
	protected bool $required = false;
	protected string $format = '';

	public function __construct(protected string $name)
	{
	}

	public function getName(): string
	{
		return $this->name;
	}

	public function setRequired(bool $required = true): static
	{
		$this->required = $required;

		return $this;
	}

	public function isRequired(): bool
	{
		return $this->required;
	}

	public function format(string $format = 'Y-m-d H:i:s'): static
	{
		$this->format = $format;

		return $this;
	}

	public function getFormat(): string
	{
		return $this->format;
	}

	abstract public function extract($content);
}
