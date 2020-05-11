@component('mail::message')
# Introduction

{{$content}}<br>



@component('mail::button', ['url' => 'http://leramiz.com'])
Open The Website
@endcomponent
<br>
<small>This Maassage Is sent from Your Persnoal page</small><br>
Thanks,<br>
{{ config('app.name') }}
@endcomponent
