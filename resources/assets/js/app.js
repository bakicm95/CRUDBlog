
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
window.Slug = require('slug');
Slug.defaults.mode = "rfc3986";


import Buefy from 'buefy';

Vue.use(Buefy);



Vue.component('slugWidget', require('./components/slugWidget.vue'));

// var app = new Vue({
// 	el: '#app',
// 	data: {}
// });


$(document).ready(function(){
	$('button.dropdown').hover(function(e){
		$(this).toggleClass('is-open');
	});
});

require('./manage');