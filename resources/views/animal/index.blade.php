<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Animals</title>
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <!-- Barra de menú -->
    <ul class="nav">
        <li class="nav-item">
            <a class="nav-link active" href={{ route('animal.index') }}>Animals</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href={{ route('animal.create') }}>Create animal</a>
        </li>
    </ul>

    <!-- contenido (tarjetas con los animales) -->
    <div class="container mt-5">
        <div class="row">
            @foreach ($animals as $animal)
            <div class="col-sm">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">{{ $animal->name }}</h5>
                    </div>
                    <div class="card-body">
                        <p class="card-text">{{ $animal->weight }} kg. {{ $animal->age }} años.
                            {{ $animal->description }}
                        </p>
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-sm">
                                <a href="{{route('animal.edit', $animal->id) }}" class="btn btn-primary btn-sm">Editar</a>
                            </div>
                            <div class="col-sm">
                                <form action="{{route('animal.destroy', $animal->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="btn btn-danger btn-sm">Eliminar</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</body>

</html>