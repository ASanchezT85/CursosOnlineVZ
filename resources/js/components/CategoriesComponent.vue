<template>
    <div class="d-block d-sm-flex">
        <ul class="list-unstyled w-100 w-sm-50 pr-0 pr-lg-5">
            <li v-for="category in categories">
                <a class="dropdown-item" href="#">{{ category.name }}</a>
            </li>            
        </ul>
    </div>
    
</template>

<script>
    import axios from 'axios'
    import moment from 'moment'
    moment.locale('es');
    export default {
        data() {
            return {
                categories: [],
            }
        },
        created: function(){
            this.getCategories();
        },
        methods: {
            //Read
            getCategories: function() {
                var urlCategories = 'listcategories';
                axios.get(urlCategories).then(response => {
                    this.categories = response.data.categories.data;
                });
            }
        }
    }
</script>