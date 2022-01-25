<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Program;
use App\Entity\Show;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // use the factory to create a Faker\Generator instance
        $faker = Faker\Factory::create('fr_FR');

        // Création de 3 fausses catégories
        for($i = 1 ; $i < 4 ; $i++)
        {
            $category = new Category();
            $category->setName($faker->word());
            $category->setDescription($faker->text());

            $manager->persist($category); 


            // Création des programs     
            for($j = 1; $j <= mt_rand(4,6); $j++) {
    
                $program = new Program();
                $content = '<p>' . join('</p><p>', $faker->paragraphs(5)) . '</p>';
                
                $program->setName($faker->word());
                $program->setDescription($content);
                $program->setHostedBy($faker->name());
                $program->addCategory($category);
                
                $manager->persist($program);
            }

            // create 60 users! Bam!
            for ($l =1; $l <= mt_rand(4,10); $l++) {
                $user = new User();

                $user->setName($faker->name());
                $user->setSurname($faker->name());
                $user->setEmail($faker->email());
                $user->setPassword($faker->password());
                $user->addProgram($program);

                $manager->persist($user);
            }
            // Creation des show
            for($k = 1 ; $k <= mt_rand(4,10) ; $k++) {
                $show = new Show(); 

                $content = '<p>' . join('</p><p>', $faker->paragraphs(2)) . '</p>';
                
                $date = new \DateTimeImmutable($faker->date('Y-m-d H:i:s'));

                $show->setName($faker->word());
                $show->setDescription($content);
                $show->setHostedBy($faker->name());
                $show->setGuest($faker->name());
                $show->setStartAt($date);
                $show->setEndAt($date);
                $show->setCreatedAt($date);
                $show->setProgram($program);

                $manager->persist($show); 

            }
        }
        $manager->flush();
    }
}