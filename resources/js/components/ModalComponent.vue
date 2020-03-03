<template>
    <div class="modalcomponent0">
            <div class="modal fade" id="envioContactos" tabindex="-1" role="dialog" aria-labelledby="envioContactosLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="envioContactosLabel">Envio de contactos</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="destino">Destinatario: </label>
                            <v-select label="name" :options="empleados" v-model="destino"></v-select>
                        </div>
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="button" @click="enviarContactos()" class="btn btn-primary" data-dismiss="modal">Aceptar</button>
                    </div>
                </div>
                </div>
            </div>
    </div>
</template>


<script>
    export default{
        props:['empleados'],
        data(){
            return{
                destino:'',
            }
        },

        methods:{
            enviarContactos(){
                let vm = this
                let empleado = vm.destino.id
                if(vm.destino == ''){
                    toastr.warning('Debe seleccionar un destino')
                }else{
                    toastr.info('Se esta enviando el directorio por favor espere!');
                    axios.post('/contactos',{
                        user: empleado
                    }).then(({data})=>{
                        toastr.success('El directorio ha sido enviado a ' + vm.destino.name)
                        vm.destino = '';
                    }).catch(function(error){
                        toastr.error('Algo salió mal ' + error)
                    })
                }
            }
        },
    }
</script>