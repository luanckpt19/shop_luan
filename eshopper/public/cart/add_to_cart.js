function addTocart(event){
    event.preventDefault();
    let urlCart= $(this).data('url');
    $.ajax({
        type:"GET",
        url:urlCart,
        dataType:'json',
        success:function (data){
            if (data.code === 200){
                alert('Thêm sản phẩm thành công');
            }
        },
        error:function (){

        }
    });
}
$(function (){
    $('.add-to-cart').on('click',addTocart)
})

//Action

function cartUpdate(event){
    event.preventDefault();
    let urlUpdateCart = $('.cart_update_times').data('url');
    let id = $(this).data('id');
    let quantity = $(this).parents('tr').find('input.quantity').val();
    $.ajax({
        type:"GET",
        url: urlUpdateCart,
        data: {id: id, quantity:quantity},
        success: function (data){
            if (data.code===200){
                $('.cart_wrapper').html(data.cart_component);
                location.reload();
            }
        },
        error: function (){

        }
    });
}

function cartDelete(event){
    event.preventDefault();
    let urlDeleteCart = $('.cart_delete_times').data('url');
    let id = $(this).data('id');
    $.ajax({
        type:"GET",
        url: urlDeleteCart,
        data: {id: id},
        success: function (data){
            if (data.code===200){
                $('.cart_wrapper').html(data.cart_component);
                location.reload();
            }
        },
        error: function (){

        }
    });
}

$(function (){
    $(document).on('click','.cart_update_times', cartUpdate);
    $(document).on('click','.cart_delete_times', cartDelete);
})



//quantity

$(document).ready(function() {
    $('.cart_quantity_down').click(function () {
        var $input = $(this).parent().find('input');
        var count = parseInt($input.val()) - 1;
        count = count < 1 ? 1 : count;
        $input.val(count);
        $input.change();
        return false;
    });
    $('.cart_quantity_up').click(function () {
        var $input = $(this).parent().find('input');
        $input.val(parseInt($input.val()) + 1);
        $input.change();
        return false;
    });
});
