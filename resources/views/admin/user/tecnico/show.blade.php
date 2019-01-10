<table>
    <tbody>
        @foreach($data->certificados as $img)
            <tr><td><img src="{{Storage::url($img->certificado)}}" width="200"></td></tr>
        @endforeach
    </tbody>
</table>