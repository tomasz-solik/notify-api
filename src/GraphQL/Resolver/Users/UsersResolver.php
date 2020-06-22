<?php
/**
 * notifyapp - UserResolver.php
 *
 * Initial version by: Toamsz Solik
 * Initial version created on: 18.06.20 / 11:02
 */

namespace App\GraphQL\Resolver\Users;

use App\Services\Users\UsersService;
use Overblog\GraphQLBundle\Definition\Argument;
use Overblog\GraphQLBundle\Definition\Resolver\AliasedInterface;
use Overblog\GraphQLBundle\Definition\Resolver\ResolverInterface;

class UsersResolver implements ResolverInterface, AliasedInterface
{
    /**
     * @var UsersService
     */
    private $usersService;

    public function __construct(UsersService $usersService)
    {
        $this->usersService = $usersService;

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
            'resolve' => 'Users',
        ];
    }

    public function resolve(Argument $argument)
    {
        return $this->usersService->getAll($argument);
    }
}