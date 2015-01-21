<?php

/*

 */
// Register Custom Post Type
add_action('plugins_loaded', 'Branches_textdomin');

function Branches_textdomin()
{
    load_plugin_textdomain('branch_text_domain', false, dirname(plugin_basename(__FILE__)) . '/languages');
}

function branches_post_type()
{

    $labels = array(
        'name' => _x('branches', 'Post Type General Name', 'branch_text_domain'),
        'singular_name' => _x('branch', 'Post Type Singular Name', 'branch_text_domain'),
        'menu_name' => __('Branches', 'branch_text_domain'),
        'parent_item_colon' => __('Parent branch:', 'branch_text_domain'),
        'all_items' => __('All Branches', 'branch_text_domain'),
        'view_item' => __('View branch', 'branch_text_domain'),
        'add_new_item' => __('Add New branch', 'branch_text_domain'),
        'add_new' => __('Add New', 'branch_text_domain'),
        'edit_item' => __('Edit branch', 'branch_text_domain'),
        'update_item' => __('Update branch', 'branch_text_domain'),
        'search_items' => __('Search branch', 'branch_text_domain'),
        'not_found' => __('Not found', 'branch_text_domain'),
        'not_found_in_trash' => __('Not found in Trash', 'branch_text_domain'),
    );
    $args = array(
        'label' => __('branches', 'branch_text_domain'),
        'description' => __('Post Type Description', 'branch_text_domain'),
        'labels' => $labels,
        'supports' => array('title', 'thumbnail',),
        'taxonomies' => array(),
        'hierarchical' => true,
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'show_in_nav_menus' => true,
        'show_in_admin_bar' => true,
        'menu_position' => 5,
        'can_export' => true,
        'has_archive' => true,
        'exclude_from_search' => false,
        'publicly_queryable' => true,
        'capability_type' => 'page',
        'menu_icon' => 'dashicons-groups',
    );
    register_post_type('branches', $args);

}

// Hook into the 'init' action
add_action('init', 'branches_post_type', 0);

// Register Custom Taxonomy
function region_taxonomy()
{

    $labels = array(
        'name' => _x('Regions', 'Taxonomy General Name', 'branch_text_domain'),
        'singular_name' => _x('Region', 'Taxonomy Singular Name', 'branch_text_domain'),
        'menu_name' => __('Region', 'branch_text_domain'),
        'all_items' => __('All Regions', 'branch_text_domain'),
        'parent_item' => __('Parent Region', 'branch_text_domain'),
        'parent_item_colon' => __('Parent Region:', 'branch_text_domain'),
        'new_item_name' => __('New Region Name', 'branch_text_domain'),
        'add_new_item' => __('Add New Region', 'branch_text_domain'),
        'edit_item' => __('Edit Region', 'branch_text_domain'),
        'update_item' => __('Update Region', 'branch_text_domain'),
        'separate_items_with_commas' => __('Separate regions with commas', 'branch_text_domain'),
        'search_items' => __('Search regions', 'branch_text_domain'),
        'add_or_remove_items' => __('Add or remove regions', 'branch_text_domain'),
        'choose_from_most_used' => __('Choose from the most used regions', 'branch_text_domain'),
        'not_found' => __('Not Found', 'branch_text_domain'),
    );
    $args = array(
        'labels' => $labels,
        'hierarchical' => true,
        'public' => true,
        'show_ui' => true,
        'show_admin_column' => true,
        'show_in_nav_menus' => true,
        'show_tagcloud' => true,
    );
    register_taxonomy('region', array('branches'), $args);

}

// Hook into the 'init' action
add_action('init', 'region_taxonomy', 0);

//Ajax
function tpp_branches_out_return()
{
    $cat_id = isset($_POST['cat_id']) ? $_POST['cat_id'] : 0;
    if ($cat_id > 0) {
        $args = array(
            'post_type' => 'branches',
            'tax_query' => array(
                array(
                    'taxonomy' => 'region',
                    'field' => 'term_id',
                    'terms' => $cat_id
                )
            )
        );
        $the_query = new WP_Query($args);
        ?>
        <table class="table table-striped table-hover">
            <thead>
            <tr>
                <th>کد</th>
                <th>عاملیت</th>
                <th>مسئول</th>
                <th>آدرس</th>
                <th>تلفن</th>
                <th>فکس</th>
                <th>پست الکترونیک</th>
            </tr>
            </thead>
            <tbody>
            <?php
            // The Loop
            if ($the_query->have_posts()) {
                while ($the_query->have_posts()) {
                    $the_query->the_post();
                    ?>
                    <tr>
                        <td><?php the_field('code'); ?></td>
                        <td><?php the_title(); ?></td>
                        <td><?php the_field('agent'); ?></td>
                        <td><?php the_field('address'); ?></td>
                        <td><?php the_field('tel'); ?></td>
                        <td><?php the_field('fax'); ?></td>
                        <td class="latin"><?php the_field('email'); ?></td>
                    </tr>
                <?php
                }
            } else {
                // no posts found
            }
            wp_reset_postdata();
            ?>
            </tbody>
        </table>
    <?php
    }
    die();
}

add_action('wp_ajax_nopriv_getbranches', 'tpp_branches_out_return');
add_action('wp_ajax_getbranches', 'tpp_branches_out_return');

function tpp_branches_script()
{
    wp_enqueue_script("tbb_branches", path_join(WP_PLUGIN_URL, basename(dirname(__FILE__)) . "/branches.js"), array("jquery"));
}

add_action('wp_print_scripts', 'tpp_branches_script');
