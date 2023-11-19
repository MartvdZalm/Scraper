<?php

namespace Scraper\Crawler;

use Scraper\Crawler\Extracter\Chain;
use Scraper\Crawler\Extracter\Path;

class Buienradar extends Crawler
{
	public const URL = 'https://forecast.buienradar.nl/2.0/forecast';

	protected function parse(string $url, string $content): bool
	{
		$days = $this->getDaysExtracterChain()->extract($content);

		foreach ($days['days'] as $day) {
			$info = $this->getInfoExtracterChain()->extract($day);

			$this->logger->info(json_encode($info));
		}

		return true;
	}

	protected function getDaysExtracterChain(): Chain
	{
		return (new Chain())
			->add(
				(new Path('days', 'days')),
			);
	}

	protected function getInfoExtracterChain(): Chain
	{
		return (new Chain())
			->add(
				(new Path('date', 'date'))->format('Y-m-d'),
				(new Path('sunrise', 'sunrise'))->format('H:i:s'),
				(new Path('sunset', 'sunset'))->format('H:i:s'),
				(new Path('winddirection', 'winddirection')),
				(new Path('windspeedms', 'windspeedms')),
				(new Path('mintemp', 'mintemp')),
				(new Path('maxtemp', 'maxtemp'))
			);
	}
}
