<template>
    <section>
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-8 mx-auto">
                    <div class="title text-center">
                        <h2>Administración de Estados</h2>
                        <p class="mb-0">Crear, Editar, o Eliminar estados de la plataforma</p>
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
                    <div class="table-responsive-sm">
                        <table class="table table-lg table-noborder table-striped">
                            <thead class="all-text-white bg-primary">
                                <tr>
                                    <th scope="col" class="text-center">#</th>
                                    <th scope="col" class="text-center">Nombre</th>
                                    <th scope="col" class="text-center">Descripción</th>
                                    <th scope="col" class="text-center">Desde</th>
                                    <th scope="col" class="text-center" colspan="3">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-show="statuses.length" v-for="(status, index) in statuses" :key="status.id">
                                <th scope="row" class="text-center">{{ index + 1 }}</th>
                                <td class="text-center">{{ status.name}}</td>
                                <td>{{ status.description}}</td>
                                <td class="text-center">{{ since(status.created) }} / {{ since(status.updated) }}</td>
                                <td class="text-center">
                                    <ul class="social-icons round si-colored-on-hover">
                                        <li class="social-icons-item social-soundcloud">
                                            <a class="social-icons-link" href="#"
                                               v-on:click.prevent="edit(status)">
                                                <i class="far fa-edit"></i>
                                            </a>
                                        </li>
                                        <li class="social-icons-item social-youtube">
                                            <a class="social-icons-link" href="#"
                                               v-on:click.prevent="destroy(status)">
                                                <i class="far fa-trash-alt"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </td>
                            </tr>
                            <tr v-show="!statuses.length">
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
                            <h5 class="modal-title" id="statusModal">{{ editMode ? "Editar" : "Agregar nuevo" }} Estado</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form @submit.prevent="editMode ? update() : store()" @keydown="form.onKeydown($event)">
                            <div class="modal-body">
                                <alert-error :form="form"></alert-error>
                                <div class="form-group">
                                    <label>Nombre</label>
                                    <input v-model="form.name" type="text" name="name" class="form-control"
                                           :class="{ 'is-invalid': form.errors.has('name') }">
                                    <has-error :form="form" field="name"></has-error>
                                </div>
                                <div class="form-group">
                                    <label for="description">Descripción</label>
                                    <textarea v-model="form.description" name="description" class="form-control" id="description" rows="3"
                                              :class="{ 'is-invalid': form.errors.has('email') }"></textarea>
                                    <has-error :form="form" field="description"></has-error>
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
                statuses: [],
                form: new Form({
                    id: "",
                    name: "",
                    description: "",
                    created: "",
                    updated: ""
                }),
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
                var url = '/api/statuses?page=' + this.pagination.current_page;
                axios.get(url).then(response => {
                    this.statuses = response.data.data;
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
                var url = '/api/search/statuses/' + this.queryFiled + "/" + this.query + "?page=" + this.pagination.current_page;
                axios.get(url).then(response => {
                    this.statuses = response.data.data;
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
            store() {
                this.$Progress.start();
                this.form.busy = true;
                this.form.post("/api/statuses")
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
                this.form.put("/api/statuses/" + this.form.id)
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
                                    axios.delete("/api/statuses/" + status.id)
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