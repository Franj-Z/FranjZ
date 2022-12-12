$("header").css({position:"absolute", top:"0", width: '100%', zIndex:'100000'});
var altoHeader=$('header').height();
$("body > :nth-child(2)").css('margin-top', altoHeader);
var freno=false;
var scrollPrevio=0;
var scrollActual=0;
var distancia=0;
var diferencia=0;
var eltop=$("header").position();
$(window).on("scroll", function(){
	scrollActual=$(document).scrollTop();
	if(scrollActual>scrollPrevio){
        if($("header").css("position")=="fixed"){
            eltop = $("header").position();
            diferencia=scrollActual-scrollPrevio;
            distancia=eltop.top-diferencia;
            if(distancia>-altoHeader){
                $("header").css("top", distancia);
            }else{
                $("header").css("top", -altoHeader);
            }
        }else{
            if(freno==false){
                $("header").css( {position:"absolute", top:"0"} );
                freno=true;
            }
        }
	}else{
        if(freno){
            freno=false;
            $("header").css({position:"fixed", top: -altoHeader});
        }
        if ($(document).scrollTop()>4*altoHeader){
            eltop=$("header").position();
            diferencia=scrollPrevio-scrollActual;
            distancia=eltop.top+diferencia;
            if(distancia<0){
                $("header").css("top", distancia);
            }else{
                $("header").css("top", 0);
            }
        }else{
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

