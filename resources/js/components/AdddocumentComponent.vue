<template>
    <div class="documentAdd">
        <div class="card" style="min-height:90vh">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-12 col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Nueva correspondencia</h3>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <div class="form-group">
                                        <label for="empresa_id">Empresa:</label>
                                        <select name="empresa_id" class="form-control" v-model="selectEmpresa">
                                            <option v-for="empresa in empresas" v-bind:value="empresa.id">{{empresa.nombre}}</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Empleados:</label>
                                        <v-select label="name" :options="em_empresa" v-model="selectem"></v-select>
                                    </div>
                                    <div class="form-group">
                                        <label for="tipo_id">Tipo de correspondencia:</label>
                                        <select name="tipo_id" class="form-control" v-model="selectTipo">
                                            <option v-for="tipo in tipos" v-bind:value="tipo.id">{{tipo.nombre}}</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="tipo_id">Detalles:</label>
                                        <textarea name="detalles" v-model="detalles" class="form-control" rows="5"></textarea>
                                    </div>
                                    <div class="form-group text-center" v-if="detalles.length > 0 && selectem != ''">
                                        <button type="button" class="btn btn-sm btn-secondary" v-on:click="reset()">Cancelar</button>
                                        <button type="button"  class="btn btn-sm btn-primary" v-on:click="saveCorrespondencia()">Guardar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-12 col-12">
                        <!-- /.row -->
                        <div class="row">
                            <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                <h3 class="card-title">Lista de correspondencia</h3>
                
                                <div class="card-tools">
                                    <div class="input-group input-group-sm" style="width: 150px;">
                                    <input type="text" name="table_search" v-model="document" class="form-control float-right" placeholder="Buscar">
                
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                                    </div>
                                    </div>
                                </div>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body table-responsive p-0" >
                                <p class="text-center" v-if="searchDocument.length == 0">No se tiene correspondencia pendiente</p>
                                <table class="table table-sm text-center" v-else>
                                    <thead>
                                        <tr class="font-weight-bold">
                                            <th>Tipo</th>
                                            <th>Empleado</th>
                                            <th>Compañia</th>
                                            <th>Descripción</th>
                                            <th>Fecha y hora</th>
                                            <th>Opción</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="documento in searchDocument" :key="documento.id">
                                            <td>{{documento.tipo.nombre}}</td>
                                            <td>{{documento.user.name}}</td>
                                            <td>{{documento.user.compania.nombre}}</td>
                                            <td max-width="100px">{{documento.descripcion}}</td>
                                            <td>{{documento.created_at}}</td>
                                            <td width="200px">
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-sm btn-danger" v-on:click="deleteDocument(documento)">Eliminar</button>
                                                    <button type="button"  class="btn btn-sm btn-primary" v-if="documento.estado === 0" v-on:click="notificar(documento)">Notificar</button>
                                                    <button type="button"  class="btn btn-sm btn-success" disabled v-else>Notificado</button>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                            </div>
                        </div>
                        <!-- /.row -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default{
    name: 'documentAdd',
    props:['empresas','empleados','tipos'],
    data(){
        return{
            document:'',
            selectEmpresa: 1,
            selectem:'',
            selectTipo:1,
            detalles:'',
            arrayDocumentos:[],
        }
    },
     computed:{
            searchDocument(){
              return this.arrayDocumentos.filter((documento) => {
                  if(documento.descripcion.toLowerCase().includes(this.document) > 0){
                      return documento.descripcion.toLowerCase().includes(this.document);
                  }else{
                      return documento.user.name.toLowerCase().includes(this.document);
                  }
              });
            },
            em_empresa(){
               return this.empleados.filter((empleado) => empleado.compania.toString().includes(this.selectEmpresa));
            },
            
        },
    
    methods:{
        reset(){
            this.selectEmpresa      = 1;
            this.selectem           = '';
            this.selectTipo         = 1;
            this.detalles           ='';
        },
        saveCorrespondencia(){
            axios.post('/documentos',{
                    user_id:this.selectem.id,
                    tipo_id:this.selectTipo,
                    descripcion:this.detalles,
                    estado:0
                }).then(({data})=>{
                    this.getDocuments();
                    this.reset();
                    toastr.success('La correspondencia se agregó correctamente!');
                }).catch(function (error) {
                    console.log(error);
            });  
        },
        getDocuments(){
            let me = this;
            axios.get('/documentos').then(function (response){
                me.arrayDocumentos = response.data;
            }).catch(function (error) {
                console.log(error);
            });
        },
        deleteDocument(data){
            let me = this;
            let document_id = data.id;
            if (confirm('¿Seguro que deseas borrar esta Correspondencia?')) {
                axios.delete('/documentos/'+document_id
                ).then(function (response) {
                    me.getDocuments();
                    toastr.success('¡La correspondencia se eliminó correctamente!');
                }).catch(function (error) {
                    toastr.error('¡Ocurrió un problema!');
                }); 
            }
        },
        notificar(data){
            let me = this;
            let empleado = data.user.id
            axios.get('/sendemails/'+empleado).then( function(response){
                toastr.info('¡Se ha notificado a !'+ data.user.name+' !');
                me.getDocuments();
            }).catch(function (error){
                toastr.error('¡Ocurrió un problema!');
                console.log(error);
            });
        }
    },

    mounted() {
        this.getDocuments();
    }
}
</script>