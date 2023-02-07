<?php

add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );

function theme_enqueue_styles() {

    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
    wp_enqueue_script('jquery-new', get_template_directory_uri() .'-enfant/assets/js/jquery.min.js', array(), '3.6.3', true);
    wp_enqueue_style( 'enfant-style', get_template_directory_uri() . '-enfant/style.css' );
    wp_enqueue_style( 'loader-style', get_template_directory_uri() . '-enfant/materialize.min.css' );
    wp_enqueue_style( 'loader-style-bis', get_template_directory_uri() . '-enfant/ghpages-materialize.css' );
    wp_enqueue_script('loader-new', get_template_directory_uri() .'-enfant/assets/js/materialize.min.js', array(), '1.0.0', true);

}
add_action('wp_footer', 'loading_circle');

function loading_circle() {
    print '
        <div id="loading" class="row white">
            <div class="col s12">
                <div class="preloader-wrapper big active">
                    <div class="spinner-layer spinner-blue">
                        <div class="circle-clipper left">
                            <div class="circle"></div>
                        </div>
                        <div class="gap-patch">
                            <div class="circle"></div>
                        </div>
                        <div class="circle-clipper right">
                            <div class="circle"></div>
                        </div>
                    </div>
                    <div class="spinner-layer spinner-red">
                        <div class="circle-clipper left">
                            <div class="circle"></div>
                        </div>
                        <div class="gap-patch">
                            <div class="circle"></div>
                        </div>
                        <div class="circle-clipper right">
                            <div class="circle"></div>
                        </div>
                    </div>
                    <div class="spinner-layer spinner-yellow">
                        <div class="circle-clipper left">
                            <div class="circle"></div>
                        </div>
                        <div class="gap-patch">
                            <div class="circle"></div>
                        </div>
                        <div class="circle-clipper right">
                            <div class="circle"></div>
                        </div>
                    </div>
                    <div class="spinner-layer spinner-green">
                        <div class="circle-clipper left">
                            <div class="circle"></div>
                        </div>
                        <div class="gap-patch">
                            <div class="circle"></div>
                        </div>
                        <div class="circle-clipper right">
                            <div class="circle"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>';
}