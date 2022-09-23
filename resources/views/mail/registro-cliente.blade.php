<body style="background:#222222">
    <table width="800" align="center" border="0" cellspacing="0" cellpadding="0">
        <tr width="800" height="337" style="background:#222222">
            <td width="800"  valign="top" height="337" >
                <img src="https://codegraph.pe/disco/mail.jpg" width="800" height="337" style="display:block;width:800px;height:337px;border:0;padding:0;margin:0">
            </td>
        </tr>
        <tr width="800" height="201" style="background:#222222">
            <td>
                <table width="800" align="center" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td width="198"  valign="top" height="409" >
                            <img src="https://codegraph.pe/disco/1_02.jpg" width="198" height="409" style="display:block;width:198px;height:409px;border:0;padding:0;margin:0">
                        </td>
                        <td width="398"  valign="top" height="409" >
                            {{-- Aqui colocamos el QR --}}

                            <img src="{{asset('/storage/cliente/'.$cliente->id ."/qrcodes/".$cliente->imagen_qr  ) }}" width="398" height="409" style="display:block;width:398px;height:409px;border:0;padding:0;margin:0">
                        </td>
                        <td width="204"  valign="top" height="409" >
                            <img src="https://codegraph.pe/disco/1_04.jpg" width="204" height="409" style="display:block;width:204px;height:409px;border:0;padding:0;margin:0">
                        </td>

                    </tr>
                </table>
            </td>
        </tr>
        <tr width="800" height="284" style="background:#222222">
            <td>
                <table width="800" align="center" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td width="538" height="284" valign="top" style="background:#222222">
                            <p style="text-align:center; font-size: 58px; letter-spacing: -0.05em;line-height: 1.25em;font-family: 'Trebuchet MS', Arial, sans-serif; margin: 0rem 0 0 0; padding: 1.5rem 0 0 0; color: #fffdfd;">
                                <strong>{{$cliente->evento->nombre}}</strong>
                            </p>
                            <p style="text-align:center; font-size: 58px; letter-spacing: -0.05em;line-height: 1.25em;font-family: 'Trebuchet MS', Arial, sans-serif; margin: 0rem 0 0 0; padding: 1.5rem 0 0 0; color: #181818; background:#fffdfd">
                                <strong>{{$cliente->zona->nombre}}</strong>
                            </p>

                            <p style="text-align:center; font-size: 34px; letter-spacing: 0.15em;line-height: 1.25em;font-family: 'Trebuchet MS', Arial, sans-serif; margin: 0rem 0 0 0; padding: 0rem 0 0 0; color: #fffdfd;">
                                {{$cliente->nombres}} {{$cliente->apellidos}}
                            </p>

                            <p style="text-align:center; font-size: 28px; letter-spacing: 0.15em;line-height: 1.25em;font-family: 'Trebuchet MS', Arial, sans-serif; margin: 0rem 0 0 0; padding: 1.75rem 0 0 0; color: #fffdfd;">
                                DNI: {{$cliente->dni}}
                            </p>

                            <p style="text-align:center; font-size: 28px; letter-spacing: 0.15em;line-height: 1.25em;font-family: 'Trebuchet MS', Arial, sans-serif; margin: 0rem 0 0 0; padding: 1.75rem 0 0 0; color: #fffdfd;">
                                PROMOTOR: {{$cliente->promotor->nombre}}
                            </p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr >
            <td width="800" height="50" style="background:#222222"></td>
        </tr>
        <tr width="800" height="391" style="background:#222222">
            <td width="800"  valign="top" height="391" >
                 <img src="https://codegraph.pe/disco/2_06.jpg" width="800" height="391" style="display:block;width:800px;height:391px;border:0;padding:0;margin:0">
            </td>
        </tr>
    </table>
</body>
{{-- <p>
    Nombre : {{$cliente->nombres}}
    Apellidos : {{$cliente->apellidos}}
    dni : {{$cliente->dni}}
    direccion : {{$cliente->direccion}}
    Fecha nacimiento : {{$cliente->fecha_nacimiento}}
    ciudad : {{$cliente->ciudad}}
    codigo : {{$cliente->codigo}}
</p> --}}
