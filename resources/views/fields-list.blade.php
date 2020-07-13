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
            .title {
                text-align: center;
            }
            .table {
                margin: auto;
            }
        </style>
    </head>
    <body>
        <a href="{{route('home')}}">Torna alla home</a>
        <div class="container">
            <h1 class="title">Lista campi</h1>
            <table class="table">
                <tr>
                    <th>Nome proprietà</th>
                    <th>Etichetta</th>
                    <th>Obbligatoria</th>
                    <th>Tipo campo</th>
                </tr>
                @foreach ($fields as $field)
                    <tr>
                        <td>{{$field['property']}}</td>
                        <td>{{$field['label']}}</td>
                        <td>{{$field['mandatory'] == 1 ? 'Si' : '-'}}</td>
                        <td>{{$field['type']}}</td>
                    </tr>
                @endforeach
            </table>
        </div>
    </body>
</html>
