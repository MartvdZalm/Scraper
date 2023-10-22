<?php
namespace KnightScraper;

class Scraper
{
	const VERSION = '1.1';
	
	protected string $url;
	protected Logger $logger;

	public function __construct(string $url = '')
	{
		$this->url = $url;
		$this->logger = new Logger();
	}

	protected function validUrl(): bool
	{
		if (is_null($this->url)) {
			$this->logger->error("URL is null");
		}
	}
}