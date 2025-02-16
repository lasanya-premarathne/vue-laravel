<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Category->View</h1>
    <div>
        @if(session()->has('success'))
        <div>
            {{session('success')}}
        </div>
        @endif
    </div>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Description</th>
            <th>Actions</th>
        </tr>
        @foreach ($categories as $category)
        <tr>
            <td>{{$category->id}}</td>
            <td>{{$category->name}}</td>
            <td>{{$category->description}}</td>
            <td>
                <a href="{{ route('category.edit', ['category' => $category->id]) }}">Edit</a>
                <form method="post" action="{{ route('category.deleteCategory', ['category' => $category->id]) }}">
                    @csrf
                    @method('delete')
                    <input type="submit" value="Delete" />
                </form>
            </td>
        </tr>
        @endforeach
    </table>
</body>
</html>