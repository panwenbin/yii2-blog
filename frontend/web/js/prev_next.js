(function () {
    var prevLink = function () {
        $('#prev_link:first').each(function () {
            this.click();
        });
    }
    var nextLink = function () {
        $('#next_link:first').each(function () {
            this.click();
        });
    }
    $(document).on('keyup', function (event) {
        if (event.keyCode == "37") {
            prevLink();
        }
        if (event.keyCode == "39") {
            nextLink();
        }
    });
    var startX, startY, endX, endY;
    $(document).on('touchstart', function (event) {
        var touch = event.changedTouches;
        startX = touch[0].clientX;
        startY = touch[0].clientY;
    });
    $(document).on('touchend', function (event) {
        var touch = event.changedTouches;
        endX = touch[0].clientX;
        endY = touch[0].clientY;
        if (Math.abs(startX - endX) > Math.abs(startY - endY)) {
            if (endX - startX > 50) {
                prevLink();
            }
            if (startX - endX > 50) {
                nextLink();
            }
        }
    });
})();
