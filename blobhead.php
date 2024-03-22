<?php

/*
Plugin Name: Blobhead
Plugin URI: http://stefansjoberg.net
Description: Removes unnecessary bloat when calling for wp_head plus removes wp_admin_bar.
Version: 0.1.2
Author: Stefan Sjöberg
Author URI: http://stefansjoberg.net
*/ 

function blobhead_cleanup () {
  // Removes wordpress admin bar
  add_filter('show_admin_bar', '__return_false');
  // Removes the rel_link and previous post links
  remove_action('wp_head', 'adjacent_posts_rel_link_wp_head');
  // Remove rss feed links
  remove_action('wp_head', 'feed_links', 2);
  // Removes all extra rss feed links
  remove_action('wp_head', 'feed_links_extra', 3);
  // Removes emojis script
  remove_action('wp_head', 'print_emoji_detection_script', 7);
  // Removes the canonical link
  remove_action('wp_head', 'rel_canonical');
  // Removes the REST API link
  remove_action('wp_head', 'rest_output_link_wp_head', 10);
  // Removes really simple discovery link
  remove_action('wp_head', 'rsd_link');
  // Removes wlwmanifest.xml (needed to support windows live writer)
  remove_action('wp_head', 'wlwmanifest_link');
  // Removes WordPress version
  remove_action('wp_head', 'wp_generator');
  // Removes oEmbed discovery links
  remove_action('wp_head', 'wp_oembed_add_discovery_links');
  // Removes oEmbed-specific javascript from front-end / back-end
  remove_action('wp_head', 'wp_oembed_add_host_js');
  // Removes shortlink
  remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);
  // Removes emojis styles
  remove_action('wp_print_styles', 'print_emoji_styles');
  // Don't filter oEmbed results
  remove_filter('oembed_dataparse', 'wp_filter_oembed_result', 10);
  // Removes the oEmbed REST API route
  remove_action('rest_api_init', 'wp_oembed_register_route');
  // Removes the REST API link from HTTP Headers
  remove_action('template_redirect', 'rest_output_link_header', 11, 0);
}
add_action('after_setup_theme', 'blobhead_cleanup');

?>