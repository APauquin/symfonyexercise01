<?php

namespace App\DataFixtures;

use App\Entity\Episode;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Faker\Factory;

class EpisodeFixtures extends Fixture implements DependentFixtureInterface
{
    const EPISODES = [
        'episode1' => [1, 'Attaque de shrek', 'Un episode a la con', 'season1_shrek', 2001],
        'episode2' => [2, 'La revange de shrek', 'Un autre episode a la con', 'season1_shrek', 2002],
        'episode3' => [3, 'Amour de shrek', 'Encore un episode a la con', 'season1_shrek', 2003],
    ];

    public function load(ObjectManager $manager)
    {
        $faker = Factory::create();
        for ($j=0; $j<SeasonFixtures::$seasonNumber; $j++) {
            for ($i = 0; $i < 50; $i++) {
                $episode = new Episode();
                $episode->setNumber($i + 1);
                $episode->setTitle($faker->realText($maxNbChars = 15));
                $episode->setSynopsis($faker->paragraphs(3, true));
                $episode->setSeason($this->getReference('season'.$j.'_shrek'));
                $manager->persist($episode);
            }
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            SeasonFixtures::class,
        ];
    }

}