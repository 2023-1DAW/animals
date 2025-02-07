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

    <!-- contenido (formulario de edición del animal) -->
    <div class="container">
        <form action={{route('animal.update', $animal)}} method="post">
            @csrf
            @method("PUT")
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" name="name" value={{$animal->name}}>
            </div>
            <div class="form-group">
                <label for="weight">Weight</label>
                <input type="number" class="form-control" name="weight" value={{$animal->weight}}>
            </div>
            <div class="form-group">
                <label for="age">Age</label>
                <input type="number" class="form-control" name="age" value={{$animal->age}}>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <input type="text" class="form-control" name="description" value={{$animal->description}}>
            </div>
            <div class="form-group">
                <label for="description">Owner's name</label>
                <input type="text" class="form-control" name="ownername"
                    value=@if ($animal->owner != null) {{$animal->owner->name}}
                @endif >
            </div>
            <div class="form-group">
                <label for="description">Owner's phone</label>
                <input type="text" class="form-control" name="ownerphone"
                    @if ($animal->owner != null)
                value={{$animal->owner->phone}}
                @endif >
            </div>
            <div class="form-group">
                <label for="vets">Vet</label>
                <select name="vets" class="form-select" aria-label="Default select example">
                    <option value="" selected>Clear selection</option>
                    @foreach ($vets as $v)
                    @if ($animal->vet!=null && $v->id == $animal->vet->id)
                    <option value="{{$v->id}}" selected>{{$v->name}}</option>
                    @else
                    <option value="{{$v->id}}">{{$v->name}}</option>
                    @endif
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary mt-3">Edit</button>
        </form>
    </div>

</body>

</html>