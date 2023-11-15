<?php

namespace App\Controller;

use App\Entity\Location;
use App\Repository\LocationRepository;
use App\Repository\WeatherRepository;
use App\Service\WeatherUtil;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Doctrine\Attribute\MapEntity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\ExpressionLanguage\Tests\Node\Obj;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class WeatherController extends AbstractController
{
    #[Route('/weather/{code}/{city}', name: 'app_weather')]
    public function index(
        string $code,
        string $city,
        WeatherUtil $util
    ): Response {
        list($location, $measurements) = $util->getWeatherForCountryAndCity($code, $city);

        return $this->render('weather/city.html.twig', [
            'controller_name' => 'WeatherController',
            'measurements' => $measurements,
            'location' => $location
        ]);
    }
}
