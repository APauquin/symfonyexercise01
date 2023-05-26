<?php

namespace App\DataFixtures;

use App\Entity\Season;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Faker\Factory;

class SeasonFixtures extends Fixture implements DependentFixtureInterface
{
    const SEASONS = [
        'season1' => [1, 'Une serie a la con', 'program_1', 2001, 'season1_shrek'],
    ];

    public static int $seasonNumber = 0;
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create();

        foreach (ProgramFixtures::PROGRAMS as $key => $program) {
            for($i = 0; $i < 10; $i++) {
                $season = new Season();
                $season->setNumber($i + 1);
                $season->setYear($faker->year());
                $season->setDescription($faker->paragraphs(3, true));
                $season->setProgram($this->getReference($program[3]));
                $this->addReference('season'.self::$seasonNumber.'_shrek', $season);
                $manager->persist($season);
                self::$seasonNumber++;
             }
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            ProgramFixtures::class,
        ];
    }
}