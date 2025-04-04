<?php
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST["name"]);
    $password = $_POST["password"];
    $file = "users.txt";

    if (empty($name) || empty($password)) {
        $error = "Please fill in all fields.";
    } elseif (!file_exists($file)) {
        $error = "No users have signed up yet.";
    } else {
        $users = file($file, FILE_IGNORE_NEW_LINES);
        $found = false;

        foreach ($users as $user) {
            list($storedName, $storedAge, $storedPassword) = explode("|", $user);
            if ($name === $storedName && $password === $storedPassword) {
                $found = true;
                break;
            }
        }

        if ($found) {
            // ✅ Redirect to game.php
            header("Location: game.php");
            exit();
        } else {
            $error = "Invalid username or password.";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <form action="login.php" method="POST">
        <fieldset>
            <legend>Login</legend>

            <?php if (!empty($error)) : ?>
                <p style="color: red;"><?= $error ?></p>
            <?php endif; ?>

            <label>Name:</label><br>
            <input type="text" name="name"><br><br>

            <label>Password:</label><br>
            <input type="password" name="password"><br><br>

            <input type="submit" value="Login">
        </fieldset>
    </form>
</body>
</html>
