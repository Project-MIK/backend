
@if($errors->any())
{{ implode('', $errors->all('<div>:message</div>')) }}
@endif  

<form action="{{ route('record') }}" method="post" enctype="multipart/form-data">
<input type="file" name="avatar">
<button type="submit">send</button>
    @csrf
</form>