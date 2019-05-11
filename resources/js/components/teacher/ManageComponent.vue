<template>
    <section>
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-8 mx-auto">
                    <div class="title text-center">
                        <h2>Administra tus Cursos</h2>
                        <p class="mb-0">Crea, Edita o Elimina los cursos que impartes!</p>
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
                                <li class="social-icons-item social-facebook">
                                    <a class="social-icons-link" href="#"
                                       v-on:click.prevent="create">
                                        <i class="far fa-plus-square"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <input v-model="query" class="form-control" type="text" placeholder="Search">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-lg-12 mx-auto mt-2">
                            <div class="table-responsive-sm">
                                <table class="table table-lg table-noborder table-striped">
                                    <thead class="all-text-white bg-primary">
                                        <tr>
                                            <th scope="col" class="text-center">#</th>
                                            <th scope="col" class="text-center">Categoría</th>
                                            <th scope="col" class="text-center">Curso</th>
                                            <th scope="col" class="text-center">Costo</th>
                                            <th scope="col" class="text-center">Estado</th>
                                            <th scope="col" class="text-center">Creado</th>
                                            <th scope="col" class="text-center">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-show="courses.length" v-for="(course, index) in courses" :key="course.id">
                                            <th scope="row" class="text-center">{{ index + 1 }}</th>
                                            <td class="text-center">{{ course.category}}</td>
                                            <td>{{ course.name}}</td>
                                            <td class="text-center">{{ course.amount}} $</td>
                                            <td class="text-center">{{ course.status}}</td>
                                            <td class="text-center">
                                                <div class="post-time">{{ since(course.created) }}</div>
                                            </td>
                                            <td class="text-center">
                                                <ul class="social-icons round si-colored-on-hover">
                                                    <li class="social-icons-item social-facebook">
                                                        <a class="social-icons-link" href="#"
                                                           v-on:click.prevent="show(course)">
                                                            <i class="far fa-eye"></i>
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
                    <pagination
                        v-if="pagination.last_page > 1"
                        :pagination="pagination"
                        :offset="5"
                        @paginate="query === '' ? getData() : searchData()"
                    ></pagination>
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
        data() {
            return {
                editMode: false,
                query: "",
                queryFiled: "name",
                courses: [],
                pagination: {
                    current_page: 1
                },
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
                var url = '/teacher/list?page=' + this.pagination.current_page;
                axios.get(url).then(response => {
                    this.courses = response.data.data;
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
                var url = '/api/search/teacher/' + this.queryFiled + "/" + this.query + "?page=" + this.pagination.current_page;
                axios.get(url).then(response => {
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
                this.query = "";
                this.queryFiled = "name";
                this.$snotify.success("Los datos se actualizan con éxito", "Éxito");
            },
            create() {
                this.editMode = false;
                this.form.reset();
                this.form.clear();
                $("#statusModalLong").modal("show");
                
            },
            show(course) {
                window.location.href = '/api/teacher/'+course.slug;
            },
            store() {
                this.$Progress.start();
                this.form.busy = true;
                this.form.post("/api/teacher")
                    .then(response => {
                        this.getData();
                        $("#statusModalLong").modal("hide");
                        if (this.form.successful) {
                            this.$Progress.finish();
                            this.$snotify.success("Estado guardado con éxito", "Éxito");
                        } else {
                            this.$Progress.fail();
                            this.$snotify.error(
                                "Algo salió mal, inténtalo de nuevo más tarde.",
                                "Error"
                            );
                        }
                    })
                    .catch(e => {
                        this.$Progress.fail();
                        console.log(e);
                    });
            },
            edit(status) {
                this.editMode = true;
                this.form.reset();
                this.form.clear();
                this.form.fill(status);
                $("#statusModalLong").modal("show");
            },
            update() {
                this.$Progress.start();
                this.form.busy = true;
                this.form.put("/api/teacher/" + this.form.id)
                    .then(response => {
                        this.getData();
                        $("#statusModalLong").modal("hide");
                        if (this.form.successful) {
                            this.$Progress.finish();
                            this.$snotify.success("Estado actualizado correctamente", "Éxito");
                        } else {
                            this.$Progress.fail();
                            this.$snotify.error(
                                "Algo salió mal, inténtalo de nuevo más tarde.",
                                "Error"
                            );
                        }
                    })
                    .catch(e => {
                        this.$Progress.fail();
                        console.log(e);
                    });
            },
            destroy(status) {
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
                                    axios.delete("/api/teacher/" + status.id)
                                        .then(response => {
                                            this.getData();
                                            this.$Progress.finish();
                                            this.$snotify.success(
                                                "Estado eliminado con éxito",
                                                "Éxito"
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
        }
    }
</script>