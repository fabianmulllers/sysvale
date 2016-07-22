<template>

    <i
            class="fa"
            :class="fontclass"
    >
        <span  v-show="show" class="badge">{{notificacion.count}}</span></i>




</template>


<style>

        .badge {


            color: white;
            background: red;
        }
    </style>



<script>

  export default{

      data(){

          return{
              show: false,
              notificacion:'',
          }
      },

      computed:{

          resource(){

              var resource = this.$resource('user/vales/vernotificacion{/id}');
              return resource;
          }

      },

      props:['fontclass'],

      ready(){
          this.viewNotificaciones()


      },

      methods:{
          viewNotificaciones(){
         var that = this;
              this.resource.save({})
                      .then(function (response) {
                          that.$set('notificacion',response.json());
                          if (that.notificacion.count > 0){
                              that.show= true;   
                          }

              });

          }


      }

  }

    </script>
