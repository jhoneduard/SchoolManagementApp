<template>
    <div class="container">
        <button type="button" @click="abrirModal('asignatura', 'registrar')" class="btn btn-primary">
            <i class="fas fa-plus-square"></i> Crear
        </button>

        <!-- Modal-->
        <div class="modal fade" tabindex="-1" :class="{ mostrar: modal }" role="dialog" aria-labelledby="myModalLabel"
            style="justify-content: center" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable my-5">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" v-text="tituloModal"></h5>
                        <button type="button" class="close btn btn-danger" @click="cerrarModal()" aria-label="Close">
                            <span aria-hidden="true"><i class="fas fa-times"></i></span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="" method="post" class="form-horizontal">

                            <!--Row 1 (nombre, docente)-->
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label>Nombre</label>
                                    <div class="input-group has-validation">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                                        </div>
                                        <input type="text" class="form-control" v-model="asignatura.name"
                                            autocomplete="off" />
                                    </div>
                                    <span v-if="errores.name" class="text-danger">
                                        <i class="fas fa-info-circle"></i>
                                        {{ errores.name[0] }}</span>
                                </div>

                                <div class="form-group col-md-6">
                                    <label>Docentes</label>
                                    <div class="input-group has-validation">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                                        </div>
                                        <select class="form-control" v-model="asignatura.idTeacher"
                                            :disabled="tipoAccion == 2">
                                            <option v-for="teacher in arrayDocentes" :key="teacher.id"
                                                :value="teacher.id" v-text="teacher.names">
                                            </option>
                                        </select>
                                    </div>
                                    <span v-if="errores.id_teacher" class="text-danger">
                                        <i class="fas fa-info-circle"></i>
                                        {{ errores.id_teacher[0] }}</span>
                                </div>

                            </div>
                            <!--END ROW  (id, Docente)-->

                            <!--Row 1 (Categoria, FechaInicial)-->
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label>Categoria</label>
                                    <div class="input-group has-validation">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                                        </div>
                                        <select class="form-control" v-model="asignatura.idCategory"
                                            :disabled="tipoAccion == 2">
                                            <option v-for="category in arrayCategory" :key="category.id"
                                                :value="category.id" v-text="category.name">
                                            </option>
                                        </select>
                                    </div>
                                    <span v-if="errores.id_category_subject" class="text-danger">
                                        <i class="fas fa-info-circle"></i>
                                        {{ errores.id_category_subject[0] }}</span>
                                </div>

                                <div class="form-group col-md-6">
                                    <label>Fecha Inicial</label>
                                    <input type="date" id="date" class="swal2-input form-control"  v-model="asignatura.initDate">
                                    <span v-if="errores.initial_date" class="text-danger">
                                        <i class="fas fa-info-circle"></i>
                                        {{ errores.initial_date[0] }}</span>
                                </div>
                            </div>
                            <!--END ROW (Categoria, FechaInicial) -->
                            

                            <!-- ROW  (Fecha Final, Descripcion)-->
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label>Fecha Final</label>
                                    <input type="date" id="date" class="swal2-input form-control"  v-model="asignatura.endDate">
                                    <span v-if="errores.end_date" class="text-danger">
                                        <i class="fas fa-info-circle"></i>
                                        {{ errores.end_date[0] }}</span>
                                </div>

                                <div class="form-group col-md-6">
                                    <label>Descripcion</label>
                                    <div class="input-group has-validation">
                                        <textarea class="form-control" rows="3" v-model="asignatura.description"></textarea>
                                    </div>
                                    <span v-if="errores.description" class="text-danger">
                                        <i class="fas fa-info-circle"></i>
                                        {{ errores.description[0] }}</span>
                                </div>
                            </div>
                        <!-- END  ROW  (Fecha Final, Descripcion)-->
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" @click="cerrarModal()">
                            <i class="fas fa-door-open"></i> Cerrar
                        </button>

                        <button type="button" v-if="tipoAccion == 1" class="btn btn-primary" @click="registrarAsignatura()">
                            <i class="fas fa-save"></i> Guardar
                        </button>
                        <button type="button" v-if="tipoAccion == 2" class="btn btn-primary"
                            @click="actualizarAsignatura()">
                            <i class="fas fa-edit"></i> Actualizar
                        </button>
                    </div>
                </div>

            </div>
        </div>
        <!-- END MODAL-->

        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-primary text-white"><i class="fas fa-users"></i> Cursos</div>
                </div>
                <!-- Card Body-->
                <div class="card-body">
                    <div class="form-group row">
                        <div class="col-md-6">
                            <div class="input-group">
                                <input type="text" v-model="buscar" @keyup.enter="
                                    listarAsignaturas(1, buscar, 'subjects.name')
                                " class="form-control" placeholder="Ingrese el nombre de la asignatura" />
                                <button type="submit" @click="listarAsignaturas(1, buscar, 'subjects.name')" class="btn btn-primary">
                                    <i class="fa fa-search"></i> Buscar
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END Card Body-->

                <!--- Tabla-->
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Nombre</th>
                                <th scope="col">Descripcion</th>
                                <th scope="col">Numero de Estudiantes</th>
                                <th scope="col">Estado</th>
                                <th scope="col">Identificacion Docente</th>
                                <th scope="col">Nombre Docente</th>
                                <th scope="col">Apellido Docente</th>
                                <th scope="col">Categoria</th>
                                <th scope="col">Fecha Inicial</th>
                                <th scope="col">Fecha Final</th>
                                <th scope="col">Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="asignatura in arrayAsignaturas" :key="asignatura.id">
                                <td v-text="asignatura.name"></td>
                                <td v-text="asignatura.description"></td>
                                <td v-text="asignatura.numberStudents"></td>
                                <td v-text="asignatura.state"></td>
                                <td v-text="asignatura.identificationTeacher"></td>
                                <td v-text="asignatura.nameTeacher"></td>
                                <td v-text="asignatura.surnamesTeacher"></td>
                                <td v-text="asignatura.nameCategory"></td>
                                <td v-text="asignatura.initDate"></td>
                                <td v-text="asignatura.endDate"></td>
                                <td>
                                    <button type="button" @click="
                                        abrirModal('asignatura', 'actualizar', asignatura)
                                    " class="btn btn-info btn-sm text-white">
                                        <i class="fas fa-edit"></i>
                                    </button>

                                    <button type="button" class="btn btn-danger" @click="eliminarAsignatura(asignatura.id)">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!--END TABLA-->
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
    </div>
