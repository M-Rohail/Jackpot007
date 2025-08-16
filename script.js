// ===== SLIDER =====
let slideIndex = 0;
showSlides();

function showSlides() {
  let slides = document.getElementsByClassName("slide");
  for (let i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";
  }
  slideIndex++;
  if (slideIndex > slides.length) { slideIndex = 1 }
  slides[slideIndex - 1].style.display = "block";
  setTimeout(showSlides, 3000); // Change image every 3s
}

// ===== MODALS =====
document.addEventListener("DOMContentLoaded", function() {
  const registerModal = document.getElementById("registerModal");
  const loginModal = document.getElementById("loginModal");

  const registerBtn = document.querySelector(".register");
  const loginBtn = document.querySelector(".signin");

  const closeRegister = document.querySelector(".close");
  const closeLogin = document.querySelector(".close-login");

  const openLoginFromRegister = document.getElementById("openLoginFromRegister");
  const openRegisterFromLogin = document.getElementById("openRegisterFromLogin");

  // Open modals
  registerBtn.addEventListener("click", () => registerModal.style.display = "flex");
  loginBtn?.addEventListener("click", () => loginModal.style.display = "flex");

  // Close modals
  closeRegister.addEventListener("click", () => registerModal.style.display = "none");
  closeLogin?.addEventListener("click", () => loginModal.style.display = "none");

  // Close when clicking outside modal
  window.addEventListener("click", (e) => {
    if (e.target === registerModal) registerModal.style.display = "none";
    if (e.target === loginModal) loginModal.style.display = "none";
  });

  // Switch modals
  openLoginFromRegister?.addEventListener("click", (e) => {
    e.preventDefault();
    registerModal.style.display = "none";
    loginModal.style.display = "flex";
  });

  openRegisterFromLogin?.addEventListener("click", (e) => {
    e.preventDefault();
    loginModal.style.display = "none";
    registerModal.style.display = "flex";
  });

  // **No form submit handling here**
  // Form will submit naturally to register.php
});
