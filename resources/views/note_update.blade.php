@extends('app')
@section('content')

<h3 class="card-header text-center">User Data :</h3>  
<form action="{{ route('notes.editRecord') }}" method = "POST">
@csrf
                            <div class="form-group m-3">
                                <input type="hidden" placeholder="Id" id="id" class="form-control" name="id"
                                    autofocus value="{{$note->id}}"/>
                            </div>
                            <div class="form-group m-3">
                                <label>
                                Title
                                </label>
                                <input type="text" placeholder="Title" id="title" class="form-control" name="title" required
                                    autofocus value="{{$note->title}}">
                                
                                @if ($errors->has('title'))
                                <span class="text-danger">{{ $errors->first('title') }}</span>
                                @endif
                            </div>
                            <div class="form-group m-3">
                                <label>
                                Description
                                </label>
                                <input type="text" placeholder="Description" id="description" class="form-control" name="description" required
                                    autofocus value="{{$note->description}}">
                               
     
                                @if ($errors->has('description'))
                                <span class="text-danger">{{ $errors->first('description') }}</span>
                                @endif
                            </div>
                            <div class="form-group m-3">
                                <label>
                                Status
                                </label>
                                <input type="text" placeholder="Status" id="status" class="form-control" name="status" required
                                    autofocus value="{{$note->status}}">
                                
                                @if ($errors->has('status'))
                                <span class="text-danger">{{ $errors->first('status') }}</span>
                                @endif
                            </div>
                            <div class="form-group m-3">
                                <label>
                                Priority
                                </label>
                                <input type="text" placeholder="Priority" id="priority" class="form-control" name="priority" required
                                    autofocus value="{{$note->priority}}">
                                
                                @if ($errors->has('priority'))
                                <span class="text-danger">{{ $errors->first('priority') }}</span>
                                @endif
                            </div>
                            <button type="submit" class="btn btn-dark btn-block m-3">Update</button>
</form>
@endsection