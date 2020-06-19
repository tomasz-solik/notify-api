<?php

namespace App\DataFixtures\Users;

use App\Entity\Users\Users;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UsersFixtures extends Fixture
{
    /**
     * @var UserPasswordEncoderInterface
     */
    private $encoder;

    /**
     * UsersFixtures constructor.
     * @param UserPasswordEncoderInterface $encoder
     */
    public function __construct(UserPasswordEncoderInterface $encoder)
    {
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

        }
        $manager->flush();
    }
}
