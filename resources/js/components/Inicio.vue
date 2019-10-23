<template>
   <div class="row">
       <div class="col-lg-12">
            <div class="box box-primary">

                <div class="box box-default">
                    <div class="box-header with-border text-center">
                        <h3 class="box-title">TEST-PREGUNTAS</h3>
                    </div>
                </div>

                
                <div class="box-body with-border">
                    <div class="row">
                        <div class="col">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <button @click="checked()" type="button" class="btn btn-primary btnagregar" data-toggle="modal" data-target="#modal-encuesta"><i class="fa fa-hand-paper-o"></i>&nbsp;&nbsp;Iniciar Encuesta</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
       </div>

    <!-- MODAL -->
        <div class="modal fade" id="modal-encuesta">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header modales">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title text-center">CUESTIONARIO</h4>
                    </div>
                    
                        <div class="modal-body">
                            <form class="form">
                                <div class="box-body">


                                    <div class="col-md-12  border-div">
                                        <div class="form-group">
                                            <!-- <button type="button" class="btn btn-primary" @click="listarPreguntaConRespuesta(), listarPreguntaConOpcion()">Actualizar</button> -->
                                            <!-- <button type="button" class="btn btn-primary" @click="imprimir()">Imprimir</button> -->
                                                <p class="pregunta">SELECCIONE AL ALUMNO</p>
                                                <select class="form-control select2" style="width: 100%;" v-model="id_alumno" id="id_alumno">
                                                    <option value="0" disabled>Seleccione</option>
                                                    <option v-for="al in alumno" :key="al.id" v-text="al.nombre+' '+al.apelledop+' '+al.apelledom" :value="al.id"></option>
                                                </select>
                                        </div>
                                    </div>
                            
                                    <div  class="col-md-12 border-div"  v-for="pregunta in preguntas" :key="pregunta.id">
                                        <p class="pregunta">{{pregunta.nPregunta}}</p>
                                        <input type="text" class="form-control" :name="'txt-'+pregunta.id" :id="'txt-'+pregunta.id" />
                                        <br>
                                    </div>
                                    
                                    <div class="col-md-12 border-div"  v-for="po in preguntasOpcion" :key="po.id">
                                        <p class="pregunta">{{po.nPregunta}}</p>
                                        <div v-for="detalle in detallePreguntas" :key="detalle.id">
                                            <div class="separacion-r" v-if="po.id == detalle.idpregunta">
                                                <input @change="agregarRadio(po.id)" type="radio" :name="'radio-'+po.id" :id="'radio-'+detalle.id"  :value="detalle.nom_pregunta">
                                                <label class="opcion-r label-radio" :for="po.id">{{detalle.nom_pregunta}}</label>
                                            </div>
                                        </div>
                                        <br>
                                    </div>

                                </div>
                            </form>      
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary pull-right" @click="regPregunta()"><i class="fa fa-arrow-circle-right"></i>&nbsp;&nbsp;Registrar</button>
                        </div>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
export default {
    props:['enlace'],

    data(){
        return {
            preguntas:[],

            preguntasOpcion:[],
            detallePreguntas:[],

            array: [],
            alumno: [],

            id_alumno : 0
        }
    },


    methods:{
        
        listarPreguntaConRespuesta(){
            let me = this;
            let ruta = me.enlace+'/pregunta/rellenar';
            axios.get(ruta).then((res) => {
                me.preguntas = res.data.pregunta
            })
        },


        listarPreguntaConOpcion(){
            let me = this;
            let ruta = me.enlace+'/pregunta/opcion';
            axios.get(ruta).then((res) => {
                me.preguntasOpcion = res.data.pregunta;
                me.detallePreguntas = res.data.detalles;
            })
        },

        listarAlumno(){
            let me = this;
            let ruta = me.enlace+'/alumno';
            axios.get(ruta).then((res) => {
                me.alumno = res.data.alumno;
            })
        },


        validarPreguntas(){
            let sw = 0
            this.id_alumno = $('#id_alumno').val()

            if(this.id_alumno == null){
                swal("Aviso!", "Seleccione al alumno!", "error")
                sw = true

            }else{

                for (let index = 0; index < this.preguntas.length; index++) {
                    if($("#txt-"+this.preguntas[index].id).val()==""){
                        swal("Aviso!", "Complete las preguntas!", "error")
                        sw = true
                    }
                }

            }
          
            return sw 
        },

        regPregunta(){

            if(this.validarPreguntas()){

                }else{
                    swal({
                        title: 'Está seguro de registrar las pereguntas del alumno?',
                        type: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Aceptar!',
                        cancelButtonText: 'Cancelar',
                        confirmButtonClass: 'btn btn-success',
                        cancelButtonClass: 'btn btn-danger',
                        buttonsStyling: false,
                        reverseButtons: true
                    }).then((result) => {
                        if (result.value) {
                            
                            for (let index = 0; index < this.preguntas.length; index++) {
                                if($("#txt-"+this.preguntas[index].id).val()!=""){
                                    this.array.push({
                                        id: this.preguntas[index].id,
                                        data: $("#txt-"+this.preguntas[index].id).val()
                                    })
                                }
                                
                            }
            
                        
                        let ruta = this.enlace + '/pregunta';
                        axios.post(ruta,{
                            'id_alumno' : this.id_alumno,
                            'data':this.array,
                            }).then((res => {
                            swal("Exito!", "Registro correcto!", "success")
                            location.reload(true);
                        }))
                    
                    }});

                }
        },

        agregarRadio (id) {
        
            for (let index = 0; index < this.array.length; index++) {
                if(this.array[index].id == id){
                    this.array.splice(index,1)
                }
            }
            this.array.push({
                id: id,
                data: $('input[name="radio-'+id+'"]:checked').val()
            })
        },

        checked(){
            $( document ).ready(function() {
                // $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
                //     checkboxClass: 'icheckbox_flat-green',
                //     radioClass   : 'iradio_flat-green'
                // })
                $('.select2').select2()
            })
        }
    },

    mounted(){
      this.listarPreguntaConRespuesta();
      this.listarPreguntaConOpcion();
      this.listarAlumno();

    }
}

</script>

<style>

    .modal-content{
        background: #FCF9F9;
    }

    .border-div{
        border-style: dotted;
        border-color:#D8D5D4;
        padding:10px; 
        margin-bottom:20px;
    }

    .pregunta{
        font-family:Arial, Helvetica, sans-serif;
        font-size:14px; 
        font-weight:bold;
    }

    .separacion-r{
        margin-left:20px;
    }

    .opcion-r{
        font-weight: normal;
    }

    /* .flat-red{
        margin-bottom: 5px;
    } */


    .label-radio {
        margin-right: 15px;
        line-height: 32px;
    }

    input[type = 'radio'] {
        -webkit-appearance: none;
        -moz-appearance: none;
        appearance: none;

        border-radius: 50%;
        width: 25px;
        height: 25px;

        border: 2px solid #999;
        transition: 0.2s all linear;
        margin-right: 5px;

        position: relative;
        top: 7px;
    }

    input:checked {
        border: 6px solid black;
    }

    input[type = 'radio']:focus{
        outline:none !important;
        outline-width: 0 !important;
        box-shadow: none;
        -moz-box-shadow: none;
        -webkit-box-shadow: none;
    }
    
</style>