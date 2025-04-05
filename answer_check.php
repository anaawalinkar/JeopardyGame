<?php
session_start();

// Get category, points, and user answer from form
$category = $_POST['category'];
$points = $_POST['points'];
$userAnswer = trim(strtolower($_POST['answer']));

// Build question key
$key = $category . "_" . $points;

// Master answer key (same keys as in question_form.php)
$answers = [
    // Math
    'Math_100' => '4',
    'Math_200' => '20',
    'Math_300' => '9',
    'Math_400' => '3.14',

    // Science
    'Science_100' => 'mars',
    'Science_200' => 'carbon dioxide',
    'Science_300' => 'water',
    'Science_400' => 'heart',

    // History
    'History_100' => 'george washington',
    'History_200' => '1945',
    'History_300' => 'thomas jefferson',
    'History_400' => 'roman empire',

    // Literature
    'Literature_100' => 'shakespeare',
    'Literature_200' => 'hogwarts',
    'Literature_300' => 'f. scott fitzgerald',
    'Literature_400' => 'moby-dick',

    // Movies
    'Movies_100' => 'james cameron',
    'Movies_200' => 'the lord of the rings',
    'Movies_300' => 'the terminator',
    'Movies_400' => 'heath ledger',
];

// Check if the answer exists for the given key
if (isset($answers[$key])) {
    $correctAnswer = strtolower(trim($answers[$key]));
    $correct = $userAnswer === $correctAnswer;

    // Add points if correct
    if ($correct) {
        $_SESSION['scores'][$_SESSION['turn']] += (int)$points;
    }
} else {
    // If answer is missing, still proceed but no score is awarded
    $correct = false;
}

// Mark question as answered
if (!in_array($key, $_SESSION['answered'])) {
    $_SESSION['answered'][] = $key;
}

// Switch turn
$_SESSION['turn'] = ($_SESSION['turn'] === 'Player 1') ? 'Player 2' : 'Player 1';

// Redirect back to the game board
header("Location: game_board.php");
exit;
?>
