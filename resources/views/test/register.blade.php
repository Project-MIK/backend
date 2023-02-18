
@if($errors->any())
{{ implode('', $errors->all('<div>:message</div>')) }}
@endif  

<form action="{{ route('register') }}" method="post">

<button type="submit">send</button>
    @csrf
</form>