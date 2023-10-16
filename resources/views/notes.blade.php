@extends('app')
@section('content')
<main class=" m-3">
@if ($notes && count($notes) > 0)
<table class='table table-striped'>
         <tr>
            <th scope='col'>ID</th>
            <th scope='col'>Title</th>
            <th scope='col'>Status</th>
            <th scope='col'>DELETE</th>
            <th scope='col'>UPDATE</th>
         </tr>
         @foreach ($notes as $note)
         <tr>
            <td scope='col'>{{ $note->id }}</td>
            <td scope='col'>{{ $note->title }}</td>
            <td scope='col'>{{ $note->status }}</td>
            <td scope='col'><a href = 'notes/delete/{{ $note->id }}'>Delete</a></td>
            <td scope='col'><a href = 'notes/update/{{ $note->id }}'>Update</a></td>
         </tr>
         @endforeach
</table>
@else
  <div>No Notes. Add notes via the form below :</div>
@endif

<form method="POST" action="{{ route('notes.addNote') }}" class="card">
@csrf
<div class="form-group form-control-lg">
    <label>
        Title
        <input type="text" placeholder="Title" id="title" class="form-control" name="title" required
                                    autofocus/>                         
    </label>
         @if ($errors->has('title'))
         <span class="text-danger">{{ $errors->first('title') }}</span>
         @endif  
</div>  
<div class="form-group form-control-lg">       
    <label>
        Description
     </label>    
        <input type="text" placeholder="Description" id="description" class="form-control" name="description" required
                                    autofocus/>                                    
         @if ($errors->has('description'))
         <span class="text-danger">{{ $errors->first('description') }}</span>
         @endif 
</div> 
<div class="form-group form-control-lg">
    <label>
        Priority
        <input type="text" placeholder="Priority" id="priority" class="form-control" name="priority" required
                                    autofocus/>                                     
    </label>
         @if ($errors->has('priority'))
         <span class="text-danger">{{ $errors->first('priority') }}</span>
         @endif 
</div> 
<div class="form-group form-control-lg">        
    <button type="submit" class="btn btn-dark btn-block">Add Note</button>
</div>    
 </form>            
</main>
@endsection      