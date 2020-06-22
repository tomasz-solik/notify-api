<?php
/**
 * notify-api - LoginService.php
 *
 * Initial version by: Toamsz Solik
 * Initial version created on: 22.06.20 / 19:59
 */

namespace App\Services\Auth;

use App\Entity\Users\Users;
use Doctrine\ORM\EntityManagerInterface;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class LoginService
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
     * @var JWTTokenManagerInterface
     */
    private $JWTManager;
    /**
     * @var UserPasswordEncoderInterface
     */
    private $encoder;

    /**
     * LoginService constructor.
     * @param EntityManagerInterface $em
     * @param ContainerInterface $container
     * @param LoggerInterface $logger
     * @param JWTTokenManagerInterface $JWTManager
     * @param UserPasswordEncoderInterface $encoder
     */
    public function __construct(
        EntityManagerInterface $em,
        ContainerInterface $container,
        LoggerInterface $logger,
        JWTTokenManagerInterface $JWTManager,
        UserPasswordEncoderInterface $encoder
    ) {
        $this->em = $em;
        $this->container = $container;
        $this->logger = $logger;
        $this->JWTManager = $JWTManager;
        $this->encoder = $encoder;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function login(Request $request)
    {
        $data = [];
        $status = JsonResponse::HTTP_UNAUTHORIZED;
        try {
            $username = $request->get('username');
            $password = $request->get('password');

            /** @var Users $user */
            $user = $this->em->getRepository(Users::class)->findOneBy([
                'username' => $username,
                'blocked' => false,
                'ghost' => false,
            ]);

            if (false === empty($user)) {
                if ($this->encoder->isPasswordValid($user, $password)) {
                    $data = [
                        'token' => $this->JWTManager->create($user),
                        'token_ttl' => $this->container->getParameter('token_ttl'),
                    ];
                    $status = JsonResponse::HTTP_OK;
                }
            }
        } catch (\Exception $ex) {
            $this->logger->critical(__METHOD__, ['ex' => $ex->getMessage()]);
        }

        return new JsonResponse($data, $status);
    }

}