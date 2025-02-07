    <!-- Barra de menú -->
    <ul class="nav">
        <li class="nav-item">
            <a class="nav-link active" href={{ route('animal.index') }}>Animals</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href={{ route('animal.create') }}>Create animal</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href={{ route('vet.index') }}>Vets</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href={{ route('vet.create') }}>Create vet</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href={{ route('playground.index') }}>Playground</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href={{ route('dbtest.inserts') }}>DB Inserts</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href={{ route('dbtest.search') }}>DB Searchs</a>
        </li>
    </ul>