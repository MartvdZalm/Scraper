<?php

namespace Scraper\Crawler;

class Buienradar extends Crawler
{
	public const URL = 'https://forecast.buienradar.nl/2.0/forecast/2757783?ak=3c4a3037-85e6-4d1e-ad6c-f3f6e4b75f2f';

	protected function parse(string $url, string $content): bool
	{

		return true;
	}

	protected function getRootExtracterChain(): Chain
	{
		return (new Chain())
			->add(
				
			);
	}
}
