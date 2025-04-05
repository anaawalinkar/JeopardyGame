<?php
session_start();

$category = $_GET['category'];
$points = $_GET['points'];

$questions = [
    // Math
    'Math_100' => ['question' => 'What is 2 + 2?', 'answer' => '4'],
    'Math_200' => ['question' => 'What is 2 x 10?', 'answer' => '20'],
    'Math_300' => ['question' => 'What is the square root of 81?', 'answer' => '9'],
    'Math_400' => ['question' => 'What is the value of Pi (to 2 decimal places)?', 'answer' => '3.14'],

    // Science
    'Science_100' => ['question' => 'What planet is known as the Red Planet?', 'answer' => 'Mars'],
    'Science_200' => ['question' => 'What gas do plants breathe in?', 'answer' => 'Carbon dioxide'],
    'Science_300' => ['question' => 'What is H2O?', 'answer' => 'Water'],
    'Science_400' => ['question' => 'What organ pumps blood through your body?', 'answer' => 'Heart'],

    // History
    'History_100' => ['question' => 'Who was the first President of the United States?', 'answer' => 'George Washington'],
    'History_200' => ['question' => 'In what year did World War II end?', 'answer' => '1945'],
    'History_300' => ['question' => 'Who wrote the Declaration of Independence?', 'answer' => 'Thomas Jefferson'],
    'History_400' => ['question' => 'What empire was ruled by Julius Caesar?', 'answer' => 'Roman Empire'],

    // Literature
    'Literature_100' => ['question' => 'Who wrote "Romeo and Juliet"?', 'answer' => 'Shakespeare'],
    'Literature_200' => ['question' => 'What is the name of the wizarding school in Harry Potter?', 'answer' => 'Hogwarts'],
    'Literature_300' => ['question' => 'Who wrote "The Great Gatsby"?', 'answer' => 'F. Scott Fitzgerald'],
    'Literature_400' => ['question' => 'What novel begins with "Call me Ishmael"?', 'answer' => 'Moby-Dick'],

    // Movies
    'Movies_100' => ['question' => 'Who directed Titanic?', 'answer' => 'James Cameron'],
    'Movies_200' => ['question' => 'Which movie features a ring and a character named Frodo?', 'answer' => 'The Lord of the Rings'],
    'Movies_300' => ['question' => 'What movie is known for the quote, "I’ll be back"?', 'answer' => 'The Terminator'],
    'Movies_400' => ['question' => 'Who played the Joker in "The Dark Knight"?', 'answer' => 'Heath Ledger'],
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
    
    <?php if (isset($questions[$key])): ?>
        <form method="POST" action="answer_check.php">
            <input type="hidden" name="category" value="<?= $category ?>">
            <input type="hidden" name="points" value="<?= $points ?>">
            <input type="text" name="answer" placeholder="Your answer here" required>
            <br><br>
            <input type="submit" value="Submit Answer">
        </form>
    <?php else: ?>
        <p style="color: red;">Sorry, this question hasn't been added yet.</p>
    <?php endif; ?>
</div>

</body>
</html>
