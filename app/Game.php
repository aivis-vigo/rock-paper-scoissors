<?php declare(strict_types=1);

namespace App;

use JetBrains\PhpStorm\NoReturn;

/**
 * Class Game represents the Rock, Paper, Scissors, Lizard, Spock game.
 *
 * @category Game
 * @package  App
 * @license  MIT License
 * @link     https://www.example.com
 * @author   Your Name
 */
class Game
{
    public int $you;
    public int $opponentWins;
    public int $round;
    public int $number;
    public array $opponents;
    public array $elements;
    public array $winningElements;

    /**
     * Game constructor.
     * Initializes the game with default values and sets up opponents, elements, and winning elements.
     */
    public function __construct()
    {
        $this->you = 0;
        $this->opponentWins = 0;
        $this->number = 0;
        $this->round = 1;

        $this->opponents =  [
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
            'lizard' =>  ['paper', 'spock'],
            'spock' =>  ['scissors', 'rock']
        ];
    }

    /**
     * Runs the game.
     * Displays game title, handles player and opponent choices, determines the winner of each round,
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

        while(true) {
            $opponentChoice = $this->opponentThrows();

            echo PHP_EOL;
            echo "You: $this->you vs $opponentName: $this->opponentWins" . PHP_EOL;
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
                echo "------------------------------------" . PHP_EOL;

                $this->opponentWins();
                break;
            case 'Player':
                echo "$message. You Won!" . PHP_EOL;
                echo PHP_EOL;
                echo "------------------------------------" . PHP_EOL;

                $this->playerWins();
                break;
            default:
                echo "$message. Draw!" . PHP_EOL;
                echo "------------------------------------" . PHP_EOL;
                echo PHP_EOL;
                break;
            }

            if ($this->you == 3 || $this->opponentWins == 3) {
                $winner = $this->determineWinner($opponentName);

                echo "You: $this->you vs $opponentName: $this->opponentWins" . PHP_EOL;

                switch ($winner) {
                case $opponentName:
                    echo PHP_EOL;
                    echo "------------------------------------" . PHP_EOL;
                    echo "$opponentName won round $this->round. You lose!" . PHP_EOL;
                    exit;
                default:
                    echo PHP_EOL;
                    echo "------------------------------------" . PHP_EOL;
                    echo "You won round $this->round!" . PHP_EOL;
                    $this->nextRound();

                    if ($this->round > count($this->opponents)) {
                        echo "You are Rock-Paper-Scissors-Lizard-Spock Champion!" . PHP_EOL;
                        echo "====================================" . PHP_EOL;
                        exit;
                    }

                    echo "====================================" . PHP_EOL;
                    echo "Round $this->round" . PHP_EOL;
                    echo "====================================" . PHP_EOL;

                    $this->resetScores();
                    $opponentName = $this->nextOpponent();
                }
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
        return $this->elements[array_rand($this->elements)];
    }

    /**
     * Gets the player's choice from input.
     *
     * @return string The player's choice
     */
    public function playerInput(): string
    {
        return strtolower(readline('Your Choice: '));
    }


    /**
     * Validate the winner of the exchange based on the choices
     *
     * @param  string $opponentChoice The opponent's choice
     * @param  string $playerChoice   The player's choice
     * @return string The winner of the exchange ('Player', 'Opponent', or 'Draw')
     */
    public function validateWinner(string $opponentChoice, string $playerChoice): string
    {
        if (in_array($opponentChoice, $this->winningElements[$playerChoice])) {
            return 'Player';
        }

        if (in_array($playerChoice, $this->winningElements[$opponentChoice])) {
            return 'Opponent';
        }

        return 'Draw';
    }

    /**
     * Increments the player's score.
     *
     * @return void
     */
    public function playerWins(): void
    {
        $this->you++;
    }

    /**
     * Increments the opponent's score.
     *
     * @return void
     */
    public function opponentWins(): void
    {
        $this->opponentWins++;
    }

    /**
     * Determine the winner of the round based on the scores
     *
     * @param  string $opponent The opponent's name
     * @return string The winner of the round ('You' or the opponent's name)
     */
    public function determineWinner(string $opponent): string
    {
        return ($this->you == 3) ? "You" : $opponent;
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
        $this->you = 0;
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