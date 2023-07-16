<?php declare(strict_types=1);

/**
 * File: GameTest.php
 *
 * This file contains the unit tests for the Game class.
 *
 * @category Test
 * @package  App
 * @author   Aivis Vigo Reimarts <aivisvigoreimarts@gmail.com>
 * @license  MIT License
 * @link     https://github.com/aivis-vigo
 *
 * @since PHP 8.1
 */

use App\Game;
use PHPUnit\Framework\TestCase;

/**
 * File: GameTest.php
 *
 * This file contains the unit tests for the Game class.
 *
 * @category Test
 * @package  App
 * @author   Aivis Vigo Reimarts <aivisvigoreimarts@gmail.com>
 * @license  MIT License
 * @link     https://github.com/aivis-vigo
 *
 * @return void
 */
class GameTest extends TestCase
{
    /**
     * Test case: Rock beats Scissors
     *
     * @return void
     */
    public function testRockBeatsScissors(): void
    {
        $exchange = (new Game())->validateWinner('rock', 'scissors');

        $this->assertEquals('Opponent', $exchange);
    }

    /**
     * Test case: Rock beats Lizard
     *
     * @return void
     */
    public function testRockBeatsLizard(): void
    {
        $exchange = (new Game())->validateWinner('rock', 'lizard');

        $this->assertEquals('Opponent', $exchange);
    }

    /**
     * Test case: Paper beats Rock
     *
     * @return void
     */
    public function testPaperBeatsRock(): void
    {
        $exchange = (new Game())->validateWinner('paper', 'rock');

        $this->assertEquals('Opponent', $exchange);
    }

    /**
     * Test case: Paper beats Spock
     *
     * @return void
     */
    public function testPaperBeatsSpock(): void
    {
        $exchange = (new Game())->validateWinner('paper', 'spock');

        $this->assertEquals('Opponent', $exchange);
    }

    /**
     * Test case: Scissors beats Paper
     *
     * @return void
     */
    public function testScissorsBeatsPaper(): void
    {
        $exchange = (new Game())->validateWinner('scissors', 'paper');

        $this->assertEquals('Opponent', $exchange);
    }

    /**
     * Test case: Scissors beats Lizard
     *
     * @return void
     */
    public function testScissorsBeatsLizard(): void
    {
        $exchange = (new Game())->validateWinner('scissors', 'lizard');

        $this->assertEquals('Opponent', $exchange);
    }

    /**
     * Test case: Lizard beats Paper
     *
     * @return void
     */
    public function testLizardBeatsPaper(): void
    {
        $exchange = (new Game())->validateWinner('lizard', 'paper');

        $this->assertEquals('Opponent', $exchange);
    }

    /**
     * Test case: Lizard beats Spock
     *
     * @return void
     */
    public function testLizardBeatsSpock(): void
    {
        $exchange = (new Game())->validateWinner('lizard', 'spock');

        $this->assertEquals('Opponent', $exchange);
    }

    /**
     * Test case: Spock beats Scissors
     *
     * @return void
     */
    public function testSpockBeatsScissors(): void
    {
        $exchange = (new Game())->validateWinner('spock', 'scissors');

        $this->assertEquals('Opponent', $exchange);
    }

    /**
     * Test case: Spock beats Rock
     *
     * @return void
     */
    public function testSpockBeatsRock(): void
    {
        $exchange = (new Game())->validateWinner('spock', 'rock');

        $this->assertEquals('Opponent', $exchange);
    }

    /**
     * Test case: Draw scenario
     *
     * @return void
     */
    public function testDrawScenario(): void
    {
        $exchange = (new Game())->validateWinner('rock', 'rock');

        $this->assertEquals('Draw', $exchange);
    }

    /**
     * Test case: Next round number
     *
     * @return void
     */
    public function testNextRound(): void
    {
        $game = new Game();
        $game->nextRound();
        $nextRound = $game->round;

        $this->assertEquals(2, $nextRound);
    }

    /**
     * Test case: Reset player scores
     *
     * @return void
     */
    public function testResetPlayerScores(): void
    {
        $game = new Game();
        $game->playerWins = 2;
        $game->opponentWins = 1;

        $game->resetScores();

        $this->assertEquals([0, 0], [$game->playerWins, $game->opponentWins]);
    }

    /**
     * Test case: Select next opponent
     *
     * @return void
     */
    public function testSelectNextOpponent(): void
    {
        $opponentName = (new Game())->nextOpponent();

        $this->assertEquals('Noodle Noodleman', $opponentName);
    }
}