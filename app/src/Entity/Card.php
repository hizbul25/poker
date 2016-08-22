<?php

namespace App\Entity;
/**
 * Created by PhpStorm.
 * User: hizbul
 * Date: 8/22/16
 * Time: 8:39 PM
 */
class Card
{
    /**
     * The suit that this card belongs to
     * @var string
     */
    private $suit;
    /**
     * The value of this card
     * @var string
     */
    private $value;
    const ALLOWED_SUITS = [
        'hearts',
        'clubs',
        'spades',
        'diamonds',
    ];
    
    const ALLOWED_VALUES = [
        1 => 'ace',
        2 => 'two',
        3 => 'three',
        4 => 'four',
        5 => 'five',
        6 => 'six',
        7 => 'seven',
        8 => 'eight',
        9 => 'nine',
        10 =>'ten',
        11 => 'jack',
        12 => 'queen',
        13 => 'king'
    ];

    public function __construct($suit, $value)
    {
        $this->setSuit($suit)->setValue($value);
    }
    /**
     * Get the suit for this card
     *
     * @return string
     */
    public function getSuit()
    {
        return $this->suit;
    }
    /**
     * Get the value of this card
     *
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }
    /**
     * clean output for when this class is echo'd to screen
     *
     * @return string
     */
    public function __toString()
    {
        return sprintf('%s of %s', $this->getValue(), $this->getSuit());
    }
    /**
     * private setter methods because you should not be able to change the suit
     * or value of the card once created, but we use these to validate the inputs
     */
    /**
     * set the suit for this card
     */
    private function setSuit($suit)
    {
        // force lower case - we'll forgive some people
        $suit = strtolower($suit);
        if (in_array($suit, self::ALLOWED_SUITS) === false) {
            throw new \Exception('Invalid Suit: ' . $suit);
        }
        $this->suit = $suit;
        return $this;
    }
    /**
     * set the value for this card
     */
    private function setValue($value)
    {
        // force lower case - we'll forgive some people
        $value = strtolower($value);
        if (in_array($value, array_values(self::ALLOWED_VALUES)) === false) {
            throw new \Exception('Invalid Value: ' . $value);
        }
        $this->value = $value;
        return $this;
    }
}
