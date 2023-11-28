<?php

namespace App\Tests\Entity;

use App\Entity\Weather;
use PHPUnit\Framework\TestCase;

class WeatherTest extends TestCase
{
    public function dataGetFahrenheit(): array
    {
        return [
            ['0', 32],
            ['0.5', 32.9],
            ['10', 50],
            ['-40', -40],
            ['-100', -148],
            ['99.9', 211.82],
            ['100', 212],
            ['-273.15', -459.67],
            ['3251.2', 5884.16],
            ['-5', 23]
        ];
    }

    /**
     * @dataProvider dataGetFahrenheit
     */
    public function testGetFahrenheit($celsius, $expectedFahrenheit): void
    {
        $weather = new Weather();

        $weather->setTemperature($celsius);
        $this->assertEquals(
            $expectedFahrenheit,
            $weather->getFahrenheit());
    }
}
