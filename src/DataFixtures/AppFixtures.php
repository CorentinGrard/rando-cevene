<?php

namespace App\DataFixtures;

use App\Entity\Categorie;
use App\Entity\Randonnee;
use App\Repository\CategorieRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use \DateTime;
use Faker;

class AppFixtures extends Fixture
{

    private $faker;

    public function __construct()
    {
        $this->faker = Faker\Factory::create('fr_FR');
    }

    public function load(ObjectManager $manager)
    {

        $ane = new Categorie();
        $ane->setNom("âne");
        $manager->persist($ane);
        $pedestre = new Categorie();
        $pedestre->setNom("pédestre");
        $manager->persist($pedestre);
        $velo = new Categorie();
        $velo->setNom("vélo");
        $manager->persist($velo);
        $equestre = new Categorie();
        $equestre->setNom("équestre");
        $manager->persist($equestre);
        $categories = array($ane,$pedestre, $velo,$equestre);

        for ($i = 0; $i < 100; $i++) {
            $randonnee = new Randonnee();
            $randonnee->setTitre($this->faker->streetAddress());
            $randonnee->setDescription($this->faker->text(200));
            $randonnee->setDate($this->faker->dateTimeBetween("-1 years", "+2 years"));
            $randonnee->setDuree($this->faker->numberBetween(1, 7));

            $idCategorie = $this->faker->numberBetween(0, 3);
            $categorie = $categories[$idCategorie];
            $randonnee->setCategorie($categorie);

            $manager->persist($randonnee);
        }
        $manager->flush();
    }
}
