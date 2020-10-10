let base_url = 'http://localhost/myhome_ci/';

function login(){
    let email = document.getElementById('email').value;
    let password = document.getElementById('password').value;
    sessionStorage.setItem("id", '1');
    sessionStorage.setItem("correo", email);

    window.location.replace(`${base_url}index.php/inicio`);
}