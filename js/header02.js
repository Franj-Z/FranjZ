$("header").css({position:"absolute", top:"0", width: '100%', zIndex:'100000'});
var altoHeader=$('header').height();
$("body > :nth-child(2)").css('margin-top', altoHeader);
var freno=false;
var scrollPrevio=0;
var scrollActual=0;
var distancia=0;
var diferencia=0;
var eltop = $("header").position();
$(window).on("scroll", function(){
	scrollActual=$(document).scrollTop();
	if(scrollActual>scrollPrevio){
        if ($(document).scrollTop()>4*altoHeader){
            if(freno == false){
                $("header").css({position:"fixed", top:-altoHeader});
                freno=true;
            }
            eltop = $("header").position();
            diferencia=scrollActual-scrollPrevio;
            distancia=eltop.top+diferencia;
            if(distancia<0){
                $("header").css("top", distancia);
            }else{
                $("header").css("top", 0);
            }
        }
	}else{
        freno=false;
        if ($(document).scrollTop()<5*altoHeader){
            if($("header").css("position")=="fixed"){
                eltop = $("header").position();
                diferencia=scrollPrevio-scrollActual;
                distancia=eltop.top-diferencia;
                if(distancia>-altoHeader){
                    $("header").css("top", distancia);
                }else{
                    $("header").css({position:"absolute", top: 0});
                }
            }
        }
	}
	scrollPrevio=scrollActual;
});

