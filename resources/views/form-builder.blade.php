@extends('partial.formbuildermain')
@section('title', 'Form-Builder')
    

@section('content')
<section class="section dashboard">
<div class="tab-content">
  <div class="tab-pane fade show active build pt-3" id="build">
  <div class="row">
      <div class="col-lg-2">
      <div style="margin-top: 110px"></div>
      <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#verticalycentered">
        Clear
      </button>
      <div class="modal fade" id="verticalycentered" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Clear</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              Are you sure want to clear all the field ?
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal" id="clearBuild">Sure</button>
            </div>
          </div>
      </div>
      </div><!-- End Vertically centered Modal--></div>
      
      <!-- Left side columns -->
      <div class="col-lg-8">
                 <div style="margin-top: 110px"></div>
                 <div class="row paginate">
                   <div class="card form-page" data-page="1">
                     <div class="card-body">
                       <!--
                       <h1 class="card-title">Add Logo (optional)</h1>
                       <div class="file-upload-wrapper">
                         <input type="file" class="form-logo" name="image" id="image" accept="image/*">
                         <br>
                         <img id="preview" src="#" alt="Preview" style="display: none; max-width: 200px;">-->
                       </div>
                       <label class="form-label"><b>Choose Your Logo (If needed)</b></label>
                       <input class="form-control form-logo-create" type="file" onchange="previewImageFormLogo(event)">
                       <center><img src="#" alt="No Logo" id="preview-formLogo" style="padding-top: 30px" width="700" height="300" class="img-fluid imgPreview"></center>
                       <input type="hidden" name="creator" class="form-creator" value="{{Auth::user()->id}}">
                       <hr><br>
                       <!-- Vertical Form -->
                       <div class="row g-3 form-builder" ondrop="drop(event)" ondragover="allowDrop(event)" id="formContainer">
                         
                         
                       </div><!-- Vertical Form -->
                       <hr>
         
                     </div>
                   </div>
         
                  
         
                 </div>
      </div><!-- End Left side columns -->

      <div class="col-lg-2">
      </div>
  </div>
  </div>
  <div class="tab-pane fade publish" id="publish">
    <div class="row">
      <div class="col-lg-2">
      </div>
      <div class="col-lg-8">
        <div style="margin-top: 120px">
          <div class="alert alert-primary alert-dismissible fade show" role="alert">
            <h4 class="alert-heading text-center">Form Builder</h4>
            <p class="text-center"><i class="bi bi-exclamation-diamond"></i> Make sure label name for each fields is unique</p>
            <p class="text-center"><i class="bi bi-exclamation-diamond"></i> Form Title must be filled in (without 'Form' at the end)</p>
            <p class="text-center"><i class="bi bi-exclamation-diamond"></i> After done building your form, click on 'Create' button below</p>
            <hr>
          </div>
        </div>
        <div id="typeError" class="alert alert-danger" style="display: none;"></div>
        <div class="card p-3 mb-3" role="alert">
          <h5 class="card-title text-center">Form Title</h5>
          <p class="text-center">Enter a name for your form</p>
          <hr>
          <div class="p-2">
            <div class="col-12 pt-2">
              <label class="form-label" ><b>Form Title*</b></label>
              <input type="text" name="formType" class="form-control form-type" placeholder="Form Title (required)" required>
            </div>
          </div>
        </div>
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
          <h5 class="card-title text-center">Notification</h5>
          <p class="text-center">Select the user that needs to be notified after submitting the form</p>
          <hr>
          <div class="p-2">
            <div class="col-12 pt-2">
              <h5 class="form-label">Select User:</h5>
            <select id="e1" class="form-select" name="notifications" multiple>
              @foreach ($allUser as $item)
                  <option value="{{$item->email}}">{{$item->email}}</option>
              @endforeach
            </select>
            <input type="hidden" id="selectedValues" name="notifications">
            </div>
          </div>
         
        </div>
        <div class="alert alert-secondary alert-dismissible fade show" role="alert">
          <h5 class="card-title text-center">Approval Flows</h5>
          <p class="text-center">Allow your employees/colleagues to approve or deny submissions. (if needed)</p>
          <hr>
          <div class="p-2">
            <div class="col-12 pt-2">
              <h5 class="form-label">This form need approval? :</h5>
              <select class="form-select val" id="needApproval" aria-label="Default select example" name="approval">
                        
                <option value="No">No</option>
                <option value="pending">Yes</option>

              </select>
              <div class="col-12 pt-2 formApproval" style="display: none">
                <label for="" class="form-label">Who need to approve ?</label>
                <select class="form-select val" name="approver" id="approvalSelection" aria-label="Default select example" name="approval">
                  @foreach ($user as $item)
                  <option value="{{$item->email}}">{{$item->email}}</option>
                  @endforeach
                </select>
            </div>
            </div>
          </div>
         
        </div>
         <!--
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          <h5 class="card-title text-center formType">privacy</h5>
          <p class="text-center">Select user that can view this form</p>
          <hr>
          <div class="p-2">
            <div class="col-12 pt-2">
              <h5 class="form-label">Select Here</h5>
              @php
                  $userNotSupAdmin = $allUser->where('role_id' , '!=', 1);
              @endphp
            <select id="e2" class="form-select" name="privacy" multiple>
                  <option value="all">All</option>
              @foreach ($userNotSupAdmin as $item)
                  <option value="{{$item->email}}">{{$item->email}}</option>
              @endforeach
            </select>
            <input type="hidden" id="selectedValuesPrivacy" name="privacy">
            </div>
          </div>
         
        </div> -->
        <div class="text-center">
          <button type="button" class="btn btn-success btn-lg btn-block" data-bs-dismiss="modal" id="saveBuild">Create</button>
      </div>
      </div>
      <div class="col-lg-2">
      </div>
    </div>
  </div>
