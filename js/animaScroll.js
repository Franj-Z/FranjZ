$('a[data-ancla="true"]').on('click', function (evento) {
    evento.preventDefault();
    var freno = $(this).attr('data-freno');
    var tiempo = $(this).attr('data-tiempo');
    var seccionApuntada = $(this.hash);
    if ($('.navbar-toggler').css('display') != 'none') {
        $(".navbar-collapse").collapse("hide");
        $('.navbar-collapse').on('hidden.bs.collapse', function () {
            anima();
        });
    } else {
        anima();
    }
    function anima() {       
        if (freno == undefined) {
            freno = parseInt(0);
        } else {
            freno = parseInt(freno);
        }  
        if (tiempo == undefined) {
            tiempo = parseInt(2000);
        } else {
            tiempo = parseInt(tiempo);
        };      
        if (seccionApuntada.length != 0) {
            var distancia = seccionApuntada.offset().top - freno;
            $('html,body').animate({
                scrollTop: distancia
            }, tiempo);
        }
        freno = tiempo = seccionApuntada = "";
    }
});
