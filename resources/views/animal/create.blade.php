<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create animal</title>
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    @include('navbar')
    <?php //var_dump($vets);
    ?>

    <!-- contenido (formulario de edición del animal) -->
    <div class="container">
        <form action={{route('animal.store')}} method="post">
            @csrf
            @method("POST")
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" name="name">
            </div>
            <div class="form-group">
                <label for="weight">Weight</label>
                <input type="number" class="form-control" name="weight">
            </div>
            <div class="form-group">
                <label for="age">Age</label>
                <input type="number" class="form-control" name="age">
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <input type="text" class="form-control" name="description">
            </div>
            <div class="form-group">
                <label for="ownername">Owner's name</label>
                <input type="text" class="form-control" name="ownername">
            </div>
            <div class="form-group">
                <label for="ownerphone">Owner's phone</label>
                <input type="text" class="form-control" name="ownerphone">
            </div>
            <div class="form-group">
                <label for="vets">Vet</label>
                <select name="vets" class="form-select" aria-label="Default select example">
                    <option value="" selected>Clear selection</option>
                    @foreach ($vets as $v)
                        <option value="{{$v->id}}">{{$v->name}}</option>
                    @endforeach
                </select>
            </div>


            <button type="submit" class="btn btn-primary mt-3">Create</button>
        </form>
    </div>


</body>

</html>