
$("#testA").on({
    'click': function () {
        alert("Zaraz zostaniesz przeniesiony na stronę Wikipedia o histori piłki nonżnej.");
    }
});


$("#testA").on({
    'mouseover': function () {
        $(this).stop().animate({ width: "68vw" }, 50);
        $(this).html("NIE NAJEŻDŻAJ TYLKO KLIKNIJ! Jesli chcesz zobaczyc historię");
    },

    'mouseout': function () {
        $(this).stop().animate({ width: "20vw" }, 100);
        $(this).html("Historia piłki nożnej.");

    }
});