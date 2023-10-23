<?php

namespace KnightScraper;

class Logger
{
	protected $errors;
	protected $warnings;
	protected $info;

	public function __construct()
	{
		$this->errors   = array();
		$this->warnings = array();
		$this->info     = array();
	}

	public function error(string $message): void
	{
		array_push($this->errors, 'Error: '. $message);
	}

	public function warning(string $message): void
	{
		array_push($this->warnings, 'Warning: '. $message);
	}

	public function info(string $message): void
	{
		array_push($this->info, 'Info: '. $message);
	}
}
