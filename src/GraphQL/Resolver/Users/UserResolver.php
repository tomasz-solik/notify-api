<?php
/**
 * notifyapp - UserResolver.php
 *
 * Initial version by: Toamsz Solik
 * Initial version created on: 18.06.20 / 11:02
 */

namespace App\GraphQL\Resolver\Users;

use App\Entity\Users\Users;
use Doctrine\ORM\EntityManagerInterface;
use Overblog\GraphQLBundle\Definition\Argument;
use Overblog\GraphQLBundle\Definition\Resolver\AliasedInterface;
use Overblog\GraphQLBundle\Definition\Resolver\ResolverInterface;

class UserResolver implements ResolverInterface, AliasedInterface
{
    /**
     * @var EntityManagerInterface
     */
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;

    }

    /**
     * Returns methods aliases.
     *
     * For instance:
     * array('myMethod' => 'myAlias')
     *
     * @return array
     */
    public static function getAliases(): array
    {
        return [
            'resolve' => 'User',
        ];
    }

    public function resolve(Argument $argument)
    {
        return $this->em->getRepository(Users::class)->find($argument->offsetGet('id'));
    }
}