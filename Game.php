<?php declare(strict_types=1);

class Game
{
    private int $you;
    private int $opponentWins;
    private int $round;
    private int $number;
    private array $opponent;
    private array $elements;
    private array $winningElements;

    public function __construct()
    {
        $this->you = 0;
        $this->opponentWins = 0;
        $this->number = 0;
        $this->round = 1;

        $this->opponent =  [
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

    public function run(): void
    {
        echo "====================================" . PHP_EOL;
        echo "Rock, Paper, Scissors, Lizard, Spock" . PHP_EOL;
        echo "====================================" . PHP_EOL;

        $opponentName = $this->opponent[$this->number];

        while(true) {
            $computerChoice = $this->elements[2];//[array_rand($this->elements)];

            echo PHP_EOL;
            echo "You: $this->you vs $opponentName: $this->opponentWins" . PHP_EOL;
            echo PHP_EOL;

            $playerChoice = strtolower(readline('Your Choice: '));

            while (!array_key_exists($playerChoice, $this->winningElements)) {
                echo PHP_EOL;
                echo "Element '$playerChoice' doesn't exist!" . PHP_EOL;
                $playerChoice = strtolower(readline('Your Choice: '));
            }

            $message = "You: " . ucfirst($playerChoice) . " vs $opponentName: " . ucfirst($computerChoice);

            if ($computerChoice == $playerChoice)
            {
                echo "$message. Draw!" . PHP_EOL;
                echo "------------------------------------" . PHP_EOL;
                echo PHP_EOL;
            } elseif (in_array($computerChoice, $this->winningElements[$playerChoice])) {
                echo "$message. You Won!" . PHP_EOL;
                echo PHP_EOL;
                echo "------------------------------------" . PHP_EOL;

                $this->you++;
            } else {
                echo "$message. PC Won!" . PHP_EOL;
                echo PHP_EOL;
                echo "------------------------------------" . PHP_EOL;

                $this->opponentWins++;
            }

            if ($this->you == 3 || $this->opponentWins == 3) {
                $winner = ($this->you == 3) ? "You" : $opponentName;

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
                        $this->round++;

                        if ($this->round > count($this->opponent)) {
                            echo "You are Rock-Paper-Scissors-Lizard-Spock Champion!" . PHP_EOL;
                            echo "====================================" . PHP_EOL;
                            exit;
                        }

                        echo "====================================" . PHP_EOL;
                        echo "Round $this->round" . PHP_EOL;
                        echo "====================================" . PHP_EOL;

                        $this->you = 0;
                        $this->opponentWins = 0;
                        $this->number += 1;
                        $opponentName = $this->opponent[$this->number];
                }
            }
        }
    }
}