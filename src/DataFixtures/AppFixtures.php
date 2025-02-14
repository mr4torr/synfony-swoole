<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    public function __construct(private UserPasswordHasherInterface $hasher) {}

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        for ($i = 0; $i < 20; $i++) {
            $resource = new User();
            $resource->setName($faker->name());
            $resource->setEmail($faker->email());
            $resource->setPassword(
                $this->hasher->hashPassword($resource, $faker->password())
            );
            $manager->persist($resource);
        }

        $manager->flush();
    }
}
