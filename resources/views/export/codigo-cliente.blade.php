<table>

    <tbody>
    @forelse ($codigos as  $codigo)
        @if($loop->index>0)
            <tr><td></td></tr>
        @endif

        <tr>
            <td >{{ $codigo["evento"]}} </td>

        </tr>
        <tr>
            <td >{{ $codigo["promotor"]}} </td>
        </tr>
        @foreach($codigo["zonas"] as $zona)
            <tr>
                <td style="background-color:#007bff;">{{$zona['zona']}}</td>
            </tr>
            @foreach( $zona['codigo'] as $value)
                <tr>
                    <td >{{$value}}</td>
                </tr>
            @endforeach
        @endforeach
    @empty
        <tr>
            <td colspan="4" class="text-center text-muted"><span>No se encontraron resultados</span></td>
        </tr>
    @endforelse

    </tbody>

</table>
