<?php

namespace App\Http\Controllers;

use App\Models\Form;
use App\Models\User;
use App\Models\Submitted;
use App\Events\FormCreated;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Events\SubmissionCreated;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use App\Notifications\notifyNotification;
use App\Notifications\approvalNotification;
use App\Notifications\approvedNotification;
use Illuminate\Support\Facades\Notification;
use App\Notifications\userNotifyNotification;
use PDF;

class FormBuilderController extends Controller
{
    public function index() {
       $user = User::all();
       Event::dispatch(new SubmissionCreated());
       $submitted = cache('submission', function() {
        return Submitted::get();
       });
       Event::dispatch(new FormCreated());
       $forms = cache('forms', function() {
        return Form::get();
       });
       if(Auth::user()){
        $myform = Form::with('user')->where('user_id', Auth::user()->id)->get();
        return view('index', ['user'=>$user, 'submitted'=>$submitted, 'forms'=>$forms, 'myform'=>$myform]);
       }
       return view('index', ['user'=>$user, 'submitted'=>$submitted, 'forms'=>$forms]);
    }

    public function formBuilder() {
        $user = User::whereIn('role_id', [1,2])->get();
        $allUser = User::all();
        return view('form-builder', ['user'=>$user, 'allUser'=>$allUser]);
    }

    public function createForm(Request $request) {

        $formData = $request->input('formData');

        $formFields = $formData[1];

        $validator = $request->validate([
    'formData.0' => [
        'required',
        Rule::unique('forms', 'type')->where(function ($query) use ($formData) {
            return $query->where('type', $formData[0]);
        }),
    ],
    // Add other validation rules for your fields here
], [
    'formData.0.required' => 'The form type is required.',
    'formData.0.unique' => 'A form with this type already exists.',
    // Add other custom error messages here
]);

         if (!empty($formData[6])) {
             $base64Image = $formData[6];
             $imageData = base64_decode($base64Image);
             $imageName = time().'.png'; // You can generate a unique name or use the original name if available
             $path = public_path('uploads/' . $imageName); // Change the path as per your requiremen   
             file_put_contents($path, $imageData);
             // Replace the base64 image with the image URL or path
             $formData[6] = '/uploads/' . $imageName; // Change the URL as per your requirements
         }
        // Loop through formFields and process the image, if available
        foreach ($formFields as &$field) {
            if ($field['type'] == 'file') {
                $base64Image = $field['image'];
                $imageData = base64_decode($base64Image);
                $imageName = time().'.png'; // You can generate a unique name or use the original name if available
                $path = public_path('images/' . $imageName); // Change the path as per your requirements

                file_put_contents($path, $imageData);

                // Replace the base64 image with the image URL or path
                $field['image'] = '/images/' . $imageName; // Change the URL as per your requirements
            }
        }
        if ($formData[2] == "No") {
            $form = new Form;
            $form->logo = $formData[6];
            $form->type = $formData[0];
            $form->subtitle = $formData[7];
            $form->fields = json_encode($formFields);
            $form->approval = $formData[2];
            $form->user_id = $formData[3];
            $form->notify = $formData[5];
            $form->save();
            return redirect("/forms");
        } else {
            $form = new Form;
            $form->logo = $formData[6];
            $form->type = $formData[0];
            $form->subtitle = $formData[7];
            $form->fields = json_encode($formFields);
            $form->approval = $formData[2];
            $form->approveBy = $formData[4];
            $form->user_id = $formData[3];
            $form->notify = $formData[5];
            $form->save();
            return redirect("/forms");
        }


    }

    public function displayForm() {
        $form = Form::orderBy('created_at', 'desc')->paginate(5);
        $submitted = Submitted::all();
        return view('form', ['form' => $form, 'submitted' => $submitted]);
    }

    public function displayMyForm($id) {
        $form = Form::where('user_id', $id)->orderBy('created_at', 'desc')->paginate(5);
        $submitted = Submitted::all();
        return view('myform', ['form' => $form, 'submitted' => $submitted]);
    }

    public function viewForm($id) {
        $form = Form::with('user')->where("id", $id)->get();

        return view('details', ['form' => $form]);
        //dd($form);
    }

