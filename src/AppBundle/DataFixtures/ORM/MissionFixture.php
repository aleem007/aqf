<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Mission;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\DataFixtures\ORM\UserFixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class MissionFixture extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        for($i=0;$i<20;$i++)  {

            $clients = array(
                UserFixture::CLIENT1_USER_REFERENCE,
                UserFixture::CLIENT2_USER_REFERENCE
            );

            $mission = new Mission();
            $mission->setClient($this->getReference($clients[array_rand($clients)]));
            $mission->setDestinationCountry("England");
            $mission->setQuantity(rand(1,100));
            $mission->setProductName("Example Product ".rand(1,100));
            $serviceDate = new \DateTime();
            $serviceDate->setTimestamp(rand(1167609600,1560627338));
            $mission->setServiceDate($serviceDate);
            $mission->setVendorName("Vendor ".rand(1,100));
            $mission->setVendorEmail("Vendoremaial".rand(1,100)."@gmail.com");
            $manager->persist($mission);
        }

        $manager->flush();
    }

    public function getEncodedPassword($plainPassword, $user) {
        $encoder = $this->container->get('security.password_encoder');
        $encoded = $encoder->encodePassword($user, $plainPassword);
        return $encoded;
    }

    public function getDependencies()
    {
        return array(
            UserFixture::class,
        );
    }
}