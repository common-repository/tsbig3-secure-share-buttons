<?php
/**
 * Plugin Name: TsBig3 Secure Share-Buttons
 * Description: Include secure share-buttons from the three biggest social-media-platforms: facebook, twitter and google+
 * Version: 1.0.2
 * Author: Nick Böcker
 * Author URI: http://blog.theskyliner.de/develop
 * License: GPL2
 *
 * Copyright 2014  NICK BÖCKER  (email : write-to-me@theskyliner.de)
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License, version 2, as 
 * published by the Free Software Foundation.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 */
defined('ABSPATH') or die("No script kiddies please!");

if (!class_exists('BigThreeSocialPrivacy')) {
    class BigThreeSocialPrivacy
    {
        protected $pluginDomain = 'ts_bigthree_social_privacy';

        /**
         * Will be executed when an object with type BigThreeSocialPrivacy is created.
         */ 
        public function __construct()
        {
            /**
             * Enable language files under /languages/
             */
            load_plugin_textdomain($this->pluginDomain, false, basename(dirname(__FILE__)).'/languages');

            /**
             * Enable shortcode [ts_bigthree_social_privacy]
             */
            add_shortcode($this->pluginDomain, array($this, 'registerPluginShortcode'));
        }

        /**
         * - Usage in posts, pages, widgets: [ts_bigthree_social_privacy]
         * - Usage in template: do_shortcode('[ts_bigthree_social_privacy]');
         */
        public function registerPluginShortcode()
        {
            wp_enqueue_style($this->pluginDomain, plugins_url('big3-social-privacy.css', __FILE__));

            $site = get_post();
            $permalink = get_permalink($site->ID);

            /**
             * outputs the whole button HTML.
             */
            require_once(dirname(__FILE__).'/big3-social-privacy-layout.php');
        }
    }
}

new BigThreeSocialPrivacy();