    public function cloneForm($id) {
        $clonedForm = Form::findOrFail($id);
        $clonedFormType = $clonedForm->type;
        $clonedFormFields = $clonedForm->fields;
        $clonedFormApproval = $clonedForm->approval;
        $clonedFormApproveBy = $clonedForm->approveBy;
        $clonedFormUserID = $clonedForm->user_id;

        $form = new Form;
        $form->type = $clonedFormType. "-Copy";
        $form->fields = $clonedFormFields;
        $form->approval = $clonedFormApproval;
        $form->approveBy = $clonedFormApproveBy;
        $form->user_id = $clonedFormUserID;
        $form->save();

        if($form) {
            Session::flash('status', 'success');
            Session::flash('message', 'Successfully copied!');
        }
        return redirect("/forms");
    }

    public function deleteForm($id) {
        $form = Form::findOrFail($id);
        $form->delete();
        if($form) {
            Session::flash('status', 'success');
            Session::flash('message', 'Successfully remove form');
        }
        return redirect('/forms');
        //dd($form);
    }

    public function editViewForm($id) {
        $form = Form::findOrFail($id);
        $user = User::where('role_id', 1)->get();
        $allUser = User::all();
        return view("edit-view-form", ['form' => $form, 'user'=>$user, 'allUser'=>$allUser]);
    }

    public function editSaveForm(Request $request, $id) {
        $formData = $request->input('formData');
        $formFields = $formData[1];
        $form = Form::findOrFail($id);
        $validator = $request->validate([
            'formData.0' => [
                'required',
                Rule::unique('forms', 'type')->where(function ($query) use ($formData) {
                    return $query->where('type', $formData[0]);
                })->ignore($form->id),
            ],
            // Add other validation rules for your fields here
        ], [
            'formData.0.required' => 'The form type is required.',
            'formData.0.unique' => 'A form with this type already exists.',
            // Add other custom error messages here
        ]);

                 if(!empty($formData[5]) && base64_decode($formData[5], true) !== false) {
                     $logo = $formData[5];
                     $logoImage = base64_decode($logo);
                     $logoName = time().'.png'; // You can generate a unique name or use the original name if available
                     $path = public_path('uploads/' . $logoName); // Change the path as per your requirements
         
                     file_put_contents($path, $logoImage);
         
                     // Replace the base64 image with the image URL or path
                     $formData[5] = '/uploads/' . $logoName; // Change the URL as per your requirements
                 }
                // Loop through formFields and process the image, if available
                foreach ($formFields as &$field) {
                    if ($field['type'] == 'file') {
                        if ($field['base64'] == "No") {
                            $field['image'] == $field['image'];
                        } else {
                            $base64Image = $field['image'];
                        $imageData = base64_decode($base64Image);
                        $imageName = time().'.png'; // You can generate a unique name or use the original name if available
                        $path = public_path('images/' . $imageName); // Change the path as per your requirements

                        file_put_contents($path, $imageData);

                        // Replace the base64 image with the image URL or path
                        $field['image'] = '/images/' . $imageName; // Change the URL as per your requirements
                        }
                    }
                }
                if ($formData[2] == "No") {
                    $form->logo = $formData[5];
                    $form->type = $formData[0];
                    $form->subtitle = $formData[6];
                    $form->fields = json_encode($formFields);
                    $form->approval = $formData[2];
                    $form->notify = $formData[4];
                    $form->save();
                    return redirect("/forms");
                } else {
                    $form->logo = $formData[5];
                    $form->type = $formData[0];
                    $form->subtitle = $formData[6];
                    $form->fields = json_encode($formFields);
                    $form->approval = $formData[2];
                    $form->approveBy = $formData[3];
                    $form->notify = $formData[4];
                    $form->save();
                    return redirect("/forms");
                }


    }
//=====================================================================================================================================
    public function publish($type, $id) {

        $decodedType = urldecode(urldecode($type));

        $user = User::findOrFail($id);
        $form = Form::where("type", $type)->get();

        return view('publish', ['form' => $form, 'user'=>$user]);
    }



