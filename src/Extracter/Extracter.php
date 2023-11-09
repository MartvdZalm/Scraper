<?php

namespace KnightScraper\Extracter;

abstract class Extracter
{
	protected bool $required = false;

	public function __construct(protected string $name) {}

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

	abstract public function extract($content);
}
