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
                        <th>Nombre Proyecto</th>
                        <th>Descripcion</th>
                        <th>Editar</th>
                        <th>Eliminar</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($proyecto as $proyectos)
                        <tr>
                            <td>{{ $proyectos->id }}</td>
                            <td>{{ $proyectos->nombre_proyecto }}</td>
                            <td>{{ $proyectos->descripcion }}</td>
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
                                                <label for="nombre_proyecto{{ $proyectos->id }}">Unidad de proyecto</label>
                                                <input type="text" class="form-control" name="nombre_proyecto" id="nombre_proyecto{{ $proyectos->id }}" value="{{ $proyectos->nombre_proyecto}}" oninput="this.value = this.value.toUpperCase();">
                                            </div>
                                            <div class="form-group">
                                                <label for="descripcion{{ $proyectos->id }}">Abreviatura</label>
                                                <input type="text" class="form-control" name="descripcion" id="nombre_proyecto{{ $proyectos->id }}" value="{{ $proyectos->descripcion}}">
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