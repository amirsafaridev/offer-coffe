<?php

// add custop post type for brewing tools

add_action('init', 'cptui_register_my_cpts_arta_brew_tool');

function cptui_register_my_cpts_arta_brew_tool()
{

    /**
     * Post Type: arta_brew_tools.
     */

    $labels = [
        "name" => esc_html__("arta_brew_tools", "twentytwentytwo"),
        "singular_name" => esc_html__("arta_brew_tool", "twentytwentytwo"),
        "menu_name" => esc_html__("وسایل قهوه", "twentytwentytwo"),
        "all_items" => esc_html__("همه وسایل", "twentytwentytwo"),
        "add_new" => esc_html__("افزودن جدید", "twentytwentytwo"),
        "add_new_item" => esc_html__("افزودن وسیله جدید", "twentytwentytwo"),
        "edit_item" => esc_html__("ویرایش وسیله", "twentytwentytwo"),
    ];

    $args = [
        "label" => esc_html__("arta_brew_tools", "twentytwentytwo"),
        "labels" => $labels,
        "description" => "وسیایل قهوه",
        "public" => true,
        "publicly_queryable" => true,
        "show_ui" => true,
        "show_in_rest" => true,
        "rest_base" => "",
        "rest_controller_class" => "WP_REST_Posts_Controller",
        "rest_namespace" => "wp/v2",
        "has_archive" => false,
        "show_in_menu" => true,
        "show_in_nav_menus" => true,
        "delete_with_user" => false,
        "exclude_from_search" => false,
        "capability_type" => "post",
        "map_meta_cap" => true,
        "hierarchical" => false,
        "can_export" => false,
        "rewrite" => ["slug" => "arta_brew_tool", "with_front" => true],
        "query_var" => true,
        "supports" => ["title", "editor", "thumbnail"],
        "show_in_graphql" => false,
        'menu_icon' => 'dashicons-coffee'
    ];

    register_post_type("arta_brew_tool", $args);
}

// register admin dashboard menu for plugin settings
add_action('admin_menu', 'arta_register_offer_coffee_setting_menu');

function arta_register_offer_coffee_setting_menu()
{
    add_menu_page(
        'افزونه آفر کافی',
        'تنظیمات آفر کافی',
        'edit_posts',
        'arta-offer-coffee',
        'arta_offer_coffee_setting_menu',
        'dashicons-menu',
        26
    );
}

// admin dashboard menu form
function arta_offer_coffee_setting_menu()
{
    if (isset($_POST['arta_offer_coffee_settings_submit'])) {
        update_option('arta_offer_coffee_weights', $_POST['arta_offer_coffee_weights']);
        update_option('description_lvl1', $_POST['description_lvl1']);
        update_option('description_lvl2', $_POST['description_lvl2']);
        update_option('description_lvl3', $_POST['description_lvl3']);
        update_option('description_lvl4', $_POST['description_lvl4']);
        update_option('description_lvl5', $_POST['description_lvl5']);
    }
    ?>
    <table class="form-table" role="presentation">
        <form action="" method="post">
            <tbody>
                <tr>
                <th>
                    <label for="arta_offer_coffee_weights">شرتکد</label>
                </th>
                <td>
                    [offer_coffee]
                </td>
            </tr
            <tr>
                <th>
                    <label for="arta_offer_coffee_weights">وزن های نمایش داده شده در صفحه اصلی (وزن مورد نظر را به گرم
                        نوشته و بدون فاصله با کاما از هم جداسازی کنید )</label>
                </th>
                <td>
                    <input type="text" name="arta_offer_coffee_weights" id="arta_offer_coffee_weights"
                           placeholder="مانند: 50,100,250,500"
                           value="<?php echo get_option('arta_offer_coffee_weights') ? get_option('arta_offer_coffee_weights') : '' ?>"
                           class="regular-text">
                </td>
            </tr>
            <tr>
                <th>
                    <label style="display: inline-block" for="description_lvl1">متن عنوان مرحله اول</label>
                    <textarea style="display: inline-block" name="description_lvl1"
                              id="description_lvl1"><?php echo get_option("description_lvl1", "") ?></textarea>
                </th>
            </tr>
            <tr>
                <th>
                    <label style="display: inline-block" for="description_lvl2">متن عنوان مرحله دوم</label>
                    <textarea style="display: inline-block" name="description_lvl2"
                              id="description_lvl2"><?php echo get_option("description_lvl2", "") ?></textarea>
                </th>
            </tr>
            <tr>
                <th>
                    <label style="display: inline-block" for="description_lvl3">متن عنوان مرحله سوم</label>
                    <textarea style="display: inline-block" name="description_lvl3"
                              id="description_lvl3"><?php echo get_option("description_lvl3", "") ?></textarea>
                </th>
            </tr>
            <tr>
                <th>
                    <label style="display: inline-block" for="description_lvl4">متن عنوان مرحله چهارم</label>
                    <textarea style="display: inline-block" name="description_lvl4"
                              id="description_lvl4"><?php echo get_option("description_lvl4", "") ?></textarea>
                </th>
            </tr>
            <tr>
                <th>
                    <label style="display: inline-block" for="description_lvl5">متن عنوان مرحله پنجم</label>
                    <textarea style="display: inline-block" name="description_lvl5"
                              id="description_lvl5"><?php echo get_option("description_lvl5", "") ?></textarea>
                </th>
            </tr>
            <tr>
                <td>
                    <input type="submit" name="arta_offer_coffee_settings_submit" id="arta_offer_coffee_settings_submit"
                           class="button button-primary" value="ذخیره">
                </td>
            </tr>
            </tbody>
        </form>
    </table>
    <?php
}


