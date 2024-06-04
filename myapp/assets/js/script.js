document.addEventListener('DOMContentLoaded', () => {
  let navbar = document.querySelector('.header .navbar');

  let menuBtn = document.querySelector('#menu-btn');
  if (menuBtn) {
    menuBtn.onclick = () => {
      navbar.classList.add('active');
    };
  }

  let closeNavbarBtn = document.querySelector('#close-navbar');
  if (closeNavbarBtn) {
    closeNavbarBtn.onclick = () => {
      navbar.classList.remove('active');
    };
  }

  let registerBtn = document.querySelector('.account-form .register-btn');
  let loginBtn = document.querySelector('.account-form .login-btn');

  if (registerBtn && loginBtn) {
    registerBtn.onclick = () => {
      registerBtn.classList.add('active');
      loginBtn.classList.remove('active');
      document.querySelector('.account-form .login-form').classList.remove('active');
      document.querySelector('.account-form .register-form').classList.add('active');
    };

    loginBtn.onclick = () => {
      registerBtn.classList.remove('active');
      loginBtn.classList.add('active');
      document.querySelector('.account-form .login-form').classList.add('active');
      document.querySelector('.account-form .register-form').classList.remove('active');
    };
  }

  let accountForm = document.querySelector('.account-form');

  let accountBtn = document.querySelector('#account-btn');
  if (accountBtn) {
    accountBtn.onclick = () => {
      accountForm.classList.add('active');
    };
  }

  let closeFormBtn = document.querySelector('#close-form');
  if (closeFormBtn) {
    closeFormBtn.onclick = () => {
      accountForm.classList.remove('active');
    };
  }
  let accordion = document.querySelectorAll('.faq .accordion-container .accordion');

  accordion.forEach(acco => {
    acco.onclick = () => {
      accordion.forEach(dion => dion.classList.remove('active'));
      acco.classList.toggle('active');
    };
  });

  let loadMoreBtn = document.querySelector('.load-more .btn');
  if (loadMoreBtn) {
    loadMoreBtn.onclick = () => {
      document.querySelectorAll('.courses .box-container .hide').forEach(show => {
        show.style.display = 'block';
      });
      loadMoreBtn.style.display = 'none';
    };
  }
});
