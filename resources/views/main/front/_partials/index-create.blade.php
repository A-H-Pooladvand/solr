<form action="{{ route('index.store') }}" method="POST">
    @csrf

    <div class="form-group mt-3">
        <button class="btn btn-info">CREATE TWITTER</button>
    </div>

</form>