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
            .table {
                margin: auto;
            }
            .nuovo {
                text-align: center;
            }
        </style>
    </head>
    <body>
        <a href="{{route('home')}}">Torna alla home</a>
        <div class="container">
            <table class="table">
                <tr>
                    <th>Cognome</th>
                    <th>Nome</th>
                    <th></th>
                    <th></th>
                </tr>
                @foreach ($entities as $entity)
                    <tr>
                        <td>{{$entity['Last_Name']}}</td>
                        <td>{{$entity['First_Name']}}</td>
                        <td><a href="/leads/edit/{{$entity['id']}}">Modifica</a></td>
                        <td><a href="/leads/delete/{{$entity['id']}}">Elimina</a></td>
                    </tr>
                @endforeach
            </table>

            <p class="nuovo">
                <a href="{{route('entityCreate')}}">Crea nuovo</a>
            </p>
        </div>
    </body>
</html>
