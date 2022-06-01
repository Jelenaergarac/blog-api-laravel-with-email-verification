@component('mail::message')
# Introduction

Dear {{ $user->firstName }}, Your Registartion has been successfully completed!
@component('mail::button', ['url' => route('posts.create',$user)])
Create Your Posts Here!
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
