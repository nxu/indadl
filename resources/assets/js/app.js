import Tabs from 'vue-tabs-component'

/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
Vue.use(Tabs);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    data: {
        sourceUrl: '',
        files: {},
        error: '',
        loading: false
    },
    methods: {
        getSource() {
            this.resetError();

            if (this.loading) {
                return false;
            }

            this.loading = true;

            axios.post('/url', {url: this.sourceUrl})
                .then((response) => {
                    this.sourceUrl = '';
                    this.files = response.data.resolutions;
                })
                .catch(() => {
                    this.error = 'Kérlek, adj meg egy működő Indavideó URL-t'
                })
                .then(() => this.loading = false);
        },
        resetError() {
            this.error = '';
        },
        reset() {
            this.sourceUrl = '';
            this.files = {};
            this.error = '';
        }
    }
});

