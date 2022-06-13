<?php

namespace App\DataFixtures;

use App\Entity\Role;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Generator;
use Faker\Provider\en_US\Person;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    /**
     * @var Generator
     */
    private Generator $faker;

    //A copier
    /* private UserPasswordHasherInterface $hasher; */

    public function __construct(/* UserPasswordHasherInterface $hasher */)
    {
        $this->faker = Factory::create("en_US");
        /* $this->hasher = $hasher; */
    }

    public function load(ObjectManager $manager): void
    {
        for($i = 0; $i < 12; $i++)
        {
            $user = new User();
            $user->setLastname($this->faker->lastName())
                ->setFirstname($this->faker->firstName())
                ->setEmail($this->faker->freeEmail())
                ->setRoles(["ROLE_ADMIN"])
                /* ->setRoles($user->getRoles()) */
                ->setConfirmPassword("test");

                /* $hash_password = $this->hasher->hashPassword(
                    $user,
                    "test"
                ); */
                /* $user->setPassword($hash_password); */
                //$user->setConfirmPassword($user->getPassword());

            $manager->persist($user);
        }
        $manager->flush();
    }
}
