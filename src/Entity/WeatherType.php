<?php

namespace App\Entity;

use App\Repository\WeatherTypeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: WeatherTypeRepository::class)]
class WeatherType
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $precipitationType = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $description = null;

    #[ORM\OneToMany(mappedBy: 'weatherType', targetEntity: Weather::class)]
    private Collection $weather;

    public function __construct()
    {
        $this->weather = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrecipitationType(): ?string
    {
        return $this->precipitationType;
    }

    public function setPrecipitationType(string $precipitationType): static
    {
        $this->precipitationType = $precipitationType;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection<int, Weather>
     */
    public function getWeather(): Collection
    {
        return $this->weather;
    }

    public function addWeather(Weather $weather): static
    {
        if (!$this->weather->contains($weather)) {
            $this->weather->add($weather);
            $weather->setWeatherType($this);
        }

        return $this;
    }

    public function removeWeather(Weather $weather): static
    {
        if ($this->weather->removeElement($weather)) {
            // set the owning side to null (unless already changed)
            if ($weather->getWeatherType() === $this) {
                $weather->setWeatherType(null);
            }
        }

        return $this;
    }
}
