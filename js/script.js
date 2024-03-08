const container = document.getElementById('container');
const registerBtn = document.getElementById('register');
const loginBtn = document.getElementById('login');

registerBtn.addEventListener('click', () => {
    container.classList.add("active");
});

loginBtn.addEventListener('click', () => {
    container.classList.remove("active");
});



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
