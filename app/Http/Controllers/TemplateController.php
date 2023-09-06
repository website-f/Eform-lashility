<?php

namespace App\Http\Controllers;

use App\Models\Form;
use App\Models\Submitted;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Notifications\notifyNotification;
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

       // Replace with the desired recipient email address
            /*Notification::route('mail', 'Thehairtric@gmail.com')
                ->notify(new notifyNotification()); */
                Notification::route('mail', 'fitri@jantzen.com')
                ->notify(new notifyNotification());

        $form = new Submitted;
        $form->logo= $formData[5];
        $form->type = $formData[0];
        $form->subtitle = $formData[4];
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

    public function delSponsor($id) {
        $submitted = Submitted::findOrFail($id);
        $submitted->delete();
        return redirect('/sponsorship-submission');
    }

    /*public function submitTempSign(Request $request) {
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
    }*/

    public function massUpdate() {
        $form = Form::all();
        collect($form)->map(function($item){
            $item->slug = Str::slug($item->type, '-');
            $item->save();
        });
    }

    public function report() {
        $submitted = Submitted::all();
        $form = Form::orderBy('created_at', 'desc')->get();
        return view('report', ['submitted' => $submitted, 'form' => $form]);
    }

    public function reportView($type) {
        $startDate = date('Y-m-d 00:00:00');
        $endDate = date('Y-m-d 23:59:59');
        if ($type == "INTAKE & CONSENT FORM") {
            $submitType = $type;
            $submitted = Submitted::where('type', $type)->whereBetween('created_at', [$startDate, $endDate])->get();
            $submittedAll = Submitted::where('type', $type)->get();
            $chartsData = [];
        } else {
            $submitType = $type;
            $submitted = Submitted::where('type', $type." Form")->whereBetween('created_at', [$startDate, $endDate])->get();
            $submittedAll = Submitted::where('type', $type." Form")->get();
            $chartsData = [];
        }
        
        return view('report-view', ['submittedAll' => $submittedAll, 'submitted' => $submitted, 'submitType' => $submitType, 'chartsData' => $chartsData]);
    }

    public function generateReport(Request $request, $type) 
    {
        // Validate and process the form input, including group_by, start_date, end_date, etc.
        $groupBysArray = $request->input('group_by');
        // Explode the input string into an array
        $groupBys = explode(',', $groupBysArray);
        // Trim each value to remove any leading or trailing spaces
        $groupBys = array_map('trim', $groupBys);

        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $startDate = date('Y-m-d 00:00:00', strtotime($startDate));
        $endDate = date('Y-m-d 23:59:59', strtotime($endDate));
        $startReportDate = date('d-m-Y', strtotime($startDate));
        $endReportDate = date('d-m-Y', strtotime($endDate));

        if ($type == "INTAKE & CONSENT FORM") {
            $submitType = $type;
            $submitted = Submitted::where('type', $type)->whereBetween('created_at', [$startDate, $endDate])->get();
            $submittedAll = Submitted::where('type', $type)->get();
        } else {
            $submitType = $type;
            $submitted = Submitted::where('type', $type." Form")->whereBetween('created_at', [$startDate, $endDate])->get();
            $submittedAll = Submitted::where('type', $type." Form")->get();
        }
    
        $chartsData = [];
        if (empty($groupBys) || (count($groupBys) === 1 && $groupBys[0] === "")) {
            
            $chartsData = null;

            return view('report-view', [
                'chartsData' => $chartsData,
                'submitType' => $submitType,
                'submitted' => $submitted,
                'submittedAll' => $submittedAll,
                'startdate' => $startReportDate,
                'enddate' => $endReportDate,
            ]);
        } else {
            foreach ($groupBys as $groupBy) {
            
                $chartsData[] = [
                    'group_by' => $groupBy,
                    'chartLabels' => $groupBy,
                ];
            }
        
            return view('report-view', [
                'chartsData' => $chartsData,
                'submitType' => $submitType,
                'submitted' => $submitted,
                'submittedAll' => $submittedAll,
                'startdate' => $startReportDate,
                'enddate' => $endReportDate,
            ]);
        }
    
    }
}
