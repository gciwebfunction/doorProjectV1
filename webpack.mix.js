const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/js').postCss('resources/css/app.css', 'public/css', [
    require('autoprefixer'),
]);
mix.js('resources/js/utility.js', 'public/js');
mix.js('resources/js/jquery.js', 'public/js');
mix.js('resources/js/jquery.dataTables.js', 'public/js');
mix.js('resources/js/product/utility1.js', 'public/js/product/utility1.js');
mix.js('resources/js/product/utility2.js', 'public/js/product/utility2.js');
mix.js('resources/js/product/utility3-changecategory.js', 'public/js/product/utility3-changecategory.js');
mix.js('resources/js/product/viewone.js', 'public/js/product/viewone.js');
mix.js('resources/js/user/utility.js', 'public/js/user/utility.js');
mix.js('resources/js/user/view.js', 'public/js/user/view.js');
mix.js('resources/js/product/view.js', 'public/js/product');
mix.js('resources/js/shoppingcart/cart1.js', 'public/js/shoppingcart');
mix.js('resources/js/shoppingcart/doorcart1.js', 'public/js/shoppingcart');
mix.js('resources/js/shoppingcart/cartview.js', 'public/js/shoppingcart');
mix.js('resources/js/shoppingcart/cartviewdoor.js', 'public/js/shoppingcart');
mix.js('resources/js/ui/jqueryui.js', 'public/js/');
mix.js('resources/js/product/door/utility1.js', 'public/js/product/door/utility1.js');
mix.js('resources/js/product/door/utility2.js', 'public/js/product/door/utility2.js');
mix.js('resources/js/product/door/utility3.js', 'public/js/product/door/utility3.js');
mix.js('resources/js/product/door/utility4.js', 'public/js/product/door/utility4.js');
mix.js('resources/js/product/door/utility5.js', 'public/js/product/door/utility5.js');
mix.js('resources/js/product/door/editutility1.js', 'public/js/product/door/editutility1.js');
mix.js('resources/js/product/door/editutility2.js', 'public/js/product/door/editutility2.js');
mix.js('resources/js/product/door/editutility5.js', 'public/js/product/door/editutility5.js');
mix.js('resources/js/category/view.js', 'public/js/category/view.js');
mix.js('resources/js/dashboard/manufdash.js', 'public/js/dashboard/manufdash.js');
mix.js('resources/js/orderrequest/view.js', 'public/js/orderrequest/view.js');
mix.js('resources/js/orderrequest/finalize.js', 'public/js/orderrequest/finalize.js');
mix.js('resources/js/permission/viewuser.js', 'public/js/permission/viewuser.js');
mix.js('resources/js/order/view.js', 'public/js/order/view.js');

mix.postCss('resources/css/bootstrap.css', 'public/css');
mix.postCss('resources/css/signin.css', 'public/css');
