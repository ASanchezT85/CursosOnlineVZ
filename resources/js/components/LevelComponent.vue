<template>
    <section>
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-12 mx-auto text-center mt-1">
                    <h3>Sección dedicada a la creación, edición o eliminación de Niveles</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-lg-12 mx-auto mt-2">
                    <div class="row">
                        <div class="col-md-6">
                            <ul class="social-icons si-colored-on-hover">
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
                                <tr v-show="levels.length" v-for="(level, index) in levels" :key="level.id">
                                <th scope="row" class="text-center">{{ index + 1 }}</th>
                                <td>{{ level.name}}</td>
                                <td>{{ level.description}}</td>
                                <td>{{ since(level.created) }} / {{ since(level.updated) }}</td>
                                <td class="text-center">
                                    <ul class="social-icons si-colored-on-hover">
                                        <li class="social-icons-item social-facebook">
                                            <a class="social-icons-link" href="#"
                                               v-on:click.prevent="edit(level)">
                                                <i class="far fa-edit"></i>
                                            </a>
                                        </li>
                                        <li class="social-icons-item social-facebook">
                                            <a class="social-icons-link" href="#"
                                               v-on:click.prevent="destroy(level)">
                                                <i class="far fa-trash-alt"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </td>
                            </tr>
                            <tr v-show="!levels.length">
                                <td colspan="7">
                                    <div class="alert alert-danger" role="alert">Lo sentimos :( No se encontraron datos.</div>
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
            <div class="modal fade" ref="levelsModalLong" id="levelsModalLong" tabindex="-1" role="dialog" aria-labelledby="levelsModal" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="levelsModal">{{ editMode ? "Editar" : "Agregar nuevo" }} Nivel</h5>
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
                levels: [],
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
                var url = '/api/levels?page=' + this.pagination.current_page;
                axios.get(url).then(response => {
                    console.log(response.data.data);
                    this.levels = response.data.data;
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
                var url = '/api/search/levels/' + this.queryFiled + "/" + this.query + "?page=" + this.pagination.current_page;
                axios.get(url).then(response => {
                    this.levels = response.data.data;
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
                $("#levelsModalLong").modal("show");
                
            },
            store() {
                this.$Progress.start();
                this.form.busy = true;
                this.form.post("/api/levels")
                    .then(response => {
                        this.getData();
                        $("#levelsModalLong").modal("hide");
                        if (this.form.successful) {
                            this.$Progress.finish();
                            this.$snotify.success("Nivel guardado con éxito", "Éxito");
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
            edit(level) {
                this.editMode = true;
                this.form.reset();
                this.form.clear();
                this.form.fill(level);
                $("#levelsModalLong").modal("show");
            },
            update() {
                this.$Progress.start();
                this.form.busy = true;
                this.form.put("/api/levels/" + this.form.id)
                    .then(response => {
                        this.getData();
                        $("#levelsModalLong").modal("hide");
                        if (this.form.successful) {
                            this.$Progress.finish();
                            this.$snotify.success("Nivel actualizado correctamente", "Éxito");
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
            destroy(level) {
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
                                    axios.delete("/api/levels/" + level.id)
                                        .then(response => {
                                            this.getData();
                                            this.$Progress.finish();
                                            this.$snotify.success(
                                                "Nivel eliminado con éxito",
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