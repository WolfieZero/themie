Themie
===============================================================================

Themie provides a set of functions to make theming WordPress sites a little
more logical and saves on having to write the same function out more than once.



inc ($paths)
-------------------------------------------------------------------------------

Include themplate part. Written to copy namespacing standard found in MVC
framework templates like Laravel's Blade.

Call `inc` in your theme file where you want to display the particular file. 

    Themie::inc('path.to.file');

You can call multiple files in order by calling an array rather than a string 
in the argument.

    Themie::inc(array('path.file.one','path.file.two'));



secure
-------------------------------------------------------------------------------

Make WordPress more secure. 

    Themie::secure();

Currently add two hooks to Wordpress;

 - `add_filter('login_errors', create_function('$a', 'return null;'));`
 - `remove_action('wp_head', 'wp_generator');`



theme_supports ($features)
-------------------------------------------------------------------------------

Include a number of theme supports through a single funcion via an array.

    Themie::theme_supports(array(
        'post-formats' => array(
            'aside',
            'gallery',
            'link',
            'image',
            'quote',
            'status',
            'video',
            'audio',
            'chat',
        ),
        'post-thumbnails',
        'custom-background',
        'custom-header',
        'automatic-feed-links',
    ));

Each root node provides access to [add_theme_support] in the following format:

    Themie::theme_supports(
        array( $feature [, $options=array()])
    );

See the WordPress API for more info on [add_theme_support].



post_types ($dir)
-------------------------------------------------------------------------------

Automatically include custom post types.

Add to your theme's function.php file to call all custom post types in the 
default directory.

    Themie::post_types(__DIR__);

***Note:** `__DIR__` is always required to work to understand where your theme
directory is.*

Add all your custom post type files to '[theme_dir]/post_type/'. You can change
the folder where post types are stored by changing the second argument, 
`$folder`, to the folder you want such as `'lib/custom/posts'`. 

    Themie::post_types(__DIR__, 'lib/custom/post');



[add_theme_support]: https://codex.wordpress.org/Function_Reference/add_theme_support