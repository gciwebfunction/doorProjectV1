require('./bootstrap');
require('./utility');
require('./jquery')
require('./jquery.dataTables')

import $ from 'jquery';
window.jQuery = $;
window.$ = $;

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();
