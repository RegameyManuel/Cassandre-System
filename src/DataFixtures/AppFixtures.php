<?php

namespace App\DataFixtures;

use App\Entity\Client;
use App\Entity\Audit;
use App\Entity\DocumentAudit;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        /************************************  création des clients */
        $client1 = new Client();
        $client1->setName("ClientA");
        $client1->setEmail("Rclienta@yaloo.fr");
        /*
        $manager->persist($client0);
        $manager->persist($clientn*);
        */
        $manager->persist($client1);



        /************************************  création des audits */
        $audit1 = new Audit();
        $audit1->setName("SuperAudit_tropBien");
        $audit1->setClient($client1);
        $manager->persist($audit1);


        /************************************  création des documents lié à un audit */
        $doc1 = new DocumentAudit();
        $doc1->setName("MonPDFchouette");
        $doc1->setPath("/home/clienta/plouf");
        $doc1->setExtension(".plf");
        $doc1->setInfo("Confidentiel(plouf)");
        $doc1->setAudit($audit1);
        $manager->persist($doc1);

        $manager->flush();
    }
}
