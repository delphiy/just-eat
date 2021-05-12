/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue').default;

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('search-text-field', require('./components/SearchTextField.vue').default);
Vue.component('badge-icon', require('./components/BadgeIcon').default);
Vue.component('add-to-cart-button', require('./components/AddToCartButton').default);
Vue.component('stripe-payment-form', require('./components/StripePaymentForm').default);
Vue.component('track-order-map', require('./components/TrackOrderMap').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

// Google Map
import * as VueGoogleMaps from 'vue2-google-maps'

Vue.use(VueGoogleMaps, {
    load: {
        key: 'AIzaSyBONW71DuoGwIiOdVXkXHEWwo9mMMVmCIw',
    },
})

import MapsUtils from './utils/maps-utils'
Vue.use(MapsUtils)

const app = new Vue({
    el: '#app',
});
