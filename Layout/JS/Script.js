$(document).ready(function(){
    
        
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
                slidesToShow: 1,
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

})


/***************************Tooltips*******************************/

var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
  return new bootstrap.Tooltip(tooltipTriggerEl)
})
