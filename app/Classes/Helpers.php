<?php

namespace Ocebot\KujiraTrack\App\Classes;

use Doctrine\ORM\EntityManagerInterface;

class Helpers
{
    public function getEntityPerDay(EntityManagerInterface $entityManager, $class)
    {
        $entity_repo = $entityManager->getRepository($class);
        $all_enities = $entity_repo->findBy([], ["tracked" => "ASC"]);
        $prev_day_date = null;

        // Filter to get just 1 record per day
        return array_filter($all_enities, function ($item) use (&$prev_day_date) {
            $item_date = $item->getTracked();

            if (is_null($prev_day_date) || $item_date->format('Y-m-d') != $prev_day_date->format('Y-m-d')) {
                $prev_day_date = $item_date;
                return true;
            }

            return false;
        });
    }
}
