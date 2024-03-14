<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultados da Comparação</title>
</head>
<body>
    <h1>Resultados da Comparação</h1>

    <h2>Linhas Iguais</h2>
    <ul>
        @foreach ($results['equals'] as $result)
            <li>Linha: {{ $result['line_number'] }} - {{ implode(', ', $result['value']) }}</li>
        @endforeach
    </ul>

    <h2>Linhas Atualizadas</h2>
    <ul>
        @foreach ($results['updated'] as $result)
            <li>
                <p>Linha: {{ $result['line_number'] }}</p>
                <p>Linha Antiga: {{ implode(', ', $result['old']) }}</p>
                <p>Linha Recente: {{ implode(', ', $result['new']) }}</p>
            </li>
        @endforeach
    </ul>

    <h2>Linhas Novas</h2>
    <ul>
        @foreach ($results['news'] as $result)
            <li>Linha: {{ $result['line_number'] }} - {{ implode(', ', $result['value']) }}</li>
        @endforeach
    </ul>
</body>
</html>
