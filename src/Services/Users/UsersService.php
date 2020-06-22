<?php
/**
 * notifyapp - UsersService.php
 *
 * Initial version by: Toamsz Solik
 * Initial version created on: 11.06.20 / 09:52
 */

namespace App\Services\Users;

use App\Entity\Users\Users;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class UsersService
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
     * LoginService constructor.
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
    }

    /**
     * @param int $id
     * @return object|null
     */
    public function getById(int $id)
    {
        try {

            return $this->em->getRepository(Users::class)->findOneBy([
                'id' => $id,
                'ghost' => false
            ]);

        } catch (\Exception $ex) {
            $this->logger->critical(__METHOD__, ['ex' => $ex->getMessage()]);
        }

    }
}