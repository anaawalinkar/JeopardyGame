<?php
session_start();

if (!isset($_SESSION['scores'])) {
    $_SESSION['scores'] = ['Player 1' => 0, 'Player 2' => 0];
    $_SESSION['turn'] = 'Player 1';
    $_SESSION['answered'] = [];
}

$categories = ["Math", "Science", "History", "Literature", "Movies"];
$pointValues = [100, 200, 300, 400];

$totalQuestions = count($categories) * count($pointValues);
$answeredCount = count($_SESSION['answered']);
$gameOver = $answeredCount >= $totalQuestions;
?>

<!DOCTYPE html>
<html>
<head>
    <title>Jeopardy Game Board</title>
    <link rel="stylesheet" type="text/css" href="style2.css">
</head>
<body>

<h1>Jeopardy Game</h1>

<div class="scoreboard">
    Player 1: <?= $_SESSION['scores']['Player 1'] ?> |
    Player 2: <?= $_SESSION['scores']['Player 2'] ?>
</div>

<!-- Turn Indicator -->
<div class="turn-box">
    🎯 <strong>Current Turn:</strong> <span><?= $_SESSION['turn'] ?></span>
</div>

<!-- Reset Game Button -->
<form action="reset_game.php" method="post">
    <button type="submit">🔄 Reset Game</button>
</form>

<?php if ($gameOver): ?>
    <h2 style="color: green;">🎉 Game Over! 🎉</h2>
    <p><strong>Final Scores:</strong></p>
    <p>Player 1: <?= $_SESSION['scores']['Player 1'] ?> | Player 2: <?= $_SESSION['scores']['Player 2'] ?></p>
<?php else: ?>
    <table>
        <tr>
            <?php foreach ($categories as $category): ?>
                <th><?= $category ?></th>
            <?php endforeach; ?>
        </tr>
        <?php foreach ($pointValues as $points): ?>
            <tr>
                <?php foreach ($categories as $cat): 
                    $id = $cat . "_" . $points;
                    $answered = in_array($id, $_SESSION['answered']);
                ?>
                    <td class="<?= $answered ? 'answered' : '' ?>">
                        <?php if (!$answered): ?>
                            <a href="question_form.php?category=<?= $cat ?>&points=<?= $points ?>">
                                <?= $points ?>
                            </a>
                        <?php else: ?>
                            —
                        <?php endif; ?>
                    </td>
                <?php endforeach; ?>
            </tr>
        <?php endforeach; ?>
    </table>
<?php endif; ?>

</body>
</html>
