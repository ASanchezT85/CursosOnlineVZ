<template>
    <section>
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-8 mx-auto">
                    <div class="title text-center">
                        <h2>Administración de Estudiantes</h2>
                        <p class="mb-0">Visualización de los estudiantes en la plataforma</p>
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
                                    <th scope="col" class="text-center">Nombre</th>
                                    <th scope="col" class="text-center">Desde</th>
                                    <th scope="col" class="text-center">Cursos</th>
                                    <th scope="col" class="text-center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-show="teachers.length" v-for="(teacher, index) in teachers" :key="teacher.id">
                                    <th scope="row" class="text-center">{{ index + 1 }}</th>
                                    <td class="text-center">{{ teacher.name}}</td>
                                    <td class="text-center">
                                        <div class="post-time">{{ since(teacher.created) }} / {{ since(teacher.updated) }}</div>
                                    </td>
                                    <td class="text-center">{{ teacher.courses_count }}</td>
                                    <td class="text-center">
                                        <ul class="social-icons round si-colored-on-hover">
                                            <li class="social-icons-item social-facebook">
                                                <a class="social-icons-link" href="#"
                                                   v-on:click.prevent="show(teacher)">
                                                    <i class="far fa-eye"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </td>
                                </tr>
                            <tr v-show="!teachers.length">
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

            <!-- Modal -->
            <div class="modal fade" id="showModal" tabindex="-1" role="dialog" aria-labelledby="showModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="showModalLabel">{{ form.name }}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="container">
                                <div class="col-md mb-4">
                                    <h5>Listado de cursos </h5>
                                    <ul class="list-group list-group-borderless list-group-icon-primary-bg">
                                        <li class="list-group-item"
                                            v-show="form.courses.length" v-for="(course, index) in form.courses" :key="course.id">
                                            <i class="fa fa-check"></i> {{ course.name }}
                                        </li>
                                        <li class="list-group-item"
                                            v-show="!form.courses.length">
                                            <i class="fas fa-exclamation-triangle text-danger"></i>
                                            Este estudiante no participa en ningún curso
                                        </li>
                                    </ul>
                                </div>
                            </div>  
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>
            <vue-progress-bar></vue-progress-bar>
            <vue-snotify></vue-snotify>
        </div>        
    </section>
</template>
<script>

    import moment from 'moment'
    moment.locale('es');

    export default {
        data (){
            return {
                editMode: false,
                query: "",
                queryFiled: "user_id",
                teachers: [],
                form: new Form({
                    id: "",
                    name: "",
                    courses: [],
                    courses_count: "",
                    created: "",
                    updated: ""
                }),
                pagination: {
                    current_page: 1
                }
            }
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
            //Read
            getData: function() {
                this.$Progress.start();
                var url = '/api/teachers?page=' + this.pagination.current_page;
                axios.get(url).then(response => {
                    this.teachers = response.data.data;
                    this.pagination = response.data.meta;
                    this.$Progress.finish();
                }).catch(e => {
                    console.log(e);
                    this.$Progress.fail();
                });
            },
            //searchData
            searchData() {
                this.$Progress.start();
                var url = '/api/search/teachers/' + this.queryFiled + "/" + this.query + "?page=" + this.pagination.current_page;
                axios.get(url).then(response => {
                    this.teachers = response.data.data;
                    this.pagination = response.data.meta;
                    this.$Progress.finish();
                }).catch(e => {
                    console.log(e);
                    this.$Progress.fail();
                });
            },
            reload() {
                this.getData();
                this.query = "";
                this.queryFiled = "user_id";
                this.$snotify.success("Los datos se actualizan con éxito", "Éxito");
            },
            show(teacher) {
                this.form.reset();
                this.form.fill(teacher);
                $("#showModal").modal("show");
                console.log(teacher);
            },
            since: function(d){
                return moment(d).fromNow();
            }
        }
    }
</script>