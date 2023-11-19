<?php

namespace Scraper\Crawler;

use Scraper\Crawler\Curl\Curl;
use Scraper\Crawler\Logger\Logger;

class Crawler
{
	private Curl $curl;
	protected Logger $logger;
	protected string $url;

	public function __construct()
	{
		$this->logger = new Logger();

		if ($this::URL !== null) {
			$this->url = $this::URL;
			$this->crawl();
		} else {
			throw new Exception('URL constant not defined in child class.');
		}
	}

	protected function crawl(): void
	{	
		$this->logger->info('Crawl Started');

		$curl    = new Curl($this->url);
		$content = $curl->run();

		$this->parse($this->url, $content);
	}

	protected function parse(string $url, string $content): bool
	{
	}
}
