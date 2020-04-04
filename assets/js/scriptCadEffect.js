var NeedEffect = (function genNeedEffect() {
  function genEffectForElement(innerEl) {

    if (!innerEl instanceof HTMLElement) {
      return;
    }

    var outerNode = innerEl.parentNode;

    if (!innerEl instanceof HTMLElement) {
      return;
    }

    var initMouse = {
      _x: 0,
      _y: 0,
      x: 0,
      y: 0,

      updatePosition: function updatePositionFunc(event) {
        var pureEvent = event || window.event;
        this.x = pureEvent.clientX - this._x;
        this.y = (pureEvent.clientY - this._y) * -1;
      },

      setOrigin: function setOriginFunc(pureEvent) {
        this._x = pureEvent.offsetLeft + Math.floor(pureEvent.offsetWidth * 1.5 );
        this._y = pureEvent.offsetTop + Math.floor(pureEvent.offsetHeight / 2 );
      },

      show: function showFunc() {
        return "(" + this.x + ", " + this.y + ")";
      },
    };

    initMouse.setOrigin(outerNode);

    var counter = 0;
    var refreshRate = 10;
    var isTimeToUpdate = function() {
      return counter++ % refreshRate === 0;
    };

    var updateTransformStyle = function updateTransformStyleFunc(x, y) {
      var style = 'rotateX(' + x + 'deg) rotateY(' + y + 'deg)';
      innerEl.style.transform = style;
      innerEl.style.webkitTransform = style;
      innerEl.style.mozTranform = style;
      innerEl.style.msTransform = style;
      innerEl.style.oTransform = style;
    };

    var update = function updateFunc(event) {
      initMouse.updatePosition(event);

      updateTransformStyle(
        (initMouse.y / innerEl.offsetHeight / 2).toFixed(2),
        (initMouse.x / innerEl.offsetWidth / 2).toFixed(2)
      );
    };

    var onMouseEnterHandler = function onMouseEnterHandlerFunc(event) {
      update(event);
    };

    var onMouseLeaveHandler = function onMouseLeaveHandlerFunc() {
      innerEl.style.transform = '';
    };

    var onMouseMoveHandler = function onMouseMoveHandlerFunc(event) {
      if (isTimeToUpdate()) {
        update(event);
      }
    };

    outerNode.onmousemove = onMouseMoveHandler;
    outerNode.onmouseleave = onMouseLeaveHandler;
    outerNode.onmouseenter = onMouseEnterHandler;
  };

  return function (els) {

    var items = els;

    if (!items instanceof HTMLCollection) {
      items = [items];
    }

    var itemsLength = items.length;
    var i = 0;

    for (; i < itemsLength; i += 1) {
      var item = items[i];
      // console.log(item)
      genEffectForElement(item);
    }
  };
}());


document.addEventListener('DOMContentLoaded', function loadedContent() {
  var items = document.getElementsByClassName('target');

  NeedEffect(items);
});
