<?php

namespace App\DataFixtures;

use App\Entity\Major;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class MajorFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $names = ["IT", "Designer", "Digital Marketing"];

        for ($i = 1; $i <= 15; $i++) {
            $key = array_rand($names, 1);
            $major = new Major;
            $major  ->setName($names[$key])
                    ->setInfo("Your chosen field of study at GreenWich University");
            $manager->persist($major);
        }

        $manager->flush();
    }
}