//////// * Register Meta Box
add_action('add_meta_boxes', function () {
//    meta box for show product in shortcode offer_coffee
    add_meta_box('arta_coffe_product', 'نمایش در شرتکد', 'arta_coffe_product_callback', 'product', 'side');
});
function arta_coffe_product_callback($post)
{
    $post_id = $post->ID;
    $select = get_post_meta($post_id, 'select_product_to_show', true);
    ?>
    <input type='checkbox' name='select_product_to_show'
           id='select_product_to_show' <?php if ($select == "selected") echo "checked" ?>>
    <label for='select_product_to_show'>انتخاب محصول برای نمایش</label>
    <?php
}

add_action('save_post', function ($post_id) {

    if (isset($_POST['select_product_to_show'])) {
        update_post_meta($post_id, 'select_product_to_show', "selected");
    } else {
        update_post_meta($post_id, 'select_product_to_show', "");
    }
});

/////// ajax callback for add to cart ////////
add_action('wp_ajax_coffee_add_to_cart', 'coffee_add_to_cart');
add_action('wp_ajax_nopriv_coffee_add_to_cart', 'coffee_add_to_cart');
function coffee_add_to_cart()
{
    $tool = $_POST['res_tool'];
    $coffee = $_POST['res_coffee'];
    $weight = $_POST['res_weight'];
    $asiab = $_POST['res_asiab'];
    $name = $_POST['res_name'];
    $percentage_coffee = $_POST['res_percentage'];
    $price = $_POST['price'];

    if (!empty($coffee) && !empty($tool) && !empty($weight) && !empty($asiab) && !empty($percentage_coffee) && !empty($name)) {
        if ($asiab == 'asiab_kon') {
            $asiab = 'آسیاب شده';
        } else {
            $asiab = 'آسیاب نشده';
        }
        $too_name = get_post(intval($tool));
        
        $objProduct = new WC_Product_Simple();
        $objProduct->set_name($name); //Set product name.
        $objProduct->set_status('coffee'); //Set product status.
        $objProduct->set_catalog_visibility('hidden'); //Set catalog visibility.                   | string $visibility Options: 'hidden', 'visible', 'search' and 'catalog'.
        $objProduct->set_price($price); //Set the product's active price.
        $objProduct->set_regular_price($price); //Set the product's regular price.
        $objProduct->set_price($price); //Set the product's sale price.
        $objProduct->set_reviews_allowed(true); //Set if reviews is allowed.                        | bool
        $objProduct->set_weight($weight);
        $new_product_id = $objProduct->save(); //Saving the data to create new product, it will return product ID.

        update_post_meta($new_product_id, 'coffee_tool', $too_name->post_title);
        update_post_meta($new_product_id, 'coffee_asiab', $asiab);
        update_post_meta($new_product_id, 'percentage_coffee', $percentage_coffee);

        global $woocommerce;
        $woocommerce->cart->add_to_cart($new_product_id, 1);
        $cart_url = wc_get_cart_url();
        $status = array(
            'status' => true,
            'url' => $cart_url
        );

    } else {
        $status = array(
            'status' => false,
            'message' => 'لطفا تمامی موارد را وراد کنید'
        );
    }
    echo json_encode($status);
    exit();
}

