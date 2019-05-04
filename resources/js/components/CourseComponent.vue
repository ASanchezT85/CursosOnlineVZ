<template>
    <section>
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-8 mx-auto">
                    <div class="title text-center">
                        <h2>Administración de Cursos</h2>
                        <p class="mb-0">Aprobar, Rechazar, o Elimina cursos de la plataforma</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-lg-12 mx-auto mt-2">
                    <div class="row">
                        <div class="col-md-6">
                            <ul class="social-icons">
                                <li class="social-icons-item social-facebook">
                                    <a class="social-icons-link" href="#"
                                       v-on:click.prevent="reload">
                                        <i class="fas fa-sync"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <input v-model="query" class="form-control" type="text" placeholder="Search">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-lg-12 mx-auto mt-2">
                    <div class="table-responsive-sm">
                        <table class="table table-lg table-noborder table-striped">
                            <thead class="all-text-white bg-primary">
                                <tr>
                                    <th scope="col" class="text-center">#</th>
                                    <th scope="col" class="text-center">Profesor</th>
                                    <th scope="col" class="text-center">Nombre</th>
                                    <th scope="col" class="text-center">Costo</th>
                                    <th scope="col" class="text-center">Desde</th>
                                    <th scope="col" class="text-center">Estado</th>
                                    <th scope="col" class="text-center" colspan="3">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-show="courses.length" v-for="(course, index) in courses" :key="course.id">
                                <th scope="row" class="text-center">{{ index + 1 }}</th>
                                <td class="text-center">{{ course.teacher}}</td>
                                <td>{{ course.name }}</td>
                                <td class="text-center">{{ course.amount }}$</td>
                                <td class="text-center">
                                    <div class="post-time">{{ since(course.update) }}</div>
                                </td>
                                <td class="text-center">
                                    <span :class="statusClass(course.status)">
                                        {{ course.status }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    <ul class="social-icons round si-colored-on-hover">
                                        <li class="social-icons-item social-facebook">
                                            <a class="social-icons-link" href="#"
                                               v-on:click.prevent="show(course)">
                                                <i class="far fa-eye"></i>
                                            </a>
                                        </li>
                                        <li class="social-icons-item social-soundcloud">
                                            <a class="social-icons-link" href="#"
                                               v-on:click.prevent="edit(course)">
                                                <i class="far fa-edit"></i>
                                            </a>
                                        </li>
                                        <li class="social-icons-item social-youtube">
                                            <a class="social-icons-link" href="#"
                                               v-on:click.prevent="destroy(course)">
                                                <i class="far fa-trash-alt"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </td>
                            </tr>
                            <tr v-show="!courses.length">
                                <td colspan="7">
                                    <div class="offset-1 col-md-10 mb-4">
                                        <h5 class="mb-4">No tenemos datos para mostrar...</h5>
                                        <blockquote class="blockquote bg-dark" cite="#">
                                            <h5 class="mb-2 ">Si pierdes tus sueños tambien puedes llegar a perder la cabeza.</h5>
                                            <cite>–Mick Jagger</cite>
                                        </blockquote>
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        <pagination
                            v-if="pagination.last_page > 1"
                            :pagination="pagination"
                            :offset="5"
                            @paginate="query === '' ? getData() : searchData()"
                        ></pagination>
                    </div>
                </div>
            </div>
            <!-- Modal Create - Update-->
            <div class="modal fade" ref="statusModalLong" id="statusModalLong" tabindex="-1" role="dialog" aria-labelledby="statusModal" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="statusModal">Editar estado del Curso</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form @submit.prevent="update()" @keydown="form.onKeydown($event)">
                            <div class="modal-body">
                                <alert-error :form="form"></alert-error>
                                <div class="form-group">
                                    <label>Estado</label>
                                    <select class="custom-select select-big mb-3" v-model="form.status_id">
                                        <option v-show="status.id!=2" v-for="status in statuses" :key="status.id" :value="status.id">{{ status.name }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                <button :disabled="form.busy" type="submit" class="btn btn-primary">Guardar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <vue-progress-bar></vue-progress-bar>
        <vue-snotify></vue-snotify>
    </section>
</template>

<script>
import axios from 'axios'
import moment from 'moment'
moment.locale('es');
export default {
    data() {
        return {
            editMode: false,
            query: "",
            queryFiled: "name",
            courses: [],
            statuses: [],
            clase: "",
            form: new Form({
                id: "",
                status_id: ""
            }),
            pagination: {
                current_page: 1
            },
            
        };
     },
    watch: {
        query: function(newQ, old) {
            if (newQ === "") {
                this.getData();
            } else {
                this.searchData();
            }
        }
    },
    mounted() {
        this.getData();
    },
    methods: {
        getData() {
            this.$Progress.start();
            //Cargamos los Cursos
            var urlCourse = "/api/courses?page=" + this.pagination.current_page
            axios.get(urlCourse).then(response => {
                this.courses = response.data.data;
                this.pagination = response.data.meta;
            }).catch(e => {
                console.log(e);
                this.$Progress.fail();
            });

            //Cargamos los Estados
            var urlStatus = '/api/statuses?page=' + this.pagination.current_page;
            axios.get(urlStatus).then(response => {
                this.statuses = response.data.data;
                this.$Progress.finish();
            }).catch(e => {
                console.log(e);
                this.$Progress.fail();
            });
        },
        searchData() {
            this.$Progress.start();
            axios.get(
                "/api/search/courses/" +
                this.queryFiled +
                "/" +
                this.query +
                "?page=" +
                this.pagination.current_page
            ).then(response => {
                this.courses = response.data.data;
                this.pagination = response.data.meta;
                this.$Progress.finish();
            }).catch(e => {
                console.log(e);
                this.$Progress.fail();
            });
        },
        reload() {
            this.getData();
            console.log('hola');
            this.query = "";
            this.queryFiled = "name";
            this.$snotify.success("Los datos se actualizan con éxito", "Éxito");
        },
        show(course) {
            window.location.href = '/courses/'+course.slug;
        },
        edit(course) {
            this.editMode = true;
            this.form.reset();
            this.form.clear();
            this.form.fill(course);
            $("#statusModalLong").modal("show");
        },
        update() {
            this.$Progress.start();
            this.form.busy = true;
            this.form
                .put("/api/courses/" + this.form.id)
                .then(response => {
                    this.getData();
                    $("#statusModalLong").modal("hide");
                    if (this.form.successful) {
                        this.$Progress.finish();
                        this.$snotify.success("Customer Successfully Updated", "Success");
                    } else {
                        this.$Progress.fail();
                        this.$snotify.error(
                            "Something went wrong try again later.",
                            "Error"
                        );
                    }
                }).catch(e => {
                    this.$Progress.fail();
                    console.log(e);
            });
        },
        destroy(course) {
            this.$snotify.clear();
            this.$snotify.confirm(
                "¡No podrás recuperar estos datos!",
                "¿Estás seguro?",
                {
                    showProgressBar: false,
                    closeOnClick: false,
                    pauseOnHover: true,
                    buttons: [
                        {
                            text: "Si",
                            action: toast => {
                                this.$snotify.remove(toast.id);
                                this.$Progress.start();
                                axios.delete("/api/courses/" + course.id)
                                    .then(response => {
                                        this.getData();
                                        this.$Progress.finish();
                                        this.$snotify.success(
                                            "Customer Successfully Deleted",
                                            "Success"
                                        );
                                    }).catch(e => {
                                        this.$Progress.fail();
                                        console.log(e);
                                    }
                                );
                            },
                            bold: true
                        },
                        {
                            text: "No",
                            action: toast => {
                                this.$snotify.remove(toast.id);
                            },
                            bold: true
                        }
                    ]
                }
            );
        },
        since: function(d){
            return moment(d).fromNow();
        }
        ,
        statusClass: function(s){
            if(s==='PUBLISHED'){
                return 'badge badge-success ml-2';
            }else if(s==='PENDING'){
                return 'badge badge-warning ml-2';
            }else if(s==='REJECTED'){
                return 'badge badge-danger ml-2';
            }else {
                return 'badge badge-info ml-2';
            }
        }
    }
};
</script>