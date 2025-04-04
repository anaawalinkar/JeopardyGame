<?php
session_start();

$category = $_GET['category'];
$points = $_GET['points'];

$questions = [
    'Math_100' => ['question' => 'What is 2 + 2?', 'answer' => '4'],
    'Science_100' => ['question' => 'What planet is known as the Red Planet?', 'answer' => 'Mars'],
    'History_100' => ['question' => 'Who was the first President of the United States?', 'answer' => 'George Washington'],
    'Literature_100' => ['question' => 'Who wrote "Romeo and Juliet"?', 'answer' => 'Shakespeare'],
    'Movies_100' => ['question' => 'Who directed Titanic?', 'answer' => 'James Cameron'],
    'Math_200' => ['question' => 'What is 2 x 10?', 'answer' => '20'],
];

$key = $category . "_" . $points;
$questionText = isset($questions[$key]) ? $questions[$key]['question'] : 'Question not available.';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Question</title>
    <link rel="stylesheet" type="text/css" href="style2.css">
</head>
<body>

<div class="container">
    <h2><?= $category ?> - <?= $points ?> Points</h2>
    <p><strong><?= $questionText ?></strong></p>
    <form method="POST" action="answer_check.php">
        <input type="hidden" name="category" value="<?= $category ?>">
        <input type="hidden" name="points" value="<?= $points ?>">
        <input type="text" name="answer" placeholder="Your answer here" required>
        <br><br>
        <input type="submit" value="Submit Answer">
    </form>
</div>

</body>
</html>
