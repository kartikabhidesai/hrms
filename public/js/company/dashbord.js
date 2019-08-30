var Dashboard = function(){
    var handleList = function () {
        $('.slick_demo_3').slick({
                infinite: true,
                speed: 500,
                fade: true,
                cssEase: 'linear',
                adaptiveHeight: true
            });
    }
    return {
        init: function () {
            handleList();
        }
    }
}();