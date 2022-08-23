@component('mail::message')
    # Add Hotel Confirmation

    Hotel record has been created with id: {{$hotel->id}} details are below:
    Name: {{$hotel->hotel_name}}
    Address: {{$hotel->address}}
    City: {{$hotel->city}}
    Rate: {{$hotel->stars}}
    Description: {{$hotel->description}}

    Thanks,
    {{ config('app.name') }}
@endcomponent
