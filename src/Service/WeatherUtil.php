<?php
declare(strict_types=1);

namespace  App\Service;

use App\Entity\Location;
use App\Entity\Weather;
use App\Repository\LocationRepository;
use App\Repository\WeatherRepository;

class WeatherUtil
{
    public function __construct(
        private readonly LocationRepository $locationRepository,
        private readonly WeatherRepository $weatherRepository,
    )
    {
    }


    /**
     * @return Weather[]
     */
    public function getWeatherForLocation(Location $location): array
    {
        $measurements = $this->weatherRepository->findByLocation($location);
        return $measurements;
    }

    /**
     * @return Weather[]
     */
    public function getWeatherForCountryAndCity(string $countryCode, string $city): array
    {
        $location = $this->locationRepository->findOneByCountryCodeAndName($countryCode, $city);

        return [$location, $this->getWeatherForLocation($location)];
    }
}
