<template>
    <div class="container">
        <button type="button" @click="abrirModal('usuario', 'registrar')" class="btn btn-primary">
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

                            <!--Row 1 (document_type)-->
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label>Tipo de Identificacion</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-info-circle"></i></span>
                                        </div>
                                        <select class="form-control" v-model="usuario.document_type"
                                            :disabled="tipoAccion == 2">
                                            <option value="C.C">
                                                Cedula Ciudadana
                                            </option>
                                            <option value="T.I">
                                                Tarjeta de Identidad
                                            </option>
                                            <option value="T.E">
                                                Tarjeta de extranjeria
                                            </option>
                                            <option value="C.E">
                                                Cedula de extranjeria
                                            </option>
                                        </select>
                                    </div>
                                    <span v-if="errores.document_type" class="text-danger">
                                        <i class="fas fa-info-circle"></i>
                                        {{ errores.document_type[0] }}</span>
                                </div>
                            </div>
                            <!--END ROW 1 (document_type)-->

                            <!--Row 2 (id, names)-->
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label>Identificacion</label>
                                    <div class="input-group has-validation">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                                        </div>
                                        <input type="number" class="form-control" v-model="usuario.id" autocomplete="off"
                                            :disabled="tipoAccion == 2" />
                                    </div>
                                    <span v-if="errores.id" class="text-danger">
                                        <i class="fas fa-info-circle"></i>
                                        {{ errores.id[0] }}</span>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Nombres</label>
                                    <div class="input-group has-validation">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                                        </div>
                                        <input type="text" class="form-control" v-model="usuario.names"
                                            autocomplete="off" />
                                    </div>
                                    <span v-if="errores.names" class="text-danger">
                                        <i class="fas fa-info-circle"></i>
                                        {{ errores.names[0] }}</span>
                                </div>
                            </div>
                            <!--END ROW 2 (id, names)-->

                            <!-- ROW 3 (surnames y phone)-->
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label>Apellidos</label>
                                    <div class="input-group has-validation">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                                        </div>
                                        <input type="text" class="form-control" v-model="usuario.surnames"
                                            autocomplete="off" />
                                    </div>
                                    <span v-if="errores.surnames" class="text-danger">
                                        <i class="fas fa-info-circle"></i>
                                        {{ errores.surnames[0] }}</span>
                                </div>

                                <div class="form-group col-md-6">
                                    <label>Telefono</label>
                                    <div class="input-group has-validation">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                                        </div>
                                        <input type="text" class="form-control" v-model="usuario.phone"
                                            autocomplete="off" />
                                    </div>
                                    <span v-if="errores.phone" class="text-danger">
                                        <i class="fas fa-info-circle"></i>
                                        {{ errores.phone[0] }}</span>
                                </div>
                            </div>
                            <!--END ROW 3 (surnames y phone)-->

                            <!-- ROW 3 (email y id_category)-->
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label>Correo Electronico</label>
                                    <div class="input-group has-validation">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                                        </div>
                                        <input type="email" class="form-control" v-model="usuario.email" autocomplete="off"
                                            :disabled="tipoAccion == 2" />
                                    </div>
                                    <span v-if="errores.email" class="text-danger">
                                        <i class="fas fa-info-circle"></i>
                                        {{ errores.email[0] }}</span>
                                </div>

                                <div class="form-group col-md-6">
                                    <label>Categoria Usuario</label>
                                    <div class="input-group has-validation">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                                        </div>
                                        <select class="form-control" v-model="usuario.id_category"
                                            :disabled="tipoAccion == 2">
                                            <option v-for="category in arrayCategoriaUsuarios" :key="category.id"
                                                :value="category.id" v-text="category.name">
                                            </option>
                                        </select>
                                    </div>
                                    <span v-if="errores.id_category" class="text-danger">
                                        <i class="fas fa-info-circle"></i>
                                        {{ errores.id_category[0] }}</span>
                                </div>

                            </div>
                            <!-- END ROW 3 (status y id_category)-->
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" @click="cerrarModal()">
                            <i class="fas fa-door-open"></i> Cerrar
                        </button>

                        <button type="button" v-if="tipoAccion == 1" class="btn btn-primary" @click="registrarUsuario()">
                            <i class="fas fa-save"></i> Guardar
                        </button>
                        <button type="button" v-if="tipoAccion == 2" class="btn btn-primary" @click="actualizarUsuario()">
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
                    <div class="card-header bg-primary text-white"><i class="fas fa-users"></i> Usuarios</div>
                </div>
                <!-- Card Body-->
                <div class="card-body">
                    <div class="form-group row">
                        <div class="col-md-6">
                            <div class="input-group">
                                <select class="form-control col-md-3" v-model="criterio">
                                    <option value="users.id">Identificacion</option>
                                    <option value="users.names">
                                        Nombres
                                    </option>
                                    <option value="users.surnames">Apellidos</option>
                                    <option value="users.email">Correo Electronico</option>
                                    <option value="users.phone">Telefono</option>
                                </select>
                                <input type="text" v-model="buscar" @keyup.enter="
                                    listarUsuarios(1, buscar, criterio)
                                " class="form-control" placeholder="Texto a buscar" />
                                <button type="submit" @click="listarUsuarios(1, buscar, criterio)" class="btn btn-primary">
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
                                <th scope="col">Identificacion</th>
                                <th scope="col">Tipo de documento</th>
                                <th scope="col">Nombres</th>
                                <th scope="col">Apellidos</th>
                                <th scope="col">Correo Electronico</th>
                                <th scope="col">Telefono</th>
                                <th scope="col">Estado</th>
                                <th scope="col">Categoria</th>

                                <th scope="col">Opciones</th>

                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="usuario in arrayUsuarios" :key="usuario.id">
                                <td v-text="usuario.id"></td>
                                <td v-text="usuario.document_type"></td>
                                <td v-text="usuario.names"></td>
                                <td v-text="usuario.surnames"></td>
                                <td v-text="usuario.email"></td>
                                <td v-text="usuario.phone"></td>
                                <td v-show="usuario.status == 1">Activo</td>
                                <td v-show="usuario.status == 0">Inactivo</td>
                                <td v-text="usuario.nombreCategoria"></td>

                                <td>
                                    <button type="button" @click="
                                        abrirModal('usuario', 'actualizar', usuario)
                                    " class="btn btn-info btn-sm text-white">
                                        <i class="fas fa-edit"></i>
                                    </button>

                                    <button type="button" class="btn btn-success text-white" v-if="usuario.status == 1"
                                        data-toggle="tooltip" data-placement="bottom" title="Inactivar Usuario"
                                        @click="cambiarEstado(usuario.id, 'Inactivar')">
                                        <i class="fas fa-info-circle"></i>
                                    </button>

                                    <button type="button" class="btn btn-danger text-white" v-if="usuario.status == 0"
                                        data-toggle="tooltip" data-placement="bottom" title="Activar Usuario"
                                        @click="cambiarEstado(usuario.id, 'Activar')">
                                        <i class="fas fa-info-circle"></i>
                                    </button>

                                    <button type="button" class="btn btn-danger" @click="eliminarUsuario(usuario.id)">
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
            arrayUsuarios: [],
            arrayCategoriaUsuarios: [],
            criterio: "id",
            buscar: "",
            errores: [],
            usuario: {
                id: 0,
                document_type: '',
                names: '',
                surnames: '',
                email: '',
                phone: '',
                id_category: null
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
        listarUsuarios(page, buscar, criterio) {
            let me = this;
            var url =
                "/users?page=" +
                page +
                "&buscar=" +
                buscar +
                "&criterio=" +
                criterio;
            axios
                .get(url)
                .then(function (response) {
                    var respuesta = response.data;
                    me.arrayUsuarios = respuesta.usuarios.data;
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
            me.listarUsuarios(page, buscar, criterio);
        },
        cambiarEstado(id, accion) {
            Swal.fire({
                title: "Esta seguro de " + accion + " este usuario?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Aceptar!",
                cancelButtonText: "Cancelar",
            }).then((result) => {
                if (result.value) {
                    let me = this;
                    let estado = "";
                    let status = 0;
                    if (accion == "Activar") {
                        estado = "Activo";
                        status = 1;
                    } else if (accion == "Inactivar") {
                        estado = "Inactivo";
                        status = 0;
                    }
                    axios
                        .post("/user/chanceState/" + id, {
                            id: id,
                            accion: status,
                            _method: 'put'
                        })
                        .then(function (response) {
                            me.listarUsuarios(1, "", "");
                            Swal.fire(
                                "El usuario ha sido " + estado + " con éxito.",
                                "",
                                "success"
                            );
                        })
                        .catch(function (error) {
                            console.log(error.response);
                        });
                } else if (
                    // Read more about handling dismissals
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                }
            });
        },
        eliminarUsuario(id) {
            Swal.fire({
                title: "Esta seguro de eliminar este usuario?",
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
                        .post("/user/" + id, {
                            _method: 'delete'
                        })
                        .then(function (response) {
                            me.listarUsuarios(1, "", "");
                            Swal.fire(
                                "El usuario ha sido eliminado con éxito.",
                                "Eliminado!",
                                "success"
                            );
                        })
                        .catch(function (error) {
                            if (error.response.status == 500) {
                                Swal.fire(
                                    "Señor usuario no se puede eliminar el usuario, por favor contactese con el administrador.",
                                    "Error en la eliminacion del usuario",
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
                case "usuario": {
                    switch (accion) {
                        case "registrar": {
                            this.modal = 1;
                            this.tituloModal = "Crear Usuario";
                            this.tipoAccion = 1;
                            this.usuario.id = 0;
                            this.usuario.document_type = '';
                            this.usuario.names = '';
                            this.usuario.surnames = '';
                            this.usuario.email = '';
                            this.usuario.phone = '';
                            this.usuario.status = true;
                            this.usuario.id_category = null;
                            this.arrayCategoriaUsuarios = [];
                            break;
                        }

                        case "actualizar": {
                            this.modal = 1;
                            this.tituloModal = "Actualizar Usuario";
                            this.tipoAccion = 2;
                            this.usuario.id = data["id"];
                            this.usuario.document_type = data["document_type"];
                            this.usuario.names = data["names"];
                            this.usuario.surnames = data["surnames"];
                            this.usuario.email = data["email"];
                            this.usuario.phone = data["phone"];
                            this.usuario.status = data["status"];
                            this.usuario.id_category = data["id_category"];
                            break;
                        }
                    }
                }
            }
            this.selectCategoriaUsuario();
        },
        selectCategoriaUsuario() {
            let me = this;
            var url = '/selectCategoryUser';
            axios
                .get(url)
                .then(function (response) {
                    //console.log(response);
                    var respuesta = response.data;
                    me.arrayCategoriaUsuarios = respuesta.categorias;
                })
                .catch(function (error) {
                    console.log(error);
                });
        },
        cerrarModal() {
            this.modal = 0;
            this.tituloModal = "";
            this.errores = [];
            this.usuario.id = 0;
            this.usuario.document_type = '';
            this.usuario.names = '';
            this.usuario.surnames = '';
            this.usuario.email = '';
            this.usuario.phone = '';
            this.usuario.status = true;
            this.usuario.id_category = null;
            this.errores = [];
            this.tipoAccion = 0;
        },
        registrarUsuario() {
            let me = this;
            axios
                .post("/registerUser", {
                    id: this.usuario.id,
                    document_type: this.usuario.document_type,
                    names: this.usuario.names,
                    surnames: this.usuario.surnames,
                    email: this.usuario.email,
                    phone: this.usuario.phone,
                    id_category: this.usuario.id_category
                })
                .then(function (response) {
                    Swal.fire(
                        "Señor usuario el registro fue exitosamente registrado!",
                        "Usuario exitosamente registrado",
                        'success'
                    );
                    me.cerrarModal();
                    me.listarUsuarios(1, "", "");
                })
                .catch(function (error) {
                    if (error.response != null && error.response.data != null) {
                        me.errores = error.response.data.errors;
                        Swal.fire(
                            "Señor usuario verifique que el formulario este correctamente diligenciado!",
                            "Error al registrar el registro",
                            'error'
                        );
                    }
                });
        },
        actualizarUsuario() {
            let me = this;
            axios
                .post("/user/update", {
                    id: this.usuario.id,
                    names: this.usuario.names,
                    surnames: this.usuario.surnames,
                    phone: this.usuario.phone,
                    _method: 'put'
                })
                .then(function (response) {
                    Swal.fire(
                        "Señor usuario el registro fue exitosamente actualizado!",
                        "Usuario exitosamente actualizado",
                        "success"
                    );
                    me.cerrarModal();
                    me.listarUsuarios(1, "", "");
                })
                .catch(function (error) {
                    console.log(error.response);
                    if (error.response != null && error.response.data != null) {
                        me.errores = error.response.data.errors;
                        Swal.fire(
                            "Señor usuario verifique que el formulario este correctamente diligenciado!",
                            "Error al actualizar el usuario",
                            "error"
                        );
                    }
                });
        }
    },
    mounted() {
        this.listarUsuarios(1, this.buscar, this.criterio);
    }
}
</script>