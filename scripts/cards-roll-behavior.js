let position = 0;
function roll(direction) {
    const cardRoll = document.querySelector('.card-roll');
    const cardWidth = document.querySelector('.card').offsetWidth;
    const cards = document.querySelectorAll('.card');
    const cardStyle = window.getComputedStyle(document.querySelector('.card'));
    const cardMargin = parseFloat(cardStyle.marginLeft) + parseFloat(cardStyle.marginRight);
    const totalCardWidth = cardWidth + cardMargin;

    const cardRollWidth = document.querySelector('.card-roll').offsetWidth;
    const totalWidth = totalCardWidth * cards.length;
    
    position += direction * totalCardWidth;

    if (position < 0) position = 0;
    if (position + cardRollWidth > totalWidth) {
        position = totalWidth - cardRollWidth;
    }

    cardRoll.style.transform = `translateX(-${position}px)`;
}