<?php

namespace KnightScraper;

class Logger
{
	public function __construct()
	{

	}

	public function error(string $message): void
	{
		echo('Error: '. $message .'\n');
	}

	public function warning(string $message): void
	{
		echo('Warning: '. $message .'\n');
	}

	public function info(string $message): void
	{
		echo('Info: '. $message .'\n');
	}
}
