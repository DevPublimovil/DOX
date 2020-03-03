/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
window.toastr = require('toastr');
import vSelect from 'vue-select';
import VModal from 'vue-js-modal';
window.moment = require('moment');
Vue.use(VModal);
/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('v-select', vSelect)
Vue.component('search-component', require('./components/SearchComponent.vue').default);
Vue.component('adddocument-component', require('./components/AdddocumentComponent.vue').default);
Vue.component('form-component', require('./components/FormComponent.vue').default);
Vue.component('modal-detalle', require('./components/ModalDetalle.vue').default);
Vue.component('contactos-component', require('./components/ContactosComponent.vue').default);
Vue.component('modal-component', require('./components/ModalComponent.vue').default);
Vue.component('agenda-component', require('./components/AgendaComponent.vue').default);
Vue.component('modal-evento', require('./components/ModalEvento.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    data:{
        empleado:'',
    },
});
