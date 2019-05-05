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
            }
        }
    }
</script>