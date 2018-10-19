<form action="{{ route('index.truncate') }}" method="POST">
    @csrf

    <div class="form-group">
        <button class="btn btn-info">TRUNCATE TWITTER</button>
    </div>

</form>