<?php
/*
Plugin Name: Themie
Description: Provides additional theme functionality
Version: 1.0
Author: Neil Sweeney
Author URI: http://wolfiezero.com/
Plugin URI:
License: GPL

Copyright 2011 Neil Sweeney <neil@wolfiezero.com>

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, version 2.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/


/**
 * Themie
 * ============================================================================
 * @package  WordPress
 * @author   Neil Sweeney <neil.sweeney@fubra.com>
 */
class Themie {


    /**
     * Include themplate part
     * @param   array|string
     * @return  void
     * @author  Neil Sweeney
     */
    public static function inc ($parts) {

        $name_space = '.';

        if (is_array($parts)) {

            foreach ($parts as $part) {
                $part = str_replace($name_space, '/',  $part);
                get_template_part($part);
            }

        } else {

            $part = str_replace($name_space, '/',  $parts);
            get_template_part($part);

        }

    }


    /**
     * Make WordPress more secure
     * @return  void
     * @author  Neil Sweeney
     */
    public static function secure () {

        add_filter('login_errors', create_function('$a', 'return null;'));
        remove_action('wp_head', 'wp_generator');

    }


    /**
     * Include a number of theme supports through a single funcion via an array
     * @param   array
     * @return  void
     * @author  Neil Sweeney
     */
    public static function theme_supports ($features) {

        foreach ($features as $key => $value) {

            if (is_numeric($key)) {
                add_theme_support($value);
            } else {
                add_theme_support($key, $value);
            }

        }

    }


    /**
     * Automatically include custom post types
     * @param   string 
     * @return  array
     * @author  Neil Sweeney
     */
    public static function post_types ($theme_dir) {

        $dir    = $theme_dir.'/lib/post_type';
        $files  = array();
        $handle = opendir($dir);

        if (!$handle) {
            die('Unable to open directory '.$dir);
            return false;
        }

        while (($entry = readdir($handle)) !== false) {
            if (!in_array($entry, array('.', '..')))
            {
                $path = $dir.'/'.$entry;
               
                if (is_file($path)) {
                    $files[] = $path;
                } elseif (is_dir($path) AND $tmp = dir_get_contents($path)) {
                    $files = array_merge($files, $tmp);
                }
            }
        }
     
        closedir($handle);

        foreach ($files as $file) {
            include $file;
        }

        return $files;

    }


}