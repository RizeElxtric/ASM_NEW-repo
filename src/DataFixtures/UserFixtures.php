<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Persistence\ObjectManager;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
      //Khởi tạo constructor để import thư viện UserPasswordHasherInterface
    public function __construct(UserPasswordHasherInterface $hasherInterface)
    {
        $this -> hasher = $hasherInterface;
    }
  
    public function load(ObjectManager $manager): void
    {
        //Tạo tài khoản với ROLE_ADMIN
        $user = new User;
        $user -> setUsername("admin"); //unique
        $user -> setRoles(["ROLE_ADMIN"]); //security.yaml
        $user -> setPassword($this -> hasher -> hashPassword($user, "123456")); //__construct
        $manager -> persist($user);

        //Tạo tài khoản với ROLE_CUSTOMER
        $user = new User;
        $user -> setUsername("customer"); //unique
        $user -> setRoles(["ROLE_CUSTOMER"]); //security.yaml
        $user -> setPassword($this -> hasher -> hashPassword($user, "123456")); //__construct
        $manager -> persist($user);

        $manager->flush();
    }
}