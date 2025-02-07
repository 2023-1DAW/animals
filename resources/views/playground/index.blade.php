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
    @include('navbar')

    <!-- Búsqueda -->
    <h2 class="m-3">Search</h2>
    <div class="container mt-1">
        <form action={{route('playground.filtrar')}} method="post">
            @csrf
            @method('POST')
            <div class="row">
                <div class="col-10">
                    <input type="text" name="name" class="form-control" placeholder="Enter animal name to search...">
                </div>
                <div class="col-1">
                    <button type="submit" class="btn btn-primary mb-2">Search</button>
                </div>
            </div>
        </form>
    </div>

    <!-- contenido (tarjetas con animales) -->
    <h2 class="m-3">Animals</h2>
    @if (isset($filter))

    @if ($filter != null)
    <h5 class="m-3">Filtered by animal name = {{$filter}}</h5>
    @endif
    @endif
    <div class="container mt-1">
        <div class="row">
            @foreach ($animals as $animal)
            <div class="col-sm mb-3">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">{{ $animal->name }}</h5>
                    </div>
                    <div class="card-body">
                        <p class="card-text">{{ $animal->weight }} kg. {{ $animal->age }} años.
                            {{ $animal->description }} - {{$animal->created_at}} {{$animal->updated_at}} {{$animal->id}}
                        </p>
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-sm">
                                <a href="{{route('animal.edit', $animal) }}" class="btn btn-primary btn-sm">Edit</a>
                            </div>
                            <div class="col-sm">
                                <form action="{{route('animal.destroy', $animal) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            </div>
                            <div class="col-sm">
                                <a href="{{route('animal.show', $animal) }}" class="btn btn-success btn-sm">Show</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <h2 class="m-3">Vets</h2>
    <!-- contenido (tarjetas con vets) -->
    <div class="container mt-1">
        <div class="row">
            @foreach ($vets as $v)
            <div class="col-sm mb-3">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">{{$v->name}}</h5>
                    </div>
                    <div class="card-body">
                        <p class="card-text">Email: {{$v->email}}. Teléfono: {{$v->phone}}.
                            @if ($v->address != null)
                            Dirección: {{$v->address}}
                            @endif
                        </p>
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-sm">
                                <a href={{route('vet.edit', $v)}} class="btn btn-primary btn-sm">Edit</a>
                            </div>
                            <div class="col-sm">
                                <form action="{{route('vet.destroy', $v) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="btn btn-danger btn-sm">Delete</button>
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