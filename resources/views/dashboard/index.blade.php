@if (Auth::user()->role === 'admin')
@include('dashboard.admin')
@else
@include('dashboard.seller')
@endif