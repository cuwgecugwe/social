<div class="mt-3">
    @if (session('success'))
        <script>
            Swal.fire({
                icon: "success",
                title: "¡Éxito!",
                text: "{{ session('success') }}"
            });
        </script>
    @endif
    @if ($errors->any())
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: "{{ $errors->first() }}"
            })
        </script>
    @endif

    <!-- formulario -->
    <div class="card card-info active">
        <div class="card-header">
            <h3 class="card-title">
                <i class="fas fa-edit mr-2"></i>
                Registrar Proyectos
            </h3>
        </div>
        <div class="card-body">
            <form method="POST" action="">
                @csrf
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="dni">DNI</label>
                            <div class="input-group">
                                <input type="search" class="form-control" name="dni" id="dni" placeholder="Ingrese el DNI" autocomplete="off" required>
                                <input type="hidden" name="estudiante_id" id="estudiante_id">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="button" id="searchButton">Search</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="nombre">Nombre</label>
                            <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Nombre" autocomplete="off" disabled>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="apellido">Apellido</label>
                            <input type="text" class="form-control" name="apellido" id="apellido" placeholder="Apellido" autocomplete="off" disabled>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nombre_proyecto">Proyecto</label>
                            <input type="text" class="form-control" name="nombre_proyecto" id='nombre_proyecto' placeholder="Escriba la proyecto" autocomplete="off" required oninput="this.value = this.value.toUpperCase();">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="descripcion">Descripcion</label>
                            <input type="text" class="form-control" name="descripcion" id='descripcion' placeholder="Escriba su descripcion" autocomplete="off" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="fecha">Fecha</label>
                            <input type="DATE" class="form-control" name="fecha" id='fecha' placeholder="Escriba su fecha" autocomplete="off" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="hora">Horas</label>
                            <input type="number" class="form-control" name="hora" id='hora' placeholder="Escriba su hora" autocomplete="off" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-info active">Registrar</button>
                </div>
            </form>
        </div>
    </div>
    
    <!-- Tabla de Proyecto -->
    <div class="card card-info active card-outline">
        <div class="card-header">
            <h3 class="card-title text-center">
                <i class="fas fa-table mr-2"></i>
                Tabla de Proyectos
            </h3>
        </div>
        <div class="card-body">
            <table id="proyecto" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Estudiante</th>
                        <th>Nombre Proyecto</th>
                        <th>Descripcion</th>
                        <th>Fecha</th>
                        <th>Horas</th>
                        <th>Editar</th>
                        <th>Eliminar</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($proyecto as $proyectos)
                        <tr>
                            <td>{{ $proyectos->id }}</td>
                            <td>{{ $proyectos->estudiantes->nombre." ".$proyectos->estudiantes->apellido }}</td>
                            <td>{{ $proyectos->nombre_proyecto }}</td>
                            <td>{{ $proyectos->descripcion }}</td>
                            <td>{{ $proyectos->fecha }}</td>
                            <td>{{ $proyectos->hora }}</td>
                            <td width="10px">
                                <a href="" class="btn btn-warning" data-toggle="modal" data-target="#editModal{{ $proyectos->id }}"><i class="fas fa-edit"></i></a>
                            </td>
                            <td width="10px">
                                <form action="{{ route('admin.proyecto.destroy', $proyectos->id) }}" method="POST" class="delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-danger btn-delete"><i class="fas fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                        <!-- Modal de edición -->
                        <div class="modal fade" id="editModal{{ $proyectos->id }}" tabindex="-1" role="dialog" aria-labelledby="editModal{{ $proyectos->id }}Label" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editModal{{ $proyectos->id }}Label">Editar proyecto</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    </div>
                                    <form action="{{ route('admin.proyecto.update', $proyectos->id) }}"
                                        method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-body">
                                            <!-- Campos del formulario de edición -->
                                            <div class="form-group">
                                                <label for="estudiante_id{{ $proyectos->id }}">Estudiante</label>
                                                <input type="text" class="form-control" name="estudiante_id" id="estudiante_id{{ $proyectos->id }}" value="{{ $proyectos->estudiantes->nombre." ".$proyectos->estudiantes->apellido}}" disabled>
                                                <input type="hidden" name="estudiante_id" value="{{ $proyectos->estudiante_id }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="nombre_proyecto{{ $proyectos->id }}">Nombre proyecto</label>
                                                <input type="text" class="form-control" name="nombre_proyecto" id="nombre_proyecto{{ $proyectos->id }}" value="{{ $proyectos->nombre_proyecto}}" oninput="this.value = this.value.toUpperCase();">
                                            </div>
                                            <div class="form-group">
                                                <label for="descripcion{{ $proyectos->id }}">Abreviatura</label>
                                                <input type="text" class="form-control" name="descripcion" id="nombre_proyecto{{ $proyectos->id }}" value="{{ $proyectos->descripcion}}">
                                            </div>
                                            <div class="form-group">
                                                <label for="fecha{{ $proyectos->id }}">Fecha</label>
                                                <input type="text" class="form-control" name="fecha" id="nombre_proyecto{{ $proyectos->id }}" value="{{ $proyectos->fecha}}">
                                            </div>
                                            <div class="form-group">
                                                <label for="hora{{ $proyectos->id }}">Hora</label>
                                                <input type="text" class="form-control" name="hora" id="nombre_proyecto{{ $proyectos->id }}" value="{{ $proyectos->hora}}">
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                                            <button type="submit" class="btn btn-info active">Guardar</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </tbody>
            </table>
        </div>
   </div>
</div>
<script>
    document.addEventListener("DOMContentLoaded", function() {
    document.getElementById("searchButton").addEventListener("click", function() {
        let dni = document.getElementById("dni").value;

        if (dni.trim() !== "") {
            fetch("{{ route('admin.proyecto.buscar') }}?dni=" + dni)
            .then(response => response.json())
            .then(data => {
                if (data.error) {
                    alert(data.error);
                } else {
                    // Autocompletar los campos de nombre, apellido y estudiante_id
                    document.getElementById("nombre").value = data.nombre;
                    document.getElementById("apellido").value = data.apellido;
                    document.getElementById("estudiante_id").value = data.estudiante_id; // Aquí se actualiza el hidden
                }
            })
            .catch(error => console.error("Error en la solicitud:", error));
        } else {
            alert("Ingrese un DNI válido.");
        }
        });
    });
</script>