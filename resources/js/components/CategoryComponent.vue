<template>
    <section>
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-8 mx-auto">
                    <div class="title text-center">
                        <h2>Administración de Categorías</h2>
                        <p class="mb-0">Crear o Elimine los categorías de la plataforma</p>
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
                        <div class="d-flex flex-wrap col-12 col-lg-10 mx-auto text-center mt-2">
                            <div class="col-sm-6 col-md-3" 
                                 v-show="categories.length" v-for="(category, index) in categories" :key="category.id">
                                <div class="team-item text-center">
                                    <div class="team-avatar">
                                        <img :src="category.picture">
                                    </div>
                                    <div class="team-desc">
                                        <h5 class="team-name">{{ category.name }}</h5>
                                        <span class="team-position">{{ since(category.updated) }}</span>
                                        <ul class="social-icons round si-colored-on-hover">
                                            <li class="social-icons-item social-youtube">
                                                <a class="social-icons-link" href="#"
                                                   v-on:click.prevent="destroy(category)">
                                                    <i class="far fa-trash-alt"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
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
            <!-- Modal Create - Update-->
            <div class="modal fade" ref="statusModalLong" id="statusModalLong" tabindex="-1" role="dialog" aria-labelledby="statusModal" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="statusModal">{{ editMode ? "Editar" : "Agregar nueva" }} Categoría</h5>
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
                                <div class="row">
                                    <div class="col-md-9">
                                        <div class="form-group">
                                            <label for="picture">Imagen</label>
                                            <input type="file" class="form-control-file" id="picture"  @change="processFile($event)"
                                                :class="{ 'is-invalid': form.errors.has('picture') }"
                                                ref="file-input">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <img :src="form.picture" :alt="form.name" v-show="editMode">
                                    </div>
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
                categories: [],
                form: new Form({
                    id: "",
                    name: "",
                    picture: "",
                    created: "",
                    updated: ""
                }),
                data: new FormData(),
                config: {
                    header : {
                        'Content-Type' : 'multipart/form-data'
                    }
                },
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
                var url = '/api/categories?page=' + this.pagination.current_page;
                axios.get(url).then(response => {
                    this.categories = response.data.data;
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
                var url = '/api/search/categories/' + this.queryFiled + "/" + this.query + "?page=" + this.pagination.current_page;
                axios.get(url).then(response => {
                    this.categories = response.data.data;
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

                //Añadimos el nombre
                this.data.append('name', this.form.name);
                //Añadimos la imagen seleccionada
                this.data.append('picture', this.form.picture);

                var url = "/api/categories";
                
                axios.post(url, this.data, this.config)
                    .then(response => {
                        $("#statusModalLong").modal("hide");
                        this.getData();
                        this.$Progress.finish();
                        this.$snotify.success("Categoría guardada con éxito", "Éxito");
                        window.location.reload();
                    })
                    .catch(e => {
                        this.$Progress.fail();
                        this.$snotify.error(
                                "Algo salió mal, inténtalo de nuevo más tarde.",
                                "Error"
                            );
                        console.log(e);
                    });
            },
            destroy(category) {
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
                                    axios.delete("/api/categories/" + category.id)
                                        .then(response => {
                                            this.getData();
                                            this.$Progress.finish();
                                            this.$snotify.success(
                                                "Estado eliminado con éxito",
                                                "Éxito"
                                            );
                                            window.location.reload();
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
            },
            processFile(event) {
                this.form.picture = event.target.files[0];
                
            }
        }
    }
</script>