</template>

<script>
import Swal from "sweetalert2";

export default {
    data() {
        return {
            modal: 0,
            tituloModal: "",
            tipoAccion: 0,
            arrayAsignaturas: [],
            arrayDocentes : [],
            arrayCategory : [],
            criterio: "subjects.name",
            buscar: "",
            errores: [],
            asignatura: {
                id: 0,
                name: '',
                description: '',
                numberStudents : 0,
                state : '',
                idTeacher : null,
                idCategory : null,
                initDate : null,
                endDate : null
            },
            pagination: {
                total: 0,
                current_page: 0,
                per_page: 0,
                last_page: 0,
                from: 0,
                to: 0,
            },
            offset: 3,
        };
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
    methods: {
        listarAsignaturas(page, buscar, criterio) {
            let me = this;
            var url =
                "/subjects?page=" +
                page +
                "&buscar=" +
                buscar +
                "&criterio=" +
                criterio;
            axios
                .get(url)
                .then(function (response) {
                    var respuesta = response.data;
                    me.arrayAsignaturas = respuesta.asignaturas.data;
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
            me.listarAsignaturas(page, buscar, criterio);
        },
        eliminarAsignatura(id) {
            Swal.fire({
                title: "Esta seguro de eliminar esta asignatura?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Aceptar!",
                cancelButtonText: "Cancelar",
            }).then((result) => {
                if (result.value) {
                    let me = this;
                    axios
                        .post("/subject/" + id, {
                            _method: 'delete'
                        })
                        .then(function (response) {
                            me.listarAsignaturas(1, "", "");
                            Swal.fire(
                                "La asignatura ha sido eliminada con éxito.",
                                "Eliminado!",
                                "success"
                            );
                        })
                        .catch(function (error) {
                            if (error.response.status == 500) {
                                Swal.fire(
                                    "Señor usuario no se puede eliminar la asignatura, por favor contactese con el administrador.",
                                    "Error en la eliminacion de la asignatura",
                                    "success"
                                );
                            }
                        });
                } else if (
                    // Read more about handling dismissals
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                }
            });
        },
        abrirModal(modelo, accion, data = []) {
            switch (modelo) {
                case "asignatura": {
                    switch (accion) {
                        case "registrar": {
                            this.modal = 1;
                            this.tituloModal = "Crear Asignatura";
                            this.tipoAccion = 1;
                            // Campos del objeto asignatura
                            this.asignatura.id = 0;
                            this.asignatura.name = '';
                            this.asignatura.description = '';
                            this.asignatura.numberStudents = 0;
                            this.asignatura.state = '';
                            this.asignatura.idTeacher = null;
                            this.asignatura.idCategory = null;
                            this.asignatura.initDate = null;
                            this.asignatura.endDate = null;
                            this.arrayDocentes = [];
                            this.arrayCategory = [];
                            break;
                        }

                        case "actualizar": {
                            this.modal = 1;
                            this.tituloModal = "Actualizar Asignatura";
                            this.tipoAccion = 2;
                            // Campos del objeto asignatura
                            this.asignatura.id = data["id"];
                            this.asignatura.name = data["name"];
                            this.asignatura.description = data["description"];
                            this.asignatura.idTeacher =  data["idTeacher"];
                            this.asignatura.idCategory = data["idCategory"];
                            this.asignatura.initDate = data["initDate"];
                            this.asignatura.endDate =  data["endDate"];
                            break;
                        }
                    }
                }
            }
            this.selectTeachers();
            this.selectCategory();
        },
        cerrarModal() {
            this.modal = 0;
            this.tituloModal = "";
            this.errores = [];
            this.asignatura.id = 0;
            this.asignatura.name = '';
            this.asignatura.description = '';
            this.asignatura.numberStudents = 0;
            this.asignatura.state = '';
            this.asignatura.idTeacher = null;
            this.asignatura.idCategory = null;
            this.asignatura.initDate = null;
            this.asignatura.endDate = null;
            this.asignatura
            this.errores = [];
            this.tipoAccion = 0;
        },
        registrarAsignatura() {
            let me = this;
            axios
                .post("/registerSubject", {
                    name: this.asignatura.name,
                    description: this.asignatura.description,
                    id_teacher: this.asignatura.idTeacher,
                    id_category_subject: this.asignatura.idCategory,
                    initial_date: this.asignatura.initDate,
                    end_date: this.asignatura.endDate
                })
                .then(function (response) {
                    Swal.fire(
                        "Señor usuario la asignatura fue exitosamente registrada!",
                        "Asignatura exitosamente registrada",
                        'success'
                    );
                    me.cerrarModal();
                    me.listarAsignaturas(1, "", "");
                })
                .catch(function (error) {
                    if (error.response != null && error.response.data != null) {
                        me.errores = error.response.data.errors;
                        Swal.fire(
                            "Señor usuario verifique que el formulario este correctamente diligenciado!",
                            "Error al registrar la asignatura",
                            'error'
                        );
                    }
                });
        },
        actualizarAsignatura() {
            let me = this;
            axios
                .post("/subject/update", {
                    id: this.asignatura.id,
                    name: this.asignatura.name,
                    description: this.asignatura.description,
                    initDate: this.asignatura.initDate,
                    endDate : this.asignatura.endDate,
                    _method: 'put'
                })
                .then(function (response) {
                    Swal.fire(
                        "Señor usuario la asignatura fue exitosamente actualizada!",
                        "Asignatura exitosamente actualizado",
                        "success"
                    );
                    me.cerrarModal();
                    me.listarAsignaturas(1, "", "");
                })
                .catch(function (error) {
                    console.log(error.response);
                    if (error.response != null && error.response.data != null) {
                        me.errores = error.response.data.errors;
                        Swal.fire(
                            "Señor usuario verifique que el formulario este correctamente diligenciado!",
                            "Error al actualizar la asignatura",
                            "error"
                        );
                    }
                });
        },
        selectTeachers(){
            let me = this;
            var url = '/select-teachers';
            axios
                .get(url)
                .then(function (response) {
                    //console.log(response);
                    var respuesta = response.data;
                    me.arrayDocentes = respuesta.teachers;
                })
                .catch(function (error) {
                    console.log(error);
                });
        },
        selectCategory(){
            let me = this;
            var url = '/select-category-subjects';
            axios
                .get(url)
                .then(function (response) {
                    //console.log(response);
                    var respuesta = response.data;
                    me.arrayCategory = respuesta.categorias;
                })
                .catch(function (error) {
                    console.log(error);
                });  
        }
    },
    mounted() {
        this.listarAsignaturas(1, this.buscar, this.criterio);
    }
}
</script>