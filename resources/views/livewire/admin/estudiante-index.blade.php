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
                Registrar Estudiante
            </h3>
        </div>
        <div class="card-body">
            <form method="POST" action="">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nombre">Nombre Estudiante</label>
                            <input type="text" class="form-control" name="nombre" id='nombre' placeholder="Escriba la estudiante" autocomplete="off" required oninput="this.value = this.value.toUpperCase();">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="apellido">Apellido</label>
                            <input type="text" class="form-control" name="apellido" id='apellido' placeholder="Escriba su apellido" autocomplete="off" required>
                    </div>
                </div>
                 <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="dni">DNI</label>
                            <input type="text" class="form-control" name="dni" id='dni' placeholder="Ingrese el DNI" autocomplete="off" required oninput="this.value = this.value.toUpperCase();">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Carrera</label>
                            <select name="carrera_id" id="carrera_id" class="form-control"required>
                                <option selected disabled> SELECCIONE CARRERA</option>
                                @foreach($carreras as $carrera)
                                <option value="{{$carrera->id}}">
                                    {{$carrera->nombre_carrera}}
                                </option>
                                @endforeach
                            </select>
                            {{-- <input type="text" class="form-control" name="carerra_id" id='carerra_id' placeholder="Seleccione la carrera" autocomplete="off" required> --}}
                    </div>
                </div>
                 <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="promocion">Promocion</label>
                            <input type="text" class="form-control" name="promocion" id='promocion' placeholder="Ingrese la promocion" autocomplete="off" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-info active">Registrar</button>
                </div>
            </form>
        </div>
    </div>
    
    <!-- Tabla de Estudiante -->
    <div class="card card-info active card-outline">
        <div class="card-header">
            <h3 class="card-title text-center">
                <i class="fas fa-table mr-2"></i>
                Tabla de Estudiantes
            </h3>
        </div>
        <div class="card-body">
            <table id="estudiante" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>DNI</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Carrera</th>
                        <th>Promocion</th>
                        <th>Editar</th>
                        <th>Eliminar</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($estudiante as $estudiantes)
                        <tr>
                            <td>{{ $estudiantes->id }}</td>
                            <td>{{ $estudiantes->dni }}</td>
                            <td>{{ $estudiantes->nombre }}</td>
                            <td>{{ $estudiantes->apellido }}</td>
                            <td>{{ $estudiantes->carrera->nombre_carrera }}</td>
                            <td>{{ $estudiantes->promocion }}</td>
                            <td width="10px">
                                <a href="" class="btn btn-warning" data-toggle="modal" data-target="#editModal{{ $estudiantes->id }}"><i class="fas fa-edit"></i></a>
                            </td>
                            <td width="10px">
                                <form action="{{ route('admin.estudiante.destroy', $estudiantes->id) }}" method="POST" class="delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-danger btn-delete"><i class="fas fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                        <!-- Modal de edición -->
                        <div class="modal fade" id="editModal{{ $estudiantes->id }}" tabindex="-1" role="dialog" aria-labelledby="editModal{{ $estudiantes->id }}Label" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editModal{{ $estudiantes->id }}Label">Editar estudiante</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    </div>
                                    <form action="{{ route('admin.estudiante.update', $estudiantes->id) }}"
                                        method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-body">
                                            <!-- Campos del formulario de edición -->
                                            <div class="form-group">
                                                <label for="dni{{ $estudiantes->id }}">DNI</label>
                                                <input type="text" class="form-control" name="dni" id="dni{{ $estudiantes->id }}" value="{{ $estudiantes->dni}}" oninput="this.value = this.value.toUpperCase();">
                                            </div>
                                            <div class="form-group">
                                                <label for="nombre{{ $estudiantes->id }}">estudiante</label>
                                                <input type="text" class="form-control" name="nombre" id="nombre{{ $estudiantes->id }}" value="{{ $estudiantes->nombre}}" oninput="this.value = this.value.toUpperCase();">
                                            </div>
                                            <div class="form-group">
                                                <label for="apellido{{ $estudiantes->id }}">apellido</label>
                                                <input type="text" class="form-control" name="apellido" id="apellido{{ $estudiantes->id }}" value="{{ $estudiantes->apellido}}" oninput="this.value = this.value.toUpperCase();">
                                            </div>
                                            <div class="form-group">
                                                <label for="promocion{{ $estudiantes->id }}">Promocion</label>
                                                <input type="text" class="form-control" name="promocion" id="promocion{{ $estudiantes->id }}" value="{{ $estudiantes->promocion}}" oninput="this.value = this.value.toUpperCase();">
                                            </div>
                                            <div class="form-group">
                                                <label for="carrera_id{{ $estudiantes->id }}">Carrera</label>
                                                <select name="carrera_id" id="carrera_id" class="form-control"required>
                                                    <option selected disabled> SELECCIONE CARRERA</option>
                                                    @foreach($carreras as $carrera)
                                                    <option value="{{$carrera->id}}">
                                                        {{$carrera->nombre_carrera}}
                                                    </option>
                                                    @endforeach
                                                </select>
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