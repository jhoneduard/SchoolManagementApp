<template>
    <div class="container">
        <div class="card">
            <h5 class="card-header  bg-primary text-white"> <i class="fa fa-book"></i> Cursos recomendados</h5>
            <div class="card-body">
                <div class="form-group row">
                    <div class="col-md-9">
                        <div class="input-group">
                            <select class="form-control col-md-3" v-model="criterio">
                                <option value="subjects.name">Nombre del curso</option>
                                <option value="users.names">Nombre del docente</option>
                                <option value="users.surnames">Apellido del docente</option>
                                <option value="category_subject.name">Categoria del curso</option>
                            </select>
                            <input type="text" v-model="buscar" @keyup.enter="
                                listarCursosRecomendados(1, buscar, criterio)
                                " class="form-control" placeholder="Texto a buscar" />
                            <button type="submit" @click="listarCursosRecomendados(1, buscar, criterio)"
                                class="btn btn-primary">
                                <i class="fa fa-search"></i> Buscar
                            </button>
                        </div>
                    </div>
                </div>
                <div>
                </div>
            </div>


            <!-- Tabla de cursos disponibles-->
            <div class="container">
                <div class="table-responsive">
                    <table class="table">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col"></th>
                                <th scope="col"></th>
                                <th scope="col"></th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="curso in arrayCoursesRecommendations" :key="curso.id">
                                <td>
                                    <div>
                                        <div class="row">
                                            <strong v-text="curso.nameSubject"></strong>
                                        </div>
                                        <strong>Docente : </strong> <strong v-text="curso.nameTeacher"></strong>
                                    </div>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-primary btn-circle btn-xl">
                                        <p v-text="curso.nameCategory"></p>
                                    </button>
                                </td>
                                <td>
                                    # estudiantes registrados <strong v-text="curso.quantityStudents"></strong>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-info btn-circle btn-xl text-white"
                                        @click="registrationCourse(curso.id)">
                                        <i class="fas fa-sign-in-alt"></i> Inscribirse
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- END Tabla de cursos disponibles-->


            <!-- Paginacion-->
            <nav class="container centerPagination my-3">
                <ul class="pagination">
                    <li class="page-item" v-if="pagination.current_page > 1">
                        <a class="page-link" href="#" @click.prevent="
                            cambiarPagina(
                                pagination.current_page - 1,
                                buscar,
                                criterio
                            )
                            "><i class="fas fa-angle-double-left"></i></a>
                    </li>
                    <li class="page-item" v-for="page in pagesNumber" :key="page"
                        :class="[page == isActived ? 'active' : '']">
                        <a class="page-link" href="#" @click.prevent="
                            cambiarPagina(page, buscar, criterio)
                            " v-text="page"></a>
                    </li>
                    <li class="page-item" v-if="pagination.current_page < pagination.last_page">
                        <a class="page-link" href="#" @click.prevent="
                            cambiarPagina(
                                pagination.current_page + 1,
                                buscar,
                                criterio
                            )
                            "><i class="fas fa-angle-double-right"></i></a>
                    </li>
                </ul>
            </nav>
            <!-- END Paginacion-->
        </div>
    </div>
</template>


<script>
import Swal from "sweetalert2";
export default {
    data() {
        return {
            criterio: 'subjects.name',
            buscar: '',
            arrayCoursesRecommendations: [],
            asignatura: {
                id_subject: 0
            },
            pagination: {
                total: 0,
                current_page: 0,
                per_page: 0,
                last_page: 0,
                from: 0,
                to: 0,
            },
            offset: 3
        };
    },
    methods: {
        listarCursosRecomendados(page, buscar, criterio) {
            let me = this;
            var url =
                "/course-recommendations?page=" +
                page +
                "&buscar=" +
                buscar +
                "&criterio=" +
                criterio;
            axios
                .get(url)
                .then(function (response) {
                    var respuesta = response.data;
                    me.arrayCoursesRecommendations = respuesta.courses_recommendations.data;
                    me.pagination = respuesta.pagination;
                })
                .catch(function (error) {
                    console.log(error);
                });
        },
        cambiarPagina(page, buscar, criterio) {
            let me = this;
            //Actualiza la página actual
            me.pagination.current_page = page;
            //Envia la petición para visualizar la data de esa página
            me.listarCursosRecomendados(page, buscar, criterio);
        },
        registrationCourse(idSubject) {
            let me = this;
            axios
                .post('/registration-course', {
                    id_subject: idSubject
                })
                .then(function (response) {
                    Swal.fire(
                        "Señor usuario la asignatura fue exitosamente registrada!",
                        "Asignatura exitosamente registrada",
                        'success'
                    );
                    me.listarCursosRecomendados(1, "", "");
                })
                .catch(function (error) {
                    console.log(error);
                });
            idSubject = null;
        },
    },
    computed: {
        isActived: function () {
            return this.pagination.current_page;
        },
        //Calcula los elementos de la paginación
        pagesNumber: function () {
            if (!this.pagination.to) {
                return [];
            }

            var from = this.pagination.current_page - this.offset;
            if (from < 1) {
                from = 1;
            }

            var to = from + this.offset * 2;
            if (to >= this.pagination.last_page) {
                to = this.pagination.last_page;
            }

            var pagesArray = [];
            while (from <= to) {
                pagesArray.push(from);
                from++;
            }
            return pagesArray;
        },
    },
    mounted() {
        this.listarCursosRecomendados(1, this.buscar, this.criterio);
    }
}
</script>

<style>
.btn-circle.btn-xl {
    width: 250px;
    height: 50px;
    padding: 13px 18px;
    border-radius: 60px;
    font-size: 15px;
    text-align: center;
}
</style>