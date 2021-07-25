<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <div class="container">
        <div>
            <h2 style="color: orangered">{{ $data['type'] }}</h2>
            <strong>
                <p>{{ $data['thanks'] }}</p>
            </strong>
            <p>Mã đơn: {{ $data['id_bill'] }}</p>
            <p> {{ $data['content'] }}</p>
        </div>
    </div>
</body>

</html>
