@extends('layouts.worker')
@section('main_content')
<form id="searchForm" method="POST" action="{{ route('worker.dish.search') }}">
    @csrf
    <input type="text" name="searchTerm" id="searchTerm" placeholder="Szukaj...">
    <select name="searchType" id="searchType">
        <option value="id">ID</option>
        <option value="name">Nazwa</option>
        <option value="dish_categories.name">Kategoria</option>
    </select>
    <button type="submit">Szukaj</button>
</form>

<form id="sortForm" method="POST" action="{{ route('worker.dish.sort') }}">
    @csrf
    <select name="sortColumn" id="sortColumn">
        <option value="id">ID</option>
        <option value="name">Nazwa</option>
        <option value="price">Cena</option>
        <option value="is_active">Dostepność</option>
        <option value="dish_categories.name">Kategoria</option>
        <option value="created_at">Data</option>
    </select>
    <select name="sortOrder" id="sortOrder">
        <option value="asc">Rosnąco</option>
        <option value="desc">Malejąco</option>
    </select>
    <button type="submit">Sortuj</button>
</form>


<table id="dishesTable" class="table table-dark border border-light">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nazwa</th>
            <th>Cena</th>
            <th>Is_active</th>
            <th>Categoria</th>
            <th>Data utworzenia</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($dishes as $dish)
            <tr>
                <td>{{$dish->id}}</td>
                <td>{{$dish->name}}</td>
                <td>{{$dish->price}}</td>
                <td>{{$dish->is_active}}</td>
                <td>{{$dish->category->name}}</td>
                <td>{{$dish->created_at}}</td>
            </tr>
        @endforeach
    </tbody>
</table>
<div class="text-white mt-3">

</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#searchForm').on('submit', function(event) {
            event.preventDefault();
            var formData = $(this).serialize();
            $.ajax({
                type: 'POST',
                url: $(this).attr('action'),
                data: formData,
                success: function(response) {
                    $('#dishesTable tbody').empty();
                    response.forEach(function(dish) {
                        $('#dishesTable tbody').append(`
                        <tr>
                            <td>${dish.id}</td>
                            <td>${dish.name}</td>
                            <td>${dish.price}</td>
                            <td>${dish.is_active}</td>
                            <td>${dish.category}</td>
                            <td>${dish.created_at}</td>
                        </tr>
                        `);
                    });
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });

        $('#sortForm').on('submit', function(event) {
            event.preventDefault();
            var formData = $(this).serialize();
            $.ajax({
                type: 'POST',
                url: $(this).attr('action'),
                data: formData,
                success: function(response) {
                    $('#dishesTable tbody').empty();
                    response.forEach(function(dish) {
                        $('#dishesTable tbody').append(`
                        <tr>
                            <td>${dish.id}</td>
                            <td>${dish.name}</td>
                            <td>${dish.price}</td>
                            <td>${dish.is_active}</td>
                            <td>${dish.category}</td>
                            <td>${dish.created_at}</td>
                        </tr>
                        `);
                    });
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });
    });
</script>

@endsection