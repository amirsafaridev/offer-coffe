<?php

add_shortcode('offer_coffee', 'arta_offer_coffee_function');

function arta_offer_coffee_function()
{
    $args = array(
        "post_type" => "product",
        "posts_per_page" => -1,
        'meta_query' => array(
            array(
                'key' => 'select_product_to_show',
                'value' => "selected",
            ),
        )
    );
    $posts = get_posts($args);

    $tool_args = array(
        "post_type" => "arta_brew_tool",
        "posts_per_page" => -1,
    );
    $tools = get_posts($tool_args);
    ?>
    <div class="container">
        <div class="arta_offer_coffee_main">
            <div class="arta_coffee_step">
                <div class="offer_coffee_svg_title">
                    <svg width="24" height="49" viewBox="0 0 24 49" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M23.3864 49H9.51364V10.7227H0.413636V8.34465e-07H23.3864V49Z" fill="#D2AA77"/>
                    </svg>
                    <svg width="3" height="46" viewBox="0 0 3 46" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <line x1="1.5" y1="6.55671e-08" x2="1.5" y2="46" stroke="#D2AA77" stroke-opacity="0.31"
                              stroke-width="3"/>
                    </svg>
                </div>
                <div class="offer_coffee_title">
                    <div class="arta_offer_coffee_stages_number">
                        مرحله اول
                    </div>
                    <div class="arta_offer_coffee_stages_title">
                        انتخاب قهوه
                    </div>
                </div>
            </div>
            <p class="arta_offer_coffee_stages_description"><?php echo get_option("description_lvl1", ""); ?> </p>
            <div class="arta_offer_coffee_flex_container_coffee_select">
                <?php
                foreach ($posts as $post) {
                    $product = wc_get_product($post->ID);
                    $price = $product->get_price();
                    $att_id = get_post_thumbnail_id($post->ID);
                    $attachment = wp_get_attachment_url($att_id);
                    ?>
                    <div class="select_coffee_item" post_id="<?php echo $post->ID ?>">
                        <img class="arta_offer_coffee_flex_container_coffee_select_img"
                             src="<?php echo $attachment ?>">
                        <p class="arta_offer_coffee_flex_container_coffee_select_title">
                            <?php echo $post->post_title ?>
                        </p>
                        <p class="arta_offer_coffee_flex_container_coffee_select_description">
                            <?php echo $post->post_content ?>
                        </p>
                        <p class="arta_offer_coffee_flex_container_coffee_select_price">
                            قیمت / کیلوگرم: <?php echo $price ?> تومان
                        </p>
                        <input type="hidden" id="<?php echo 'price_' . $post->ID ?>" value="<?php echo $price ?>">
                    </div>
                    <?php
                }
                ?>
                <input type="hidden" id="select_coffee_item_hidden" value="">
            </div>
            <div>
                <div class="arta_coffee_step">
                    <div class="offer_coffee_svg_title">
                        <svg width="42" height="50" viewBox="0 0 42 50" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M41.25 50H3.1V41.3136L21.4273 24.1636C22.7212 22.9545 23.6864 21.8833 24.3227 20.95C24.9803 20.0167 25.4045 19.1682 25.5955 18.4045C25.8076 17.6409 25.9136 16.9303 25.9136 16.2727C25.9136 14.6818 25.3833 13.4409 24.3227 12.55C23.2833 11.6591 21.7136 11.2136 19.6136 11.2136C17.8318 11.2136 16.1773 11.6167 14.65 12.4227C13.1227 13.2076 11.8606 14.3955 10.8636 15.9864L0.586364 10.2273C2.45303 7.10909 5.09394 4.62727 8.50909 2.78182C11.9242 0.936362 16.05 0.013634 20.8864 0.013634C24.6409 0.013634 27.95 0.628786 30.8136 1.85909C33.6773 3.06818 35.9045 4.79697 37.4955 7.04545C39.1076 9.27273 39.9136 11.903 39.9136 14.9364C39.9136 16.5273 39.7015 18.1076 39.2773 19.6773C38.8742 21.2258 38.0682 22.8803 36.8591 24.6409C35.65 26.4015 33.8894 28.3424 31.5773 30.4636L22.35 39.0227H41.25V50Z"
                                  fill="#D2AA77"/>
                        </svg>
                        <svg width="3" height="46" viewBox="0 0 3 46" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <line x1="1.5" y1="6.55671e-08" x2="1.5" y2="46" stroke="#D2AA77" stroke-opacity="0.31"
                                  stroke-width="3"/>
                        </svg>
                    </div>
                    <div class="offer_coffee_title">
                        <div class="arta_offer_coffee_stages_number">
                            مرحله دوم
                        </div>
                        <div class="arta_offer_coffee_stages_title">
                            ترکیب قهوه ات رو بساز
                        </div>
                    </div>
                </div>

                <p class="arta_offer_coffee_stages_description"><?php echo get_option("description_lvl2", ""); ?></p>
                <?php
                foreach ($posts as $post) {
                    $att_id = get_post_thumbnail_id($post->ID);
                    $attachment = wp_get_attachment_url($att_id);
                    ?>
                    <div style="display: none" class="weight_range" post_id="<?php echo $post->ID ?>">
                        <img class="arta_offer_coffee_select_combination_img"
                             src="<?php echo $attachment ?>">
                        <p class="arta_offer_coffee_select_combination_title"><?php echo $post->post_title ?></p>
                        <div style="display: flex;align-items: center" class="slidecontainer">
                            <input onchange="updateTextInput(this.value,<?php echo $post->ID ?>)" type="range" min="0"
                                   max="100" value="0" step="10" class="slider myRange"
                                   id="myRange_<?php echo $post->ID ?>" post_id="<?php echo $post->ID ?>">
                            <div style="margin-right: 10px"><span style="font-weight: 600" class="demo"
                                                                  post_id="<?php echo $post->ID ?>"
                                                                  id="demo_<?php echo $post->ID ?>">0</span><span
                                        style="font-weight: 600">%</span></div>
                        </div>
                    </div>
                    <?php
                }
                ?>
                <input type="hidden" id="percentage_coffee" value=''>
                <input type="hidden" id="data_add_to_cart" value=''>
                <input type="hidden" id="data_add_to_cart_result" value=''>
                <div class="percentage_validation text-danger" style="font-weight: 600;font-family: iranYekanWeb"></div>
                <div>
                    <div class="arta_coffee_step">
                        <div class="offer_coffee_svg_title">
                            <svg width="42" height="50" viewBox="0 0 42 50" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path d="M19.7727 49.9864C16.3788 49.9864 12.9955 49.5727 9.62273 48.7455C6.27121 47.9182 3.30152 46.7197 0.713636 45.15L5.77273 34.7136C7.76667 36.05 9.95151 37.0682 12.3273 37.7682C14.703 38.447 17.0364 38.7864 19.3273 38.7864C21.6818 38.7864 23.5697 38.3515 24.9909 37.4818C26.4121 36.5909 27.1227 35.3182 27.1227 33.6636C27.1227 30.503 24.6197 28.9227 19.6136 28.9227H13.8227V20.1727C16.7288 17.0121 19.6455 13.8621 22.5727 10.7227H3.22727V8.34465e-07H38.6727V8.68636L28.5227 19.6C32.6591 20.5121 35.7879 22.2091 37.9091 24.6909C40.0515 27.1727 41.1227 30.1636 41.1227 33.6636C41.1227 35.7424 40.6985 37.7576 39.85 39.7091C39.0015 41.6606 37.7076 43.4106 35.9682 44.9591C34.2288 46.4864 32.0121 47.7061 29.3182 48.6182C26.6455 49.5303 23.4636 49.9864 19.7727 49.9864Z"
                                      fill="#D2AA77"/>
                            </svg>
                            <svg width="3" height="46" viewBox="0 0 3 46" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <line x1="1.5" y1="6.55671e-08" x2="1.5" y2="46" stroke="#D2AA77" stroke-opacity="0.31"
                                      stroke-width="3"/>
                            </svg>
                        </div>
                        <div class="offer_coffee_title">
                            <div class="arta_offer_coffee_stages_number">
                                مرحله سوم
                            </div>
                            <div class="arta_offer_coffee_stages_title">
                                با چی می خوای قهوه ت رو آماده کنی؟
                            </div>
                        </div>
                    </div>
                    <p class="arta_offer_coffee_stages_description"><?php echo get_option("description_lvl3", ""); ?> </p>
                    <div class="row">
                        <?php foreach ($tools as $tool) { ?>
                            <?php
                            $att_tool = get_post_thumbnail_id($tool->ID);
                            $attachment_tool = wp_get_attachment_url($att_tool);
                            ?>
                            <div class="col-12 col-sm-12 col-md-6 col-lg-4 col-xl-4 ">
                                <div class="arta_offer_coffee_flex_container_coffee_brew_tool_select">

                                    <div class="coffee_tool_selection_item" post_id="<?php echo $tool->ID ?>">
                                        <img class="arta_offer_coffee_flex_container_coffee_brew_tool_select_img"
                                             src="<?php echo $attachment_tool ?>">
                                        <div class="tool_content_info">
                                            <p class="arta_offer_coffee_flex_container_coffee_brew_tool_select_title"><?php echo $tool->post_title ?></p>
                                            <p class="arta_offer_coffee_flex_container_coffee_brew_tool_select_description"><?php echo $tool->post_content ?></p>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>

                <div>
                    <div class="arta_coffee_step">
                        <div class="offer_coffee_svg_title">
                            <svg width="48" height="49" viewBox="0 0 48 49" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path d="M40.3 49H26.7773V39.6136H0.877273V30.5773L22.8636 8.34465e-07H37.2136L17.2636 28.6364H27.2227V20.3H40.3V28.6364H47.5864V39.6136H40.3V49Z"
                                      fill="#D2AA77"/>
                            </svg>
                            <svg width="3" height="46" viewBox="0 0 3 46" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <line x1="1.5" y1="6.55671e-08" x2="1.5" y2="46" stroke="#D2AA77" stroke-opacity="0.31"
                                      stroke-width="3"/>
                            </svg>
                        </div>
                        <div class="offer_coffee_title">
                            <div class="arta_offer_coffee_stages_number">
                                مرحله چهارم
                            </div>
                            <div class="arta_offer_coffee_stages_title">
                                وزن بسته بندی را انتخاب کنید.
                            </div>
                        </div>
                    </div>


                    <p class="arta_offer_coffee_stages_description"><?php echo get_option("description_lvl4", ""); ?></p>

                    <div class="coffee_weight_selection">
                        <div class="coffee_weight_selection_img"></div>
                        <?php
                        $weights = get_option('arta_offer_coffee_weights', "");
                        $weights = explode(",", $weights);
                        foreach ($weights as $key => $weight) { ?>
                            <div class="coffee_weight_selection_item" weight="<?php echo $weight ?>">
                                <label class="arta_offer_coffee_select_weight_box"
                                       for="arta_offer_coffee_select_weight_radio_<?php echo $weight ?>"><?php echo $weight . " گرم" ?></label>
                                <input style="display: none;" type="radio"
                                       id="arta_offer_coffee_select_weight_radio_<?php echo $weight ?>"
                                       class="coffee_select_weight" name="coffee_select_weight"
                                       value="<?php echo $weight ?>">
                            </div>
                        <?php } ?>
                    </div>
                </div>
                <div>
                    <div class="arta_coffee_step">
                        <div class="offer_coffee_svg_title">
                            <svg width="41" height="50" viewBox="0 0 41 50" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path d="M19.5364 49.9864C16.1424 49.9864 12.7591 49.5727 9.38636 48.7455C6.03485 47.9182 3.09697 46.7197 0.572727 45.15L5.53636 34.7136C7.55152 36.05 9.72576 37.0682 12.0591 37.7682C14.4136 38.447 16.7682 38.7864 19.1227 38.7864C21.4561 38.7864 23.3439 38.3409 24.7864 37.45C26.2288 36.5379 26.95 35.2545 26.95 33.6C26.95 32.603 26.6742 31.7333 26.1227 30.9909C25.5712 30.2273 24.6061 29.6439 23.2273 29.2409C21.8697 28.8379 19.9394 28.6364 17.4364 28.6364H4.13636L6.58636 8.34465e-07H37.8V10.7227H18.0727L17.4364 17.85H20.7136C25.55 17.85 29.4424 18.5288 32.3909 19.8864C35.3606 21.2439 37.5136 23.0894 38.85 25.4227C40.2076 27.7561 40.8864 30.3652 40.8864 33.25C40.8864 35.4348 40.4621 37.5348 39.6136 39.55C38.7652 41.5439 37.4712 43.3258 35.7318 44.8955C33.9924 46.4652 31.7758 47.7061 29.0818 48.6182C26.4091 49.5303 23.2273 49.9864 19.5364 49.9864Z"
                                      fill="#D2AA77"/>
                            </svg>
                            <svg width="3" height="46" viewBox="0 0 3 46" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <line x1="1.5" y1="6.55671e-08" x2="1.5" y2="46" stroke="#D2AA77" stroke-opacity="0.31"
                                      stroke-width="3"/>
                            </svg>
                        </div>
                        <div class="offer_coffee_title">
                            <div class="arta_offer_coffee_stages_number">
                                مرحله پنجم
                            </div>
                            <div class="arta_offer_coffee_stages_title">
                                نامگذاری و آسیاب و تعداد
                            </div>
                        </div>
                    </div>

                    <p class="arta_offer_coffee_stages_description"><?php echo get_option("description_lvl5", ""); ?> </p>
                    <div class="arta_coffee_extras">
                        <div class="arta_coffee_extras_selection">
                            <div class="arta_offer_coffee_extras_img"></div>
                            <div class="row" style="width: 100%">
                                <div class="col-12 col-sm-12 col-md-6 col-lg-6 ">
                                    <div class="coffee_asiab">
                                        <label for="coffee_asiab">دوست داری آسیاب کنیم قهوه ات رو؟
                                        </label>
                                        <select name="coffee_asiab" id="coffee_asiab">
                                            <option disabled selected>انتخاب کنید</option>
                                            <option value="asiab_kon">بله</option>
                                            <option value="asiab_nakon">خیر</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-12 col-md-6 col-lg-6 ">
                                    <div class="coffee_naming">
                                        <label for="coffee_naming">درنهایت میتونید یک اسم برای قهوه خودتون
                                            بگذارید</label>
                                        <input type="text" name="coffee_naming" id="coffee_naming"
                                               placeholder="اسم مورد نظر خود را بنویسید ...">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="coffee_pricing" style="display:none">
                <div class="coffee_price_title">
                    <sapn id="price_total_coffee">0</sapn>
                    تومان
                </div>
                <div class="coffee_add_to_cart">
                    <button type="button" id="coffee_add_to_cart">افزودن به سبد خرید</button>
                </div>
                <div id="validation_coffee"></div>
            </div>
        </div>
        <div class="cart_container"></div>
    </div>
    </div>
    <?php
}
