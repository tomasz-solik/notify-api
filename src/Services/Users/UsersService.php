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
use Overblog\GraphQLBundle\Definition\Argument;
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
     * @param Argument $argument
     * @return object|null
     */
    public function getOne(Argument $argument)
    {
        try {
            return $this->em->getRepository(Users::class)->findOneBy([
                'id' => $argument->offsetGet('id'),
                'ghost' => false,
            ]);
        } catch (\Exception $ex) {
            $this->logger->critical(__METHOD__, ['ex' => $ex->getMessage()]);
        }

    }

    /**
     * @param Argument $argument
     * @return object|null
     */
    public function getAll(Argument $argument)
    {
        try {
            if (!empty($argument->offsetGet('test'))) {
                $criteria['test'] = $argument->offsetGet('test');
            }
            if (!empty($argument->offsetGet('blocked'))) {
                $criteria['blocked'] = $argument->offsetGet('blocked');
            }
            $criteria['ghost'] = false;

            return $this->em->getRepository(Users::class)->findBy($criteria);
        } catch (\Exception $ex) {
            $this->logger->critical(__METHOD__, ['ex' => $ex->getMessage()]);
        }

    }


}