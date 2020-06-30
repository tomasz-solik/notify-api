<?php
/**
 * notify-api - ChannelsUsersService.php
 *
 * Initial version by: Toamsz Solik
 * Initial version created on: 30.06.20 / 14:45
 */

namespace App\Services\Channels;

use App\Entity\Channels\News;
use Doctrine\ORM\EntityManagerInterface;
use Overblog\GraphQLBundle\Definition\Argument;
use Psr\Log\LoggerInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;

class NewsService
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
     * @param Argument $argument
     * @return object|null
     */
    public function getOne(Argument $argument)
    {
        try {
            return $this->em->getRepository(News::class)->findOneBy([
                'id' => $argument->offsetGet('id'),
                'ghost' => false,
            ]);
        } catch (\Exception $ex) {
            $this->logger->critical(__METHOD__, ['ex' => $ex->getMessage()]);
        }
    }

    /**
     * @param Argument $argument
     * @return object[]
     */
    public function getAll(Argument $argument)
    {
        try {
            $criteria['channel'] = $argument->offsetGet('channel_id');
            $criteria['ghost'] = false;

            return $this->em->getRepository(News::class)->findBy($criteria);
        } catch (\Exception $ex) {
            $this->logger->critical(__METHOD__, ['ex' => $ex->getMessage()]);
        }
    }

}