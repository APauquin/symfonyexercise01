<?php

namespace App\DataFixtures;

use App\Entity\Program;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ProgramFixtures extends Fixture implements DependentFixtureInterface
{
    const PROGRAMS = [
        'shrek' => ['Shrek', 'C\'est shrek mec', 'category_Action', 'program_0'],
        'shrek2' => ['Shrek 2', 'C\'est shrek 2 mec', 'category_Aventure', 'program_1'],
        'shrek3' => ['Shrek 3', 'C\'est shrek 3 mec', 'category_Animation', 'program_2'],
        'shrek4' => ['Shrek 4', 'C\'est shrek 4 mec', 'category_Fantastique', 'program_3'],
        'shrek5' => ['Shrek 5', 'C\'est shrek 5 mec', 'category_Horreur', 'program_4'],
    ];

    public function load(ObjectManager $manager)
    {
        foreach (self::PROGRAMS as $key => $movie) {
            $program = new Program();
            $program->setTitle($movie[0]);
            $program->setSynopsis($movie[1]);
            $program->setCategory($this->getReference($movie[2]));
            $this->addReference($movie[3], $program);
            $manager->persist($program);
        }
        $manager->flush();
    }


    public function getDependencies()
    {
        return [
            CategoryFixtures::class,
        ];
    }
}
