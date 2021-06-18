$(document).ready(function(){

        $(window).scroll(function(){
            if($(this).scrollTop() > 40){
                $('#backTop').fadeIn();
            }else{
                $('#backTop').fadeOut();
            }
        });

        function sendEmail(){
            var name=$(".f-name");
            var email=$('.email');
            //var phone=$('.tel');

            $.ajax({
                url:"contact.php",
                method:"POST",
                dataType:"json",
                data:{
                    name:name.val(),
                    email:email.val(),
                },
                success:function(response){
                    $('#from-send')[0].reset();
                    $('.notification-send').text("message sent seccessfult");
                }

            })
        }

        $('#backTop').click(function(){
            $('html , body').animate({scrollTop:0},800);
            console.log('cc');
        });
    // filter_data();
    // function filter_data(){
    //     $('.rows').html('<div id="loading" style=""></div>');
    //     var id_c=$('#id_categ').val();
    //     var action='fetch_data.php';
    //     var minimun_price=$('#hidden_minimum_price').val();
    //     var maximun_price=$('#hidden_maximum_price').val();
        
    //     $.ajax({
    //         url:'fetch_data.php',
    //         method:'POST',
    //         data:{action:action,id_c:id_c,minimun_price:minimun_price,maximun_price:maximun_price},
    //         success:function(data){
    //             $('.rows').html(data);
    //         }
    //     });

    // };

    $('.slider-product').slick({
        slidesToShow: 5,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 2000,
        nextArrow: $('.btn-nex'),
        prevArrow: $('.btn-prev'),
        responsive: [
            {
                breakpoint: 1024,
                settings: {
                slidesToShow: 3,
                slidesToScroll: 3,
                infinite: true,
                dots: true
                }
            },
            {
                breakpoint: 600,
                settings: {
                slidesToShow: 2,
                slidesToScroll: 2
                }
            },
            {
                breakpoint: 480,
                settings: {
                slidesToShow: 2,
                slidesToScroll: 1
                }
            }
            ]
    });

    $('#price-range').slider({
        
        range:true,
        min:300,
        max:10000,
        values:[300,10000],
        step:100,
        stop:function(event,ui){
            $('#text-show-price').html(ui.values[0]+' - '+ui.values[1]);
            $('#hidden_minimum_price').val(ui.values[0]);
            $('#hidden_maximum_price').val(ui.values[1]);
            filter_data();
        }
    });

    /************delete product the card heard */
    $('.btn-delete').click(function(){
        var del_id=$(this).data('id');
        $.ajax({
            method:"POST",
            url:"delete-lv-pro.php",
            data:{del_id:del_id},
            datatype:"text",
            success:function(data){
                $('#content-model-prod'+del_id).hide("slow");
                
            }

        })
    })

    /************delete product the card shopp */
    $('.btn-delete-shop').click(function(){
        var del_id_shop=$(this).data('id');
        $.ajax({
            method:"POST",
            url:"delete-lv-pro.php",
            data:{del_id_shop:del_id_shop},
            datatype:"text",
            success:function(data){
                $('#content-model-prod-shop'+del_id_shop).hide("slow");
                
            }

        })
    })


    jQuery('<div class="quantity-nav"><div class="quantity-button quantity-up" >+</div><div class="quantity-button quantity-down" >-</div></div>').insertAfter('.quantity input');
    jQuery('.quantity').each(function() {
      var spinner = jQuery(this),
        input = spinner.find('input[type="number"]'),
        btnUp = spinner.find('.quantity-up'),
        btnDown = spinner.find('.quantity-down'),
        min = input.attr('min'),
        max = input.attr('max');

      btnUp.click(function() {
        var oldValue = parseFloat(input.val());
        if (oldValue >= max) {
          var newVal = oldValue;
        } else {
          var newVal = oldValue + 1;
        }
        spinner.find("input").val(newVal);
        spinner.find("input").trigger("change");
      });

      btnDown.click(function() {
        var oldValue = parseFloat(input.val());
        if (oldValue <= min) {
          var newVal = oldValue;
        } else {
          var newVal = oldValue - 1;
        }
        spinner.find("input").val(newVal);
        spinner.find("input").trigger("change");
      });

    });





        // var iprice=$('.iprice');
        // var QNT=$('.qnt');
        // var total=$('.itotal');
        // var res=0;
        // for(var i=0;i<QNT.length;i++){
        //     //res=QNT[i].val();
        //     alert(iprice.val());
        //     //total.text(res)=QNT
        // }
        // $(".iprice").each(function(){
        //     var iprice=$('.iprice').val();
        //     alert(iprice);
            
        // });
        // $(".qnt").each(function(){
        //     var qnt=$('.qnt').val();
        //     //alert(iprice);
        //     alert(qnt);
        // });
    




})

var gt=0
var iprice =document.getElementsByClassName("iprice");
var qnt =document.getElementsByClassName("qnt");
var itotal =document.getElementsByClassName("itotal")[0];
var Detail_qnt =document.getElementsByClassName("Detail-qnt");

var res=0;
function suTotal(){
    gt=0;
    for(var i=0;i<iprice.length;i++){
        Detail_qnt[i].value=qnt[i].value;
         res=(iprice[i].value * qnt[i].value);
        gt=gt+(iprice[i].value * qnt[i].value);
    }
    itotal.innerHTML=gt;
}

suTotal();
/***************************Tooltips*******************************/

var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
  return new bootstrap.Tooltip(tooltipTriggerEl)
})
