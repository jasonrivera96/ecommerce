<?php headerAdmin($data); ?>
<main class="app-content">
    <div class="app-title">
        <div>
            <h1><i class="fa-solid fa-user-tag"></i> <?= $data['page_title'] ?>
                <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#modalCrearRol"><i class="fa-solid fa-circle-plus"></i> Crear</button>
            </h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item"><a href="<?= base_url(); ?>/Roles"><?= $data['page_tag'] ?></a></li>
        </ul>
    </div>
    <!-- <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-body">Roles de Usuario</div>
            </div>
        </div>
    </div> -->

    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-body">
                    <div class="table-responsive">
                        <table id="tableRoles" class="table table-bordered table-striped" style="margin-bottom: 10px">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    <th>Descripción</th>
                                    <th>Estado</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</main>

<!-- Modal Crear Rol -->
<div class="modal fade" id="modalCrearRol" tabindex="-1" role="dialog" aria-labelledby="modalCrearRolTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCrearRolTitle"> <i class="fa-solid fa-square-plus"></i> Crear Rol</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formRol" name="formRol">
                    <div class="form-group">
                        <label class="col-form-label" for="inputDefault">Nombre</label>
                        <input class="form-control" id="nombreRol" name="nombreRol" type="text" placeholder="Nombre de Rol" required>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="textAreaDefault">Descripción</label>
                        <textarea class="form-control" rows="2" id="descripcionRol" name="descripcionRol" placeholder=" Descripción del Rol" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="exampleSelect1">Estado</label>
                        <select class="form-control" id="estadoRol" name="estadoRol" required>
                            <option value="1">Activo</option>
                            <option value="0">Inactivo</option>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"> Cancelar</button>
                        <button type="submit" class="btn btn-primary"> Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php footerAdmin($data); ?>

<script type="text/javascript">
    $(document).ready(function() {
        /* document.addEventListener('DOMContentLoaded', function(){ */
        var tableRoles;

        tableRoles = $('#tableRoles').DataTable({
            "aProcessing": true,
            "aServerSide": true,

            "ajax": {
                "url": base_url + "/Roles/getRoles",
                "dataSrc": ""
            },

            "language": {
                "sProcessing": "Procesando...",
                "sLengthMenu": "Mostrar _MENU_ registros",
                "sZeroRecords": "No se encontraron resultados",
                "sEmptyTable": "Ningún dato disponible en esta tabla",
                "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
                "sInfoPostFix": "",
                "sSearch": "Buscar:",
                "sUrl": "",
                "sInfoThousands": ",",
                "sLoadingRecords": "Cargando...",
                "oPaginate": {
                    "sFirst": "Primero",
                    "sLast": "Último",
                    "sNext": "Siguiente",
                    "sPrevious": "Anterior"
                },
                "oAria": {
                    "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                    "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                }
            },

            "columns": [{
                    "data": "idrol"
                },
                {
                    "data": "nombrerol"
                },
                {
                    "data": "descripcion"
                },
                {
                    "data": "estado"
                },
                {
                    "data": "acciones"
                }
            ],

            "responsive": "true",
            "bDestroy": true,
            "iDisplayLength": 10,
            "order": []
        });

        var formRol = document.querySelector("#formRol");
        formRol.onsubmit = function(e) {
            e.preventDefault();

            var strNombre = document.querySelector('#nombreRol').value;
            var strDescripcion = document.querySelector('#descripcionRol').value;
            var strEstado = document.querySelector('#estadoRol').value;

            if (strNombre == '' || strDescripcion == '' || strEstado == '') {
                swal("Atención", "Todos los campos son obligatorios.", "error");
                return false;
            }

            var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            var ajaxUrl = base_url + '/Roles/insertRol';
            var formData = new FormData(formRol);
            request.open("POST", ajaxUrl, true);
            request.send(formData);
            request.onreadystatechange = function() {
                if (request.readyState == 4 && request.status == 200) {

                    var objData = JSON.parse(request.responseText);

                    if (objData.status) {
                        $('#modalCrearRol').modal("hide");
                        formRol.reset();
                        swal("Roles de Usuario", objData.msg, "success");
                        tableRoles.ajax.reload();
                        /* tableRoles.api().ajax.reload(function(){
                            fntPermisos();
                            fntEditarRol();
                            fntEliminarRol();
                        }); */
                    } else {
                        swal("Error", objData.msg, "error");
                    }
                }
            }
        }

    });

    $('#tableRoles').DataTable();
</script>