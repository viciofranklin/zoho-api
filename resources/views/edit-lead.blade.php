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
            * {
                font-family: 'Nunito';
                box-sizing: border-box;
            }
            div.container {
                width: 60%;
                margin: auto;
            }
            form {
                display: flex;
                flex-wrap: wrap;
                padding: 20px;
            }
            .input-container {
                width: 50%;
                padding: 10px 50px;
            }
            .input-container label, .input-container input {
                display: block;
                width: 100%;
            }            
            input[type=submit] {
                width: 91%;
                margin: 30px auto 0;
            }
        </style>
    </head>
    <body>
        <a href="{{route('home')}}">Torna alla home</a>
        <div class="container">
            <h1 class="title">Modifica lead</h1>
            <div class="messages">
            @if ($errors->any())
                <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
                </ul>
            @endif
            </div>
            <form action="" method="post">
                @csrf
                <div class="input-container">
                    <label for="Last_Name">Cognome*</label>
                    <input type="text" id="Last_Name" name="Last_Name" value="{{$entity['Last_Name']}}" required>
                </div>
                <div class="input-container">
                    <label for="First_Name">Nome</label>
                    <input type="text" id="First_Name" name="First_Name" value="{{$entity['First_Name']}}">
                </div>
                <input type="submit" value="Modifica">
            </form>
            <a href="{{route('entityList')}}">Torna indietro</a>
        </div>

    </body>
</html>
