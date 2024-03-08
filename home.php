<?php

session_start();

include("php/config.php");

if(!isset($_SESSION['valid'])){
    header ("Location: login.php");
};


?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="style/style1.css">
    <title>home</title>
</head>

<body>
    <div class="nav">
        <div class="logo">
            <p><a href="home.php">Logo</a></p>
        </div>

        <div class="right-links">
        <?php
$id = $_SESSION['id'];
$id = mysqli_real_escape_string($con, $id); // Güvenlik önlemi
$query = mysqli_query($con, "SELECT * FROM users WHERE Id='$id'"); // Tek tırnak içine alındı

while ($result = mysqli_fetch_assoc($query)) {
    $res_Uname = $result['Username'];
    $res_Email = $result['Email'];
    $res_id = $result['Id'];
}

if (isset($res_id)) {
    echo "<a href='edit.php?Id=$res_id'>Profil Değiştirin</a>";
} else {
}
?>

            <a href="php/logout.php"><button class="btn">Çıkış Yap</button></a>
        </div>
    </div>

    <main>
        <div class="main-box top">
            <div class="top">
                <div class="box">
                    <p>Merhaba<b> <?php echo $res_Uname?></b>, Hoşgeldin!</p>
                </div>
                <div class="box">
                    <p>Email'iniz <b><?php echo $res_Email?></b>, Hoşgeldin!</p>
                </div>

            </div>

            <div class="bottom">
                <div class="box">
                    <p>Lorem, ipsum dolor.</p>
                </div>

            </div>
        </div>
    </main>
</body>

</html>