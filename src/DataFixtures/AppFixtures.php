<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Entreprise;
use App\Entity\Stage;
use App\Entity\Formation;
use Faker;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
      // On configure dans quelles langues nous voulons nos données
      $faker = Faker\Factory::create('fr_FR');

      // on créé 10 personnes
      for ($i = 0; $i < 10; $i++) {
          $stage = new Stage();
          $stage->setTitre($faker->jobTitle);
          $stage->setDescription($faker->realText($maxNbChars = 200, $indexSize = 2));
          $stage->setDateDebut($faker->DateTime($max = 'now'));
          $stage->setDateFin($faker->DateTime($max = 'now'));
          $stage->setContact($faker->companyEmail);

          $entreprise = new Entreprise();
          $entreprise->setNom($faker->company);
          $entreprise->setContact("unContact");
          $entreprise->setAdresse($faker->address);
          $entreprise->setNumTel($faker->phoneNumber);
          $entreprise->setSite($faker->url);
          $entreprise->addStage($stage);

          $formation = new Formation();
          $formation->setType($faker->randomElement($array = array ('DUT Informatique','LP Prog','LP Num', 'DUT TIC', 'DUT GEA', 'Master Biologie')));
          $formation->setDescription($faker->realText($maxNbChars = 200, $indexSize = 2));
          $formation->addStage($stage);

          $stage->setEntreprise($entreprise);
          $stage->addFormation($formation);

          $manager->persist($stage);
          $manager->persist($formation);
          $manager->persist($entreprise);
      }
        $manager->flush();
    }
}
