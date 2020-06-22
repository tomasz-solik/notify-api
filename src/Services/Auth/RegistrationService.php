<?php
/**
 * notify-api - RegistrationService.php
 *
 * Initial version by: Toamsz Solik
 * Initial version created on: 22.06.20 / 20:01
 */

namespace App\Services\Auth;

use App\Entity\Users\Users;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class RegistrationService
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
     * @var UserPasswordEncoderInterface
     */
    private $encoder;

    /**
     * RegistrationService constructor.
     * @param EntityManagerInterface $em
     * @param ContainerInterface $container
     * @param LoggerInterface $logger
     * @param UserPasswordEncoderInterface $encoder
     */
    public function __construct(
        EntityManagerInterface $em,
        ContainerInterface $container,
        LoggerInterface $logger,
        UserPasswordEncoderInterface $encoder
    ) {
        $this->em = $em;
        $this->container = $container;
        $this->logger = $logger;
        $this->encoder = $encoder;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function registration(Request $request)
    {
        $data = [];
        $status = JsonResponse::HTTP_INTERNAL_SERVER_ERROR;
        try {
            $role = (int)$request->get('role');
            $email = $request->get('email');
            $username = $request->get('username');
            $password = $request->get('password');

            $user = new Users();
            $user->setRole($role)
                ->setEmail($email)
                ->setUsername($username)
                ->setPassword($this->encoder->encodePassword($user, $password));
            $this->em->persist($user);
            $this->em->flush();

            $data = [
                'email' => $email,
                'username' => $username,
            ];
            $status = JsonResponse::HTTP_CREATED;
        } catch (\Exception $ex) {
            $this->logger->critical(__METHOD__, ['ex' => $ex->getMessage()]);
        }

        return new JsonResponse($data, $status);
    }

}