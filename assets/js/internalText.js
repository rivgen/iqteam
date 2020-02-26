$(document).ready(function () {
        $(".internalText").html("Your browser does not support SVG");
});

        document.querySelectorAll('.hoverEffects').forEach(button =>
        button.innerHTML = '<div><span>' + button.textContent.trim().split('').join('</span><span>').replace('<span>_', "<span class='lineInvisible'>_") + '</span></div>');
