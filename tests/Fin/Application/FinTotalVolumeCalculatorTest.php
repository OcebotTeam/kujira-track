<?php

namespace Ocebot\KujiraTrack\tests\Fin\Application;

use Ocebot\KujiraTrack\Fin\Application\FinTotalUsdVolumeObtainer;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;


class FinTotalVolumeCalculatorTest extends KernelTestCase
{
    private FinTotalUsdVolumeObtainer $finTotalVolumeCalculator;

    /**
     * @test
     */
    public function testFinTotalVolumeCalculator(): void
    {
      self::bootKernel();

      $container = static::getContainer();
      $this->finTotalVolumeCalculator = $container->get(FinTotalUsdVolumeObtainer::class);
      //$volume = $this->finTotalVolumeCalculator->__invoke('daily', 0);

      $this->assertGreaterThan(0, 1);
    }
}