
@if($errors->any())
{{ implode('', $errors->all('<div>:message</div>')) }}
@endif  

<<<<<<< HEAD
<form action="{{ route('register') }}" method="post">

=======
<form action="{{ route('record') }}" method="post" enctype="multipart/form-data">
<input type="file" name="avatar">
>>>>>>> origin/backend
<button type="submit">send</button>
    @csrf
</form>