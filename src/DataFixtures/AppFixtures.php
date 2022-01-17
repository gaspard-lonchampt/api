<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Program;
use App\Entity\User;
use App\Entity\Show;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

use Faker;
class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // use the factory to create a Faker\Generator instance
        $faker = Faker\Factory::create('fr_FR');
        echo $faker->name();
        echo $faker->email();
        echo $faker->text();
        echo $faker->randomDigitNotNull();


        // Création de 3 fausses catégories
        for($i = 1 ; $i < 4 ; $i++)
        {
            $category = new Category();
            $category->setName('category '.$i);
            $category->setDescription($faker->text());

            $manager->persist($category); 

            $program = new Program();

            // create 60 users! Bam!
            for ($l =1; $l <= mt_rand(4,10); $l++) {
                $user = new User();

                $user->setEmail($faker->email());
                $user->setRoles([$faker->randomDigitNotNull()]);
                $user->setPassword($faker->password());
                $user->setName($faker->name());
                $user->setSurname($faker->name());
                $user->addProgram($program);

                $manager->persist($user);
            }

            // Création des programs     
            for($j = 1; $j <= mt_rand(4,6); $j++) {
    
                // $program = new Program();
                $content = '<p>' . join('</p><p>', $faker->paragraphs(5)) . '</p>';
                
                $program->setName('program '.$j);
                $program->setDescription($content);
                $program->setHostedBy($faker->name());
                $program->addCategory($category);
                $program->addFav($user);
                
                $manager->persist($program);
            }


        }
        $manager->flush();
    }
}