<?php

namespace BowlingKata;

use PHPUnit\Framework\TestCase;

use BowlingKata\Play;

class BowlingKataTest extends TestCase
{

    private $bowling;

    public function setUp()
    {
        $this->bowling = new BowlingKata();
    }



    public function testPlayShouldHaveANumberOfPins()
    {
        $pins = 9;
        $play = new Play($pins);
        $this->assertEquals($pins, $play->getPins());
    }

    public function testFrameShouldBeAbleToAddPlay()
    {
        # Given
        $pins = 9;
        $play = new Play($pins);
        $frame = new Frame();

        # When
        $frame->addPlay($play);

        # Assert
        $this->assertSame([$play], $frame->getPlays());
    }

    public function testPlayMaxPinsShouldBe10()
    {
        $pins = 11;

        $this->expectException(InvalidNumberOfPins::class);

        new Play($pins);
    }

    public function testPinsShouldBePositive()
    {
        $pins = -1;

        $this->expectException(InvalidNumberOfPins::class);

        new Play($pins);
    }

    public function testFrameShouldHaveItsPosition()
    {
        $frame = new Frame(5);
        $this->assertEquals(5, $frame->getPosition());
    }

    public function testFrameShouldBeAbleToAddTwoPlays()
    {
        $playA = new Play(1);
        $playB = new Play(8);

        $frame = new Frame();

        $frame->addPlay($playA);
        $frame->addPlay($playB);

        $this->assertSame([$playA, $playB], $frame->getPlays());
    }

    public function testFrameShouldOnlyAcceptTwoUntilTheLastOne()
    {
        $playA = new Play(1);
        $playB = new Play(8);
        $playC = new Play(1);

        $frame = new Frame();

        $frame->addPlay($playA);
        $frame->addPlay($playB);

        $this->expectException(TwoManyPlays::class);

        $frame->addPlay($playC);

    }

    public function testLastFrameShouldAcceptTwoThreePlays()
    {
        $playA = new Play(1);
        $playB = new Play(8);
        $playC = new Play(1);

        $frame = new Frame(10);

        $frame->addPlay($playA);
        $frame->addPlay($playB);
        $frame->addPlay($playC);

        $this->assertSame([$playA, $playB, $playC], $frame->getPlays());
    }

    public function testLastFrameShouldBreakWithFour()
    {
        $playA = new Play(1);
        $playB = new Play(8);
        $playC = new Play(1);
        $playD = new Play(10);

        $frame = new Frame(10);

        $frame->addPlay($playA);
        $frame->addPlay($playB);
        $frame->addPlay($playC);

        $this->expectException(TwoManyPlays::class);
        $frame->addPlay($playD);
    }


}
