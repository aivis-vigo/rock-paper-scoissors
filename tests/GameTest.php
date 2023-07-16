<?php declare(strict_types=1);

use App\Game;
use PHPUnit\Framework\TestCase;

class GameTest extends TestCase
{
    public function testRockBeatsScissors(): void
    {
        $exchange = (new Game())->validateWinner('rock', 'scissors');

        $this->assertEquals('Opponent', $exchange);
    }

    public function testRockBeatsLizard(): void
    {
        $exchange = (new Game())->validateWinner('rock', 'lizard');

        $this->assertEquals('Opponent', $exchange);
    }

    public function testPaperBeatsRock(): void
    {
        $exchange = (new Game())->validateWinner('paper', 'rock');

        $this->assertEquals('Opponent', $exchange);
    }

    public function testPaperBeatsSpock(): void
    {
        $exchange = (new Game())->validateWinner('paper', 'spock');

        $this->assertEquals('Opponent', $exchange);
    }

    public function testScissorsBeatsPaper(): void
    {
        $exchange = (new Game())->validateWinner('scissors', 'paper');

        $this->assertEquals('Opponent', $exchange);
    }

    public function testScissorsBeatsLizard(): void
    {
        $exchange = (new Game())->validateWinner('scissors', 'lizard');

        $this->assertEquals('Opponent', $exchange);
    }

    public function testLizardBeatsPaper(): void
    {
        $exchange = (new Game())->validateWinner('lizard', 'paper');

        $this->assertEquals('Opponent', $exchange);
    }

    public function testLizardBeatsSpock(): void
    {
        $exchange = (new Game())->validateWinner('lizard', 'spock');

        $this->assertEquals('Opponent', $exchange);
    }

    public function testSpockBeatsScissors(): void
    {
        $exchange = (new Game())->validateWinner('spock', 'scissors');

        $this->assertEquals('Opponent', $exchange);
    }

    public function testSpockBeatsRock(): void
    {
        $exchange = (new Game())->validateWinner('spock', 'rock');

        $this->assertEquals('Opponent', $exchange);
    }

    public function testDrawScenario(): void
    {
        $exchange = (new Game())->validateWinner('rock', 'rock');

        $this->assertEquals('Draw', $exchange);
    }

    public function testNextRound(): void
    {
        $game = new Game();
        $game->nextRound();
        $nextRound = $game->round;

        $this->assertEquals(2, $nextRound);
    }

    public function testResetPLayerScores(): void
    {
        $game = new Game();
        $game->playerWins = 2;
        $game->opponentWins = 1;

        $game->resetScores();

        $this->assertEquals([0, 0], [$game->playerWins, $game->opponentWins]);
    }

    public function testSelectNextOpponent(): void
    {
        $opponentName = (new Game())->nextOpponent(); // current opponent: 'Snickerdoodle McFizz'

        $this->assertEquals('Noodle Noodleman', $opponentName);
    }
}