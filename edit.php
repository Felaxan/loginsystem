<?php
session_start();
include("php/config.php");

if (!isset($_SESSION['valid'])) {
    header("Location: login.php");
    exit; // Kodun devam etmemesi için
}

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $id = $_SESSION['id'];

    $edit_query = mysqli_query($con, "UPDATE users SET Username='$username', Email='$email', Password='$password' WHERE Id='$id'") or die("Hata Meydana Geldi");
    if ($edit_query) {
        echo "<div class='message'>
                <p class='success'> Profil Başarıyla Güncellendi </p>
            </div> <br>";
        echo "<a href='home.php'><button class='btn'>Anasayfaya Dön</button>";
    }
} else {
    $id = $_SESSION['id'];
    $query = mysqli_query($con, "SELECT * FROM users WHERE Id=$id");

    while ($result = mysqli_fetch_assoc($query)) {
        $res_Uname = $result['Username'];
        $res_Email = $result['Email'];
        $res_Pass = $result['Password'];
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style1.css">
    <title>Change Profile</title>
</head>

<body>
    <div class="nav">
        <div class="logo">
            <p><a href="home.php">Logo</a></p>
        </div>
        <div class="right-links">
            <a href="#">Profil Değiştir</a>
            <a href="php/logout.php"><button class="btn">Çıkış Yap</button></a>
        </div>
    </div>
    <div class="container">
        <div class="box form-box">
            <header>Profil Bilgileri Değiştirme</header>
            <form action="" method="post">
                <div class="field input">
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username" value="<?php echo $res_Uname ?>" autocomplete="off" required>
                </div>
                <div class="field input">
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email" value="<?php echo $res_Email ?>" autocomplete="off" required>
                </div>
                <div class="field input">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" value="<?php echo $res_Pass ?>" autocomplete="off" required>
                </div>
                <div class="field">
                    <input type="submit" class="btn" name="submit" value="Güncelle" required>
                </div>
            </form>
        </div>
    </div>
</body>

</html>
<?php } ?>
