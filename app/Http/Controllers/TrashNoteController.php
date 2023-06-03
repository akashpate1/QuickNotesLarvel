<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TrashNoteController extends Controller
{
    public function index(){

        $notes = Auth::user()->notes()->onlyTrashed()->latest('updated_at')->paginate(5);

        return view('notes.index')->with('notes',$notes);
    }

    public function show(Note $note){

        if(!$note->user()->is(Auth::user())){
            return abort(403);
        }

        return view('notes.show')->with('note',$note);
    }

    public function update(Note $note){

        if(!$note->user()->is(Auth::user())){
            return abort(403);
        }

        $note->restore();

        return to_route('notes.show',$note)->with("success","Note restored successfully");
    }

    public function delete(Note $note){

        if(!$note->user()->is(Auth::user())){
            return abort(403);
        }

        $note->forceDelete();

        return to_route('trash.notes',$note)->with("success","Note deleted successfully");
    }
}
