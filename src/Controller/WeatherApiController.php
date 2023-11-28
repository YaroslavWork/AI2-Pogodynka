<?php

namespace App\Controller;

use App\Entity\Location;
use App\Entity\Weather;
use App\Service\WeatherUtil;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapQueryParameter;
use Symfony\Component\Routing\Annotation\Route;

class WeatherApiController extends AbstractController
{
    #[Route('/api/v1/weather/', name: 'app_weather_api')]
    public function index(
        WeatherUtil $util,
        #[MapQueryParameter("city")] string $city,
        #[MapQueryParameter("code")] string $code,
        #[MapQueryParameter("format")] string $format = 'json',
        #[MapQueryParameter('twig')] bool $twig = false
    ): Response
    {
        $measurements = $util->getWeatherForCountryAndCity($code, $city);

        if ($twig) {
            if ($format === 'json') {
                return $this->render('weather_api/index.json.twig', [
                    'city' => $city,
                    'country' => $code,
                    'measurements' => $measurements[1],
                ]);
            } else {
                return $this->render('weather_api/index.csv.twig', [
                    'city' => $city,
                    'country' => $code,
                    'measurements' => $measurements[1],
                ]);
            }


        } else {
            if ($format === 'json') {
                return $this->json([
                    'city' => $city,
                    'country' => $code,
                    'measurements' => array_map(fn(Weather $m) => [
                        'date' => $m->getDate()->format('Y-m-d'),
                        'celsius' => $m->getTemperature(),
                        'fahrenheit' => $m->getFahrenheit(),
                    ], (array)$measurements[1]),

                ]);
            } else {
                $csv = "city,country,date,celsius\n";
                $csv .= implode(
                    "\n",
                    array_map(fn(Weather $m) => sprintf(
                        '%s,%s,%s,%s,%s',
                        $city,
                        $code,
                        $m->getDate()->format('Y-m-d'),
                        $m->getTemperature(),
                        $m->getFahrenheit()
                    ), (array)$measurements[1])
                );

                return new Response($csv, 200, [
                    'Content-Type' => 'text/csv'
                ]);
            }
        }
    }
}
