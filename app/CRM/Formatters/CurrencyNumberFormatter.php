<?php


namespace CRM\Formatters;


use NumberFormatter;

class CurrencyNumberFormatter
{
    private $amount;
    private $precision = 2;
    private $millions = false;

    public function format()
    {
        $numberFormatter =  NumberFormatter::create (config('app.faker_locale'), NumberFormatter::CURRENCY);

        $result = numfmt_format_currency($numberFormatter, round($this->amount, $this->precision), config('currency.symbol'));

        return $this->millions ? $result . "M" : $result;
    }

    public function amount($amount)
    {
        $this->amount = $amount;

        return $this;
    }

    public function precision($precision)
    {
        $this->precision = $precision;

        return $this;
    }

    public function millions()
    {
        $this->millions = true;

        $this->amount = $this->amount / 1000000;

        return $this;
    }
}
