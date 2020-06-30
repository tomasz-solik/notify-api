<?php

namespace App\DataFixtures\Channels;

use App\Entity\Channels\Channels;
use App\Entity\Channels\News;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;

class ChannelsFixtures extends Fixture
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
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $this->fixtureChannels($manager);
    }

    /**
     * @param ObjectManager $manager
     */
    private function fixtureChannels(ObjectManager $manager)
    {
        $channels = [
            [
                'type' => 1,
                'name' => 'Informacje ze świata',
                'path_to_icon' => '/storage/images/channels/channel_icons/1/sample.png',
            ],
            [
                'type' => 1,
                'name' => 'Gry',
                'path_to_icon' => '/storage/images/channels/icons/1/sample.png',
            ],
            [
                'type' => 1,
                'name' => 'Klasa ABC',
                'path_to_icon' => '/storage/images/channels/icons/1/sample.png',
            ],
        ];
        foreach ($channels as $ch) {
            $channel = (new Channels())
                ->setType($ch['type'])
                ->setName($ch['name'])
                ->setPathToIcon($ch['path_to_icon']);
            $manager->persist($channel);
            $this->fixtureNews($manager, $channel);
        }
        $manager->flush();
    }

    /**
     * @param ObjectManager $manager
     * @param Channels $channel
     */
    private function fixtureNews(ObjectManager $manager, Channels $channel)
    {
        $news = [
            [
                'channel' => $channel,
                'title' => 'News 01 ['.$channel->getName().']',
                'content' => '<h1>News 01</h1><p>lorem ipsum</p>',
                'path_to_image' => '/storage/images/channels/news/1/sample.png',
            ],
            [
                'channel' => $channel,
                'title' => 'News 02 ['.$channel->getName().']',
                'content' => '<h1>News 02</h1><p>lorem ipsum</p>',
                'path_to_image' => '/storage/images/channels/news/1/sample.png',
            ],
            [
                'channel' => $channel,
                'title' => 'News 03 ['.$channel->getName().']',
                'content' => '<h1>News 03</h1><p>lorem ipsum</p>',
                'path_to_image' => '/storage/images/channels/news/1/sample.png',
            ],
        ];
        foreach ($news as $n) {
            $new = (new News())
                ->setChannel($n['channel'])
                ->setTitle($n['title'])
                ->setContent($n['content'])
                ->setPathToImage($n['path_to_image']);
            $manager->persist($new);
        }
        $manager->flush();
    }
}
