<?php

namespace App\DataFixtures;

use App\Entity\Semester;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class SemesterFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i=1;$i<20;$i++) 
        {
            $semester = new Semester;
            $semester->setName("Semester $i")
                     ->setPeriod("4 months");
            $manager->persist($semester);
        }

        $manager->flush();
    }
}