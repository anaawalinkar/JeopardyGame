<?php
session_start();

$category = $_POST['category'];
$points = $_POST['points'];
$userAnswer = trim(strtolower($_POST['answer']));

$key = $category . "_" . $points;

$answers = [
    'Math_100' => '4',
    'Science_100' => 'mars',
    'History_100' => 'george washington',
    'Literature_100' => 'shakespeare',
    'Movies_100' => 'james cameron',
    'Math_200' => '20',
];

$correct = strtolower($answers[$key]) === $userAnswer;

if ($correct) {
    $_SESSION['scores'][$_SESSION['turn']] += (int)$points;
}

// Mark as answered
if (!in_array($key, $_SESSION['answered'])) {
    $_SESSION['answered'][] = $key;
}

// Switch turn
$_SESSION['turn'] = ($_SESSION['turn'] === 'Player 1') ? 'Player 2' : 'Player 1';

header("Location: game_board.php");
exit;
