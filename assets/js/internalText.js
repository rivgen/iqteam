$(document).ready(function () {
    $(".internalText").html("Your browser does not support SVG");
    $("#menuLeft").on("click", "a", function (event) {
        event.preventDefault();
        var id = $(this).attr('href'),
            top = $(id).offset().top;
        $('body,html').animate({scrollTop: top}, 1500);
    });
    if ($("*").is('#menuLeft')) {
        let menuLeft = $("#menuLeft"),
            lastId,
            menuItems = menuLeft.find("a"),
            scrollItems = menuItems.map(function () {
                let item = $($(this).attr("href"));
                if (item.length) {
                    return item;
                }
            });
        $(window).scroll(() => {
            let windowTop = $(window).scrollTop();
            let cur = scrollItems.map(function () {
                if ($(this).offset().top < windowTop + 10)
                    return this;
            });
            cur = cur[cur.length - 1];
            let id = cur && cur.length ? cur[0].id : "";
            if (lastId !== id) {
                lastId = id;
                menuItems
                    .parent().removeClass("activeMenu")
                    .end().filter("[href='#" + id + "']").parent().addClass("activeMenu");
            }
        })

    }
});

document.querySelectorAll('.hoverEffects').forEach(button =>
    button.innerHTML = '<div><span>' + button.textContent.trim().split('').join('</span><span>').replace(/<span>_/g, "<span class='lineInvisible'>_") + '</span></div>');

let lengthImg = $('.carousel-indicators li').length
$('#lengthImg').html(lengthImg)
$("#carouselExampleIndicators").carousel();
$('#carouselExampleIndicators').on('slide.bs.carousel', function (e) {
    $('#countImg').html(e.to + 1)
})

var social = $('.socialBlock');
let position = 0,
    opacity = 0;
$(document).on('scroll', function () {
    var positionBottom = $(window).scrollTop() + $(window).height(),
        positionTop = $(window).scrollTop() + $(window).height() / 2,
        block_position = $('#letter-E').offset().top


    if (positionBottom > block_position) {

        if (block_position - positionTop >= 100) {
            position = Math.round(block_position - positionTop) / 2
            opacity = position / 1000
            social.css('display', 'block')
        } else {
            opacity = 0
            social.css('display', 'none')
        }
        // console.log(position, opacity)
        social.css('opacity', opacity);
    } else {
        social.removeAttr('style');
    }
});



