<?php

namespace KnightScraper\Curl;

class Proxy
{
	private string $url;
	private string $username;
	private string $password;
	private int $timeout;

	public function __construct(string $url = '', string $username = '', string $password = '', int $timeout = 0)
	{
		$this->url      = $url;
		$this->username = $username;
		$this->password = $password;
		$this->timeout  = $timeout;
	}

	public function setUrl(string $url): void
	{
		$this->url = $url;
	}

	public function setUsername(string $username): void
	{
		$this->username = $username;
	}

	public function setPassword(string $password): void
	{
		$this->password = $password;
	}

	public function setTimeout(int $timeout): void
	{
		$this->timeout = $timeout;
	}

	public function getUrl(): string
	{
		return $this->url;
	}

	public function getUsername(): string
	{
		return $this->username;
	}

	public function getPassword(): string
	{
		return $this->password;
	}

	public function getTimeout(): int
	{
		return $this->timeout;
	}
}
