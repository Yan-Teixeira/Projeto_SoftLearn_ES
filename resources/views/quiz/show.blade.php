<!DOCTYPE html>
<html>
<head>
    <title>Responder Pergunta</title>
</head>
<body>
    <h2>{{ $question['pergunta'] }}</h2>

    <ul>
        @foreach ($question['alternativas'] as $alt)
            <li>{{ $alt }}</li>
        @endforeach
    </ul>

    <p><strong>Resposta correta:</strong> {{ $question['resposta'] }}</p>

    <a href="/piloto-qa">Voltar</a>
</body>
</html>
