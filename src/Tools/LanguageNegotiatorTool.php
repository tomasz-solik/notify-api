<?php
/**
 * notifyapp - LanguageNegotiatorTool.php
 *
 * Initial version by: Toamsz Solik
 * Initial version created on: 15.06.20 / 13:38
 */

namespace App\Tools;

use Negotiation\LanguageNegotiator;
use Psr\Log\LoggerInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\HeaderBag;

class LanguageNegotiatorTool
{
    /**
     * @var ContainerInterface
     */
    private $container;
    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * LanguageNegotiatorTool constructor.
     * @param ContainerInterface $container
     * @param LoggerInterface $logger
     */
    public function __construct(
        ContainerInterface $container,
        LoggerInterface $logger
    ) {
        $this->container = $container;
        $this->logger = $logger;
    }

    /**
     * @param HeaderBag $headerBag
     * @return string|null
     */
    public function getLocale(HeaderBag $headerBag): ?string
    {
        $locale = null;
        try {
            $locale = $this->container->getParameter('kernel.default_locale');
            $appPrioritiesLocales = $this->container->getParameter('app_priorities_locales');
            $languageNegotiator = new LanguageNegotiator();
            $bestLanguage = $languageNegotiator->getBest($headerBag->get('Accept-Language'),
                explode('|', $appPrioritiesLocales));
            if (false === empty($bestLanguage)) {
                $locale = $bestLanguage->getType();
            }
            if (empty($locale)) {
                throw new \Exception('No default_locale found');
            }
        } catch (\Exception $ex) {
            $this->logger->critical(__METHOD__, ['ex' => $ex->getMessage()]);
        }

        return $locale;
    }
}
