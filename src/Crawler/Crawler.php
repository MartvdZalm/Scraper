<?php

namespace Scraper\Crawler;

use Scraper\Crawler\Curl\Curl;

class Crawler
{
	private Curl $curl;
	protected string $url;

	public function __construct()
	{
		if ($this::URL !== null) {
			$this->url = $this::URL;
			$this->crawl();
		} else {
			throw new Exception('URL constant not defined in child class.');
		}
	}

	protected function crawl(): void
	{
		$curl    = new Curl($this->url);
		$content = $curl->run();

		$this->parse($this->url, $content);
	}

	protected function parse(string $url, string $content): bool
	{
	}
}
