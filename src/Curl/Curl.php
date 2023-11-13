<?php

namespace KnightScraper\Curl;

use CurlHandle;
use KnightScraper\Logger\Logger;

class Curl
{
	protected string $response;
	protected CurlHandle $curl;
	protected Logger $logger;

	public function __construct(string $url = '')
	{
		$this->logger = new Logger();
		$this->curl   = curl_init($url);
		$this->setup();
	}

	public function run(): string
	{
		$this->start();
		$this->close();

		return $this->response;
	}

	public function addProxy(Proxy $proxy): void
	{
		curl_setopt($this->curl, CURLOPT_PROXY, $proxy->getUrl());
		curl_setopt($this->curl, CURLOPT_PROXYUSERPWD, $proxy->getUsername().':'.$proxy->getPassword());
		curl_setopt($this->curl, CURLOPT_PROXY_CONNECT_TIMEOUT, $proxy->getTimeout());
	}

	protected function start(): void
	{
		$this->logger->info('Curl started');
		$this->response = curl_exec($this->curl);

		if (curl_errno($this->curl)) {
			$this->logger->error(curl_error($this->curl));
		}
	}

	protected function close(): void
	{
		$this->logger->info('Curl closed');
		curl_close($this->curl);
	}

	protected function setup(): void
	{
		curl_setopt($this->curl, CURLOPT_RETURNTRANSFER, true);
	}
}
