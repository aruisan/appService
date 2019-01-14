<form action="{{route('certificacion.store')}}" method="POST" enctype="multipart/form-data">
@csrf
<input type="file" name="file">
<input type="submit" value="enviar">
</form>


<table>
    <tbody>
        @foreach($data as $img)
            <tr><td><img src="{{Storage::url($img->certificado)}}" width="200"></td></tr>
        @endforeach
    </tbody>
</table>