<template>
    <div id="appWrapper">
        <div class="container p-4">
            <div class="card">
                <div class="card-header text-white bg-primary">
                    Buscador
                </div>
                <div class="card-body">
                    <form class="row g-3" @submit.prevent="buscar()">
                        <div class="col-auto">
                            <label for="nombre">Nombres y apellidos</label>
                            <input type="text" class="form-control" placeholder="Ej: Alejandro Hernandez" v-model="nombre" required>
                        </div>
                        <div class="col-auto">
                            <label for="porcentaje">Porcentaje de Concidencia</label>
                            <input type="number" min="0" max="100" class="form-control" placeholder="Ej: 95" v-model="porcentaje" required>
                        </div>
                        <div class="col-auto">
                            <br><button class="btn btn-primary mb-3 pd-3" type="submit">Buscar</button>
                        </div>
                        <div class="col-auto">
                            <br><button type="button" class="btn btn-info mb-3 pd-3" disabled>Exportar</button>
                        </div>
                    </form>
                    <div class="row">
                        <!-- Datos Starts -->
                        <div class="col-sm-12 col-md-12 table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Tipo persona</th>
                                        <th>Tipo cargo</th>
                                        <th>Departamento</th>
                                        <th>Municipio</th>
                                        <th>% Coincidencia</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(item, index) in datos" :key="index">
                                        <th>{{ item.nombre }}</th>
                                        <td>{{ item.tipo_persona }}</td>
                                        <td>{{ item.tipo_cargo }}</td>
                                        <td>{{ item.departamento }}</td>
                                        <td>{{ item.municipio }}</td>
                                        <td>{{ item.porcentaje }}</td>
                                    </tr>
                    
                                </tbody>
                            </table>
                        </div>
                        <!-- Datos Ends -->

                    </div>
                </div>
            </div>
        </div>
    </div>    


</template>

<script>
    export default {
        data(){
            return{
                nombre: '',
                porcentaje: '',
                datos: [],
                mensaje: '',
            }
        },
        created()
        {
            //this.listarDatos();
        },

        methods:{

            listarDatos(){
                axios.get('/datos')
                .then(res => {
                    this.datos=res.data.datos;
                }).catch(e=>{
                    console.log('error' + e)
                })
            },

            buscar(){
                console.log('Buscando...');
                axios.post('/datos/buscar',{
                   q1:this.nombre, 
                   q2:this.porcentaje,
                }).then( res => {
                    this.datos=res.data.datos;
                    this.mensaje=res.data.mensaje;
                    console.log(res);
                }).catch( error => {
                    console.log(error.response);
                })
            },
        }
    }
</script>
