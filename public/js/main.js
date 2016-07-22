/**
 * Created by fabian on 14-07-16.
 */

var urlnotificacion='http://sysvale.local/user/vales/vernotificacion';
Vue.http.headers.common['X-CSRF-TOKEN'] = document.querySelector('#token').getAttribute('value');

Vue.component('notification-user',{

    template:'#notification_tpl',
    data:

        function(){

            return {

            }
        },
     created: function(){
       var self=this;

        setInterval(function(){
            setTimeout(function(){

                self.viewNotification();
            },4000)


        },6000);

    },

    methods:{
        viewNotification:function(){

                this.$http.post(urlnotificacion,{})
                       .then(function(response){

                         //  alert(response);

                       });

        }
    }

})


var vm = new Vue({

    el:'body',
    data:{
        hello:'hola mundo',
    },

    methods:{

      notification: function(){



      }


    }


});