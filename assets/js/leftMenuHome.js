$(() => {
    if ($("*").is('#menuLeft')) {
        let menuLeft = $("#menuLeft"),
            heghtManu = menuLeft.height(),
            blockMenu = $("#blockMenu").height(),
            distance = $('#blockMenu').offset().top,
            marginMenu = $('.leftTerms.menuTerms').outerHeight(true) - $('.leftTerms.menuTerms').outerHeight(),
            endDistance = $('#blockMenu').offset().top + blockMenu - heghtManu - marginMenu,
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
            windowTop > distance ? windowTop > endDistance ? classAddBottom() : classAdd() : classRemove();
            function classAdd() {
                menuLeft.addClass("menu-nav");
                menuLeft.removeClass("menu-nav-bottom");
            }

            function classRemove() {
                menuLeft.removeClass("menu-nav");
                menuLeft.removeClass("menu-nav-bottom");
            }

            function classAddBottom() {
                menuLeft.addClass("menu-nav-bottom");
            }

            let cur = scrollItems.map(function () {
                if ($(this).offset().top < windowTop + 10)
                    return this;
            });
            cur = cur[cur.length - 1];
            let id = cur && cur.length ? cur[0].id : "";
            if (lastId !== id) {
                lastId = id;
                menuItems
                    .parent().removeClass("active")
                    .end().filter("[href='#" + id + "']").parent().addClass("active");
            }
        });


        menuItems.click(function (e) {
            let href = $(this).attr("href")

            offsetTop = href === "#" ? 0 : $(href).offset().top;
            $('html, body').stop().animate({
                scrollTop: offsetTop
            }, 300);
            e.preventDefault();
        });
    }
});