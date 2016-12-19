<?php

namespace AppBundle\Intl;

use NumberFormatter;

class CurrencyHelper
{
    /**
     * @param string $countryCode
     *
     * @return null|string
     */
    public static function getCurrencyForCountry(string $countryCode)
    {
        // Intl accepts English as a language for any country
        $locale = sprintf('en_%s', $countryCode);
        $currencyCode = (new NumberFormatter($locale, NumberFormatter::CURRENCY))
            ->getTextAttribute(NumberFormatter::CURRENCY_CODE);

        return is_string($currencyCode) ? $currencyCode : null;
    }
}
