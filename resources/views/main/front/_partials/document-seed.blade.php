<form action="{{ route('index.seed') }}" method="POST">
    @csrf

    <div class="form-group mt-3">
        <button class="btn btn-info">SEED TWITTER</button>
    </div>

</form>