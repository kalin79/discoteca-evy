<!DOCTYPE html>
<html lang="es">
<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <meta http-equiv="X-UA-Compatible" content="ie=edge">
     <title>Visualizar Cliente</title>
     <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,300;1,600&family=Roboto:wght@100;400;700&family=Saira+Condensed:wght@500;600;700;800&display=swap" rel="stylesheet">
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
</head>
<style type="text/css">
     body{
          background: #222222;
     }
     .card-body, .card{
          background: #222222;
          border-color: #222222;
     }
     .boxLogo{
          margin-top: 2rem;
     }
     .boxLogo img{
          width: 15rem;
     }
     h5, p{
          color: white;
          font-family: 'Poppins';
          font-size: 25px;
          text-align: center;
          font-weight: 100;
          line-height: 1em;
     }
     h5.card-title{
          /* margin-top: .5rem; */
          margin-bottom: 1rem;
          font-size: 20px;
          font-weight: 600;
          line-height: 1em;
     }
     h5.card-title2{
          background: white;
          line-height: 1.5em;
          color: #222222;
          font-size: 25px;
          font-weight: 700;
          font-family: 'Roboto';
          margin-bottom: 1.25rem;
          /* line-height: 1.5em; */
     }
     .btn-primary{
          font-size: 18px;
          font-family: 'Roboto';
          font-weight: 600;
          margin-top: 1rem;
          padding-left: 2rem;
          padding-right: 2rem;
     }
     .boxCenter{
          height: 100vh;
     }
</style>
<body>
     <div class="container">
          <div class="d-flex justify-content-center align-items-center boxCenter">

               <div class="card">
                    <div class="d-flex justify-content-center align-items-center boxLogo">
                         <img src="{{ asset('frontend/logo3.png') }}" />
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{route('cliente.store.qr',$cliente->id)}}">
                            @csrf
                             <h5 class="card-title">CLIENTE</h5>
                             <h5 class="card-title">{{$cliente->evento->nombre}}</h5>
                             <h5 class="card-title2">{{$cliente->zona->nombre}}</h5>
                             <p class="card-text">{{$cliente->nombres}} {{$cliente->apellidos}}</p>
                             <p class="card-text">DNI: {{$cliente->dni}}</p>
                             <p class="card-text">Promotor: {{$cliente->promotor->nombre}}</p>
                             <div class="d-flex justify-content-center align-items-center">
                                  <button type="submit" class="btn btn-primary">REGISTRAR</button>
                             </div>
                        </form>
                    </div>

               </div>
          </div>
     </div>
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
</body>
</html>
