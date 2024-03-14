<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Upload Files</title>
    </head>
    <body>
        <form action="{{ url('/upload') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div>
                <label for="newest_file">Arquivo CSV Mais Recente:</label>
                <input type="file" name="newest_file" id="newest_file">
            </div>
            <div>
                <label for="oldest_file">Arquivo CSV Antigo:</label>
                <input type="file" name="oldest_file" id="oldest_file">
            </div>
            <button type="submit">Comparar Arquivos</button>
        </form>
    </body>
</html>