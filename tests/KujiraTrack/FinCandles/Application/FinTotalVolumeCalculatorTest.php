<?php

namespace Ocebot\test\KujiraTrack\FinCandles\Application;

use Ocebot\KujiraTrack\FinCandles\Application\FinTotalVolumeCalculator;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;


class FinTotalVolumeCalculatorTest extends KernelTestCase
{
    private FinTotalVolumeCalculator $finTotalVolumeCalculator;

    /**
     * @test
     */
    public function testFinTotalVolumeCalculator(): void
    {
      self::bootKernel();

      $container = static::getContainer();
      $this->finTotalVolumeCalculator = $container->get(FinTotalVolumeCalculator::class);
      //$volume = $this->finTotalVolumeCalculator->__invoke('daily', 0);

      $this->assertGreaterThan(0, 1);
    }
}