<?php

namespace App\DataFixtures\Users;

use App\Entity\Channels\Channels;
use App\Entity\Channels\ChannelsUsers;
use App\Entity\Users\Users;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UsersFixtures extends Fixture
{
    /**
     * @var EntityManagerInterface
     */
    private $em;
    /**
     * @var UserPasswordEncoderInterface
     */
    private $encoder;

    /**
     * UsersFixtures constructor.
     * @param EntityManagerInterface $em
     * @param UserPasswordEncoderInterface $encoder
     */
    public function __construct(
        EntityManagerInterface $em,
        UserPasswordEncoderInterface $encoder
    ) {
        $this->em = $em;
        $this->encoder = $encoder;
    }

    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $this->fixtureUsers($manager);
    }

    /**
     * @param ObjectManager $manager
     */
    private function fixtureUsers(ObjectManager $manager)
    {
        $users = [
            [
                'role' => 1,
                'email' => 'user@user.com',
                'username' => 'user',
                'password' => 'password123!',
            ],
            [
                'role' => 2,
                'email' => 'moderator@moderator.com',
                'username' => 'moderator',
                'password' => 'password123!',
            ],
            [
                'role' => 3,
                'email' => 'admin@admin.com',
                'username' => 'admin',
                'password' => 'password123!',
            ],
        ];
        foreach ($users as $u) {
            $user = new Users();
            $user->setRole($u['role'])
                ->setEmail($u['email'])
                ->setUsername($u['username'])
                ->setPassword($this->encoder->encodePassword($user, $u['password']));
            $manager->persist($user);
            $this->fixtureChannelsUsers($manager, $user);

        }
        $manager->flush();
    }

    /**
     * @param ObjectManager $manager
     * @param Users $user
     */
    private function fixtureChannelsUsers(ObjectManager $manager, Users $user)
    {
        $channels = $this->em->getRepository(Channels::class)->findAll();
        foreach ($channels as $channel) {
            $channelsUsers = (new ChannelsUsers())
                ->setChannel($channel)
                ->setUsers($user)
                ->setRole(1)
                ->setNotify(0);
            $manager->persist($channelsUsers);
        }
        $manager->flush();
    }
}
