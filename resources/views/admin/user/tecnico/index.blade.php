<table>
    <thead>
        <th>Tecnico</th>
        <th>Activar/Desactivar</th>
        <th>Ver</th>
    </thead>
    <tbody>
        @foreach($data as $tecnico)
            <tr>
                <td>{{$tecnico->name}}</td>
                <td><a href="{{route('admin-tecnico.edit', $tecnico->id)}}">{{$tecnico->activo == 1 ? 'Activo': 'No Activo'}}</a></td>
                <td><a href="{{route('admin-tecnico.show', $tecnico->id)}}">ver</a></td>
            </tr>
        @endforeach
    </tbody>
</table>