<?php declare(strict_types=1);

$opponent = 0;
$you = 0;
$round = 1;

$opposition = [
    'Snickerdoodle McFizz',
    'Noodle Noodleman',
    'Bumble Bopkins'
];

$index = 0;
$oppName = $opposition[$index];

$elements = [
    'rock',
    'paper',
    'scissors',
    'lizard',
    'spock'
];

$winningElements = [
    'rock' => ['scissors', 'lizard'],
    'paper' => ['rock', 'spock'],
    'scissors' => ['paper', 'lizard'],
    'lizard' =>  ['paper', 'spock'],
    'spock' =>  ['scissors', 'rock']
];

echo "====================================" . PHP_EOL;
echo "Rock, Paper, Scissors, Lizard, Spock" . PHP_EOL;
echo "====================================" . PHP_EOL;

while(true) {
    $computerChoice = $elements[array_rand($elements)];

    echo PHP_EOL;
    echo "You: $you vs $oppName: $opponent" . PHP_EOL;
    echo PHP_EOL;

    $playerChoice = strtolower(readline('Your Choice: '));

    while (!array_key_exists($playerChoice, $winningElements)) {
        echo PHP_EOL;
        echo "Element '$playerChoice' doesn't exist!" . PHP_EOL;
        $playerChoice = strtolower(readline('Your Choice: '));
    }

    $message = "You: " . ucfirst($playerChoice) . " vs $oppName: " . ucfirst($computerChoice);

    if ($computerChoice == $playerChoice)
    {
        echo "$message. Draw!" . PHP_EOL;
        echo "------------------------------------" . PHP_EOL;
        echo PHP_EOL;
    } elseif (in_array($computerChoice, $winningElements[$playerChoice])) {
        echo "$message. You Won!" . PHP_EOL;
        echo PHP_EOL;
        echo "------------------------------------" . PHP_EOL;

        $you++;
    } else {
        echo "$message. PC Won!" . PHP_EOL;
        echo PHP_EOL;
        echo "------------------------------------" . PHP_EOL;

        $opponent++;
    }

    if ($you == 3 || $opponent == 3) {
        $winner = ($you == 3) ? "You" : $oppName;

        echo "You: $you vs $oppName: $opponent" . PHP_EOL;

        switch ($winner) {
            case $oppName:
                echo PHP_EOL;
                echo "------------------------------------" . PHP_EOL;
                echo "$oppName won round $round. You lose!" . PHP_EOL;
                exit;
            default:
                echo PHP_EOL;
                echo "------------------------------------" . PHP_EOL;
                echo "You won round $round!" . PHP_EOL;
                $round++;

                if ($round > count($opposition)) {
                    echo "You are Rock-Paper-Scissors-Lizard-Spock Champion!" . PHP_EOL;
                    echo "====================================" . PHP_EOL;
                    exit;
                }

                echo "====================================" . PHP_EOL;
                echo "Round $round" . PHP_EOL;
                echo "====================================" . PHP_EOL;

                $you = 0;
                $opponent = 0;
                $index = $index++;
                $oppName = $opposition[$index];
        }
    }
}