<?php
/**
 * notifyapp - UserResolver.php
 *
 * Initial version by: Toamsz Solik
 * Initial version created on: 18.06.20 / 11:02
 */

namespace App\GraphQL\Resolver\Channels;

use App\Services\Channels\ChannelsUsersService;
use Overblog\GraphQLBundle\Definition\Resolver\AliasedInterface;
use Overblog\GraphQLBundle\Definition\Resolver\ResolverInterface;

class ChannelsUserResolver implements ResolverInterface, AliasedInterface
{
    /**
     * @var ChannelsUsersService
     */
    private $channelsUsersService;

    public function __construct(ChannelsUsersService $channelsUsersService)
    {
        $this->channelsUsersService = $channelsUsersService;
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
            'resolve' => 'ChannelsUser',
        ];
    }

    public function resolve()
    {
        return $this->channelsUsersService->getMyAll();
    }
}