/////// purchasable product
add_filter('woocommerce_is_purchasable', 'make_coffee_product_purchasable', 10, 2);
function make_coffee_product_purchasable($is_purchasable, $product)
{

    if (get_post_status($product->get_id()) == 'coffee')
        $is_purchasable = true;
    return $is_purchasable;

}

/////// add custom status for product
function wpdocs_custom_post_status()
{
    register_post_status('coffee', array(
        'label' => _x('coffee', 'post'),
        'public' => true,
        'exclude_from_search' => false,
        'show_in_admin_all_list' => false,
        'show_in_admin_status_list' => true,
        'label_count' => _n_noop('coffee <span class="count">(%s)</span>', 'coffee <span class="count">(%s)</span>'),
    ));


}

add_action('init', 'wpdocs_custom_post_status');

/////// add custom extra data for cart item
add_filter('woocommerce_add_cart_item_data', 'add_extra_data_to_cart_item', 10, 3);
function add_extra_data_to_cart_item($cart_item_data, $product_id)
{
    $coffee_tool = get_post_meta($product_id, 'coffee_tool', true) != null ? get_post_meta($product_id, 'coffee_tool', true) : '';
    $coffee_asiab = get_post_meta($product_id, 'coffee_asiab', true) != null ? get_post_meta($product_id, 'coffee_asiab', true) : '';
    $percentage_coffee = get_post_meta($product_id, 'percentage_coffee', true) != null ? get_post_meta($product_id, 'percentage_coffee', true) : '';

    if (!empty($coffee_tool)) {
        $cart_item_data['coffee_tool'] = $coffee_tool;
    }
    if (!empty($coffee_asiab)) {
        $cart_item_data['coffee_asiab'] = $coffee_asiab;
    }

    if (!empty($percentage_coffee)) {
        $cart_item_data['percentage_coffee'] = $percentage_coffee;
    }

    return $cart_item_data;
}

////// display extra data for cart item
add_filter('woocommerce_get_item_data', 'display_cart_item_extra_data', 10, 2);
function display_cart_item_extra_data($item_data, $cart_item)
{   
        if (isset($cart_item['coffee_tool'])) {
	    foreach($cart_item['percentage_coffee'] as $key=>$value){
	        if($value != 0){
	           $post = get_post($key);
	                   $item_data[] =
	            array(
	                'key' => __($post->post_title, 'coffee_tool'),
	                'value' => wc_clean('<br><br>' . $value . ' %<br>'),
	                'display' => $coffee_tool
	            );
	        }
	    }
	}
    
    if (isset($cart_item['coffee_tool'])) {
        $coffee_tool = $cart_item['coffee_tool'];

        $item_data[] =
            array(
                'key' => __('دستگاه تهیه قهوه', 'coffee_tool'),
                'value' => wc_clean('<br><br>' . $coffee_tool . '<br>'),
                'display' => $coffee_tool
            );
    }

    if (isset($cart_item['coffee_asiab'])) {
        $coffee_asiab = $cart_item['coffee_asiab'];
        $item_data[] =
            array(
                'key' => __('اسیاب', 'coffee_asiab'),
                'value' => wc_clean($coffee_asiab),
                'display' => $coffee_asiab
            );
    }
    return $item_data;
}

////// admin order header add fields
add_action('woocommerce_admin_order_item_headers', 'arta_admin_order_items_headers');
function arta_admin_order_items_headers()
{
    ?>
    <th class="line_customtitle sortable" data-sort="your-sort-option">
        دستگاه تهیه قهوه
    </th>
    <th class="line_customtitle sortable" data-sort="your-sort-option">
        اسیاب
    </th>
    <?php
}

////// value order header fields
add_action('woocommerce_admin_order_item_values', 'arta_admin_order_item_values');
function arta_admin_order_item_values($product)
{
    $id = $product->id;
    $coffee_tool = get_post_meta($id, 'coffee_tool', true) != null ? get_post_meta($id, 'coffee_tool', true) : '-';
    $coffee_asiab = get_post_meta($id, 'coffee_asiab', true) != null ? get_post_meta($id, 'coffee_asiab', true) : '-';
    ?>
    <td class="line_customtitle">
        <?php echo $coffee_tool ?>
    </td>
    <td class="line_customtitle">
        <?php echo $coffee_asiab ?>
    </td>
    <?php
}