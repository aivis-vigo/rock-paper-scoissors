<?php declare(strict_types=1);

namespace App;

use JetBrains\PhpStorm\NoReturn;

class Game
{
    private int $you;
    private int $opponentWins;
    private int $round;
    private int $number;
    private array $opponents;
    private array $elements;
    private array $winningElements;

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

            if ($opponentChoice == $playerChoice)
            {
                echo "$message. Draw!" . PHP_EOL;
                echo "------------------------------------" . PHP_EOL;
                echo PHP_EOL;
            } elseif (in_array($opponentChoice, $this->winningElements[$playerChoice])) {
                echo "$message. You Won!" . PHP_EOL;
                echo PHP_EOL;
                echo "------------------------------------" . PHP_EOL;

                $this->playerWins();
            } else {
                echo "$message. PC Won!" . PHP_EOL;
                echo PHP_EOL;
                echo "------------------------------------" . PHP_EOL;

                $this->opponentWins();
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

    private function selectOpponent(): string
    {
        return $this->opponents[$this->number];
    }

    private function opponentThrows(): string
    {
        return $this->elements[array_rand($this->elements)];
    }

    private function playerInput(): string
    {
        return strtolower(readline('Your Choice: '));
    }

    private function playerWins(): void
    {
        $this->you++;
    }

    private function opponentWins(): void
    {
        $this->opponentWins++;
    }

    private function determineWinner(string $opponent): string
    {
        return ($this->you == 3) ? "You" : $opponent;
    }

    private function nextRound(): void
    {
        $this->round++;
    }

    private function resetScores(): void
    {
        $this->you = 0;
        $this->opponentWins = 0;
    }

    private function nextOpponent(): string
    {
        $this->number += 1;
        return $this->opponents[$this->number];
    }
}