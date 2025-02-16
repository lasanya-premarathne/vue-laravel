<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Cateogory->Create</h1>
    <div>
        @if($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{$error}}</li>
            @endforeach
        </ul>
        @endif
    </div>
    <form action="{{route('category.postCategory')}}" method="post">
        @csrf
        @method('post')
        <div>
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" placeholder="Enter Name">
        </div>
        <div>
            <label for="description">Description:</label>
            <input type="text" id="description" name="description" placeholder="Enter Description"></input>
        </div>
        <div>
            <button type="submit">Create Category</button>
        </div>
    </form>
</body>
</html>