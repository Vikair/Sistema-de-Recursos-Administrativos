function menuShow() {
  let menuMobile = document.querySelector('.mobile-menu');
  if (menuMobile.classList.contains('open')) {
      menuMobile.classList.remove('open');
      document.querySelector('.icon').src = "assets/img/menu_white_36dp.svg";
  } else {
      menuMobile.classList.add('open');
      document.querySelector('.icon').src = "assets/img/close_white_36dp.svg";
  }
}



function openPopup() {
  // Seleciona o elemento do pop-up pelo ID
  var popup = document.getElementById("popup-form");
  
  // Define o estilo display como "block" para torná-lo visível
  popup.style.display = "block";
}
