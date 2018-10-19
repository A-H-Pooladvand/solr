<form action="{{ route('index.destroy') }}" method="POST">
    @csrf

    <div class="form-group">
        <button class="btn btn-info">DELETE TWITTER</button>
    </div>

</form>