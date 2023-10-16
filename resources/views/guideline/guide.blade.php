@extends('partial.main')

@section('title', 'Guidelines')
    
@section('content')
<section class="section">
    <div class="row">
      <div class="col-lg-12">

        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Eform Guidelines</h5>

            <!-- Default Accordion -->
            <div class="accordion" id="accordionExample">
              <div class="accordion-item">
                <h2 class="accordion-header" id="headingOne">
                  <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    How to create/build a form ?
                  </button>
                </h2>
                <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                  <div class="accordion-body">
                   <p><strong>1. First 'click' on the 'Create Form' button here</strong></p>
                   <img src="{{asset('assets/guide/eformGuide.png')}}" class="img-fluid mb-2"> <br>
                   <p><strong>2. After that you can see all the fields here</strong></p>
                   <img src="{{asset('assets/guide/eformGuideCreateForm.png')}}" class="img-fluid"> <br>
                   <p><strong>3. Below is the video on how to create the form</strong></p>
                   <video class="img-fluid" controls>
                    <source src="{{asset('assets/guide/eform-vid.mp4')}}" type="video/mp4">
                    Your browser does not support the video tag.
                  </video>
                  </div>
                </div>
              </div>
              <div class="accordion-item">
                <h2 class="accordion-header" id="headingTwo">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                    How to check all my form ?
                  </button>
                </h2>
                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                  <div class="accordion-body">
                    <p><strong>1. To check all your created forms, you need to click here</strong></p>
                   <img src="{{asset('assets/guide/eformGuideMyForms.png')}}" class="img-fluid mb-2"> <br>
                   <p><strong>1. To check all available forms, you need to click here</strong></p>
                   <img src="{{asset('assets/guide/eformGuideAllForms.png')}}" class="img-fluid mb-2"> <br>
                  </div>
                </div>
              </div>
              <div class="accordion-item">
                <h2 class="accordion-header" id="headingThree">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                   How to make a report ?
                  </button>
                </h2>
                <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                  <div class="accordion-body">
                    <p><strong>1. To make a report, you need to click here and select the form that you want</strong></p>
                    <img src="{{asset('assets/guide/eformGuideReport.png')}}" class="img-fluid mb-2"> <br>
                  </div>
                </div>
              </div>
            </div><!-- End Default Accordion Example -->

          </div>
        </div>

      </div>

    </div>
  </section>
@endsection