    public function submit(Request $request)
    {
        $formData = $request->input('formData');
        $formFields = $formData[1];
        $formNotify = $formData[5];
        $notifyArray = explode(',', json_decode($formNotify)[0]);
        $form = new Submitted;
        $form->logo = $formData[8];
        $form->type = $formData[0];
        $form->subtitle = $formData[7];
        $form->approval = $formData[2];
        $form->publisher_id = $formData[3];

        // Loop through formFields and process the image, if available
        foreach ($formFields as &$field) {
             if ($field['fieldType'] == 'file allFile') {
                if (!empty($field['value'])) {
                    $base64Image = $field['value'];
                    $imageData = base64_decode($base64Image);
                    $imageName = time().'.'.$field['fileExtension']; // You can generate a unique name or use the original name if available
                    $path = public_path('uploads/' . $imageName); // Change the path as per your requirements

                    file_put_contents($path, $imageData);

                    // Replace the base64 image with the image URL or path
                    $field['value'] = '/uploads/' . $imageName; // Change the URL as per your requirements
                } else {
                    $field['value'] = 'No File';
                }
            } else if ($field['fieldType'] == 'Signature') {
                $base64Image = $field['value'];
                $imageData = base64_decode($base64Image);
                $imageName = time().'.png'; // You can generate a unique name or use the original name if available
                $path = public_path('signature/' . $imageName); // Change the path as per your requirements

                file_put_contents($path, $imageData);

                // Replace the base64 image with the image URL or path
                $field['value'] = '/signature/' . $imageName; // Change the URL as per your requirements
            }

        }

        unset($field);

        if ($formData[2] == "pending") {
            $form->fields = json_encode($formFields) ;
            $form->usermail = $formData[6];
            $form->notify = $formNotify;
            $form->save();
            $recipientEmail = $formData[4]; // Replace with the desired recipient email address
            Notification::route('mail', $recipientEmail)
                ->notify(new approvalNotification($form->id));
            return redirect("/thankyou");
        }

        //$pdf = PDF::loadView('form-pdf', ['formData' => json_encode($formFields), 'formTitle' => $formData[0]]);

        if(isset($formData[6])) {
            Notification::route('mail', $formData[6])
            ->notify(new userNotifyNotification($pdf->output()));

            $form->fields = json_encode($formFields) ;
            $form->save();
            return redirect("/thankyou");
        }

        $form->fields = json_encode($formFields) ;
        $form->save();

        foreach ($notifyArray as $email) {
            Notification::route('mail', $email)
                ->notify(new notifyNotification($form->id, $formData[0]));
        }
        return redirect("/thankyou");
    }



    public function submittedView() {
        $submitted = Submitted::orderBy('created_at', 'desc')->get();
        return view('submitted', ['submitted'=> $submitted]);
    }

    public function submittedDetails($id) {
        $submitted = Submitted::findOrFail($id);
        return view('view-submitted', ['submitted'=> $submitted]);
    }

    public function submittedDelete($id) {
        $submitted = Submitted::findOrFail($id);
        $submitted->delete();
        if($submitted) {
            Session::flash('status', 'success');
            Session::flash('message', 'Successfully remove Submission');
        }
        return redirect('/submitted');
    }

    public function submittedBasedDelete($id, $type) {
        $form = str_replace("Form", "", $type);
        $fType = Form::where('type', $form)->first();
        $submitted = Submitted::findOrFail($id);
        $submitted->delete();
        if($submitted) {
            Session::flash('status', 'success');
            Session::flash('message', 'Successfully remove Submission');
        }
        return redirect('/submitted-based/'.$fType->slug);
    }

    public function submittedBased($formType) {
        $slugprefix = $formType . "-form";
        $submitted = Submitted::with('published')->where('slug','LIKE', "$slugprefix%")->orderBy('created_at', 'desc')->get();
        return view('submitted-based', ['submitted'=> $submitted]);
    }

    public function submittedPending($formType) {
        $submitted = Submitted::with('published')->where('type', $formType)->where('approval', 'pending')->orderBy('created_at', 'desc')->get();
        return view('approvalView', ['submitted'=> $submitted]);
    }

    public function thankyou() {
        return view('thankyou');
    }

    public function approved($id) {
        $submitted = Submitted::findOrFail($id);
        $submitted->approval = "Approved";
        $submitted->save();

        $notify = $submitted->notify;
        $notifyJson = json_decode($notify);
        $notifyArray = explode(',', $notifyJson[0]);

        foreach ($notifyArray as $email) {
            Notification::route('mail', $email)
                ->notify(new approvedNotification($submitted->id));
        }
        return redirect('forms');
    }

    public function rejected($id) {
        $submitted = Submitted::findOrFail($id);
        $submitted->approval = "Rejected";
        $submitted->save();
        return redirect('forms');
    }

    public function submission($id) {
        $submitted = Submitted::findOrFail($id);
        return view('partial.submission-main', ['submitted'=> $submitted]);
    }

    public function deleteSelectedSubmission(Request $request) {
        $selectedItems = $request->input('items');
        $submitted = Submitted::whereIn('id', $selectedItems);
        $submitted->delete();
        if($submitted) {
            Session::flash('status', 'success');
            Session::flash('message', 'Successfully deleted Submission');
        }
        return redirect('/trash-submitted');
    }


}
