$(document).ready(function () {
    let left = {x: 0, y: 55},
        right = {x: 53, y: 68}
    $('#parallax').mousemove(function (e) {
        parallax(e, document.getElementById('leftId'), 0.2, left);
        parallax2(e, document.getElementById('rightId'), 0.1, right);
        // console.log(e)
    });
//                                        $('.icon-col').click(function () {
//                                            $('.icon').addClass('flip');
//                                            console.log(111)
//                                        });
});

function parallax(e, target, layer, left) {
    var strength = 20;
    var layer_coeff = strength / layer;
    var x = (left.x - $(window).width() / layer_coeff / 2) + e.pageX / layer_coeff;
    var y = (left.y - $(window).height() / layer_coeff / 2) + e.pageY / layer_coeff;
    $(target).css('transform', 'translate(' + x + '%, -' + y + '%)');
};

function parallax2(e, target, layer, right) {
    var strength = 20;
    var layer_coeff = strength / layer;
    var x = (right.x + $(window).width() / layer_coeff / 2) - e.pageX / layer_coeff;
    var y = (right.y + $(window).height() / layer_coeff / 2) - e.pageY / layer_coeff;
    $(target).css('transform', 'translate(' + x + '%, -' + y + '%)');
};