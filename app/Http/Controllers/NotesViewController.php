<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class NotesViewController extends Controller {
   public function index(){
      if(Auth::check()){
        $userId = auth()->user()->id;

        $notes = DB::select('select * from notes where userId = ?',[$userId]);
        return view('notes',['notes'=>$notes]);
      }

    return redirect("login")->withSuccess('You are not allowed to access');
   }

   public function addNote(Request $request){
    $request->validate([
      'title' => 'required|max:25',
      'description' => 'required|min:15|max:250',
      'priority' => 'required|max:25',
    ]);

        $title = $request -> title;
        $description = $request -> description;
        $priority = $request -> priority;
        $userId = auth()->user()->id;

        try {
          DB::insert('insert into notes (userId,title,description,priority,status) values (?, ?, ?, ?, ?)', [$userId,$title, $description,$priority,'INCOMPLETE']);
          
          return redirect("notes")->withSuccess('Success');
        } catch (Throwable $th) {
          return redirect("notes")->withSuccess('Unsuccessful');
        }
   }

   public function removeNote($id){
    try {
      DB::delete('delete from notes where id = ?',[$id]);

      return redirect("notes")->withSuccess('Success');
    } catch (Throwable $th) {
      return redirect("notes")->withSuccess('Unsuccessful');
    }
   
    return redirect("login")->withSuccess('Unautharized');
   }

   public function editRecord(Request $request){
    $request->validate([
      'id' => 'required',
      'title' => 'required|max:25',
      'description' => 'required|min:15|max:250',
      'priority' => 'required|max:25',
      'status' => 'required|max:25',
    ]);

    $id = $request -> id;
    $title = $request -> title;
    $description = $request -> description;
    $priority = $request -> priority;
    $status = $request -> status;

    try {
      DB::table('notes')
              ->where('id', $id)
              ->update([
                'title' => $title,
                'description' => $description,
                'priority' => $priority,
                'status' => $status,
            ]);
      
      return redirect("notes")->withSuccess('Success');
    } catch (Throwable $th) {
      return redirect("notes")->withSuccess('Unsuccessful');
    }
   
    return redirect("login")->withSuccess('Unautharized');
   }

   public function getNote($id){
    $note = DB::select('select * from notes where id = ?',[$id]);
    
    return view("note_update",['note'=>$note[0]]);
   }
}