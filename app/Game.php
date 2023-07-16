<?php declare(strict_types=1);

/**
 * File: Game.php
 *
 * This file contains the Game class.
 *
 * @category Game
 * @package  App
 * @author   Aivis Vigo Reimarts <aivisvigoreimarts@gmail.com>
 * @license  MIT License
 * @link     https://github.com/aivis-vigo
 * @since    PHP 8.1
 */

namespace App;

use JetBrains\PhpStorm\NoReturn;

/**
 * Class Game represents the Rock, Paper, Scissors, Lizard, Spock game.
 *
 * @category Game
 * @package  App
 * @author   Aivis Vigo Reimarts <aivisvigoreimarts@gmail.com>
 * @license  MIT License
 * @link     https://github.com/aivis-vigo
 */
class Game
{
    public int $playerWins;
    public int $opponentWins;
    public int $round;
    public int $number;
    public array $opponents;
    public array $elements;
    public array $winningElements;

    /**
     * Game constructor.
     * Initializes the game with values, opponents, elements, and winning elements.
     */
    public function __construct()
    {
        $this->playerWins = 0;
        $this->opponentWins = 0;
        $this->number = 0;
        $this->round = 1;

        $this->opponents = [
            'Snickerdoodle McFizz',
            'Noodle Noodleman',
            'Bumble Bopkins'
        ];

        $this->elements = [
            'rock',
            'paper',
            'scissors',
            'lizard',
            'spock'
        ];

        $this->winningElements = [
            'rock' => ['scissors', 'lizard'],
            'paper' => ['rock', 'spock'],
            'scissors' => ['paper', 'lizard'],
            'lizard' => ['paper', 'spock'],
            'spock' => ['scissors', 'rock']
        ];
    }

    /**
     * Runs the game.
     * Displays game title, wins, opponent choices, determines the winner of each round,
     * and declares the overall champion.
     *
     * @return void
     */
    #[NoReturn] public function run(): void
    {
        echo "====================================" . PHP_EOL;
        echo "Rock, Paper, Scissors, Lizard, Spock" . PHP_EOL;
        echo "====================================" . PHP_EOL;

        $opponentName = $this->selectOpponent();

        while ($this->round < 4) {
            $opponentChoice = $this->opponentThrows();

            echo PHP_EOL;
            echo "You: $this->playerWins vs $opponentName: $this->opponentWins" . PHP_EOL;
            echo PHP_EOL;

            $playerChoice = $this->playerInput();

            while (!array_key_exists($playerChoice, $this->winningElements)) {
                echo PHP_EOL;
                echo "Element '$playerChoice' doesn't exist!" . PHP_EOL;
                $playerChoice = $this->playerInput();
            }

            $message = "You: " . ucfirst($playerChoice) . " vs $opponentName: " . ucfirst($opponentChoice);
            $exchangeWinner = $this->validateWinner($opponentChoice, $playerChoice);

            switch ($exchangeWinner) {
            case 'Opponent':
                echo "$message. $opponentName Won!" . PHP_EOL;
                echo PHP_EOL;

                $this->addOneOpponentWin();
                break;
            case 'Player':
                echo "$message. You Won!" . PHP_EOL;
                echo PHP_EOL;

                $this->addOnePlayerWin();
                break;
            default:
                echo "$message. Draw!" . PHP_EOL;
                echo PHP_EOL;
                break;
            }

            echo "------------------------------------" . PHP_EOL;

            if ($this->round == count($this->opponents) && $this->playerWins == 3) {
                echo "You are Rock-Paper-Scissors-Lizard-Spock Champion!" . PHP_EOL;
                echo "====================================" . PHP_EOL;
                exit;
            }

            if ($this->opponentWins == 3) {

                echo "$opponentName won! You lose!" . PHP_EOL;
                echo "=====================================" . PHP_EOL;
                exit;
            }

            if ($this->playerWins == 3) {
                $this->nextRound();

                echo "====================================" . PHP_EOL;
                echo "Round $this->round" . PHP_EOL;
                echo "====================================" . PHP_EOL;

                $this->resetScores();
                $opponentName = $this->nextOpponent();
            }
        }
    }

    /**
     * Selects the opponent's name based on the current round.
     *
     * @return string The opponent's name
     */
    public function selectOpponent(): string
    {
        return $this->opponents[$this->number];
    }

    /**
     * Randomly selects an element for the opponent.
     *
     * @return string The opponent's choice
     */
    public function opponentThrows(): string
    {
        return $this->elements[0];//[array_rand($this->elements)];
    }

    /**
     * Gets the players choice from input.
     *
     * @return string The players choice
     */
    public function playerInput(): string
    {
        return strtolower(readline('Your Choice: '));
    }


    /**
     * Validate the winner of the exchange based on the choices
     *
     * @param string $opponent The opponent's choice
     * @param string $player   The player's choice
     *
     * @return string The winner of the exchange ('Player', 'Opponent', or 'Draw')
     */
    public function validateWinner(string $opponent, string $player): string
    {
        if (in_array($opponent, $this->winningElements[$player])) {
            return 'Player';
        }

        if (in_array($player, $this->winningElements[$opponent])) {
            return 'Opponent';
        }

        return 'Draw';
    }

    /**
     * Increments the players score.
     *
     * @return void
     */
    public function addOnePlayerWin(): void
    {
        $this->playerWins++;
    }

    /**
     * Increments the opponent's score.
     *
     * @return void
     */
    public function addOneOpponentWin(): void
    {
        $this->opponentWins++;
    }

    /**
     * Increments the round number.
     *
     * @return void
     */
    public function nextRound(): void
    {
        $this->round++;
    }

    /**
     * Resets the scores to 0.
     *
     * @return void
     */
    public function resetScores(): void
    {
        $this->playerWins = 0;
        $this->opponentWins = 0;
    }

    /**
     * Gets the next opponent's name.
     *
     * @return string The next opponent's name
     */
    public function nextOpponent(): string
    {
        $this->number += 1;
        return $this->opponents[$this->number];
    }
}