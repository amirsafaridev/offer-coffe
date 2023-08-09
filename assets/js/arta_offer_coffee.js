var percentage_coffee = [];
var data_product = [];

    $(document).ready(function () {
    var selected_items = [];
    $(".select_coffee_item").click(function () {
        var post_id = $(this).attr("post_id");
        if ($(".weight_range[post_id=" + post_id + "]").css("display") == "none") {
            $(this).css('box-shadow', 'rgb(210 170 119) 0px 0px 6px 2px');
            $(".weight_range[post_id=" + post_id + "]").show();
            $(".weight_range[post_id=" + post_id + "]").find("input[type='range']").val(0);
            $(".demo[post_id=" + post_id + "]").text(0);
            selected_items.push(post_id);
            $('#select_coffee_item_hidden').val([selected_items]);
        } else {
            selected_items.pop(post_id);
            percentage_coffee.pop(post_id);
            $('#select_coffee_item_hidden').val([selected_items]);
            $(this).css('box-shadow', '0px 4px 20px rgb(0 0 0 / 8%)');
            $(".weight_range[post_id=" + post_id + "]").hide();
            cal_total_price();
        }
    });

    $(".coffee_tool_selection_item").click(function () {

        $(".coffee_tool_selection_item").css("box-shadow", "none");
        $(this).css("box-shadow", "0px 0px 6px 2px rgb(210 170 119)");
        var tool_id = $(this).attr("post_id");
        data_product['tool'] = tool_id;
    });


    $(".coffee_weight_selection_item").click(function () {
        $('.coffee_pricing').show();
        $(".coffee_weight_selection_item .arta_offer_coffee_select_weight_box").css("box-shadow", "0px 3.82154px 19.1077px rgb(0 0 0 / 8%)");
        $(this).find("label").css("box-shadow", "0px 0px 0px 2px rgb(210 170 119)");
        var weight = $(this).attr("weight");
        var posts = $('#select_coffee_item_hidden').val();
        data_product['weight'] = weight;
        data_product['coffee'] = posts;
        $('#data_add_to_cart').val(data_product);
        cal_total_price();
    });

    $('#coffee_asiab').on("change", function () {
        var asiab = $(this).val();
        data_product['asiab'] = asiab;
    });

    $("#coffee_add_to_cart").click(function () {
        data_product['name'] = $('#coffee_naming').val();
        data_product['percentage_coffee'] = percentage_coffee;
        var price = $('#price_total_coffee').text();
        if (data_product !== "" && data_product != null) {
            $('#validation_coffee').text("");
            $('#validation_coffee').removeClass("text-danger");
            $.ajax({
                type: 'post',
                url: ajax_url.url,
                data: {
                    "action": 'coffee_add_to_cart',
                    'res_tool': data_product['tool'],
                    'res_coffee': data_product['coffee'],
                    'res_weight': data_product['weight'],
                    'res_asiab': data_product['asiab'],
                    'res_name': data_product['name'],
                    'res_percentage': data_product['percentage_coffee'],
                    'price': price,
                },
                beforeSend: function () {
                    $("#coffee_add_to_cart").prop('disabled', true);
                },
                success: function (data) {

                    data = JSON.parse(data);
                    if (data.status != false) {
                        location.href = data.url
                    } else {
                        $('#validation_coffee').text(data.message);
                        $('#validation_coffee').addClass("text-danger");
                    }
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    alert(xhr.status);
                    alert(thrownError);
                },
                complete: function () {
                    $("#coffee_add_to_cart").prop('disabled', false);
                }
            });
        } else {
            $('#validation_coffee').text("لطفا اطلاعات خرید خود را تکمیل کنید");
            $('#validation_coffee').addClass("text-danger");
        }
    });

});



function updateTextInput(val = 0, id) {
    $('#demo_' + id).text(val);
    percentage_coffee[id] = val;
    cal_total_price()
}

function cal_total_price() {
    var total = 0;
    var total_prec = 0;
    var weight = parseInt($("input[name='coffee_select_weight']:checked").val());
    percentage_coffee.forEach(function (value, key) {
        var price = $("#price_" + key).val();
        var prec = parseInt(value);
        total_prec += prec;
        total += prec * price;
    });
    total = (total * weight) / 100;
    $('#price_total_coffee').text(total);
    if (total_prec > 100) {
        $('.percentage_validation').text('مجموع درصد قهوه ها از 100 بیشتر است در این صورت سفارش شما لغو خواهد شد');
    }else {
        $('.percentage_validation').text('');
    }
}

