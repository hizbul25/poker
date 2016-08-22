<?php
namespace App\Command;

use App\Entity\Card;
use App\Entity\Deck;
use App\Entity\Player;
/**
 * Created by PhpStorm.
 * User: hizbul
 * Date: 8/22/16
 * Time: 8:44 PM
 */
class PokerRun
{

    /**
     * Number of deal.
     * @var integer
     */
    private $deal;

    /**
     * The pack of cards
     * @var Deck
     */
    private $deck;

    /**
     * Current players
     * @var array
     */
    private $players = [];

    public function __construct(Deck $deck)
    {
        $this->deck = $deck;
    }

    /**
     * Set deal
     * @param int $deal
     * @return int
     * @throws \Exception
     */
    public function setDeal($deal = 2)
    {
        if($deal <= 5)
        {
            $this->deal = $deal;
        }
        else {
            throw new \Exception('You cannot deal more than 5 times.');
        }

        return $this->deal;
    }
    /**
     * add a new player to the game - will throw an exception if cards are currently
     * in play - as you cannot join mid deal.
     *
     * @param Player $player
     * @return App
     */
    public function addPlayer(Player $player)
    {
        if ($this->deck->count() < 52) {
            throw new \Exception('You cannot add players once a card has been dealt.');
        }
        $this->players[] = $player;
        return $this;
    }

    /**
     * get all the current players in this game
     */
    public function getPlayers()
    {
        return $this->players;
    }

    /**
     * get all the cards currently in the deck
     */
    public function getDeck()
    {
        return $this->deck;
    }

    /**
     * Shuffle the cards in the deck - you shouldn't re-shuffle the deck once a card
     * has been dealt.
     *
     * We'll shuffle the cards 3 times here, because no dealer would accept just one shuffle
     *
     * @return PokerRun
     */
    public function shuffleCards()
    {
        if ($this->deck->count() < 52) {
            throw new \Exception('You cannot add players once a card has been dealt.');
        }
        $this->deck->shuffle();
        $this->deck->shuffle();
        $this->deck->shuffle();
        return $this;
    }

    /**
     * deal 7 cards to each player
     *
     * @return PokerRun
     */
    public function dealCards()
    {
        if (count($this->players) < 2) {
            throw new \Exception('You cannot deal the cards until more players have joined.');
        }

        for ($i = 0; $i < $this->deal; $i++) {
            foreach ($this->players as $player) {
                $player->addCard($this->deck->dealCard());
            }
        }
        return $this;
    }

    /**
     * Return a string representing the status of this game
     *
     * @return string
     */
    public function displaySummary()
    {
        $output[] = "------------------";
        $output[] = "Poker Game Summary";
        $output[] = "------------------";

        foreach ($this->players as $player) {
            $output[] = $player->displaySummary();
        }
        $output[] = '';
        return implode("\n", $output);
    }
}