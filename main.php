<?php declare(strict_types=1);

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

$player = 0;
$pc = 0;

while(true) {
    $computerChoice = $elements[array_rand($elements)];

    echo PHP_EOL;
    echo "Player: $player vs PC: $pc" . PHP_EOL;
    echo PHP_EOL;

    $playerChoice = strtolower(readline('Your Choice: '));
    $message = "PC: " . ucfirst($computerChoice) . ' vs Player: ' . ucfirst($playerChoice);

    if ($computerChoice == $playerChoice)
    {
        echo $message . '. Draw!' . PHP_EOL;
        echo "------------------------------------" . PHP_EOL;
        echo PHP_EOL;
    } elseif (in_array($computerChoice, $winningElements[$playerChoice])) {
        echo $message . '. Player Won!' . PHP_EOL;
        echo PHP_EOL;
        echo "------------------------------------" . PHP_EOL;

        $player++;
    } else {
        echo $message . '. PC Won!' . PHP_EOL;
        echo PHP_EOL;
        echo "------------------------------------" . PHP_EOL;

        $pc++;
    }

    if ($player >= 3 || $pc >= 3) {
        $winner = ($player == 3) ? "Player" : "PC";
        break;
    }
}

echo "Player: $player vs PC: $pc" . PHP_EOL;
echo "$winner won!" . PHP_EOL;