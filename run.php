<?php
/**
 * Created by PhpStorm.
 * User: hizbul
 * Date: 8/22/16
 * Time: 8:35 PM
 */

require_once __DIR__ . '/vendor/autoload.php';

use App\Command\PokerRun;
use App\Entity\Deck;
use App\Entity\Player;


$pokerRun = new PokerRun(new Deck());

// lets shuffle the cards
$pokerRun->shuffleCards();

// 4 players join the table
for($i = 0; $i < 4; $i++) {
    $pokerRun->addPlayer(new Player());
}

// deal the cards to the players. default deal = 2 and deal >= 5.
$pokerRun->setDeal(7);
$pokerRun->dealCards();
// display a summery of the players and the cards they are holding
print $pokerRun->displaySummary();