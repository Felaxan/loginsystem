<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="style/style.css">


    <title>Giriş</title>
</head>

<body class="Body">

    <div class="container" id="container">
        <?php
        
        include("php/config.php");
        
        if(isset($_POST['submit'])){
            $email = mysqli_real_escape_string($con, $_POST['email']);
            $password = mysqli_real_escape_string($con, $_POST['password']);
        
            // Kullanıcının e-posta adresine göre veritabanından kullanıcıyı seç
            $result = mysqli_query($con,"SELECT * FROM users WHERE Email='$email' AND Password='$password' ") or die("Select Error");
            $row = mysqli_fetch_assoc($result);        
            if(is_array($row) && !empty($row)){
                $_SESSION['valid'] = $row['Email'];
                $_SESSION['username'] = $row['Username'];
                $_SESSION['id'] = $row['Id'];
            }else{
                echo "<div class='message'>
                  <p>Yanlış Mail veya Şifre</p>
                   </div> <br>";
            }
            if(isset($_SESSION['valid'])){
                header("Location: home.php");
            }
          }else{
        }
        function checkPasswordStrength($password) {
            // Şifrenin uzunluğunu kontrol et
            if (strlen($password) < 8) {
                return false;
            }
        
            // En az bir büyük harf kontrolü
            if (!preg_match('/[A-Z]/', $password)) {
                return false;
            }
        
            // En az bir küçük harf kontrolü
            if (!preg_match('/[a-z]/', $password)) {
                return false;
            }
        
            // En az bir sayı kontrolü
            if (!preg_match('/[0-9]/', $password)) {
                return false;
            }
        
            // Tüm şartlar sağlandıysa, şifre güçlüdür
            return true;
        }
        
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if(isset($_POST['register'])){
                $username = $_POST['username'];
                $email = $_POST['email'];
                $password = $_POST['password'];
        
                // Şifrenin güçlü olup olmadığını kontrol et
                if (!checkPasswordStrength($password)) {
                    echo "<div class='message'>
                              <p>Şifreniz en az bir büyük harf, bir küçük harf, bir sayı içermeli ve toplamda en az 8 karakter uzunluğunda olmalıdır.</p>
                          </div> <br>";
                } else {
                    $verify_query = mysqli_query($con, "SELECT Email FROM users WHERE Email='$email'");
                    if (empty($username) || empty($email) || empty($password)) {
                        echo "<div class='message'>
                                  <p>Lütfen tüm alanları doldurunuz!</p>
                              </div> <br>";
                    } else {
                        if(mysqli_num_rows($verify_query) != 0 ){
                            echo "<div class='message' onclick='this.style.display=\"none\";'> <!-- Bu satır eklenmiştir -->
                                    <p>Bu Email Kullanılıyor lütfen başka bir tane deneyin</p>
                                </div> <br>";
                        } else {
                            $result = mysqli_query($con,"INSERT INTO users(Username,Email,Password) VALUES('$username','$email','$password')") or die(mysqli_error($con));
                        
                            // JavaScript ile başarı mesajını gösterme
                            echo "<script>
                                    var successMessage = document.createElement('div');
                                    successMessage.classList.add('message');
                                    successMessage.innerHTML = '<p class=\"success\">Başarıyla Kayıt Olundu</p>';
                                    document.body.appendChild(successMessage);
                                  </script>";
                        }
                    }
                }
            }
        }
        
        
        ?>
        <div class="form-container sign-up">
        <form name="registrationForm" action="login.php" method="POST" onsubmit="return validateForm()">

                <h1>Hesap Oluşturun</h1>

                <div class="social-icons">       
                </div>
                <span>Kayıt olmak için lütfen bilgileri doldurunuz</span>
                <input type="text" name="username" placeholder="İsim">
                <input type="email" name="email" placeholder="Email">
                <input type="password" name="password" placeholder="Şifre">
                <button type="submit" name="register">Kayıt Ol</button>
            </form>
        </div>
        <div class="form-container sign-in">
            <form action="login.php" method="POST">

                <h1>Giriş Yapın</h1>

                <div class="social-icons">
                </div>
                <span>Giriş yapmak için lütfen email ve şifrenizi giriniz</span>
                <input type="email" name="email" placeholder="Email">
                <input type="password" name="password" placeholder="Şifre">
                <a href="#">Şifrenizi mi unuttunuz ?</a>
                <button type="submit" name="submit">Giriş Yap</button>
            </form>
        </div>
        <div class="toggle-container">
            <div class="toggle">
                <div class="toggle-panel toggle-left">

                    <h1>Tekrardan Hoşgeldiniz </h1>
                    <p>Bir Hesabınız var mı </p>
                    <button class="hidden" id="login">Giriş Yap</button>
                </div>
                <div class="toggle-panel toggle-right">

                    <h1>Merhaba</h1>
                    <p>Bir hesabınız yok mu lütfen kayıt olun </p>
                    <button class="hidden" id="register">Kayıt Ol</button>
                </div>
            </div>
        </div>
    </div>

    <script src="js/script.js"></script>

</body>

</html>
