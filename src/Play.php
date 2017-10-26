<?php
/**
 * Created by PhpStorm.
 * User: ricardobatista
 * Date: 25/10/2017
 * Time: 18:32
 */

namespace BowlingKata;


class Play
{

    /**
     * @var int
     */
    private $pins;

    public function __construct(int $pins)
    {
        $this->ensureNumberOfPins($pins);

        $this->pins = $pins;
    }

    public function getPins():int
    {
        return $this->pins;
    }

    private function ensureNumberOfPins(int $pins)
    {
        if($pins > 10 || $pins < 0) {
            throw new InvalidNumberOfPins();
        }
    }


}