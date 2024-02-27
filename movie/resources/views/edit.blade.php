@extends('layout')
@section('content')
    <form action="{{ route('movie.update', $data->id) }}" method="POST" class="form-control">
        @csrf
        @method('PUT')
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Edit Movie Name</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <input type="text" value="{{ $data->name }}" name="movieName" placeholder="Movie Name"
                class="form-control">
        </div>
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Edit Movie Year</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <input type="text" value="{{ $data->year }}" name="movieYear" placeholder="Movie Name"
                class="form-control">
        </div>
        <div class="modal-footer">
            <a href="{{ route('movie.index') }}" class="btn btn-secondary">Cancel</a>
            <input type="submit" class="btn btn-success" value="Update">
        </div>
    </form>
@endsection
