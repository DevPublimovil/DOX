<template>
  <div>
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-3">
            <div class="sticky-top mb-3">
              <div class="card">
                <div class="card-header">
                  <h4 class="card-title">Etiquetas</h4>
                </div>
                <div class="card-body">
                  <!-- the events -->
                  <div id="external-events">
                    <div class="external-event " v-for="etiqueta in updateEtiquetas" :id="etiqueta.id" :style="{'background-color': etiqueta.bgcolor, 'color': etiqueta.textColor}" :title="etiqueta.tipo"><i class="fa fa-star-o" aria-hidden="true" v-if="etiqueta.tipo == 'publica'" ></i> {{etiqueta.descripcion}}</div>
                    <div class="checkbox">
                      <label for="drop-remove">
                        <input type="checkbox" id="drop-remove">
                        eliminar despues de agregar
                      </label>
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Añadir etiqueta</h3>
                </div>
                <div class="card-body">
                  <div class="btn-group" style="width: 100%; margin-bottom: 10px;">
                    <!--<button type="button" id="color-chooser-btn" class="btn btn-info btn-block dropdown-toggle" data-toggle="dropdown">Color <span class="caret"></span></button>-->
                    <ul class="fc-color-picker" id="color-chooser">
                      <li><a class="text-primary" href="#" @click="bgBoton = 'rgb(52, 144, 220)'"><i class="fa fa-square"></i></a></li>
                      <li><a class="text-warning" href="#" @click="bgBoton = 'rgb(255, 237, 74)'"><i class="fa fa-square"></i></a></li>
                      <li><a class="text-success" href="#" @click="bgBoton = 'rgb(56, 193, 114)'"><i class="fa fa-square"></i></a></li>
                      <!--<li><a class="text-danger" href="#" @click="bgBoton = 'rgb(227, 52, 47)'"><i class="fa fa-square"></i></a></li>-->
                    </ul>
                  </div>
                  <!-- /btn-group -->
                  <div class="input-group">
                    <input id="new-event" type="text" class="form-control" placeholder="Event Title" v-model="title">

                    <div class="input-group-append">
                      <button id="add-new-event" type="button" :disabled="title.length == 0" class="btn" :style="{'background-color': tipo ? 'rgb(243, 58, 21)' : bgBoton, 'color': bgBoton == 'rgb(255, 237, 74)' && !tipo ? '#000' : '#FFF'}" @click="newEtiqueta()">Agregar</button>
                    </div>
                    <!-- /btn-group -->
                  </div>
                  <!-- /input-group -->
                  <div class="checkbox mt-2" v-if="title.length && role == 4">
                      <label for="makepublic">
                        <input type="checkbox" id="makepublic" v-model="tipo" >
                        Hacer pública
                      </label>
                    </div>
                </div>
              </div>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-md-9">
            <div class="card card-primary">
              <div class="card-body p-0">
                <!-- THE CALENDAR -->
                <FullCalendar
                class="demo-app-calendar"
                ref="fullCalendar"
                defaultView="dayGridMonth"
                :header="{
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
                }"
                :plugins="calendarPlugins"
                :weekends="calendarWeekends"
                :editable="true"
                :droppable="true"
                :allDaySlot="false"
                :defaultView="'timeGridWeek'"
                :events="updateAgenda"
                :minTime="'07:00:00'"
                :maxTime="'19:00:00'"
                :slotDuration="'00:30:00'"
                @dateClick="handleDateClick"
                @drop="dropEvent"
                @eventClick="viewEvent"
                @eventDrop="updateEvent"
                @eventResize="updateEvent"
                />
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  
  </div>
</template>

<script>
import EventBus from '../event-bus.js';  
import FullCalendar from "@fullcalendar/vue";
import dayGridPlugin from "@fullcalendar/daygrid";
import timeGridPlugin from "@fullcalendar/timegrid";
import interactionPlugin, {Draggable} from "@fullcalendar/interaction";

// must manually include stylesheets for each plugin
import "@fullcalendar/core/main.css";
import "@fullcalendar/daygrid/main.css";
import "@fullcalendar/timegrid/main.css";

