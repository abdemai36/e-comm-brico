$(document).ready(function(){
	$('#toggle-nabvar').click(function(){
        $('.SidBar-respons').slideToggle('slow');
        $('.main').fadeToggle();

    });

    $('.navbar-respons .fa-search').click(function(){
        $('.main').hide();
        $('.navbar').fadeToggle();
        $('.search-respons').show();
        $('.SidBar-respons').hide();
    });

    $('.search-respons img').click(function(){
        $('.search-respons').hide();
        $('.main').show();
        $('.navbar').fadeToggle();
    })



    $('.multi-img-view').hover(function(){
        $Src= $(this).attr('src');

        $('.Big-img-view').attr('src',$Src);
    })

});


$('.SidBar ul li a').click(function(){
    $(this).addClass('active').parent().find('a').siblings().removeClass('active');
});

$(window).resize(function(){
    var width=$(window).width();
    if(width>=767){
        $('.SidBar-respons').hide();
        $('.main').show();
        $('.navbar').show();
        $('.search-respons').hide();
    }
});



/*****JS********/



// document.querySelector('#imgContainer').addEventListener('mouseover',function(){
//     imgeZoom('zoomImg');
// });


// // $('#img-container').mouseover(function(){
// //     $('#zoomImg').css('display','none');
// // })

// function imgeZoom(imgID){
//     let img =document.getElementById(imgID);
//     let lens =document.getElementById('lens');

//     lens.style.backgroundImage=`url(${img.src})`;
//     let retio=3;
//     lens.style.backgroundSize=(img.width * retio)+ 'px '+(img.height * retio)+ 'px';

//     img.addEventListener('mousemove',moveLens);
//     lens.addEventListener('mousemove',moveLens);
//     img.addEventListener('touchmove',moveLens);

//     function moveLens(){
//         let position=getCursor();
//         //console.log("position :",position)

//         let positionLeft=position.x-(lens.offsetWidth/2);
//         let positionTop=position.y-(lens.offsetHeight/2);

//         if(positionLeft<0){
//             positionLeft=0;
//         }
//         if(positionTop<0){
//             positionTop=0;
//         }

//         if(positionLeft>img.width - lens.offsetWidth/3){
//             positionLeft=img.width - lens.offsetWidth/3;
//         }
//         if(positionTop>img.height - lens.offsetHeight/3){
//             positionTop=img.height - lens.offsetHeight/3;
//         }

//         lens.style.left=positionLeft+"px";
//         lens.style.top=positionTop+"px";

//         lens.style.backgroundPosition= "-"+(position.x * retio)+'px -' +(position.y * retio)+'px ';


//     }



//     function getCursor(){
//         let e=window.event;
//         let bounds=img.getBoundingClientRect();
//         // console.log('e :',e);
//         // console.log('Bounds :',bounds);

//         let x=e.pageX - bounds.left;
//         let y=e.pageY - bounds.top;

//         x=x-window.pageXOffset;
//         y=y-window.pageYOffset;
//         return {'x':x,'y':y};

//     }


// }
// imgeZoom('zoomImg');



