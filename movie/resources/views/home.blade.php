@extends('layout')
@section('content')
    <style>
        .tablecontainer {
     width:80%;
            margin: 0 auto;
            margin-top: 4%;
        }

        .container {
            margin-top: 4%;
        }
        button{
            background-color: transparent;
            border:none;
        }
    </style>

@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
    <div class="row tablecontainer">
        <div class="col-12">
            <div class="table-responsive">
                <table class="table" id="record_table">
                    <thead>
                        <tr>
                            <th scope="col" colspan="6" style="text-align: right;">
                                <button class="btn btn-success"  data-bs-toggle="modal" data-bs-target="#fileModal"><i
                                        class="fa-solid fa-plus"></i> Add from File</button>
                                <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#formModal"><i
                                        class="fa-solid fa-plus"></i> Add from Form</button>
                            </th>
                        </tr>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Movie Name</th>
                            <th scope="col">Image URL</th>
                            <th scope="col">Released Date</th>
                            <th scope="col">Movie Type</th>
                            <th scope="col">Language</th>
                           
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $record)
                        <tr>
                            <td>{{ $record->id }}</td>
                            <td>{{ $record->name }}</td>
                            <td><a href="{{'storage/'.$record->url}}"><img style='width: 100px; object-fit: contain;' src="{{'storage/'.$record->url}}" alt=""></a></td>
                            <td>{{ $record->releasedDate }}</td>
                            <td>{{ $record->movieType }}</td>
                            <td>{{ $record->language }}</td>
                            <td>
                                
                                @php
                                    $name = $record->name;
                                    $year = $record->year;
                                 @endphp
                                <a href="{{ $record->url == '' ? route('movie.show', ['movie' => $name,'name' => $name,'year' =>$year,]) : '#' }}">
                                    <i class="fa-solid fa-arrows-rotate"></i>
                                </a>
                                <a onclick="test('{{$record->movieType}}')"><i class="fa-solid fa-pen-to-square"></i></a>
                                <form action="{{route('movie.destroy', $record->id)}}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"><i class="fa-solid fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                      
                    </tbody>
                </table>
            </div>
        </div>
    </div>






    <!-- File Modal -->
    <div class="modal fade" id="fileModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ url('file_upload') }}" method="POST" enctype="multipart/form-data"  class="form-control">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Upload File</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="file" name= "file" class="form-control">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!-- Form Modal -->
    <div class="modal fade" id="formModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('movie.store') }}" method="POST"  class="form-control">
                    @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Enter Movie Name</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="text" name="movieName" placeholder="Movie Name" class="form-control">
                </div>
                <div class="modal-body">
                    <input type="number" name="movieYear" placeholder="Movie Year" class="form-control">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <input type="submit" class="btn btn-primary" value="Submit">
                </div>
            </form>
            </div>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>

@endsection





































