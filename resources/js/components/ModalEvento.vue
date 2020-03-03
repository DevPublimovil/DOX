<template id="evento-modal">
  <div name="modal-evento">
      <modal id="modal-link" name="modal-event" :draggable="true"  :adaptive="true" width="40%" height="80%" @before-open="beforeOpen" style="z-index:2000">
          <div class="container p-2" style="margin-top:100px">
            <div class="row form-group">
              <div class="col text-center">
                  <h4>{{accion}}</h4>
                  <p v-if="name.length"><small class="text-secondary">Evento creado por: {{name}}</small></p>
              </div>
            </div>
            <div class="row form-group mt-4" v-if="userevent==user && tipo == 'privada' && accion == 'Crear evento'">
              <div class="col">
                <label >Colores de etiqueta</label>
                <ul class="fc-color-picker" id="color-chooser">
                  <li><a class="text-primary" href="#" @click="getColor('rgb(52, 144, 220)')"><i class="fa fa-square"></i></a></li>
                  <li><a class="text-warning" href="#" @click="getColor('rgb(255, 237, 74)')"><i class="fa fa-square"></i></a></li>
                  <li><a class="text-success" href="#" @click="getColor('rgb(56, 193, 114)')"><i class="fa fa-square"></i></a></li>
                  <!--<li><a class="text-danger" href="#" @click="getColor('rgb(227, 52, 47)')"><i class="fa fa-square"></i></a></li>-->
                </ul>
              </div>
            </div>
            <div class="row form-group">
              <div class="col">
                  <label for="title">Titulo:</label>
                  <input type="text" name="title" id="title" class="form-control" v-model="titulo" v-if="tipo == 'privada' && userevent == user && accion == 'Crear evento'">
                  <p else>{{titulo}}</p>
                  <!--<div class="checkbox mt-4">
                      <label for="alldayCheck">
                        <input type="checkbox" id="alldayCheck" v-model="dayCheck" :disabled="tipo == 'publica' && userevent!=user && accion == 'Actualizar evento'">
                        Todo el día
                      </label>
                  </div>-->
              </div>
            </div>
            <div class="row form-group">
              <div class="col">
                  <div class="row">
                    <div class="col-6">
                        <label for="start">Fecha inicio</label>
                        <input type="date" name="start" id="start" class="form-control" v-model="start" :disabled="dayCheck">
                    </div>
                    <div class="col-6">
                        <label for="timestart">Hora inicio</label>
                        <input type="time" name="timestart" id="timestart" class="form-control" v-model="timestart" :disabled="dayCheck">
                    </div>
                  </div>
              </div>
            </div>
             <div class="row form-group">
              <div class="col">
                 <div class="row">
                    <div class="col-6">
                        <label for="end">Fecha fin</label>
                        <input type="date" name="end" id="start" class="form-control" v-model="end" :disabled="dayCheck">
                    </div>
                    <div class="col-6">
                        <label for="timeend">Hora fin</label>
                        <input type="time" name="timeend" id="timeend" class="form-control" v-model="timeend" :disabled="dayCheck">
                    </div>
                  </div>
              </div>
            </div>
            <div class="row form-group mt-4">
              <div class="col text-center">
                <button type="button" class="btn btn-danger" v-if="accion=='Actualizar evento'" :disabled="userevent!=user"  @click="deleteEvent(evento)">Eliminar</button>
                <button type="button" class="btn" :disabled="tipo == 'publica' && userevent!=user && accion == 'Actualizar evento'" :style="{'background-color': backgroundColor, 'color': textcolor}" @click="updateEvent(evento)">Aceptar</button>
              </div>
            </div>
          </div>
      </modal>
  </div>
</template>

<script>
  import EventBus from '../event-bus.js';
    export default{
        data(){
            return{
              accion:'',
              titulo:'',
              start:'',
              end:'',
              timestart:'',
              timeend:'',
              backgroundColor:'rgb(52, 144, 220)',
              evento:'',
              dayCheck:false,
              tipo: '',
              textcolor: '#FFFFF',
              name:'',
              userevent:0,
              user:0
            }
        },

        methods:{
            beforeOpen(event){
              let vm = this
                vm.accion = event.params.accion
                vm.titulo = event.params.titulo
                vm.start= moment(event.params.start).format('Y-MM-DD')
                vm.timestart = moment(event.params.start).format('HH:MM')
                vm.dayCheck = event.params.allDay
                if(event.params.end == null){
                  vm.end= moment(event.params.start).format('Y-MM-DD')
                  vm.timeend= moment(event.params.start).add(1, 'hours').format('HH:MM')
                }else{
                  vm.end= moment(event.params.end).format('Y-MM-DD')
                  vm.timeend= moment(event.params.end).format('HH:MM')
                }
                vm.backgroundColor = event.params.backgroundColor
                vm.evento = event.params.id
                vm.tipo = event.params.tipo
                vm.textcolor = event.params.color
                vm.userevent = event.params.user

                if(event.params.accion == 'Actualizar evento'){
                  axios.get('/agendas/'+event.params.id).then(response =>{
                    vm.name = response.data.user.name
                    vm.user = response.data.user.id
                    vm.tipo = response.data.evento.tipo
                  })
                }else{
                  vm.name = ''
                  vm.user =  event.params.user
                  vm.userevent = event.params.user
                }
            },

            deleteEvent(evento){
                axios.delete('/agendas/'+evento).then(response =>{
                  toastr.success(response.data)
                  this.$modal.hide('modal-event')
                  EventBus.$emit('deletEvent')
                })
            },

            getColor(color){
                color == 'rgb(255, 237, 74)' ? this.textcolor = '#000' : this.textcolor = '#FFFFFF'
                this.backgroundColor = color
            },

            updateEvent(evento) {
              let vm = this
              if(vm.accion == 'Actualizar evento'){
                
                if(vm.end >= vm.start){
                    axios.put('/agendas/' + evento, {
                    start: vm.start + ' ' + vm.timestart,
                    end: vm.end + ' ' + vm.timeend,
                    allDay: vm.dayCheck,
                    backgroundColor: vm.backgroundColor,
                    title: vm.titulo
                  }).then(({data}) => {
                    if(data.errormessage){
                      toastr.error(data.errormessage)
                    }else{
                      EventBus.$emit('addNewevent', {newEvent: data})
                      this.$modal.hide('modal-event')
                      toastr.success('El evento se actualizó con éxito')
                    }
                  }).catch(({error}) => {
                    console.log(error)
                  })
                }else{
                  toastr.error('La fecha fin debe ser mayor o igual a fecha inicio');
                }
              }else{
                vm.insertEvent();
              }
            },

            insertEvent(){
              let vm = this
               if(vm.titulo.length)
               {
                  axios.post('/agendas',{
                    allDay: vm.dayCheck,
                    start: vm.start + ' ' + vm.timestart,
                    end: vm.end + ' ' + vm.timeend,
                    backgroundColor: vm.backgroundColor,
                    title: vm.titulo,
                    tipo: vm.tipo,
                    textColor: vm.textcolor
                  }).then(({data})=>{
                    if(data.errormessage){
                      toastr.error(data.errormessage)
                    }else{
                      toastr.success(data.message)
                      EventBus.$emit('addNewevent')
                    this.$modal.hide('modal-event')
                    }
                  }).catch(function (response){
                    toastr.error(response.message)
                  })
               }else{
                 toastr.warning('El evento no contiene un título')
               }
            }
        }

    }
</script>