

require('./bootstrap');

window.Vue = require('vue');


Vue.component('cuestionario', require('./components/cuestionario').default);
Vue.component('test', require('./components/Test.vue').default);


const app = new Vue({
    el: '#app',
    data :{
        menu: 0,
        enlace: 'http://localhost:8080/colegioinicial/public',
        login:{
            usuario:'',
            clave:''
        }
    },

    methods:{
        iniciarSesion:function(){
            let me = this;
            let ruta  = me.enlace+'/iniciar-sesion';
            let array  = []
            let mensaje = "Error no indentificado"
            axios.post(ruta,me.login).then(res => {
        
                array = res.data.sesion;
                if (array.length) {
                    swal("Has iniciado sesión!", "Datos correctos!", "success")
      
                }else{
                     swal("Usuario no existe!", "Datos incorrectos!", "error")
                }

            }).catch(err =>{

                let er = err.response.data.errors
               
                if (er.hasOwnProperty('usuario')) {
                    mensaje = er.usuario[0]
                }else if(er.hasOwnProperty('clave')){
                    mensaje = er.clave[0]
                }
                // }else if(er.hasOwnProperty('login')){
                //     mensaje = er.clave[0]
                // }
                swal("Error!", mensaje, "error")
                // console.log(err.response);

            })
        }
    }
});
