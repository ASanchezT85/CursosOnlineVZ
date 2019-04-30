<template>
  <section>
    <div class="row">
        <div class="col-12 col-lg-8 mx-auto text-center mt-1">
            <h3>Sección dedicada a la creación, edición o eliminación de categorías</h3>
            <b-button v-b-modal.modal-prevent-closing class="btn btn-grad">Agregar Categoría</b-button>
        </div>
    </div>
    <div class="row">
        <div class="d-flex flex-wrap col-12 col-lg-10 mx-auto text-center mt-2">
            <div class="col-sm-6 col-md-3" v-for="category in categories">
                <div class="team-item text-center">
                    <div class="team-avatar">
                        <img :src="picture(category.picture)">
                    </div>
                    <div class="team-desc">
                        <h5 class="team-name">{{ category.name }}</h5>
                        <span class="team-position">{{ since(category.created_at) }}</span>
                        <ul class="social-icons si-colored-on-hover">
                            <li class="social-icons-item social-facebook">
                                <a class="social-icons-link" href="#"
                                   v-on:click.prevent="deleteCategory(category)">
                                    <i class="far fa-trash-alt"></i>
                                    Eliminar
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="d-flex flex-wrap col-12 col-lg-10 mx-auto text-center mt-2">
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <li class="page-item" v-if="pagination.current_page > 1">
                        <a class="page-link" href="#" aria-label="Previous" 
                           @click.prevent="changePage(pagination.current_page - 1)">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                    <li class="page-item" v-for="page in pagesNumber" v-bind:class="[ page == isActived ? 'active' : '']">
                        <a class="page-link" href="#" @click.prevent="changePage(page)">
                            {{ page }}
                        </a>
                    </li>
                    <li class="page-item" v-if="pagination.current_page < pagination.last_page">
                        <a class="page-link" href="#" aria-label="Next" 
                           @click.prevent="changePage(pagination.current_page + 1)">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
    
    <b-modal id="modal-prevent-closing"
             ref="modal"
             title="Agregar Categoría"
             @show="resetModal"
             @hidden="resetModal"
             @ok="handleOk">
      <form ref="form" @submit.stop.prevent="handleSubmit">
        <b-form-group :state="nameState" label="Name" label-for="name-input" invalid-feedback="Nombre es requerido">
            <b-form-input id="name-input" v-model="nameCategory" :state="nameState" required></b-form-input>
        </b-form-group>
        <b-form-file v-model="file" 
                     :state="Boolean(file)" 
                     placeholder="Escoge un archivo..."
                     drop-placeholder="Soltar el archivo aquí..."
                     @change="processFile($event)"
                     ref="file-input" required>
        </b-form-file>
      </form>
    </b-modal>
  </section>
</template>

<script>
    import axios from 'axios'
    import moment from 'moment'
    moment.locale('es');
    export default {
        data() {
            return {
                categories: [],
                nameCategory: '',
                pictureCategory: '',
                nameState: null,
                file: null,
                pagination: {
                    'total': 0,
                    'current_page': 0,
                    'per_page': 0,
                    'last_page': 0,
                    'from': 0,
                    'to': 0
                },
                offset: 3,
                error: '',
            }
        },
        created: function(){
            this.getCategories();
        },
        computed: {
            isActived: function(){
                return this.pagination.current_page;
            },
            pagesNumber: function(){
                if(!this.pagination.to){
                    return [];
                }
                var from = this.pagination.current_page - this.offset;
                if(from < 1){
                    from = 1;
                }
                var to = from + (this.offset * 2);
                if(to >= this.pagination.last_page){
                    to = this.pagination.last_page;
                }
                var pagesArray = [];
                while(from <= to){
                    pagesArray.push(from);
                    from++;
                }
                return pagesArray;
            }
        },
        methods: {
            checkFormValidity() {
                const valid = this.$refs.form.checkValidity()
                this.nameState = valid ? 'valid' : 'invalid'
                return valid
            },
            resetModal() {
                this.nameCategory = ''
                this.pictureCategory = ''
                this.nameState = null
                this.$refs['file-input'].reset()
            },
            handleOk(bvModalEvt) {
                // Prevent modal from closing
                bvModalEvt.preventDefault()
                // Trigger submit handler
                this.handleSubmit()
            },
            handleSubmit() {
                // Exit when the form isn't valid
                if (!this.checkFormValidity()) {
                    return
                }
                this.createCategory();
                // Hide the modal manually
                this.$nextTick(() => {
                    this.$refs.modal.hide()
                })
            },
            //Create
            createCategory: function(){
                //Creamos el formData
                let data = new  FormData();
                //Añadimos el nombre
                data.append('name', this.nameCategory);
                //Añadimos la imagen seleccionada
                data.append('picture', this.pictureCategory);
                //Cargamos las configuración
                let config = {
                    header : {
                        'Content-Type' : 'multipart/form-data'
                    }
                }
                this.error = this.nameCategory;
                //url
                var url = 'categories';
                axios.post(url, data, config).then(response => {
                    this.getCategories();
                    window.location.reload()
                }).catch(error => {
                    if (error.response.status == 422){
                        this.$toasted.show(error.response.message, { 
                            theme: "toasted-primary", 
                            position: "top-right", 
                            duration : 5000
                        });
                    }
                    if (error.response.status == 500){
                        this.$toasted.show(error.response.status + ': ' + this.error + ' ya existe.', { 
                            theme: "bubble", 
                            position: "top-right", 
                            duration : 5000
                        });
                    }
                });
            },
            //Read
            getCategories: function(page) {
                var urlCategories = 'list-categories?page=' + page;
                axios.get(urlCategories).then(response => {
                    this.categories = response.data.categories.data,
                    this.pagination = response.data.pagination
                });
            },
            //destroy
            deleteCategory: function(category){
                var url = 'categories/' + category.id;
                axios.delete(url).then(response => {
                    this.getCategories();
                });
            },
            since: function(d){
                return moment(d).fromNow();
            },
            picture: function(url){
                return '/images/categories/'+ url;
            },
            processFile(event) {
                this.pictureCategory = event.target.files[0];
            },            
            changePage: function(page) {
                this.pagination.current_page = page;
                this.getCategories(page);
            }
        }
    }
</script>