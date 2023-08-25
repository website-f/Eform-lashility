<?php

namespace App\Http\Controllers;

use App\Models\Form;
use App\Models\Submitted;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class RecycleController extends Controller
{
    public function trashForm() {
       $form = Form::onlyTrashed()->get();
       return view('trash-form', ['form'=>$form]);
    }

    public function trashFormRestore($id) {
        $deletedForm = Form::withTrashed()->where('id', $id)->restore();

        if($deletedForm) {
            Session::flash('status', 'success');
            Session::flash('message', 'Successfully restore form');
        }
        return redirect('forms');
    }

    public function trashFormDelete($id) {
        $form = Form::withTrashed()->where('id', $id)->first();
        $formField = json_decode($form->fields, true);
        foreach ($formField as $field) {
            if(isset($field['type']) && $field['type'] == 'file' && isset($field['image'])) {
                $imagePath = str_replace('\/', '/', $field['image']);

                // Delete the image
                $fullImagePath = public_path($imagePath);
                unlink($fullImagePath);
            }
        }
        $form->forceDelete();
        if($form) {
            Session::flash('status', 'success');
            Session::flash('message', 'Successfully deleted form');
        }
        return redirect('forms');
    }

    public function trashSubmitted() {
        $submitted = Submitted::onlyTrashed()->get();
        return view('trash-submitted', ['submitted'=>$submitted]);
    }

    public function trashSubmittedRestore($id) {
        $deletedSubmitted = Submitted::withTrashed()->where('id', $id)->restore();

        if($deletedSubmitted) {
            Session::flash('status', 'success');
            Session::flash('message', 'Successfully restore Submission');
        }
        return redirect('/submitted');
    }

    public function trashSubmittedDelete($id) {
        $submitted = Submitted::withTrashed()->where('id', $id);
        $submitted->forceDelete();
        if($submitted) {
            Session::flash('status', 'success');
            Session::flash('message', 'Successfully deleted Submission');
        }
        return redirect('/submitted');
    }
}
