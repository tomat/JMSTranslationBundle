<?php

namespace JMS\TranslationBundle\DataCollector;

use JMS\TranslationBundle\Translation\TraceableTranslator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\DataCollector\DataCollector;

class TranslationDataCollector extends DataCollector
{
    private $translator;

    public function __construct(TraceableTranslator $translator)
    {
        $this->translator = $translator;
    }

    /**
     * Collects data for the given Request and Response.
     *
     * @param Request    $request   A Request instance
     * @param Response   $response  A Response instance
     * @param \Exception $exception An Exception instance
     */
    public function collect(Request $request, Response $response, \Exception $exception = null)
    {
        $this->data['translations'] = $this->translator->getTranslations();
    }

    public function getTranslations()
    {
        return $this->data['translations'];
    }

    /**
     * Returns the name of the collector.
     *
     * @return string The collector name
     */
    public function getName()
    {
        return 'jms_translation';
    }
}