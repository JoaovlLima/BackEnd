var currentIndex = 0; // Comece no primeiro card
var initialOffset = 6280; // Deslocamento inicial do primeiro card
var cards = document.querySelectorAll('.carousel-card');
var cardWidth = cards[0].offsetWidth + 80; // Largura de um card com a margem

document.getElementById('nextBtn').addEventListener('click', function() {
  function moveToNextCard() {
    var totalCards = cards.length;
    currentIndex = (currentIndex + 1) % totalCards; // Use o operador módulo para criar um loop infinito
    var newTranslateValue = -(currentIndex * cardWidth) + initialOffset; // Atualiza o valor de translação com o deslocamento inicial
    document.querySelector('.carousel2').style.transform = 'translateX(' + newTranslateValue + 'px)';
  }
  moveToNextCard();
});

document.getElementById('prevBtn').addEventListener('click', function() {
  function moveToPrevCard() {
    var totalCards = cards.length;
    currentIndex = (currentIndex - 1 + totalCards) % totalCards; // Ajuste para o loop infinito ao ir para o card anterior
    var newTranslateValue = -(currentIndex * cardWidth) + initialOffset; // Atualiza o valor de translação com o deslocamento inicial
    document.querySelector('.carousel2').style.transform = 'translateX(' + newTranslateValue + 'px)';
  }
  moveToPrevCard();
});
