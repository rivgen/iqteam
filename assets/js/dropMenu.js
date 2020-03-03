dropdownMenu()
function dropdownMenu() {
    let dropdown = document.querySelector('#dropdownMenuButton')
    let baseMenu = document.querySelector('#menuBase')
    let button = document.querySelector('#button360vw')
    let filter = document.querySelector('#filterMenu')
    let background = document.querySelector('#fixedBackground')
    dropdown.addEventListener('click', dropdownMenu);
    if (filter) {
        button.addEventListener('click', filterMenu);
    }
    function dropdownMenu() {
        baseMenu.querySelector('.baseMenu').classList.add('slideInLeft')
        baseMenu.querySelector('.baseMenu').classList.remove('slideOutLeft')
        baseMenu.style.display = "block"
    }
    function filterMenu() {
        filter.querySelector('.filterMenu').classList.add('slideInLeft')
        filter.querySelector('.filterMenu').classList.remove('slideOutLeft')
        background.style.display = "block"
        filter.style.display = "block"
    }

    window.onclick = function (event) {
        if (event.target == document.querySelector('#menuBase')) {
            let baseMenuNone = baseMenu
            baseMenu.querySelector('.baseMenu').classList.add('slideOutLeft')
            baseMenu.querySelector('.baseMenu').classList.remove('slideInLeft')
            setTimeout(function () {
                baseMenuNone.style.display = "none"
            }, 1500)
        }
        if (event.target == background) {
            let filterMenuNone = filter
            background.style.display = "none"
            filter.querySelector('.filterMenu').classList.add('slideOutLeft')
            filter.querySelector('.filterMenu').classList.remove('slideInLeft')
            setTimeout(function () {
                filterMenuNone.style.display = "none"
            }, 1500)
        }
    }
}
