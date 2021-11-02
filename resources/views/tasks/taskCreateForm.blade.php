<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Task application</title>
</head>
<body>
    <h1>New task form:</h1>
    <form method="post" action="{{ route('tasks.store') }}">
        @csrf
        <p><label for="name">Enter task title:</label></p>
        <input id="name" type="text" name="title" placeholder="title">

        <p><label for="content">Enter task description:</label></p>
            <textarea id="content" name="content" rows="5" cols="40" placeholder="content"></textarea>

        <p><button type="submit">Submit</button></p>
    </form>
</body>
</html>