export default {
  components: {
    FullCalendar// make the <FullCalendar> tag available
  },
  data: function() {
    return {
        role:0,
        user: 0,
        agendas:[],
        tipo: false,
        bgBoton:'rgb(52, 144, 220)',
        title:'',
        etiquetas:[],
      calendarPlugins: [
        // plugins must be defined in the JS
        dayGridPlugin,
        timeGridPlugin,
        interactionPlugin // needed for dateClick
      ],
      calendarWeekends: true,
    };
  },
  methods: {
        newEtiqueta(){
            let vm = this
            axios.post('/etiquetas', {
              descripcion: vm.title,
              bgcolor: vm.tipo ? 'rgb(243, 58, 21)' : vm.bgBoton,
              textcolor: vm.bgBoton == 'rgb(255, 237, 74)' && !vm.tipo ? '#000' : '#FFF',
              tipo: vm.tipo ? 'publica' : 'privada',
            }).then(function (response){
                toastr.success(response.data)
                vm.tipo = false
                vm.title = ''
                vm.getAgenda()
            }).catch(function (response){
              toastr.error('Algo salió mal!, ' + response)
            })
        },
        getAgenda(){
          let ma = this
          axios.get('/apiagendas').then(function (response){
                ma.agendas = response.data.agendas
                ma.etiquetas = response.data.etiquetas
                ma.role = response.data.user.role_id
                ma.user = response.data.user.id
            }).catch(function (error) {
                toastr.error('Algo salio mal! ' + error)
            });
        },
        viewEvent(data){
            this.$modal.show('modal-event',{user:this.user,allDay:data.event.allDay,id:data.event.id, accion:'Actualizar evento', titulo:data.event.title, start: data.event.start, end: data.event.end, backgroundColor:data.event.backgroundColor, color: data.event.textColor})
        },
        updateEvent(evento){
          let vm = this
            axios.put('/agendas/'+ evento.event.id, {
              start: moment(evento.event.start).format('Y-MM-DD hh:mm'),
              end: moment(evento.event.end).format('Y-MM-DD hh:mm'),
              allDay: false,
              backgroundColor: evento.event.backgroundColor,
              title: evento.event.title,
              textColor: evento.event.textColor,
            }).then(response => {
                if(response.data == 200){
                  toastr.success('El evento se actualizó con éxito')
                }else if(response.data== 500){
                  toastr.warning('Los cambios no se guardaron por que el evento no te pertenece')
                  vm.getAgenda();
                }else{
                  toastr.error(response.data.errormessage)
                }
            }).catch(response =>{
              toastr.error('Algo salió mal')
            })
        },
        dropEvent(info){
          let ma = this
          let checkbox = document.getElementById('drop-remove')
          this.$modal.show('modal-event', {user: ma.user, tipo: info.draggedEl.title ,allDay:false, accion:'Nuevo evento', titulo:info.draggedEl.innerText, start: info.dateStr, end: null, backgroundColor: window.getComputedStyle( info.draggedEl,null).getPropertyValue('background-color'), color: window.getComputedStyle( info.draggedEl,null).getPropertyValue('color')})
          if (checkbox.checked) {
              axios.delete('/etiquetas/'+info.draggedEl.id).then(response => {
                if(response.data == 200){
                  toastr.warning('La etiqueta se eliminó de tu lista')
                }else{
                  toastr.error('No tienes los permisos para eliminar la etiqueta')
                }
                ma.getAgenda()
              }).catch(response =>{
                toastr.error(response)
              })
          }
        },
        handleDateClick(arg) {
           /*  let element = this.$refs.modal.$el
            $(element).modal('show')*/
          let ma = this
          this.$modal.show('modal-event', {user: ma.user, tipo: 'privada' ,allDay:false, accion:'Crear evento', titulo: '', start: arg.dateStr, end: null, backgroundColor: 'rgb(52, 144, 220)', color: '#FFFFFF'})
        }
    },

    computed:{
        updateAgenda(){
          return this.agendas
        },

        updateEtiquetas(){
          return this.etiquetas
        }
    },

    mounted(){
        let draggable = document.getElementById('external-events')
        new Draggable(draggable,{
            itemSelector: '.external-event',
        });

        this.getAgenda();
        EventBus.$on('addNewevent', evt => {
            this.getAgenda();
        });

        EventBus.$on('deletEvent', evt => {
          this.getAgenda();
        })
    }
};
</script>