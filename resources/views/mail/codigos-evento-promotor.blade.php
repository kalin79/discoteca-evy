<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0">
</head>
<body>
<p>Estimado Promotor <b>{{$promotor->nombre }}</b>, se le esta enviando su lista de codigos, asociados al evento <b>{{$evento->nombre}}</b>,
    para descargarlo de click en el siguiente enlace: {{route('frontend.evento.codigo-download',$evento_promotor_id)}}</p>
</body>
</html>
