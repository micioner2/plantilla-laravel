<template>
   <div class="row">
       <div class="col-lg-12">
            <div class="box box-primary">

                <div class="box box-default">
                    <div class="box-header with-border text-center">
                        <h3 class="box-title">ENTREVISTA PERSONAL</h3>
                    </div>
                </div>

                
                <div class="box-body with-border">
                    <div class="row">
                        <div class="col">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <button @click="checked()" type="button" class="btn btn-primary btnagregar" data-toggle="modal" data-target="#modal-encuesta"><i class="fa fa-hand-paper-o"></i>&nbsp;&nbsp;Empezar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
       </div>

    <!-- MODAL CUESTIONARIO -->
        <div class="modal fade" id="modal-encuesta" style="overflow-y: scroll;">
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

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <p class="pregunta">Número de documento</p>
                                             <div class="input-group">
                                                <input type="number" class="form-control" placeholder="Digite su número de documento..." v-model="num_documento" v-on:keyup.enter="buscarAlumno()">
                                                <span class="input-group-btn">
                                                    <button type="button" class="btn btn-default" @click="buscarAlumno()"><i class="fa fa-search"></i></button>
                                                </span>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="col-md-6" >
                                        <div class="form-group">
                                            <p class="pregunta">SELECCIONE AL ALUMNO</p>
                                            <select class="form-control select2" style="width: 100%;" v-model="id_alumno" id="id_alumno">
                                                <option value="0" disabled>Seleccione</option>
                                                <option v-for="al in alumno" :key="al.id" v-text="al.nombre+' '+al.apelledop+' '+al.apelledom" :value="al.id"></option>
                                            </select>
                                        </div>
                                    </div>

                                    
                                    <div class="col-md-12 border-div"  v-for="po in preguntasCuestionario" :key="po.id">
                                        <p class="pregunta">{{po.nPregunta}}</p>
                                        <div v-for="detalle in detallePreguntasCuestionario" :key="detalle.id">
                                            <div class="separacion-r" v-if="po.id == detalle.idpregunta">
                                                <input @change="agregarRadio(po.id,detalle.puntaje)" type="radio" :name="'radio-'+po.id" :id="'radio-'+detalle.id"  :value="detalle.nom_pregunta">
                                                <label class="opcion-r label-radio" :for="po.id">{{detalle.nom_pregunta}}</label>
                                            </div>
                                        </div>
                                        <br>
                                    </div>

                                </div>
                            </form>      
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal"><i class="fa fa-close"></i>&nbsp;&nbsp;Cerrar</button>
                            <button type="submit" class="btn btn-primary pull-right" @click="regPregunta()"><i class="fa fa-save"></i>&nbsp;&nbsp;Registrar</button>
                        </div>
                </div>
            </div>
        </div>
        <!--  -->

    
        
    <!-- MODAL MENSAJE -->

    <div id="modal-mensaje" class="modal fade modal-success" role="dialog" style="overflow-y: scroll;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <p class="text-center" style="font-size:20px">Buscando Alumno....</p>
                </div>
            </div>
        </div>
    </div>
    <!--  -->
    </div>

</template>

<script>
export default {
    props:['enlace'],

    data(){
        return {
            preguntasCuestionario:[],
            detallePreguntasCuestionario:[],

            array: [],
            alumno: [],
            num_documento: '',
            id_alumno : 0
        }
    },

    computed:{

        calcularPuntaje(){
            let resultado = 0.0;
            for (let index = 0; index < this.array.length; index++) {
                resultado += this.array[index].puntaje;
                
            }
            return resultado
        }
    },

    methods:{
        
        listarPreguntas(){
            let me = this;
            let ruta = me.enlace+'/cuestionario/pregunta';
            axios.get(ruta).then((res) => {
                me.preguntasCuestionario = res.data.pregunta;
                me.detallePreguntasCuestionario = res.data.detalles;
            })
        },


        buscarAlumno(){
            let me = this;
            if (me.num_documento.length >= 8) {
                $('#modal-mensaje').modal('show')
                me.listarAlumno(me.num_documento);
            }
        },

        listarAlumno(num_documento){
            let me = this;
            let ruta = me.enlace+'/cuestionario/alumno?num_documento='+num_documento;
            axios.get(ruta).then((res) => {
                setTimeout(function() {
                    $('#modal-mensaje').modal('hide')
                    me.alumno = res.data.alumno;
                },1000);
            })
        },

        validarPreguntas(){

            let sw = 0
            this.id_alumno = $('#id_alumno').val()


            for (let index = 0; index < this.preguntasCuestionario.length; index++) {
             
                if (($('input[name="radio-'+this.preguntasCuestionario[index].id+'"]:checked').length == 0)) {
                    swal("Aviso!", "Marque todas las respuestas!", "error")
                    sw = true
                }
            }

            if(this.id_alumno == null){
                swal("Aviso!", "Seleccione al alumno!", "error")
                sw = true
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
                        
                        let ruta = this.enlace + '/cuestionario/pregunta';
                        axios.post(ruta,{
                            'id_alumno' : this.id_alumno,
                            'data':this.array,
                            'puntaje':this.calcularPuntaje
                            }).then((res => {
                            swal("Exito!", "Registro correcto!", "success")
                            location.reload(true);
                        }))
                    
                    }});

                }
        },

        agregarRadio (id,puntaje) {
        
            for (let index = 0; index < this.array.length; index++) {
                if(this.array[index].id == id){
                    this.array.splice(index,1)
                }
            }
            this.array.push({
                id: id,
                data: $('input[name="radio-'+id+'"]:checked').val(),
                puntaje: puntaje
            })
        },

        checked(){
            $( document ).ready(function() {
                $('.select2').select2()
            })
        },
    },

    mounted(){
      this.listarPreguntas();
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