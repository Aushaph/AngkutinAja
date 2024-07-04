document.addEventListener('DOMContentLoaded', function() {
    var loginModal = document.getElementById('loginModal');
    var registerModal = document.getElementById('registerModal');

    var loginBtn = document.getElementById('loginBtn');
    var registerBtn = document.getElementById('registerBtn');
    var registerBtnMain = document.getElementById('registerBtnMain');

    var closeLogin = document.getElementById('closeLogin');
    var closeRegister = document.getElementById('closeRegister');

    // Open Login Modal
    loginBtn.addEventListener('click', function() {
        loginModal.style.display = 'block';
    });

    // Open Register Modal from Header
    registerBtn.addEventListener('click', function() {
        registerModal.style.display = 'block';
    });

    // Open Register Modal from Main Content
    registerBtnMain.addEventListener('click', function() {
        registerModal.style.display = 'block';
    });

    // Close Login Modal
    closeLogin.addEventListener('click', function() {
        loginModal.style.display = 'none';
    });

    // Close Register Modal
    closeRegister.addEventListener('click', function() {
        registerModal.style.display = 'none';
    });

    // Switch to Register Modal from Login Modal
    var switchToRegister = document.getElementById('switchToRegister');
    switchToRegister.addEventListener('click', function(e) {
        e.preventDefault();
        loginModal.style.display = 'none';
        registerModal.style.display = 'block';
    });

    // Switch to Login Modal from Register Modal
    var switchToLogin = document.getElementById('switchToLogin');
    switchToLogin.addEventListener('click', function(e) {
        e.preventDefault();
        registerModal.style.display = 'none';
        loginModal.style.display = 'block';
    });

    // Close Modal when clicking outside of the modal content
    window.addEventListener('click', function(event) {
        if (event.target == loginModal) {
            loginModal.style.display = 'none';
        } else if (event.target == registerModal) {
            registerModal.style.display = 'none';
        }
    });
});
