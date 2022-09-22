<!DOCTYPE html>
<html>
<head>
  <title>Sesión expirada</title>
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <style>
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
      -webkit-font-smoothing: antialiased;
      -moz-osx-font-smoothing: grayscale;
      text-rendering: optimizeLegibility;
    }

    html, body {
      display: flex;
      justify-content: center;
      align-items: center;
      position: absolute;
      top: 0;
      right: 0;
      left: 0;
      bottom: 0;
      background-color: #fff;

      color: #6a6a6a;
      font-family: "ProximaNova", sans-serif;
      font-size: 14px;
      line-height: 18px;
    }


    button, .btn-solid
    {
      cursor: pointer;
    }

    .btn-solid {
      background-color: #3389ff;
      border: none;
      box-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
      color: #fff;
      line-height: 50px;
      font-weight: bold;
      transition: background-color 0.1s ease-out;
      border-radius: 2px;
      background-clip: padding-box;
      display: inline-block;
      height: 50px;
      padding: 0 13px;
      font-family: "ProximaNova", sans-serif;
      font-size: 25px;
      text-align: center;
      text-decoration: none;
      -webkit-user-select: none;
      -moz-user-select: none;
      -ms-user-select: none;
      user-select: none;
    }

    section {
      display: flex;
      margin-top: 180px;
      position: relative;
      align-items: center;
      flex-direction: column;
      text-align: center;
    }

    figure {
      position: absolute;
      top: -242px;
      left: 50%;
      transform: translateX(-50%);
      pointer-events: none;
    }

    h1 {
      margin-bottom: 22px;
      color: #000;
      font-size: 80px;
      font-weight: bold;
      line-height: 100%;
    }

    h2 {
      max-width: 750px;
      margin-bottom: 38px;
      color: #919191;
      font-weight: normal;
      line-height: 36px;
    }
  </style>
</head>

<body class="rails-default-error-page">
  <section>
    <header>
      <h1>Sesión expirada!</h1>
      <h2>Su sesión ah expirado, para volver a ingresar dar click en el siguiente botón.</h2>
      <a href='/interno/login' class='btn-solid' >Iniciar sesión</a>
    </header>
  </section>
</body>
</html>
