<?php

namespace App\Controller;

use App\Entity\Location;
use App\Repository\WeatherRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Doctrine\Attribute\MapEntity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\ExpressionLanguage\Tests\Node\Obj;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class WeatherController extends AbstractController
{
    #[Route('/weather/{city}', name: 'app_weather')]
    public function index(
        EntityManagerInterface $entityManager,
        string $city,
        WeatherRepository $repository
    ): Response {
        $locationRepository = $entityManager->getRepository(Location::class);

        $location = $locationRepository->findOneBy(['name' => $city]);

        $measurements = $repository->findByLocation($location);

        return $this->render('weather/city.html.twig', [
            'controller_name' => 'WeatherController',
            'measurements' => $measurements,
            'location' => $location
        ]);
    }
}
