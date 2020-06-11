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
// mainmenu
$(window).scroll(function(){
    if($(window).scrollTop()>500){
        $('.blockToFix').show()
        $('#home.homeClass').addClass('slideInDown fixedClass')
        $('#home .home-content-main').addClass('fixedLogo')
        $('.menuFlex.inRight').addClass('fixedInRight')
        $('#home .hadMenu').addClass('fixedCenter')
        $('#home .homeLocale').addClass('fixedLocale')
        $('#home .homeButton').show()
        $('.down object').removeClass('downImg')
        $('.down object').addClass('upImg')
    }
})
$(window).scroll(function(){
    if($(window).scrollTop()<=500){
        $('.blockToFix').hide()
        $('#home.homeClass').removeClass('slideInDown fixedClass')
        $('#home .home-content-main').removeClass('fixedLogo')
        $('.menuFlex.inRight').removeClass('fixedInRight')
        $('#home .hadMenu').removeClass('fixedCenter')
        $('#home .homeLocale').removeClass('fixedLocale')
        $('#home .homeButton').hide()
        $('.down object').removeClass('upImg')
        $('.down object').addClass('downImg')


    }
})
let timerY
$('.down').mouseover(function () {
    let yTr = 35
    transformer(yTr)
     timerY = setInterval(function () {
         transformer(yTr)
            let upDown =  yTr
         yTr = upDown
            if (yTr == -80) {
                yTr = 35
            } else {
                yTr = -80
            }

    }, 1000);
})

$('.down').mouseout(function () {
    clearInterval(timerY)
    transformer(-50)
});

function transformer(yTr) {
    $('.downImg').css('transform', 'translate(-50%, ' + yTr + '%)');
}

//failSend
var inputs = document.querySelectorAll('.inputfile');
Array.prototype.forEach.call(inputs, function(input){
    var label	 = document.querySelectorAll('.button label'),
        labelVal = label[0].innerHTML;
//        console.log(labelVal)
    input.addEventListener('change', function(e){
        var fileName = '';
        if( this.files && this.files.length > 1 )
            fileName = ( this.getAttribute( 'data-multiple-caption' ) || '' ).replace( '{count}', this.files.length );
        else
            fileName = e.target.value.split( '\\' ).pop();
        if( fileName ) {
            label[0].innerHTML = fileName;
        }
        else {
            label[0].innerHTML = labelVal;
        }
    });
});