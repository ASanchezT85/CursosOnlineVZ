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
                queryFiled: "name",
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
                var url = '/api/students?page=' + this.pagination.current_page;
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
                var url = '/api/search/students/' + this.queryFiled + "/" + this.query + "?page=" + this.pagination.current_page;
                axios.get(url).then(response => {
                    this.statuses = response.data.data;
                    this.pagination = response.data.meta;
                    this.$Progress.finish();
                }).catch(e => {
                    console.log(e);
                    this.$Progress.fail();
                });
            }
        }
    }
</script>