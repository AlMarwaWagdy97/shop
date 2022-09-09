@component('mail::message')
    # Hi, admin

    Product with id = {{$product->id}} is out of stock.

    Name: {{$product->title}}


    Thanks,<br>
    34ml
@endcomponent
