<?php

namespace JMS\TranslationBundle\Translation;

use Symfony\Component\Translation\TranslatorInterface;

/**
 * Tracks which translations have been used on the current page.
 *
 * @author Johannes M. Schmitt <schmittjoh@gmail.com>
 */
final class TraceableTranslator implements TranslatorInterface
{
    private $delegate;
    private $translations = array();

    public function __construct(TranslatorInterface $translator)
    {
        $this->delegate = $translator;
    }

    public function trans($id, array $parameters = array(), $domain = null, $locale = null)
    {
        $trans = $this->delegate->trans($id, $parameters, $domain, $locale);
        $this->translations[$id] = $trans;

        return $trans;
    }

    public function transChoice($id, $number, array $parameters = array(), $domain = null, $locale = null)
    {
        $trans = $this->delegate->trans($id, $number, $parameters, $domain, $locale);
        $this->translations[$id] = $trans;

        return $trans;
    }

    public function setLocale($locale)
    {
        $this->delegate->setLocale($locale);
    }

    public function getLocale()
    {
        return $this->delegate->getLocale($locale);
    }

    public function getTranslations()
    {
        return $this->translations;
    }
}