<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class UserFixture extends Fixture
{
    const ADMIN_USER_REFERENCE = 'admin-user';
    const CLIENT1_USER_REFERENCE = 'client1-user';
    const CLIENT2_USER_REFERENCE = 'client2-user';

    public function load(ObjectManager $manager)
    {
        $plainPassword = "test";

        //User1 - admin
        $user1 = new User();
        $user1->setUsername('admin');
        $user1->setEmail("admin@aqf.com");
        $user1->setPassword($this->getEncodedPassword($plainPassword,$user1));
        $user1->setRoles(array("ROLE_ADMIN"));
        $manager->persist($user1);

        $this->addReference(self::ADMIN_USER_REFERENCE, $user1);

        //User2 - client1
        $user2 = new User();
        $user2->setUsername('client1');
        $user2->setEmail("client1@aqf.com");
        $user2->setPassword($this->getEncodedPassword($plainPassword,$user2));
        $user2->setRoles(array("ROLE_CLIENT"));
        $manager->persist($user2);

        $this->addReference(self::CLIENT1_USER_REFERENCE, $user2);

        //User3 - client2
        $user3 = new User();
        $user3->setUsername('client2');
        $user3->setEmail("client2@aqf.com");
        $user3->setPassword($this->getEncodedPassword($plainPassword,$user3));
        $user3->setRoles(array("ROLE_CLIENT"));
        $manager->persist($user3);

        $this->addReference(self::CLIENT2_USER_REFERENCE, $user3);

        $manager->flush();
    }

    public function getEncodedPassword($plainPassword, $user) {
        $encoder = $this->container->get('security.password_encoder');
        $encoded = $encoder->encodePassword($user, $plainPassword);
        return $encoded;
    }
}