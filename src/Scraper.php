<?php
namespace KnightScraper;

class Scraper
{
	protected string $url;
	protected Logger $logger;
	protected Curl $curl;

	public function __construct(string $url = '')
	{
		$this->url = $url;
		$this->logger = new Logger();

		if (empty($url)) {
			$this->curl = new CurlHandle();
		} else {
			$this->curl = new CurlHandle($url);
		}
	}

	public function start(): string
	{

	}
}