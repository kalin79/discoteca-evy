<option></option>
@foreach ($zonas as $zona)
    <option value="{{$zona["id"]}}">{{$zona["nombre"]}}</option>
@endforeach
