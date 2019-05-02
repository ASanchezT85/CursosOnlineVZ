<template>
    <section>
        <div class="container">
            <div class="row">
                <div class="col-12 mb-5">
                    <h5 class="text-center mb-4 mt-4">Tabla de Curos</h5>
                    <div class="row">
                        <div class="col-md-4">
                            <button type="button" class="btn btn-primary" @click="reload">
                                Recargar
                                <i class="fas fa-sync"></i>
                            </button>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <select v-model="queryFiled" class="custom-select select-big mb-3">
                                    <option value="name">Name</option>
                                    <option value="category">Category</option>
                                    <option value="teacher">Teacher</option>
                                    <option value="status">Status</option>
                                </select>
                            </div>
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
                                    <th scope="col" class="text-center">Profesor</th>
                                    <th scope="col" class="text-center">Nombre</th>
                                    <th scope="col" class="text-center">Costo</th>
                                    <th scope="col" class="text-center" colspan="2">Acciones</th>
                                    <th scope="col" class="text-center">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-show="courses.length" v-for="(course, index) in courses" :key="course.id">
                                <th scope="row" class="text-center">{{ index + 1 }}</th>
                                <td>{{ course.teacher}}</td>
                                <td>{{ course.name }}</td>
                                <td class="text-center">{{ course.amount }}</td>
                                <td class="text-center">
                                    <button class="btn btn-info" @click="show(course)" style="min-width: 100px">
                                        Detaller
                                    </button>
                                    <button class="btn btn-danger" @click="destroy(course)" style="min-width: 100px">
                                        Eliminar
                                    </button>
                                </td>
                                <td class="text-center">
                                    <form @submit.prevent="update()">
                                        <input
                                            v-if="course.status_id === 1"
                                            v-model="form.status_id=2"
                                            name="status_id"
                                            type="hidden">
                                        <input
                                            v-else
                                            v-model="form.status_id=3"
                                            name="status_id"
                                            type="hidden">
                                        <button 
                                            :disabled="form.busy" type="submit"
                                            :class="(course.status_id === 1) ? 'btn btn-primary' : 'btn btn-warning'"
                                            style="min-width: 100px">
                                            {{ (course.status_id === 1) ? 'Aprobar' : 'Rechazar' }}
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            <tr v-show="!courses.length">
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
                            @paginate="query === '' ? getCoursesData() : searchData()"
                        ></pagination>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">            
            <!-- showModal -->
            <b-modal ref="showModal" hide-footer>
                <template slot="modal-title">
                    <span class="pre-title">{{ form.name }}</span>
                </template>
                <template slot="default" slot-scope="{ hide }">
                    <div class="blog bg-light">
                        <div class="post">
                            <img :src="form.picture" alt="">
                            <div class="post-info">
                                <span class="post-tag bg-grad text-white mb-3 clearfix">
                                    {{ form.category }}
                                </span>
                                <span class="post-tag bg-grad text-white mb-3 clearfix" style="top: 60px !important;">{{ form.level }}</span>
                                <div class="post-author"><strong>{{ form.teacher }}</strong></div>,
                                <div class="post-time"> {{ since(form.created) }}</div>
                                <br>
                                <div class="post-author"><strong>Costo:</strong></div>
                                <div class="post-time">{{ form.amount }} $</div>
                                <br>
                                <div class="post-author"><strong>Estado: </strong></div>
                                <div class="post-time">{{ form.status }}</div>
                            </div>
                        </div>
                    </div>
                </template>
            </b-modal>

            <vue-progress-bar></vue-progress-bar>
            <vue-snotify></vue-snotify>
        </div>
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
            form: new Form({
                id: "",
                teacher: "",
                category: "",
                level: "",
                name: "",
                description: "",
                amount: "",
                slug: "",
                picture: "",
                status: "",
                approved: "",
                rejected: "",
                created: "",
                update: "",
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
                this.getCoursesData();
            } else {
                this.searchData();
            }
        }
    },
    mounted() {
        this.getCoursesData();
    },
    methods: {
        getCoursesData() {
            this.$Progress.start();
            axios.get("/api/courses?page=" + this.pagination.current_page)
                 .then(response => {
                    this.courses = response.data.data;
                    this.pagination = response.data.meta;
                    this.$Progress.finish();
            })
            .catch(e => {
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
            this.getCoursesData();
            this.query = "";
            this.queryFiled = "name";
            this.$snotify.success("Los datos se actualizan con éxito", "Éxito");
        },
        show(course) {
            this.form.reset();
            this.form.fill(course);
            this.$refs.showModal.show();
        },
        edit(course) {
            this.editMode = true;
            this.form.reset();
            this.form.clear();
            this.form.fill(course);
            this.$refs.courseModalLong.show();
        },
        update() {
            this.$Progress.start();
            this.form.busy = true;
            this.form
                .put("/api/courses/" + this.form.id)
                .then(response => {
                    this.getCoursesData();
                    //$("#courseModalLong").modal("hide");
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
                                        this.getCoursesData();
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
    }
};
</script>