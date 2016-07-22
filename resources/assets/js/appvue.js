/**
 * Created by fabian on 21-07-16.
 */
var Vue =require('vue');
var FontNotification = require('./components/FontNotification.vue');
var VueResource =require('vue-resource');
Vue.use (VueResource);


Vue.http.headers.common['X-CSRF-TOKEN'] = document.querySelector('#token').getAttribute('value');
Vue.http.options.emulateJSON = true;


new Vue({
    el:'body',

   data:{

    hello:'HOlA MUNDO'

   },

    components:{

        'font-notification':FontNotification
    },


});

