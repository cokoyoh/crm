<?php


namespace CRM\Formatters;


use NumberFormatter;

class CurrencyNumberFormatter
{
    const ONE_MILLION = 1000000;
    private $amount;
    private $precision = 2;
    private $millions = false;

    public function format()
    {
        $numberFormatter =  NumberFormatter::create (config('app.faker_locale'), NumberFormatter::CURRENCY);

        $result = numfmt_format_currency($numberFormatter, round($this->amount, $this->precision), config('currency.symbol'));

        $value = $this->millions ? $result . "M" : $result;

        $this->millions = false;

        return $value;
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
        if ($this->amount > self::ONE_MILLION) {
            $this->millions = true;

            $this->amount = $this->amount / self::ONE_MILLION;
        }

        return $this;
    }
}
