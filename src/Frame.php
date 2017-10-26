<?php
/**
 * Created by PhpStorm.
 * User: ricardobatista
 * Date: 25/10/2017
 * Time: 18:39
 */

namespace BowlingKata;


class Frame
{
    private $plays = [];
    /**
     * @var int
     */
    private $position;

    public function __construct(int $position = 1)
    {
        $this->position = $position;
    }


    public function addPlay(Play $play): void
    {
        if ($this->position === 10 && count($this->plays) >= 3) {
            throw new TwoManyPlays();
        }

        if(count($this->plays) >= 2 && $this->position < 10){
            throw new TwoManyPlays();
        }

        $this->plays[] = $play;
    }

    public function getPlays(): array
    {
        return $this->plays;
    }

    public function getPosition(): int
    {
        return $this->position;
    }
}