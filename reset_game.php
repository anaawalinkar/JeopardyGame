<?php
session_start();
session_destroy(); // Clear everything
header("Location: game_board.php");
exit;
