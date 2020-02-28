dropdownMenu()
function dropdownMenu() {
    let dropdown = document.querySelector('#dropdownMenuButton')
    let baseMenu = document.querySelector('#menuBase')
    dropdown.addEventListener('click', dropdownMenu);
    function dropdownMenu() {
        baseMenu.querySelector('.baseMenu').classList.add('slideInLeft')
        baseMenu.querySelector('.baseMenu').classList.remove('slideOutLeft')
        baseMenu.style.display = "block"
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
    }
}
