@component('mail::message')
    # Hotel Edited Confirmation

    There has been an action perform on this item with id: {{$hotel->id}} details are below:
    Name: {{$hotel->hotel_name}}
    Address: {{$hotel->address}}
    City: {{$hotel->city}}
    Rate: {{$hotel->stars}}
    Description: {{$hotel->description}}

    Thanks,
    {{ config('app.name') }}
@endcomponent
