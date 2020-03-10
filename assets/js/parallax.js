$(document).ready(function () {
    let left = {x: 0, y: 55},
        right = {x: 53, y: 68}
    // $('#parallax').mousemove(function (e) {
    $('body').mousemove(function (e) {
        parallax(e, document.getElementById('leftId'), 0.2, left);
        parallax2(e, document.getElementById('rightId'), 0.1, right);
    });


    function parallax(e, target, layer, left) {
        var strength = 20;
        var layer_coeff = strength / layer;
        let pageY = e.pageY > 1000 ? 1000 : e.pageY
        var x = (left.x - $(window).width() / layer_coeff / 2) + e.pageX / layer_coeff;
        var y = (left.y - $(window).height() / layer_coeff / 2) + pageY / layer_coeff;
        printNumbers(target, x, y);
        // $(target).css('transform', 'translate3d(' + x + '%, -' + y + '%, 0)');
    };

    currentX = left.x;
    currentY = left.y;
    function printNumbers(target, x, y) {

        xx = x
        yy = y
        // console.log('xx1', xx, 'x1', x)

        let timerX = setInterval(function () {
            $(target).css('transform', 'translate3d(' + currentX + '%, -' + currentY + '%, 0)');
            // console.log(currentX)
            if (currentX > xx) {
                if (currentX != xx) {
                    currentX -= 0.01
                }
                timerY()
                if (currentX < xx) {
                    currentX = xx
                }
                if (currentY == yy && currentX == xx) {
                    clearInterval(timerX)
                }
            } else if (currentX < xx) {
                if (currentX != xx) {
                    currentX += 0.01
                }
                timerY()
                if (currentX > xx) {
                    currentX = xx
                }
                if (currentY == yy && currentX == xx) {
                    clearInterval(timerX)
                }

            } else {
                clearInterval(timerX);
            }
        }, 50);

        let timerY = function () {
            if (currentY > yy) {
                currentY -= 0.01
                if (currentY < yy) {
                    currentY = yy
                }

            } else if (currentY < yy) {
                currentY += 0.01
                if (currentY > yy) {
                    currentY = yy
                }
            } else {
                currentY = yy
            }
        };
    }

// использование:

    function parallax2(e, target, layer, right) {
        var strength = 20;
        var layer_coeff = strength / layer;
        let pageY = e.pageY > 1000 ? 1000 : e.pageY
        var x = (right.x + $(window).width() / layer_coeff / 2) - e.pageX / layer_coeff;
        var y = (right.y + $(window).height() / layer_coeff / 2) - pageY / layer_coeff;
        // $(target).css('transform', 'translate3d(' + x + '%, -' + y + '%, 0)');
        printNumbers2(target, x, y)
    };

    currentX2 = right.x;
    currentY2 = right.y;
    function printNumbers2(target, x, y) {

        xx2 = x
        yy2 = y
        // console.log('xx1', xx, 'x1', x)

        let timerX = setInterval(function () {
            $(target).css('transform', 'translate3d(' + currentX2 + '%, -' + currentY2 + '%, 0)');
            // console.log(currentX)
            if (currentX2 > xx2) {
                if (currentX2 != xx2) {
                    currentX2 -= 0.01
                }
                timerY2()
                if (currentX2 < xx2) {
                    currentX2 = xx2
                }
                if (currentY2 == yy2 && currentX2 == xx2) {
                    clearInterval(timerX)
                }
            } else if (currentX2 < xx2) {
                if (currentX2 != xx2) {
                    currentX2 += 0.01
                }
                timerY2()
                if (currentX2 > xx2) {
                    currentX2 = xx2
                }
                if (currentY2 == yy2 && currentX2 == xx2) {
                    clearInterval(timerX)
                }

            } else {
                clearInterval(timerX);
            }
        }, 50);

        let timerY2 = function () {
            if (currentY2 > yy2) {
                currentY2 -= 0.01
                if (currentY2 < yy2) {
                    currentY2 = yy2
                }

            } else if (currentY2 < yy2) {
                currentY2+= 0.01
                if (currentY2 > yy2) {
                    currentY2 = yy2
                }
            } else {
                currentY2 = yy2
            }
        };
    }
});