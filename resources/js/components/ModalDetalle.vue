<template>
    <div class="modal-detalle d-flex" >
        <modal id="modal-document" name="modal-detalle" :draggable="true" :resizable="true" :adaptive="true" width="40%" height="40%" @before-open="beforeOpen">
            <div class="container">
                <h3 class="text-center">Detalles de la correspondencia</h3>
                <p><strong>Empleado:</strong> {{name}}</p>
                <p><strong>Compañia:</strong> {{compania}}</p>
                <p><strong>Tipo de correspondencia: </strong> {{tipo}}</p>
                <p><strong>Detalle: </strong> {{descripcion}}</p>
                <p><strong>Fecha y hora:</strong> {{fecha}}</p>
            </div>
        </modal>
    </div>
</template>

<script>
    export default{
		data(){
			return {
                documento:[],
                name:'',
                compania:'',
                tipo:'',
                fecha:'',
                descripcion:'',
			}
		},

        methods:{
            beforeOpen(event){
                this.documento = event.params.document;
                this.name = this.documento.user.name;
                this.compania = this.documento.user.compania.nombre;
                this.tipo = this.documento.tipo.nombre;
                this.fecha = this.documento.created_at;
                this.descripcion = this.documento.descripcion;
            }
        }
    }
</script>