<?php

namespace App\Http\Controllers;

use App\Models\Form;
use App\Models\Submitted;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Notifications\approvalNotification;
use Illuminate\Support\Facades\Notification;

class TemplateController extends Controller
{
    public function readyMade() {
       $submitted = Submitted::all();
       return view('readyMade', ['submitted'=> $submitted]); 
    }

    public function sponsor() {
        return view('template.sponsorship-form');
    }

    public function sponsorPublish() {
        return view('template.sponsorship-form-published');
    }

    public function signupForm() {
        return view('template.19LsignupForm');
    }

    public function signupFormPublish() {
        return view('template.19LsignupFormpublish');
    }

    public function submitTemp(Request $request)
    {
        $formData = $request->input('formData');

        $formFields = $formData[1];
        $formJsonField = json_encode($formFields);
        // Loop through formFields and process the image, if available
        foreach ($formFields as &$field) {
             if ($field['fieldType'] === 'Signature') {
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

        if ($formData[2] == "pending") { // Replace with the desired recipient email address
            Notification::route('mail', 'gitdev1234@gmail.com')
                ->notify(new approvalNotification());
        
            $form = new Submitted;
            $form->type = $formData[0];
            $form->fields = json_encode($formFields) ;
            $form->approval = $formData[2];
            $form->publisher_id = $formData[3];
            $form->save();
            return redirect("/thankyou");
        }

        $form = new Submitted;
        $form->type = $formData[0];
        $form->fields = json_encode($formFields) ;
        $form->approval = $formData[2];
        $form->publisher_id = $formData[3];
        $form->save();
        return redirect("/thankyou");
    
    }

    public function sponsorshipSubmission() {
        $submitted = Submitted::where('type', 'Intake & Consent Form')->orderBy('created_at', 'desc')->get();
        return view('template.sponsorship-submission', ['submitted'=>$submitted]);
    }

    public function signupSubmission() {
        $submitted = Submitted::where('type', '19L Sign Up Form')->orderBy('created_at', 'desc')->get();
        return view('template.19LSignUp-submission', ['submitted'=>$submitted]);
    }

    public function submitTempSign(Request $request) {
        $formData = $request->input('formData');

        $formFields = $formData[1];
        $formJsonField = json_encode($formFields);

        // Loop through formFields and process the image, if available
        foreach ($formFields as &$field) {
             if ($field['fieldType'] == 'file') {
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

        $form = new Submitted;
        $form->type = $formData[0];
        $form->fields = json_encode($formFields) ;
        $form->publisher_id = $formData[2];
        $form->save();
        return redirect("/thankyou");
    }
}
