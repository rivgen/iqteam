function isVisible(elem) {

    let coords = elem.getBoundingClientRect();

    let windowHeight = document.documentElement.clientHeight;

    // видны верхний ИЛИ нижний край элемента
    let topVisible = coords.top > 0 && coords.top < windowHeight;
    let bottomVisible = coords.bottom < windowHeight && coords.bottom > 0;

    return topVisible || bottomVisible;
}

function showVisible() {
    for (let img of document.querySelectorAll('img')) {
        let realSrc = img.dataset.src;
        if (!realSrc) continue;

        if (isVisible(img)) {
            // отключение кеширования
            // эта строка должна быть удалена в "боевом" коде
            // realSrc += '?nocache=' + Math.random();

            img.src = realSrc;

            img.dataset.src = '';
        }
    }
}

window.addEventListener('scroll', showVisible);
showVisible();