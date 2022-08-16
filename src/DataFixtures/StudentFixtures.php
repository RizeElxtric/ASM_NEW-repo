<?php

namespace App\DataFixtures;

use App\Entity\Student;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class StudentFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i=1;$i<20;$i++) {
            $student= new Student;
            $student->setName("Student $i")
                    ->setPhone(0+rand(100000000,999999999))
                    ->setEmail("student$i@fpt.edu.vn");
        }

        $manager->flush();
    }
}