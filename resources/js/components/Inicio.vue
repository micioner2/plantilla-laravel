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
                                    <button type="button" class="btn btn-primary btnagregar" data-toggle="modal" data-target="#modal-encuesta"><i class="fa fa-hand-paper-o"></i>&nbsp;&nbsp;Iniciar Encuesta</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
       </div>

    <!-- MODAL -->
        <div class="modal  fade" id="modal-encuesta">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header modales">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Preguntas</h4>
                    </div>
                    
                        <div class="modal-body">
                            <form class="form">
                                <div class="box-body">

                                    <div class="form-group">
                                        <button type="button" class="btn btn-primary" @click="listarPreguntaConRespuesta()">Actualizar</button>
                                         <button type="button" class="btn btn-primary" @click="imprimir()">Imprimir</button>
                                    </div>

                                    <div class="tex-center" v-for="(pregunta,index) in preguntas" :key="pregunta.id">
                                            <div v-if="pregunta.tipo == 0">
                                                <p>{{(index+1) + '. &nbsp;&nbsp;'+ pregunta.nPregunta}}</p>
                                                <textarea type="textarea" class="form-control" v-model="datosEntrada[index]" />
                                            </div>
                                            <div v-else>
                                                <p>{{(index+1) + '. &nbsp;&nbsp;'+ pregunta.nPregunta}}</p>
                                            </div>
                                        <div v-for="detalle in detallePreguntas" :key="detalle.id">
                                            <div class="" v-if="pregunta.id == detalle.idpregunta">
                                                <input type="radio" :name="pregunta.id" :id="pregunta.id"  :value="pregunta.id">
                                                <label :for="pregunta.id">{{detalle.nom_pregunta}}</label>
                                            </div>
                                        </div>
                                        <br>

                                    </div>
                                </div>
                            </form>      
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary pull-right"><i class="fa fa-arrow-circle-right"></i>&nbsp;&nbsp;Siguiente</button>
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
            detallePreguntas:[],

            datosEntrada: []
        }
    },

    methods:{
        
        listarPreguntaConRespuesta(){
            let me = this;
            let ruta = me.enlace+'/pregunta';
            axios.get(ruta).then((res) => {
                me.preguntas = res.data.pregunta;
                me.detallePreguntas = res.data.detalle;
            })
        },

        imprimir(){
            for (let index = 0; index < this.datosEntrada.length; index++) {
                console.log(this.datosEntrada[2]);
            }
        }
    },

    mounted(){
      this.listarPreguntaConRespuesta();
    }
}

</script>