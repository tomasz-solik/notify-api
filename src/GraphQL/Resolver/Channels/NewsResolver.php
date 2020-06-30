<?php
/**
 * notifyapp - UserResolver.php
 *
 * Initial version by: Toamsz Solik
 * Initial version created on: 18.06.20 / 11:02
 */

namespace App\GraphQL\Resolver\Channels;

use App\Services\Channels\ChannelsUsersService;
use App\Services\Channels\NewsService;
use Overblog\GraphQLBundle\Definition\Argument;
use Overblog\GraphQLBundle\Definition\Resolver\AliasedInterface;
use Overblog\GraphQLBundle\Definition\Resolver\ResolverInterface;

class NewsResolver implements ResolverInterface, AliasedInterface
{
    /**
     * @var NewsService
     */
    private $newsService;

    public function __construct(NewsService $newsService)
    {
        $this->newsService = $newsService;
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
            'resolve' => 'News',
        ];
    }

    public function resolve(Argument $argument)
    {
        return $this->newsService->getAll($argument);
    }
}