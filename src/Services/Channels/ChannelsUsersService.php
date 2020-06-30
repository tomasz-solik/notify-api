<?php
/**
 * notify-api - ChannelsUsersService.php
 *
 * Initial version by: Toamsz Solik
 * Initial version created on: 30.06.20 / 14:45
 */

namespace App\Services\Channels;


use App\Entity\Channels\ChannelsUsers;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;

class ChannelsUsersService
{
    /**
     * @var EntityManagerInterface
     */
    private $em;

    /**
     * @var ContainerInterface
     */
    private $container;
    /**
     * @var LoggerInterface
     */
    private $logger;
    /**
     * @var TokenInterface
     */
    private $token;

    /***
     * ChannelsUsersService constructor.
     * @param EntityManagerInterface $em
     * @param ContainerInterface $container
     * @param LoggerInterface $logger
     */
    public function __construct(
        EntityManagerInterface $em,
        ContainerInterface $container,
        LoggerInterface $logger
    ) {
        $this->em = $em;
        $this->container = $container;
        $this->logger = $logger;
        $this->token = $this->container->get('security.token_storage')->getToken();
    }

    /**
     * @return object[]
     */
    public function getMyAll()
    {
        try {
            return $this->em->getRepository(ChannelsUsers::class)->findBy([
                'users' => $this->token->getUser(),
                'ghost' => false,
            ]);
        } catch (\Exception $ex) {
            $this->logger->critical(__METHOD__, ['ex' => $ex->getMessage()]);
        }

    }

}