
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('comments-tree', require('./components/CommentComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

import CommentComponent from './components/CommentComponent.vue'

const app = new Vue({
    el: '#main-content',

    data: {

        parent_id: null,
        parent_poster_name: null,
        full_name: null,
        comment: null,

        comments: [],
        spinner: false,

        errors: []
    },

    components: {
        CommentComponent
    },

    methods: {

        getAllComments: function(record_id=null) {
            window.axios.get('/comments/all').then(response => {
                this.comments = response.data.data;
                if (record_id !== null) {

                    setTimeout(function(){
                        jQuery('html, body').animate({
                            scrollTop: jQuery("#record-" + record_id).offset().top
                        }, 2000);

                    }, 300);
                }
            });
        },

        submitForm: function() {

            var postData = {
                full_name: this.full_name,
                comment: this.comment,
                parent_id: this.parent_id
            };

            var headers = {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            };

            axios.post('/comments/save', postData, {
                headers
            })
            .then((response) => {

                // refresh the fields
                this.full_name = null;
                this.comment = null;
                this.parent_id = null;
                this.errors = [];

                if (typeof response.data.record_id !== undefined) {

                    // refresh the comments & jump to new record
                    let record_id = response.data.record_id;
                    this.getAllComments(record_id);
                }
            })
            .catch((error) => {

                this.errors = [];

                const response = error.response;

                if (response === undefined) {
                    return;
                }

                let serverErrors = response.data.errors;

                if (typeof serverErrors.full_name !== 'undefined') {
                    this.errors.push(serverErrors.full_name[0]);
                }

                if (typeof serverErrors.comment !== 'undefined') {
                    this.errors.push(serverErrors.comment[0]);
                }

            });
        },

    },

    mounted() {
        this.getAllComments();
    }
});