</div>
</div>
</section>
  <script>
    function previewImage(event) {
      const input = event.target;
      if (input.files && input.files[0]) {
          const reader = new FileReader();
          reader.onload = function (event) {
              const preview = document.getElementById(idValueImage);
              preview.src = event.target.result;
              preview.style.display = 'block';
          };
          reader.readAsDataURL(input.files[0]);
      }
  }
</script>
<script>
  const nospin = document.querySelector('.nospin')
  const spin = document.querySelector('.spin')
  nospin.addEventListener('click', function() {
     nospin.classList.add('formFieldHide');
     spin.classList.remove('formFieldHide');
  });

</script>


<script> 
  document.addEventListener("DOMContentLoaded",function(){let e=document.getElementById("signatureCanvas"),t=document.getElementById("clearButton"),n=document.getElementById("saveButton"),i=document.getElementById("savedSignature"),d=e.getContext("2d"),l=!1;e.addEventListener("mousedown",t=>{l=!0;let n=t.clientX-e.getBoundingClientRect().left,i=t.clientY-e.getBoundingClientRect().top;d.beginPath(),d.moveTo(n,i)}),e.addEventListener("mousemove",t=>{if(!l)return;let n=t.clientX-e.getBoundingClientRect().left,i=t.clientY-e.getBoundingClientRect().top;d.lineWidth=2,d.lineCap="round",d.strokeStyle="#000",d.lineTo(n,i),d.stroke(),d.beginPath(),d.moveTo(n,i)}),e.addEventListener("mouseup",()=>{l=!1}),t.addEventListener("click",()=>{d.clearRect(0,0,e.width,e.height)}),n.addEventListener("click",()=>{let t=e.toDataURL();i.src=t})});
</script>
<script>
    const selectedApproval = document.getElementById("needApproval");
    const approverDiv = document.querySelector('.formApproval');
    selectedApproval.addEventListener("change", function() {
        const selectedValueApproval = selectedApproval.options[selectedApproval.selectedIndex].value
        console.log(selectedValueApproval)
        if (selectedValueApproval == "pending") {
            approverDiv.style.display = "block";
        } else {
          approverDiv.style.display = "none";
        }
    });

</script>
<script>
  function previewImageFormLogo(event, idValueImage) {
    const input = event.target;
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function (event) {
            const preview = document.getElementById('preview-formLogo');
            preview.src = event.target.result;
            preview.style.display = 'block';
        };
        reader.readAsDataURL(input.files[0]);
    }
}
</script>

@endsection


  