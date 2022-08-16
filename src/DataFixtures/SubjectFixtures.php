<?php

namespace App\DataFixtures;

use App\Entity\Subject;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class SubjectFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $names = ["IT", "Designer", "Digital Marketing"];
        for ($i = 1; $i <= 15; $i++) {
            $key = array_rand($names, 1);
            $subject = new Subject;
            $subject ->setName($names[$key])
                    ->setInfo("Description of subject")
                    ->setFee(rand(200,300));
            $manager->persist($subject);
        }
        $manager->flush();
    }
}
