<?php
/**
 * Created by PhpStorm.
 * User: hizbul
 * Date: 8/22/16
 * Time: 8:43 PM
 */

namespace App\Entity;


class Player
{
    /**
     * The name of this player
     * @var string
     */
    private $name;

    /**
     * The cards that this player has been given
     * @var array
     */
    private $cards = [];

    private $rank = [];

    public function __construct($name)
    {
        $this->setName($name);
    }

    /**
     * Set the name of this player (we set a random one on construct)
     *
     * @return Player
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Get the name of this player
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Deal a card to this player
     *
     * @param Card $card
     * @return Player
     */
    public function addCard(Card $card)
    {
        $this->cards[] = $card;
        return $this;
    }

    /**
     * Get the cards held by this player
     *
     * @return array
     */
    public function getCards()
    {
        return $this->cards;
    }

    /**
     * rest this player's cards (assume we give them back to the dealer)
     *
     * @return Player
     */
    public function fold()
    {
        $this->cards = [];
        return $this;
    }

    /**
     * Return a string representing the cards held by this player
     *
     * @return string
     */
    public function displaySummary()
    {
        $hand = [];
        $weight = [];
        foreach ($this->cards as $card) {
            $hand[] = $card;
            $weight[] = array_flip(Card::ALLOWED_VALUES)[$card->getValue()];
        }
        $this->setRank(array_sum($weight));
        $output = [];

        $output[] = sprintf(" - %s", $this->getName());
        $output[] = implode(", ", $hand);

        return implode("\n", $output);
    }

    /**
     * Set rank
     * @param $rank
     */
    private function setRank($rank)
    {
        $this->rank = $rank;
    }

    /**
     * Get rank
     * @return array
     */
    public function getRank()
    {
        return $this->rank;
    }
    /**
     * clean output for when this class is echo'd to screen
     *
     * @return string
     */
    public function __toString()
    {
        return $this->displaySummary();
    }
}