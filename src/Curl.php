<?php

namespace KnightScraper;

use CurlHandle;

class Curl
{
	protected string $url;
	protected string $response;

	protected CurlHandle $curl;
	protected Logger $logger;

	public function __construct(string $url = '')
	{
		$this->url = $url;
		$this->response = '';
		$this->logger = new Logger();

		if (empty($url)) {
			$this->curl = curl_init();
		} else {
			$this->curl = curl_init($url);
		}

		$this->setup();
	}

	public function url(string $url): void
	{
		if ($this->validUrl($url)) {
			if ($this->url !== $url) {
				$this->logger->warning('URL has been overriden from '.$this->url.' to '.$url.'');
			}
			$this->url = $url;
			curl_setopt($this->curl, CURLOPT_URL, $url);
		}
	}

	public function options(array $options): void
	{
		foreach ($options as $key => $value) {
			curl_setopt($this->curl, $key, $value);
		}
	}

	public function response(): string
	{
		return $this->response;
	}

	public function start(): void
	{
		$this->logger->info("Curl started");
		$this->response = curl_exec($this->curl);

		if (curl_errno($this->curl)) {
			$this->logger->error(curl_error($this->curl));
		}
	}

	public function close(): void
	{
		$this->logger->info("Curl closed");
		curl_close($this->curl);
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

	protected function setup(): void
	{
		curl_setopt($this->curl, CURLOPT_RETURNTRANSFER, true);
	}
}
