<?php
namespace KnightScraper;

class Curl
{
	protected string $url;
	protected \CurlHandle $curl;
	protected Logger $logger;

	public function __construct(string $url = '')
	{
		$this->url = $url;

		if (empty($url)) {
			$this->curl = new CurlHandle();
		} else {
			$this->curl = new CurlHandle($url);
		}
	}

	public function url(string $url): void
	{
		if ($this->validUrl($url)) {
			$this->url = $url;
			$this->curl = new CurlHandle($url);
		}
	}

	public function options(string ...$options): void
	{
		
	}

	protected function validUrl(): bool
	{
		if (is_null($this->url)) {
			$this->logger->error('URL is null');
			return false;
		}

		if (!filter_var($this->url, FILTER_VALIDATE_URL)) {
			$this->logger->error('URL is not valid');
			return false;
		}

		return true;
	}
}