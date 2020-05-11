@component('mail::message')
# Introduction

{{$content}}<br>



@component('mail::button', ['url' => 'http://leramiz.com/property/'.$propid])
See The Property
@endcomponent
<br>
<small> Your Property Id is  {{$propid}}</small><br>
Thanks,<br>
{{ config('app.name') }}
@endcomponent
