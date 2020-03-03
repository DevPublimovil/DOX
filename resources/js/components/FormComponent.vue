<template>
    <div class="form_component">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                <div class="card shadow shadow-lg">
                    <div class="card-header">
                        <h3 class="card-title">Editar documento</h3>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="compania">Compañia:</label>
                            <select name="compania_id" id="compania" class="form-control" v-model="companiaselect">
                                <option v-for="compania in companias" :value="compania.id" >{{compania.nombre}}</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="empleado">Empleado:</label>
                            <v-select label="name" :options="em_empresa" v-model="empleadoselect"></v-select>
                        </div>
                        <div class="form-group">
                            <label for="tipo_id">Tipo de correspondencia:</label>
                            <select name="tipo_id" class="form-control" v-model="tiposelect">
                                <option v-for="tipo in tipos" v-bind:value="tipo.id">{{tipo.nombre}}</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="detalles">Detalles:</label>
                            <textarea name="detalles" id="detalles" v-model="detalles" class="form-control" rows="5"></textarea>
                        </div>
                        <div class="form-group text-center" v-if="detalles.length > 0 && empleadoselect.lenght != ''">
                            <button type="button" class="btn btn-sm btn-secondary" v-on:click="cancelar()">Cancelar</button>
                            <button type="button"  class="btn btn-sm btn-primary" v-on:click="saveCorrespondencia()">Guardar y notificar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>


<script>
export default{
    props:['documento','user'],
    data(){
        return{
            companiaselect:0,
            empleadoselect:[],
            tiposelect:0,
            companias:[],
            empleados:[],
            tipos:[],
            detalles:'',
        }
    },

    computed:{
        em_empresa(){
            return this.empleados.filter((empleado) => empleado.compania.toString().includes(this.companiaselect));
        },
    },

    methods:{
        cancelar(){
             window.history.back();
        },
        saveCorrespondencia(){
          axios.put('/excluidos/'+this.documento.id,{
                    compania_id:this.companiaselect,
                    user_id:this.empleadoselect.id,
                    tipo_id:this.tiposelect,
                    descripcion:this.detalles,
                    estado:1
                }).then(({data})=>{
                    if(data.tipo == 'success'){
                        toastr.success(data.mensaje);
                        window.location = "/home";
                    }else{
                        toastr.error(data.mensaje);
                    }
                }).catch(function (error) {
                    toastr.error('Ocurrió un problema! '+error);
            });  
        },
    },

    created(){
         let me = this;
            axios.get('/variablessystem').then(function (response){
                me.tipos = response.data.tipos;
                me.empleados = response.data.empleados;
                me.companias = response.data.companias;
            }).catch(function (error) {
                toastr.error('Ocurró un error al cargar la página por favor debes recargar');
                console.log(error);
            });
            me.companiaselect = me.documento.user.compania_id
            me.tiposelect = me.documento.tipo_id
            me.empleadoselect = me.user;
            me.detalles = me.documento.descripcion
    }
}
</script>