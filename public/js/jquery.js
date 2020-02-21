$(document).ready(function () {
    clockUpdate();
    setInterval(clockUpdate, 1000);

    $('#createForm').hide();

    $('#createBtn').click(function (e) {
        $('#createForm').show();
        $('#createBtn').hide();
    });

    $('#createClose').click(function (e) {
        $('#createBtn').show();
        $('#createForm').hide();
    });

    function clockUpdate() {
        var date = new Date();
        $('.digital-clock').css({'color': '#000', 'text-shadow': '0 0 1px #000'});
        function addZero(x) {
            if (x < 10) {
                return x = '0' + x;
            } else {
                return x;
            }
        }

        function twelveHour(x) {
            if (x > 12) {
                return x = x - 12;
            } else if (x == 0) {
                return x = 12;
            } else {
                return x;
            }
        }

        var h = addZero(twelveHour(date.getHours()));
        var m = addZero(date.getMinutes());
        var s = addZero(date.getSeconds());

        $('.digital-clock').text(h + ':' + m + ':' + s)
    }
});

