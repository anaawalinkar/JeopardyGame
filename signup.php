<?php
$errors = [];
$usersFile = "users.txt";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST["name"]);
    $age = trim($_POST["age"]);
    $password = $_POST["password"];
    $repeat_password = $_POST["repeat_password"];

    if (empty($name)) {
        $errors[] = "Name is required.";
    }
    if (empty($age)) {
        $errors[] = "Age is required.";
    } elseif (!ctype_digit($age) || (int)$age <= 0) {
        $errors[] = "Age must be a positive number.";
    }
    if (empty($password)) {
        $errors[] = "Password is required.";
    } else {
        if (strlen($password) < 5) {
            $errors[] = "Password must be at least 5 characters long.";
        }
        if (!preg_match('/[A-Z]/', $password)) {
            $errors[] = "Password must contain at least one uppercase letter.";
        }
    }
    if (empty($repeat_password)) {
        $errors[] = "Please repeat the password.";
    } elseif ($password !== $repeat_password) {
        $errors[] = "Passwords do not match.";
    }

    // check user already exists
    if (empty($errors) && file_exists($usersFile)) {
        $users = file($usersFile, FILE_IGNORE_NEW_LINES);
        foreach ($users as $user) {
            list($existingName) = explode("|", $user);
            if ($name === $existingName) {
                $errors[] = "Username already taken.";
                break;
            }
        }
    }

    // save user 
    if (empty($errors)) {
        $newUserLine = "$name|$age|$password\n";
        file_put_contents($usersFile, $newUserLine, FILE_APPEND);
        
        //go to game.php
        header("Location: game_board.php");
        exit();
    }

}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Signup</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <form action="signup.php" method="POST">
        <fieldset>
            <legend>New User Signup</legend>

            <label class="label-name" for="name">Name:</label><br>
            <input type="text" id="name" name="name"><br><br>

            <label class="label-age" for="age">Age:</label><br>
            <input type="number" id="age" name="age" min="1"><br><br>

            <label class="label-password" for="password">Password:</label><br>
            <input type="password" id="password" name="password"><br><br>

            <label class="label-repeat" for="repeat_password">Repeat Password:</label><br>
            <input type="password" id="repeat_password" name="repeat_password"><br>

            <?php if (!empty($errors)) : ?>
                <ul style="color: red;">
                    <?php foreach ($errors as $err) : ?>
                        <li><?= htmlspecialchars($err) ?></li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>

            <br>

            <input type="submit" value="Sign Up">

            
        </fieldset>
    </form>
</body>
</html>
