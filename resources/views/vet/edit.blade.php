<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit vet</title>
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <!-- Barra de menú -->
    @include('navbar')

     <!-- Mostrar los posibles errores al rellenar el formulario -->
     @if ($errors->any())
        @foreach ($errors->all() as $error)
        <div class="alert alert-danger" role="alert">
            {{$error}}
        </div>
        @endforeach
    @endif

    <!-- contenido (formulario de edición del animal) -->
    <div class="container">
        <form action={{route('vet.update', $vet)}} method="post">
            @csrf
            @method("PUT")
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" name="name" value={{$vet->name}}>
            </div>
            <div class="form-group">
                <label for="weight">Email</label>
                <input type="email" class="form-control" name="email" value={{$vet->email}}>
            </div>
            <div class="form-group">
                <label for="age">Phone</label>
                <input type="text" class="form-control" name="phone" value={{$vet->phone}}>
            </div>
            <div class="form-group">
                <label for="description">Address</label>
                <input type="text" class="form-control" name="address" value={{$vet->address}}>
            </div>

            <button type="submit" class="btn btn-primary mt-3">Edit</button>
        </form>
    </div>

</body>

</html>