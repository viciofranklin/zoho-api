<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.8.2/css/bulma.min.css">
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <style>
            p.error {
                color: red;
            }
            p.success {
                color: green;
            }
            p {
                text-align: center;
            }
        </style>
    </head>
    <body>
        <div class="container">
            @if(Session::has('status') && Session::get('status') == 'success')
                <p class="{{ Session::get('status') }} title">Operazione effettuata con successo</p>
            @else 
                <p class="error title">Operazione non eseguita</p>
            @endif
            <a href="{{ route('home') }}">Torna alla home</a>
        </div>

    </body>
</html>
