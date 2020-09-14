<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>New Order</title>
    </head> 
    <body>
        <h1> {{$details['title']}} </h1>
        
        <div>{{$details['user']->name}}</div>
        <div>{{$details['user']->address}}</div>
        <div>{{$details['user']->phone_number}}</div>
        
        @foreach (session('cart') as $item)
            <div>{{$item['name']}}</div>
            <div>{{$item['qty']}}</div>
        @endforeach
        <p>Thank you</p>
    </body>
</html>