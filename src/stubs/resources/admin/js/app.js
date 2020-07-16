/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

(function($) {
    $('input[type="file"].dropify').dropify();
    $('select.selectpicker').selectpicker();
    $('.scroll-to-top').click(function(){
        $("html, body").animate({ scrollTop: 0 }, 500);
    });
})(jQuery)
