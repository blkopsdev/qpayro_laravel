<!DOCTYPE html>
<html>
    <head>
        <title>Be right back.</title>
        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
        <style>
            html, body { height: 100%;}
            body {
                margin: 0;
                padding: 0;
                width: 100%;
                color: #B0BEC5;
                display: table;
                font-weight: 100;
                font-family: 'Lato';
            }
            .container {
                text-align: center;
                display: table-cell;
                vertical-align: middle;
            }
            .content {
                text-align: center;
                display: inline-block;
            }
            .title {
                font-size: 72px;
                margin-bottom: 40px;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="content">
                <div class="title">QPAYPRO</div>
                <div class="">
                    @if(env('APP_DEBUG'))
                        {{ $e->getMessage() }}
                    @else
                    Ha ocurrido un error. Si el problema persiste contacte al administrador del sitio
                    <a href="mailto:soporte@qpaypro.com" target="_blank">soporte@qpaypro.com
                    </a>
                    @endif</div>
            </div>
        </div>
    </body>
</html>
