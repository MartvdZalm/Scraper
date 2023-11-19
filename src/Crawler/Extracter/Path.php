<?php

namespace Scraper\Crawler\Extracter;

use JmesPath\CompilerRuntime;
use JmesPath\Parser;
use JmesPath\SyntaxErrorException;
use ReflectionNamedType;
use ReflectionProperty;

class Path extends Extracter
{
	private $compilerRuntime = null;

	public function __construct(protected string $name, private string $expression, protected bool $required = false)
	{
		parent::__construct($name);

		$this->setRequired($required);

		try {
			$parser = new Parser();
			$parser->parse($this->expression);
		} catch (SyntaxErrorException $e) {
			$this->throwPathException($e->getMessage());
		}
	}

	public function extract($content)
	{
		try {
			$object = $content;

			if (is_string($content) || is_numeric($content)) {
				$object = json_decode($content);
				if ($object === null) {
					$this->throwJsonException('Failed to json_decode content: ' . json_last_error_msg());
				}
			} elseif (is_array($content)) {
				$object = (object)$content;
			} elseif (!is_null($content) && !is_object($content)) {
				$this->throwPathException('Content is not an object and cannot be turned into one');
			}

			$result = $this->getCompilerRunTime()($this->expression, $object);

		} catch (SyntaxErrorException $e) {
			$this->throwPathException($e->getMessage());
		}

		return $result;
	}

	private function getCompilerRuntime(): CompilerRuntime
	{
		if ($this->compilerRuntime instanceof CompilerRunTime) {
			return $this->compilerRuntime;
		}

		return $this->compilerRuntime = new CompilerRuntime();
	}

	/**
	 * @throws Exception\Path
	 */
	private function throwPathException(string $message): never
	{
		throw new Exception\Path('Path failure: ' . $message . ', expression: ' . $this->expression . ', name: ' . $this->getName() . ', expectedType: ' . $this->expectedType);
	}

	/**
	 * @throws Exception\Json
	 */
	private function throwJsonException(string $message): never
	{
		throw new Exception\Json('JSON failure: ' . $message . ', expression: ' . $this->expression . ', name: ' . $this->getName() . ', expectedType: ' . $this->expectedType);
	}
}
