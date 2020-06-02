var Effect3D = (function makeEffect3D() {
    function make3DEffect(el) {
        if (!el instanceof HTMLElement) {
            return;
        }

        var counter = 0;
        var refreshRate = 5;
        var isTimeToUpdate = function() {
            return counter++ % refreshRate === 0;
        };

        var update = function updateFunc(event) {
            pureEvent = event || window.event;
            var boundingRect = el.getBoundingClientRect();

            var halfWidth = boundingRect.width / 2;
            var halfHeight = boundingRect.height / 2;

            var startPosX = event.clientX - boundingRect.left;
            var startPosY = event.clientY - boundingRect.top;

            var rotateX = startPosX - halfWidth;
            rotateX /= halfWidth;

            var rotateY = startPosY - halfHeight;
            rotateY /= -halfHeight;

            var style = 'rotateX(' + rotateY.toFixed(2) + 'deg) rotateY(' + rotateX.toFixed(2) + 'deg)' + ' scale(1.05)';
            el.style.transform = style;
            el.style.webkitTransform = style;
            el.style.mozTranform = style;
            el.style.msTransform = style;
            el.style.oTransform = style;
        };

        var onMouseEnterHandler = function onMouseEnterHandlerFunc(event) {
            update(event);
        };

        var onMouseMoveHandler = function onMouseMoveHandlerFunc(event) {
            if (isTimeToUpdate()) {
                update(event);
            }
        };

        var onMouseLeaveHandler= function onMouseLeaveHandlerFunc() {
            el.style.transform = '';
        };

        el.addEventListener('mouseenter', onMouseEnterHandler);
        el.addEventListener('mousemove', onMouseMoveHandler);
        el.addEventListener('mouseleave', onMouseLeaveHandler);

        return function destroyFunc() {
            onMouseLeaveHandler();
            el.removeEventListener('mouseenter', onMouseEnterHandler);
            el.removeEventListener('mousemove', onMouseMoveHandler);
            el.removeEventListener('mouseleave', onMouseLeaveHandler);
        };
    };

    return function (els) {
        var destroyFuncs = [];
        var destroyFuncsLength = 0;
        var items = els;

        if (!items instanceof HTMLCollection) {
            items = [items];
        }

        var itemsLength = items.length;
        var i = 0;

        for (; i < itemsLength; i += 1) {
            var item = items[i];
            var destroyFunc = make3DEffect(item);

            if (typeof destroyFunc === 'function') {
                destroyFuncs[destroyFuncsLength] = destroyFunc;
                destroyFuncsLength += 1;
            }
        }

        return {
            destroy() {
                var i = 0;

                for (; i < destroyFuncsLength; i += 1) {
                    var destroyFunc = destroyFuncs[i];
                    destroyFunc();
                }
            }
        };
    };
}());

document.addEventListener('DOMContentLoaded', function loadedContent() {
    var items = document.getElementsByClassName('target');
    var effect3D = Effect3D(items);
})