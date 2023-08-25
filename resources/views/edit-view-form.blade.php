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
      </div>
      </div>
      <!-- Left side columns -->
      <div class="col-lg-8">
        
           

            @php
            $fieldsData = json_decode($form->fields, true);
            $maxPageNumber = 0;
            foreach ($fieldsData as $field) {
                if ($field['pageNumber'] > $maxPageNumber) {
                    $maxPageNumber = $field['pageNumber'];
                }
            }
            @endphp
            
            @for ($pageNumber = 1; $pageNumber <= $maxPageNumber; $pageNumber++)
              <div class="row paginate" style="margin-top: 110px">
                <div class="card form-page" data-page="{{ $pageNumber }}">
                  <div class="card-body">
                    @if ($pageNumber === 1)
                      <center><img style="padding-top: 30px; padding-bottom: 20px" width="300" height="120" src="{{ asset('images/Artboard-5.png') }}" alt=""></center>
                      <input type="text" name="formType" class="form-control form-ID formFieldHide" value="{{ $form->id }}">
                      <input type="hidden" name="creator" class="form-creator" value="{{ Auth::user()->id }}">
                      <hr><br>
                    @endif
            
                    <div class="row g-3 form-builder" ondrop="drop(event)" ondragover="allowDrop(event)" id="formContainer">
                      @foreach ($fieldsData as $field)
                        @if ($field['pageNumber'] === $pageNumber)
                        @if ($field['type'] == 'text')
                            <div class="type form-field" title="text" draggable="true">
                                <div class="modal fade" role="dialog" id="exampleModal-{{$field['fieldID']}}">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel"></h5>
                                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                              <span aria-hidden="true">&times;</span>
                                            </button>
                                          </div>
                                          <div class="modal-body">
                                          <label class="form-label"><b>label name: </b></label>
                                          <input class="form-control" id="labelInput-{{$field['fieldID']}}" type="text" value="{{$field['label']}}">
                                          
                                          </div>
                                          <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal" id="saveButtonText-{{$field['fieldID']}}">Save changes</button>
                                          </div>
                                        </div>
                                    </div>
                                </div>
                                <label class="col-sm-10 col-form-label labelBold" id="{{$field['fieldID']}}">{{$field['label']}}</label>
                                <div class="col-sm-10 input-group">
                                    <input type="{{$field['type']}}" readonly id="textType" class="form-control typeForm">
                                    <input type="fieldID"  class="form-control formFieldHide" value="{{$field['fieldID']}}">
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal-{{$field['fieldID']}}">
                                        Edit
                                        </button>
                                        <button class="btn btn-outline-danger btn-sm" id="{{$field['fieldID']}}" onclick="deleteThis(event)">Delete</button>
                                    </div>
                                </div>
                            </div>
                            <script>
                              function deleteThis(event) {
                                event.target.parentElement.parentElement.parentElement.remove()
                              }

                                let save{{$field['fieldID']}}= document.getElementById("saveButtonText-{{$field['fieldID']}}");
                                let inputfield{{$field['fieldID']}} = document.getElementById("labelInput-{{$field['fieldID']}}");
                                let textInpLabel{{$field['fieldID']}} = document.getElementById("{{$field['fieldID']}}");

                                save{{$field['fieldID']}}.addEventListener("click", function() {

                                console.log(inputfield{{$field['fieldID']}}.value)
                                textInpLabel{{$field['fieldID']}}.textContent = inputfield{{$field['fieldID']}}.value;


                                })          
                            </script>
                      @elseif ($field['type'] == 'email')
                           <div class="type form-field" title="text" draggable="true">
                               <div class="modal fade" role="dialog" id="exampleModal-{{$field['fieldID']}}">
                                   <div class="modal-dialog" role="document">
                                       <div class="modal-content">
                                         <div class="modal-header">
                                           <h5 class="modal-title" id="exampleModalLabel"></h5>
                                           <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                             <span aria-hidden="true">&times;</span>
                                           </button>
                                         </div>
                                         <div class="modal-body">
                                         <label class="form-label"><b>label name: </b></label>
                                         <input class="form-control" id="labelInput-{{$field['fieldID']}}" type="text" value="{{$field['label']}}">
                                         
                                         </div>
                                         <div class="modal-footer">
                                           <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                           <button type="button" class="btn btn-primary" data-bs-dismiss="modal" id="saveButtonText-{{$field['fieldID']}}">Save changes</button>
                                         </div>
                                       </div>
                                   </div>
                               </div>
                               <label class="col-sm-10 col-form-label labelBold" id="{{$field['fieldID']}}">{{$field['label']}}</label>
                               <div class="col-sm-10 input-group">
                                   <input type="{{$field['type']}}" readonly id="textType" class="form-control typeForm">
                                   <input type="fieldID"  class="form-control formFieldHide" value="{{$field['fieldID']}}">
                                   <div class="input-group-append">
                                       <button class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal-{{$field['fieldID']}}">
                                       Edit
                                       </button>
                                       <button class="btn btn-outline-danger btn-sm" id="{{$field['fieldID']}}" onclick="deleteThis(event)">Delete</button>
                                   </div>
                               </div>
                           </div>
                           <script>
                             function deleteThis(event) {
                               event.target.parentElement.parentElement.parentElement.remove()
                             }
                           
                               let save{{$field['fieldID']}}= document.getElementById("saveButtonText-{{$field['fieldID']}}");
                               let inputfield{{$field['fieldID']}} = document.getElementById("labelInput-{{$field['fieldID']}}");
                               let textInpLabel{{$field['fieldID']}} = document.getElementById("{{$field['fieldID']}}");
                           
                               save{{$field['fieldID']}}.addEventListener("click", function() {
                           
                               console.log(inputfield{{$field['fieldID']}}.value)
                               textInpLabel{{$field['fieldID']}}.textContent = inputfield{{$field['fieldID']}}.value;
                           
                           
                               })
                                
                           
                             
                           </script>
                      @elseif ($field['type'] == 'file allFile')
                        <div class="type form-field" title="text" draggable="true">
                            <div class="modal fade" role="dialog" id="exampleModal-{{$field['fieldID']}}">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel"></h5>
                                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                        </button>
                                      </div>
                                      <div class="modal-body">
                                      <label class="form-label"><b>label name: </b></label>
                                      <input class="form-control" id="labelInput-{{$field['fieldID']}}" type="text" value="{{$field['label']}}">
                                      
                                      </div>
                                      <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal" id="saveButtonText-{{$field['fieldID']}}">Save changes</button>
                                      </div>
                                    </div>
                                </div>
                            </div>
                            <label class="col-sm-10 col-form-label labelBold" id="{{$field['fieldID']}}">{{$field['label']}}</label>
                            <div class="col-sm-10 input-group">
                                <input type="file" class="form-control">
                                <input type="{{$field['type']}}" readonly id="textType" class="form-control typeForm formFieldHide">
                                <input type="fieldID"  class="form-control formFieldHide" value="{{$field['fieldID']}}">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal-{{$field['fieldID']}}">
                                    Edit
                                    </button>
                                    <button class="btn btn-outline-danger btn-sm" id="{{$field['fieldID']}}" onclick="deleteThis(event)">Delete</button>
                                </div>
                            </div>
                        </div>
                        <script>
                          function deleteThis(event) {
                            event.target.parentElement.parentElement.parentElement.remove()
                          }

                            let save{{$field['fieldID']}}= document.getElementById("saveButtonText-{{$field['fieldID']}}");
                            let inputfield{{$field['fieldID']}} = document.getElementById("labelInput-{{$field['fieldID']}}");
                            let textInpLabel{{$field['fieldID']}} = document.getElementById("{{$field['fieldID']}}");

                            save{{$field['fieldID']}}.addEventListener("click", function() {

                            console.log(inputfield{{$field['fieldID']}}.value)
                            textInpLabel{{$field['fieldID']}}.textContent = inputfield{{$field['fieldID']}}.value;


                            })
                             

                          
                        </script>
                      @elseif ($field['type'] == 'textarea')
                          <div class="type form-field" title="text" draggable="true">
                              <div class="modal fade" role="dialog" id="exampleModal-{{$field['fieldID']}}">
                                  <div class="modal-dialog" role="document">
                                      <div class="modal-content">
                                        <div class="modal-header">
                                          <h5 class="modal-title" id="exampleModalLabel"></h5>
                                          <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                          </button>
                                        </div>
                                        <div class="modal-body">
                                        <label class="form-label"><b>label name: </b></label>
                                        <input class="form-control" id="labelInput-{{$field['fieldID']}}" type="text" value="{{$field['label']}}">
                                        
                                        </div>
                                        <div class="modal-footer">
                                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                          <button type="button" class="btn btn-primary" data-bs-dismiss="modal" id="saveButtonText-{{$field['fieldID']}}">Save changes</button>
                                        </div>
                                      </div>
                                  </div>
                              </div>
                              <label class="col-sm-10 col-form-label labelBold" id="{{$field['fieldID']}}">{{$field['label']}}</label>
                              <div class="col-sm-10 input-group">
                                  <textarea class="form-control typeForm" name="textarea" type="textarea" id="textarea"></textarea>
                                  <input type="fieldID"  class="form-control formFieldHide" value="{{$field['fieldID']}}">
                                  <div class="input-group-append">
                                      <button class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal-{{$field['fieldID']}}">
                                      Edit
                                      </button>
                                      <button class="btn btn-outline-danger btn-sm" id="{{$field['fieldID']}}" onclick="deleteThis(event)">Delete</button>
                                  </div>
                              </div>
                          </div>
                          <script>
                            function deleteThis(event) {
                              event.target.parentElement.parentElement.parentElement.remove()
                            }
    
                              let save{{$field['fieldID']}}= document.getElementById("saveButtonText-{{$field['fieldID']}}");
                              let inputfield{{$field['fieldID']}} = document.getElementById("labelInput-{{$field['fieldID']}}");
                              let textInpLabel{{$field['fieldID']}} = document.getElementById("{{$field['fieldID']}}");
    
                              save{{$field['fieldID']}}.addEventListener("click", function() {
    
                              console.log(inputfield{{$field['fieldID']}}.value)
                              textInpLabel{{$field['fieldID']}}.textContent = inputfield{{$field['fieldID']}}.value;
    
    
                              })
                               
    
                            
                          </script>
                      @elseif ($field['type'] == 'checkbox')
                          <div class="type form-field checkbox-container{{$field['fieldID']}}" draggable="true">
                              <div class="modal fade" role="dialog" id="exampleModal-{{$field['fieldID']}}">
                                  <div class="modal-dialog" role="document">
                                      <div class="modal-content">
                                        <div class="modal-header">
                                          <h5 class="modal-title" id="exampleModalLabel"></h5>
                                          <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                          </button>
                                        </div>
                                        <div class="modal-body">
                                        <label class="form-label"><b>label name: </b></label>
                                        <input class="form-control" id="labelInput-{{$field['fieldID']}}" type="text" value="{{$field['label']}}">
                                        <label class="form-label"><b>Checkbox Option: </b></label>
                                        <textarea class="form-control" id="checkboxOption-{{$field['fieldID']}}"></textarea>
                                        </div>
                                        <div class="modal-footer">
                                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                          <button type="button" class="btn btn-primary" data-bs-dismiss="modal" id="saveButtonText-{{$field['fieldID']}}">Save changes</button>
                                        </div>
                                      </div>
                                  </div>
                              </div>
                              <label class="col-form-label labelBold checkboxLabel{{$field['fieldID']}}" id="{{$field['fieldID']}}">{{$field['label']}}</label>
                              <input type="fieldID"  class="form-control formFieldHide" value="{{$field['fieldID']}}">
                              @foreach ($field['checkValues'] as $opt)
                                  <div class="form-check checkboxOption" id="checkDiv{{$field['fieldID']}}">
                                    <input class="form-check-input typeForm" type="checkbox" id="{{$field['fieldID']}}" name="{{$field['fieldID']}}" value="{{$opt}}">
                                    <label class="form-check-label" for="gridCheck1">
                                      {{$opt}}
                                    </label>
                                    
                                  </div>
                                @endforeach
                              
                                <button class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal-{{$field['fieldID']}}">
                                Edit
                                </button>
                                <button class="btn btn-outline-danger btn-sm" id="checkboxDelete{{$field['fieldID']}}" >Delete</button>
                              
                          </div>
                          <script>
                            let allCheckboxTexts = '';
                            let checkboxes = document.querySelectorAll(".checkboxOption label");
                        
                            checkboxes.forEach(function(label) {
                                allCheckboxTexts += label.textContent.trim() + '\n';
                            });
                        
                            // Set the collected checkbox texts in the textarea
                            document.getElementById("checkboxOption-{{$field['fieldID']}}").textContent = allCheckboxTexts;

                            const del = document.getElementById("checkboxDelete{{$field['fieldID']}}")
                            del.addEventListener('click', function(event) {
                              event.target.parentElement.remove()
                            })
      
                              let save{{$field['fieldID']}}= document.getElementById("saveButtonText-{{$field['fieldID']}}");
                              let inputfield{{$field['fieldID']}} = document.getElementById("labelInput-{{$field['fieldID']}}");
                              let textInpLabel{{$field['fieldID']}} = document.getElementById("{{$field['fieldID']}}");
      
                              save{{$field['fieldID']}}.addEventListener("click", function() {
      
                              console.log(inputfield{{$field['fieldID']}}.value)
                              textInpLabel{{$field['fieldID']}}.textContent = inputfield{{$field['fieldID']}}.value;

                              const checkdivLabel = document.querySelector(".checkbox-container{{$field['fieldID']}}")
                              const checkOption = document.getElementById("checkboxOption-{{$field['fieldID']}}");
                              const options = checkOption.value.trim().split('\n');
                            
                              //Remove the existing radioDiv element
                              const checkboxDiv = document.querySelectorAll("#checkDiv{{$field['fieldID']}}");
                              checkboxDiv.forEach((chDiv)  => {
                               chDiv.remove();
                              });
                              
                        
                             // Add new radio inputs and labels based on the textarea content
                             options.forEach((text) => {
                               if (text.trim() !== '') {
                                 const newCheckDiv = document.createElement("div");
                                 newCheckDiv.classList.add("form-check");
                                 newCheckDiv.classList.add("checkboxOption");
                                 newCheckDiv.setAttribute("id", "checkDiv{{$field['fieldID']}}");
                                 
                                 const newInput = document.createElement("input");
                                 newInput.type = "checkbox";
                                 newInput.classList.add("form-check-input");
                                 newInput.value = text.trim();
                                 newInput.name = "{{$field['fieldID']}}";
                                 newInput.setAttribute("id", "{{$field['fieldID']}}")
                                 newInput.classList.add("typeForm");
                                 newCheckDiv.appendChild(newInput);
                        
                                 const newLabel = document.createElement("label");
                                 newLabel.classList.add("form-check-label");
                                 newLabel.textContent = text.trim();
                                 newCheckDiv.appendChild(newLabel);
                        
                                 checkdivLabel.appendChild(newCheckDiv);
                               }
                             });

                            })
                               
      
                            
                          </script>
                      @elseif ($field['type'] == 'radio')
                       <div class="type form-field radio-container{{$field['fieldID']}}" draggable="true">
                           <div class="modal fade" role="dialog" id="exampleModal-{{$field['fieldID']}}">
                               <div class="modal-dialog" role="document">
                                   <div class="modal-content">
                                     <div class="modal-header">
                                       <h5 class="modal-title" id="exampleModalLabel"></h5>
                                       <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                         <span aria-hidden="true">&times;</span>
                                       </button>
                                     </div>
                                     <div class="modal-body">
                                     <label class="form-label"><b>label name: </b></label>
                                     <input class="form-control" id="labelInput-{{$field['fieldID']}}" type="text" value="{{$field['label']}}">
                                     <label class="form-label"><b>Radio Option: </b></label>
                                     <textarea class="form-control" id="radioOption-{{$field['fieldID']}}"></textarea>
                                     </div>
                                     <div class="modal-footer">
                                       <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                       <button type="button" class="btn btn-primary" data-bs-dismiss="modal" id="saveButtonText-{{$field['fieldID']}}">Save changes</button>
                                     </div>
                                   </div>
                               </div>
                           </div>
                           <label class="col-form-label labelBold radioLabel{{$field['fieldID']}}" id="{{$field['fieldID']}}">{{$field['label']}}</label>
                             <input type="fieldID"  class="form-control formFieldHide" value="{{$field['fieldID']}}">
                           @foreach ($field['radioValues'] as $opt)
                               <div class="form-check radioOption" id="radioDiv{{$field['fieldID']}}">
                                 <input class="form-check-input typeForm" type="radio" id="{{$field['fieldID']}}" name="{{$field['fieldID']}}" value="{{$opt}}">
                                 <label class="form-check-label" for="gridCheck1">
                                   {{$opt}}
                                 </label>
                               </div>
                             @endforeach
                           
                             <button class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal-{{$field['fieldID']}}">
                             Edit
                             </button>
                             <button class="btn btn-outline-danger btn-sm" id="radioDelete{{$field['fieldID']}}" >Delete</button>
                           
                       </div>
                       <script>
                         let allRadioTexts = '';
                         let radio = document.querySelectorAll(".radioOption label");
                     
                         radio.forEach(function(label) {
                             allRadioTexts += label.textContent.trim() + '\n';
                         });
                     
                         // Set the collected checkbox texts in the textarea
                         document.getElementById("radioOption-{{$field['fieldID']}}").textContent = allRadioTexts;

                         const raddel = document.getElementById("radioDelete{{$field['fieldID']}}")
                         raddel.addEventListener('click', function(event) {
                           event.target.parentElement.remove()
                         })
   
                           let save{{$field['fieldID']}}= document.getElementById("saveButtonText-{{$field['fieldID']}}");
                           let inputfield{{$field['fieldID']}} = document.getElementById("labelInput-{{$field['fieldID']}}");
                           let textInpLabel{{$field['fieldID']}} = document.getElementById("{{$field['fieldID']}}");
   
                           save{{$field['fieldID']}}.addEventListener("click", function() {
   
                           console.log(inputfield{{$field['fieldID']}}.value)
                           textInpLabel{{$field['fieldID']}}.textContent = inputfield{{$field['fieldID']}}.value;

                           const checkdivLabel = document.querySelector(".radio-container{{$field['fieldID']}}")
                           const checkOption = document.getElementById("radioOption-{{$field['fieldID']}}");
                           const options = checkOption.value.trim().split('\n');
                         
                           //Remove the existing radioDiv element
                           const radioDiv = document.querySelectorAll("#radioDiv{{$field['fieldID']}}");
                           radioDiv.forEach((chDiv)  => {
                            chDiv.remove();
                           });
                           
                     
                          // Add new radio inputs and labels based on the textarea content
                          options.forEach((text) => {
                            if (text.trim() !== '') {
                              const newRadioDiv = document.createElement("div");
                              newRadioDiv.classList.add("form-check");
                              newRadioDiv.classList.add("radioOption");
                              newRadioDiv.setAttribute("id", "radioDiv{{$field['fieldID']}}");
                              
                              const newInput = document.createElement("input");
                              newInput.type = "radio";
                              newInput.classList.add("form-check-input");
                              newInput.value = text.trim();
                              newInput.name = "{{$field['fieldID']}}";
                              newInput.setAttribute("id", "{{$field['fieldID']}}")
                              newInput.classList.add("typeForm");
                              newRadioDiv.appendChild(newInput);
                     
                              const newLabel = document.createElement("label");
                              newLabel.classList.add("form-check-label");
                              newLabel.textContent = text.trim();
                              newRadioDiv.appendChild(newLabel);
                     
                              checkdivLabel.appendChild(newRadioDiv);
                            }
                          });

                         })
                            
   
                         
                       </script>
                      @elseif ($field['type'] == 'date')
                          <div class="type form-field" title="text" draggable="true">
                              <div class="modal fade" role="dialog" id="exampleModal-{{$field['fieldID']}}">
                                  <div class="modal-dialog" role="document">
                                      <div class="modal-content">
                                        <div class="modal-header">
                                          <h5 class="modal-title" id="exampleModalLabel"></h5>
                                          <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                          </button>
                                        </div>
                                        <div class="modal-body">
                                        <label class="form-label"><b>label name: </b></label>
                                        <input class="form-control" id="labelInput-{{$field['fieldID']}}" type="text" value="{{$field['label']}}">
                                        
                                        </div>
                                        <div class="modal-footer">
                                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                          <button type="button" class="btn btn-primary" data-bs-dismiss="modal" id="saveButtonText-{{$field['fieldID']}}">Save changes</button>
                                        </div>
                                      </div>
                                  </div>
                              </div>
                              <label class="col-sm-10 col-form-label labelBold" id="{{$field['fieldID']}}">{{$field['label']}}</label>
                              <div class="col-sm-10 input-group">
                                 
                                  <input type="{{$field['type']}}" id="textType" class="form-control typeForm">
                                  <input type="fieldID"  class="form-control formFieldHide" value="{{$field['fieldID']}}">
                                  <div class="input-group-append">
                                      <button class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal-{{$field['fieldID']}}">
                                      Edit
                                      </button>
                                      <button class="btn btn-outline-danger btn-sm" id="{{$field['fieldID']}}" onclick="deleteThis(event)">Delete</button>
                                  </div>
                              </div>
                          </div>
                          <script>
                            function deleteThis(event) {
                              event.target.parentElement.parentElement.parentElement.remove()
                            }
      
                              let save{{$field['fieldID']}}= document.getElementById("saveButtonText-{{$field['fieldID']}}");
                              let inputfield{{$field['fieldID']}} = document.getElementById("labelInput-{{$field['fieldID']}}");
                              let textInpLabel{{$field['fieldID']}} = document.getElementById("{{$field['fieldID']}}");
      
                              save{{$field['fieldID']}}.addEventListener("click", function() {
      
                              console.log(inputfield{{$field['fieldID']}}.value)
                              textInpLabel{{$field['fieldID']}}.textContent = inputfield{{$field['fieldID']}}.value;
      
      
                              })
                               
      
                            
                          </script>
                      @elseif ($field['type'] == 'time')
                          <div class="type form-field" title="text" draggable="true">
                              <div class="modal fade" role="dialog" id="exampleModal-{{$field['fieldID']}}">
                                  <div class="modal-dialog" role="document">
                                      <div class="modal-content">
                                        <div class="modal-header">
                                          <h5 class="modal-title" id="exampleModalLabel"></h5>
                                          <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                          </button>
                                        </div>
                                        <div class="modal-body">
                                        <label class="form-label"><b>label name: </b></label>
                                        <input class="form-control" id="labelInput-{{$field['fieldID']}}" type="text" value="{{$field['label']}}">
                                        
                                        </div>
                                        <div class="modal-footer">
                                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                          <button type="button" class="btn btn-primary" data-bs-dismiss="modal" id="saveButtonText-{{$field['fieldID']}}">Save changes</button>
                                        </div>
                                      </div>
                                  </div>
                              </div>
                              <label class="col-sm-10 col-form-label labelBold" id="{{$field['fieldID']}}">{{$field['label']}}</label>
                              <div class="col-sm-10 input-group">
                                  <input type="{{$field['type']}}" id="textType" class="form-control typeForm">
                                  <input type="fieldID"  class="form-control formFieldHide" value="{{$field['fieldID']}}">
                                  <div class="input-group-append">
                                      <button class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal-{{$field['fieldID']}}">
                                      Edit
                                      </button>
                                      <button class="btn btn-outline-danger btn-sm" id="{{$field['fieldID']}}" onclick="deleteThis(event)">Delete</button>
                                  </div>
                              </div>
                          </div>
                          <script>
                            function deleteThis(event) {
                              event.target.parentElement.parentElement.parentElement.remove()
                            }
      
                              let save{{$field['fieldID']}}= document.getElementById("saveButtonText-{{$field['fieldID']}}");
                              let inputfield{{$field['fieldID']}} = document.getElementById("labelInput-{{$field['fieldID']}}");
                              let textInpLabel{{$field['fieldID']}} = document.getElementById("{{$field['fieldID']}}");
      
                              save{{$field['fieldID']}}.addEventListener("click", function() {
      
                              console.log(inputfield{{$field['fieldID']}}.value)
                              textInpLabel{{$field['fieldID']}}.textContent = inputfield{{$field['fieldID']}}.value;
      
      
                              })
                               
      
                            
                          </script>
                      @elseif ($field['type'] == 'text datetime')
                          <div class="type form-field" title="text" draggable="true">
                              <div class="modal fade" role="dialog" id="exampleModal-{{$field['fieldID']}}">
                                  <div class="modal-dialog" role="document">
                                      <div class="modal-content">
                                        <div class="modal-header">
                                          <h5 class="modal-title" id="exampleModalLabel"></h5>
                                          <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                          </button>
                                        </div>
                                        <div class="modal-body">
                                        <label class="form-label"><b>label name: </b></label>
                                        <input class="form-control" id="labelInput-{{$field['fieldID']}}" type="text" value="{{$field['label']}}">
                                        
                                        </div>
                                        <div class="modal-footer">
                                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                          <button type="button" class="btn btn-primary" data-bs-dismiss="modal" id="saveButtonText-{{$field['fieldID']}}">Save changes</button>
                                        </div>
                                      </div>
                                  </div>
                              </div>
                              <label class="col-sm-10 col-form-label labelBold" id="{{$field['fieldID']}}">{{$field['label']}}</label>
                              <div class="col-sm-10 input-group">
                                  <input type="{{$field['type']}}" readonly id="textType" class="form-control typeForm" id ="reservationdatetime" value="07/24/2023 12:00 AM - 07/24/2023 11:59 PM">
                                  <input type="fieldID"  class="form-control formFieldHide" value="{{$field['fieldID']}}">
                                  <div class="input-group-append">
                                      <button class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal-{{$field['fieldID']}}">
                                      Edit
                                      </button>
                                      <button class="btn btn-outline-danger btn-sm" id="{{$field['fieldID']}}" onclick="deleteThis(event)">Delete</button>
                                  </div>
                              </div>
                          </div>
                          <script>
                            function deleteThis(event) {
                              event.target.parentElement.parentElement.parentElement.remove()
                            }
      
                              let save{{$field['fieldID']}}= document.getElementById("saveButtonText-{{$field['fieldID']}}");
                              let inputfield{{$field['fieldID']}} = document.getElementById("labelInput-{{$field['fieldID']}}");
                              let textInpLabel{{$field['fieldID']}} = document.getElementById("{{$field['fieldID']}}");
      
                              save{{$field['fieldID']}}.addEventListener("click", function() {
      
                              console.log(inputfield{{$field['fieldID']}}.value)
                              textInpLabel{{$field['fieldID']}}.textContent = inputfield{{$field['fieldID']}}.value;
      
      
                              })
                               
      
                            
                          </script>
                      @elseif ($field['type'] == 'file')
                            <div class="type form-field" title="text" draggable="true">
                                <div class="modal fade" role="dialog" id="exampleModal-{{$field['fieldID']}}">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel"></h5>
                                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                              <span aria-hidden="true">&times;</span>
                                            </button>
                                          </div>
                                          <div class="modal-body">
                                          <label class="form-label"><b>label name: </b></label>
                                          <input class="form-control" id="labelInput-{{$field['fieldID']}}" type="text" value="{{$field['label']}}">
                                          <label class="form-label"><b>Select Image: </b></label>
                                          <input class="form-control"  type="file" onchange="previewImageEdit(event, '{{$field['fieldID']}}')">
                                          </div>
                                          <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal" id="saveButtonText-{{$field['fieldID']}}">Save changes</button>
                                          </div>
                                        </div>
                                    </div>
                                </div>
                                <label class="col-sm-10 col-form-label labelBold" id="{{$field['fieldID']}}">{{$field['label']}}</label>
                                <img src="{{$field['image']}}" alt="" id="preview-{{$field['fieldID']}}" class="imgPreview">
                                <div class="col-sm-10 input-group">
                                    <input type="{{$field['type']}}" id="imageType" class="form-control typeForm formFieldHide" accept="image/*">
                                    <input type="fieldID"  class="form-control formFieldHide" value="{{$field['fieldID']}}">
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal-{{$field['fieldID']}}">
                                        Edit
                                        </button>
                                        <button class="btn btn-outline-danger btn-sm" id="{{$field['fieldID']}}" onclick="deleteThis(event)">Delete</button>
                                    </div>
                                </div>
                            </div>
                            <script>
                              function deleteThis(event) {
                                event.target.parentElement.parentElement.parentElement.remove()
                              }
        
                                let save{{$field['fieldID']}}= document.getElementById("saveButtonText-{{$field['fieldID']}}");
                                let inputfield{{$field['fieldID']}} = document.getElementById("labelInput-{{$field['fieldID']}}");
                                let textInpLabel{{$field['fieldID']}} = document.getElementById("{{$field['fieldID']}}");
        
                                save{{$field['fieldID']}}.addEventListener("click", function() {
        
                                console.log(inputfield{{$field['fieldID']}}.value)
                                textInpLabel{{$field['fieldID']}}.textContent = inputfield{{$field['fieldID']}}.value;
        
        
                                })
                                 
        
                              
                            </script>
                      @elseif ($field['type'] == 'text location')
                            <div class="type form-field" title="text" draggable="true">
                                <div class="modal fade" role="dialog" id="exampleModal-{{$field['fieldID']}}">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel"></h5>
                                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                              <span aria-hidden="true">&times;</span>
                                            </button>
                                          </div>
                                          <div class="modal-body">
                                          <label class="form-label"><b>label name: </b></label>
                                          <input class="form-control" id="labelInput-{{$field['fieldID']}}" type="text" value="{{$field['label']}}">
                                          
                                          </div>
                                          <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal" id="saveButtonText-{{$field['fieldID']}}">Save changes</button>
                                          </div>
                                        </div>
                                    </div>
                                </div>
                                <label class="col-sm-10 col-form-label labelBold" id="{{$field['fieldID']}}">{{$field['label']}}</label>
                                <div class="col-sm-10 input-group">
                                    <button class="btn btn-outline-primary">Get Location</button>
                                    <input type="{{$field['type']}}" readonly id="textType" class="form-control typeForm formFieldHide">
                                    <input type="fieldID"  class="form-control formFieldHide" value="{{$field['fieldID']}}">
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal-{{$field['fieldID']}}">
                                        Edit
                                        </button>
                                        <button class="btn btn-outline-danger btn-sm" id="{{$field['fieldID']}}" onclick="deleteThis(event)">Delete</button>
                                    </div>
                                </div>
                            </div>
                            <script>
                              function deleteThis(event) {
                                event.target.parentElement.parentElement.parentElement.remove()
                              }
        
                                let save{{$field['fieldID']}}= document.getElementById("saveButtonText-{{$field['fieldID']}}");
                                let inputfield{{$field['fieldID']}} = document.getElementById("labelInput-{{$field['fieldID']}}");
                                let textInpLabel{{$field['fieldID']}} = document.getElementById("{{$field['fieldID']}}");
        
                                save{{$field['fieldID']}}.addEventListener("click", function() {
        
                                console.log(inputfield{{$field['fieldID']}}.value)
                                textInpLabel{{$field['fieldID']}}.textContent = inputfield{{$field['fieldID']}}.value;
        
        
                                })
                                 
        
                              
                            </script>
                      @elseif ($field['type'] == 'search')
                            <div class="type form-field" title="text" draggable="true">
                                <div class="modal fade" role="dialog" id="exampleModal-{{$field['fieldID']}}">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel"></h5>
                                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                              <span aria-hidden="true">&times;</span>
                                            </button>
                                          </div>
                                          <div class="modal-body">
                                          <label class="form-label"><b>label name: </b></label>
                                          <input class="form-control" id="labelInput-{{$field['fieldID']}}" type="text" value="{{$field['label']}}">
                                          
                                          </div>
                                          <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal" id="saveButtonText-{{$field['fieldID']}}">Save changes</button>
                                          </div>
                                        </div>
                                    </div>
                                </div>
                                <label class="col-sm-10 col-form-label labelBold" id="{{$field['fieldID']}}">{{$field['label']}}</label>
                                <div class="col-sm-10 input-group">
                                  <input type="search" class="form-control">
                                    <button class="btn btn-success">search</button>
                                    <input type="{{$field['type']}}" readonly id="textType" class="form-control typeForm formFieldHide">
                                    <input type="fieldID"  class="form-control formFieldHide" value="{{$field['fieldID']}}">
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal-{{$field['fieldID']}}">
                                        Edit
                                        </button>
                                        <button class="btn btn-outline-danger btn-sm" id="{{$field['fieldID']}}" onclick="deleteThis(event)">Delete</button>
                                    </div>
                                </div>
                            </div>
                            <script>
                              function deleteThis(event) {
                                event.target.parentElement.parentElement.parentElement.remove()
                              }
        
                                let save{{$field['fieldID']}}= document.getElementById("saveButtonText-{{$field['fieldID']}}");
                                let inputfield{{$field['fieldID']}} = document.getElementById("labelInput-{{$field['fieldID']}}");
                                let textInpLabel{{$field['fieldID']}} = document.getElementById("{{$field['fieldID']}}");
        
                                save{{$field['fieldID']}}.addEventListener("click", function() {
        
                                console.log(inputfield{{$field['fieldID']}}.value)
                                textInpLabel{{$field['fieldID']}}.textContent = inputfield{{$field['fieldID']}}.value;
        
        
                                })
                                 
        
                              
                            </script>
                      @elseif ($field['type'] == 'text youtube')
                              <div class="type form-field" title="text" draggable="true">
                                  <div class="modal fade" role="dialog" id="exampleModal-{{$field['fieldID']}}">
                                      <div class="modal-dialog" role="document">
                                          <div class="modal-content">
                                            <div class="modal-header">
                                              <h5 class="modal-title" id="exampleModalLabel"></h5>
                                              <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                              </button>
                                            </div>
                                            <div class="modal-body">
                                            <label class="form-label"><b>label name: </b></label>
                                            <input class="form-control" id="labelInput-{{$field['fieldID']}}" type="text" value="{{$field['label']}}">
                                            
                                            </div>
                                            <div class="modal-footer">
                                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                              <button type="button" class="btn btn-primary" data-bs-dismiss="modal" id="saveButtonText-{{$field['fieldID']}}">Save changes</button>
                                            </div>
                                          </div>
                                      </div>
                                  </div>
                                  <label class="col-sm-10 col-form-label labelBold" id="{{$field['fieldID']}}">{{$field['label']}}</label>
                                  <div class="col-sm-10 input-group">
                                      <iframe src="{{$field['youtubeLink']}}" id="$field"></iframe>
                                      <input type="{{$field['type']}}" readonly id="textType" class="form-control typeForm formFieldHide">
                                      <input type="fieldID"  class="form-control formFieldHide" value="{{$field['fieldID']}}">
                                      <div class="input-group-append">
                                          <button class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal-{{$field['fieldID']}}">
                                          Edit
                                          </button>
                                          <button class="btn btn-outline-danger btn-sm" id="{{$field['fieldID']}}" onclick="deleteThis(event)">Delete</button>
                                      </div>
                                  </div>
                              </div>
                              <script>
                                function deleteThis(event) {
                                  event.target.parentElement.parentElement.parentElement.remove()
                                }
          
                                  let save{{$field['fieldID']}}= document.getElementById("saveButtonText-{{$field['fieldID']}}");
                                  let inputfield{{$field['fieldID']}} = document.getElementById("labelInput-{{$field['fieldID']}}");
                                  let textInpLabel{{$field['fieldID']}} = document.getElementById("{{$field['fieldID']}}");
          
                                  save{{$field['fieldID']}}.addEventListener("click", function() {
          
                                  console.log(inputfield{{$field['fieldID']}}.value)
                                  textInpLabel{{$field['fieldID']}}.textContent = inputfield{{$field['fieldID']}}.value;
          
          
                                  })
                                   
          
                                
                              </script>
                      @elseif ($field['type'] == 'Signature')
                              <div class="type form-field" title="text" draggable="true">
                                  <div class="modal fade" role="dialog" id="exampleModal-{{$field['fieldID']}}">
                                      <div class="modal-dialog" role="document">
                                          <div class="modal-content">
                                            <div class="modal-header">
                                              <h5 class="modal-title" id="exampleModalLabel"></h5>
                                              <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                              </button>
                                            </div>
                                            <div class="modal-body">
                                            <label class="form-label"><b>label name: </b></label>
                                            <input class="form-control" id="labelInput-{{$field['fieldID']}}" type="text" value="{{$field['label']}}">
                                            
                                            </div>
                                            <div class="modal-footer">
                                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                              <button type="button" class="btn btn-primary" data-bs-dismiss="modal" id="saveButtonText-{{$field['fieldID']}}">Save changes</button>
                                            </div>
                                          </div>
                                      </div>
                                  </div>
                                  <label class="col-sm-10 col-form-label labelBold" id="{{$field['fieldID']}}">{{$field['label']}}</label>
                                  <div class="col-sm-10 input-group">
                                      <canvas id="signatureCanvas" class="canvasBack"></canvas>
                                      <input type="{{$field['type']}}" readonly id="textType" class="form-control typeForm formFieldHide">
                                      <input type="fieldID"  class="form-control formFieldHide" value="{{$field['fieldID']}}">
                                      <div class="input-group-append">
                                          <button class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal-{{$field['fieldID']}}">
                                          Edit
                                          </button>
                                          <button class="btn btn-outline-danger btn-sm" id="{{$field['fieldID']}}" onclick="deleteThis(event)">Delete</button>
                                      </div>
                                  </div>
                              </div>
                              <script>
                                function deleteThis(event) {
                                  event.target.parentElement.parentElement.parentElement.remove()
                                }
          
                                  let save{{$field['fieldID']}}= document.getElementById("saveButtonText-{{$field['fieldID']}}");
                                  let inputfield{{$field['fieldID']}} = document.getElementById("labelInput-{{$field['fieldID']}}");
                                  let textInpLabel{{$field['fieldID']}} = document.getElementById("{{$field['fieldID']}}");
          
                                  save{{$field['fieldID']}}.addEventListener("click", function() {
          
                                  console.log(inputfield{{$field['fieldID']}}.value)
                                  textInpLabel{{$field['fieldID']}}.textContent = inputfield{{$field['fieldID']}}.value;
          
          
                                  })
                                   
          
                                
                              </script>
                      @elseif ($field['type'] == 'select')
                            <div class="type form-field" title="text" draggable="true">
                                <div class="modal fade" role="dialog" id="exampleModal-{{$field['fieldID']}}">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel"></h5>
                                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                              <span aria-hidden="true">&times;</span>
                                            </button>
                                          </div>
                                          <div class="modal-body">
                                           
                                          <label class="form-label"><b>label name: </b></label>
                                          <input class="form-control" id="labelInput-{{$field['fieldID']}}" type="text" value="{{$field['label']}}">
                                          <label class="form-label"><b>Select Option: </b></label>
                                          <textarea class="form-control" id="selectOption-{{$field['fieldID']}}"></textarea>
                                          </div>
                                          <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal" id="saveButtonText-{{$field['fieldID']}}">Save changes</button>
                                          </div>
                                        </div>
                                    </div>
                                </div>
                                <label class="col-sm-10 col-form-label labelBold" id="{{$field['fieldID']}}">{{$field['label']}}</label>
                                <div class="col-sm-10 input-group">
                                    <select class="form-select typeForm" type="select" name="select" id="select">
                                      @foreach ($field['selectOption'] as $item)
                                          <option value="{{$item}}">{{$item}}</option>
                                      @endforeach
                                    </select>
                                    
                                    <input type="fieldID"  class="form-control formFieldHide" value="{{$field['fieldID']}}">
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal-{{$field['fieldID']}}">
                                        Edit
                                        </button>
                                        <button class="btn btn-outline-danger btn-sm" id="{{$field['fieldID']}}" onclick="deleteThis(event)">Delete</button>
                                    </div>
                                </div>
                            </div>
                            <script>
                              let allOptionTexts = '';
                                              for (let i = 0; i < select.options.length; i++) {
                                                allOptionTexts += select.options[i].textContent + '\n';
                                              }
                                              document.getElementById("selectOption-{{$field['fieldID']}}").textContent = allOptionTexts;
                              function deleteThis(event) {
                                event.target.parentElement.parentElement.parentElement.remove()
                              }
        
                                let save{{$field['fieldID']}}= document.getElementById("saveButtonText-{{$field['fieldID']}}");
                                let inputfield{{$field['fieldID']}} = document.getElementById("labelInput-{{$field['fieldID']}}");
                                let textInpLabel{{$field['fieldID']}} = document.getElementById("{{$field['fieldID']}}");
        
                                save{{$field['fieldID']}}.addEventListener("click", function() {
        
                                console.log(inputfield{{$field['fieldID']}}.value)
                                textInpLabel{{$field['fieldID']}}.textContent = inputfield{{$field['fieldID']}}.value;
                                const selectOption = document.getElementById("selectOption-{{$field['fieldID']}}");
                                const options = selectOption.value.trim().split('\n');
                              
                                // Remove all existing options from the select element
                                while (select.options.length > 0) {
                                  select.options[0].remove();
                                }
                              
                                // Update or add new options based on the textarea content
                                options.forEach((text) => {
                                  if (text.trim() !== '') {
                                    const newOption = document.createElement('option');
                                    newOption.textContent = text.trim();
                                    newOption.value = text.trim(); // You can set the option value to the same as the text, or provide a different value as needed.
                                    select.appendChild(newOption);
                                  }
                                });

                                })
                                 
        
                              
                            </script>
                      @elseif ($field['type'] == 'Rating')
                          <div class="type form-field" title="text" draggable="true">
                              <div class="modal fade" role="dialog" id="exampleModal-{{$field['fieldID']}}">
                                  <div class="modal-dialog" role="document">
                                      <div class="modal-content">
                                        <div class="modal-header">
                                          <h5 class="modal-title" id="exampleModalLabel"></h5>
                                          <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                          </button>
                                        </div>
                                        <div class="modal-body">
                                        <label class="form-label"><b>label name: </b></label>
                                        <input class="form-control" id="labelInput-{{$field['fieldID']}}" type="text" value="{{$field['label']}}">
                                        
                                        </div>
                                        <div class="modal-footer">
                                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                          <button type="button" class="btn btn-primary" data-bs-dismiss="modal" id="saveButtonText-{{$field['fieldID']}}">Save changes</button>
                                        </div>
                                      </div>
                                  </div>
                              </div>
                              <label class="col-sm-10 col-form-label labelBold" id="{{$field['fieldID']}}">{{$field['label']}}</label>
                              <input type="{{$field['type']}}" readonly id="textType" class="form-control typeForm formFieldHide">
                              <input type="fieldID"  class="form-control formFieldHide" value="{{$field['fieldID']}}">
                            
                              <div class="form-check form-check-inline">
                                <input type="radio" value="1" name="{{$field['fieldID']}}" class="form-check-input">
                                <label class="form-check-label">Disagree</label>
                              </div>
                              <div class="form-check form-check-inline">
                                <input type="radio" value="2" name="{{$field['fieldID']}}" class="form-check-input">
                                <label class="form-check-label">2</label>
                              </div>
                              <div class="form-check form-check-inline">
                                <input type="radio" value="3" name="{{$field['fieldID']}}" class="form-check-input">
                                <label class="form-check-label">3</label>
                              </div>
                              <div class="form-check form-check-inline">
                                <input type="radio" value="4" name="{{$field['fieldID']}}" class="form-check-input">
                                <label class="form-check-label">4</label>
                              </div>
                              <div class="form-check form-check-inline">
                                <input type="radio" value="5" name="{{$field['fieldID']}}" class="form-check-input">
                                <label class="form-check-label">Agree</label>
                              </div>
                                  
                                 
                               <button class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal-{{$field['fieldID']}}">
                               Edit
                               </button>
                               <button class="btn btn-outline-danger btn-sm" id="{{$field['fieldID']}}" onclick="deleteThis(event)">Delete</button>
                                  
                             
                          </div>
                          <script>
                            function deleteThis(event) {
                              event.target.parentElement.parentElement.parentElement.remove()
                            }
      
                              let save{{$field['fieldID']}}= document.getElementById("saveButtonText-{{$field['fieldID']}}");
                              let inputfield{{$field['fieldID']}} = document.getElementById("labelInput-{{$field['fieldID']}}");
                              let textInpLabel{{$field['fieldID']}} = document.getElementById("{{$field['fieldID']}}");
      
                              save{{$field['fieldID']}}.addEventListener("click", function() {
      
                              console.log(inputfield{{$field['fieldID']}}.value)
                              textInpLabel{{$field['fieldID']}}.textContent = inputfield{{$field['fieldID']}}.value;
      
      
                              })
                               
      
                            
                          </script>
                      @elseif ($field['type'] == 'hidden')
                            <div class="type form-field" title="text" draggable="true">
                                <div class="modal fade" role="dialog" id="exampleModal-{{$field['fieldID']}}">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel"></h5>
                                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                              <span aria-hidden="true">&times;</span>
                                            </button>
                                          </div>
                                          <div class="modal-body">
                                          <label class="form-label"><b>label name: </b></label>
                                          <input class="form-control" id="labelInput-{{$field['fieldID']}}" type="text" value="{{$field['label']}}">
                                          
                                          </div>
                                          <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal" id="saveButtonText-{{$field['fieldID']}}">Save changes</button>
                                          </div>
                                        </div>
                                    </div>
                                </div>
                                <label class="col-sm-10 col-form-label labelBold" id="{{$field['fieldID']}}">{{$field['label']}}</label>
                                <div class="col-sm-10 input-group">
                                  <div class="col-sm-10">
                                    <div class="star-rating d-inline-flex">
                                        <i class="fas fa-star" data-rating="1"></i>
                                        <i class="fas fa-star" data-rating="2"></i>
                                        <i class="fas fa-star" data-rating="3"></i>
                                        <i class="fas fa-star" data-rating="4"></i>
                                        <i class="fas fa-star" data-rating="5"></i>
                                      </div>
                                      <input type="hidden" name="starrating" id="rating-value">
                                </div>
                                    <input type="{{$field['type']}}" readonly id="textType" class="form-control typeForm formFieldHide">
                                    <input type="fieldID"  class="form-control formFieldHide" value="{{$field['fieldID']}}">
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal-{{$field['fieldID']}}">
                                        Edit
                                        </button>
                                        <button class="btn btn-outline-danger btn-sm" id="{{$field['fieldID']}}" onclick="deleteThis(event)">Delete</button>
                                    </div>
                                </div>
                            </div>
                            <script>
                              function deleteThis(event) {
                                event.target.parentElement.parentElement.parentElement.remove()
                              }
        
                                let save{{$field['fieldID']}}= document.getElementById("saveButtonText-{{$field['fieldID']}}");
                                let inputfield{{$field['fieldID']}} = document.getElementById("labelInput-{{$field['fieldID']}}");
                                let textInpLabel{{$field['fieldID']}} = document.getElementById("{{$field['fieldID']}}");
        
                                save{{$field['fieldID']}}.addEventListener("click", function() {
        
                                console.log(inputfield{{$field['fieldID']}}.value)
                                textInpLabel{{$field['fieldID']}}.textContent = inputfield{{$field['fieldID']}}.value;
        
        
                                })
                                 
        
                              
                            </script>
                      @elseif ($field['type'] == 'Heading')
                            <div class="type form-field" title="text" draggable="true">
                                <div class="modal fade" role="dialog" id="exampleModal-{{$field['fieldID']}}">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel"></h5>
                                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                              <span aria-hidden="true">&times;</span>
                                            </button>
                                          </div>
                                          <div class="modal-body">
                                          <label class="form-label"><b>Heading: </b></label>
                                          <input class="form-control" id="headInput-{{$field['fieldID']}}" type="text" value="{{$field['label']}}">
                                          <label class="form-label"><b>Subheading: </b></label>
                                          <input class="form-control" id="subInput-{{$field['fieldID']}}" type="text">
                                          </div>
                                          <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal" id="saveButtonText-{{$field['fieldID']}}">Save changes</button>
                                          </div>
                                        </div>
                                    </div>
                                </div>
                                <label class="col-sm-10 col-form-label labelBold formFieldHide" id="{{$field['fieldID']}}">{{$field['label']}}</label>
                                <h2 id="{{$field['fieldID']}}">{{$field['label']}}</h2>
                                <p id="{{$field['fieldID']}}">{{$field['subheading']}}</p>
                                <div class="col-sm-10 input-group">
                                    <input type="{{$field['type']}}" readonly id="textType" class="form-control typeForm formFieldHide">
                                    <input type="fieldID"  class="form-control formFieldHide" value="{{$field['fieldID']}}">
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#exampleModal-{{$field['fieldID']}}">
                                        Edit
                                        </button>
                                        <button class="btn btn-outline-danger" id="{{$field['fieldID']}}" onclick="deleteThis(event)">Delete</button>
                                    </div>
                                </div>
                                <hr>
                            </div>
                            <script>
                              function deleteThis(event) {
                                event.target.parentElement.parentElement.parentElement.remove()
                              }
        
                                var fieldID = "{{$field['fieldID']}}";
                                let save{{$field['fieldID']}}= document.getElementById("saveButtonText-{{$field['fieldID']}}");
                                let inputfield{{$field['fieldID']}} = document.getElementById("headInput-{{$field['fieldID']}}");
                                let subfield{{$field['fieldID']}} = document.getElementById("subInput-{{$field['fieldID']}}");
                                let textInpLabel{{$field['fieldID']}} = document.getElementById("{{$field['fieldID']}}");
                                let h2{{$field['fieldID']}} = document.querySelector("h2[id='"+fieldID+"']");
                                let p{{$field['fieldID']}} = document.querySelector("p[id='"+fieldID+"']");
                                console.log(h2{{$field['fieldID']}})
                                save{{$field['fieldID']}}.addEventListener("click", function() {
        
        
                                textInpLabel{{$field['fieldID']}}.textContent = inputfield{{$field['fieldID']}}.value;
                                h2{{$field['fieldID']}}.textContent = inputfield{{$field['fieldID']}}.value;
                                p{{$field['fieldID']}}.textContent = subfield{{$field['fieldID']}}.value;
                                })
                                 
        
                              
                            </script>
                      @elseif ($field['type'] == 'termscondition')
                             <div class="type form-field" title="text" draggable="true">
                                 <div class="modal fade" role="dialog" id="exampleModal-{{$field['fieldID']}}">
                                     <div class="modal-dialog" role="document">
                                         <div class="modal-content">
                                           <div class="modal-header">
                                             <h5 class="modal-title" id="exampleModalLabel"></h5>
                                             <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                               <span aria-hidden="true">&times;</span>
                                             </button>
                                           </div>
                                           <div class="modal-body">
                                           <label class="form-label"><b>label name: </b></label>
                                           <input class="form-control" id="labelInput-{{$field['fieldID']}}" type="text" value="{{$field['label']}}">
                                           
                                           </div>
                                           <div class="modal-footer">
                                             <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                             <button type="button" class="btn btn-primary" data-bs-dismiss="modal" id="saveButtonText-{{$field['fieldID']}}">Save changes</button>
                                           </div>
                                         </div>
                                     </div>
                                 </div>
                                
                                 <div class="col-sm-10 input-group">
                                    <input class="form-check-input" type="checkbox" id="{{$field['fieldID']}}" name="{{$field['fieldID']}}" value="Agree">
                                    <label class="col-sm-10 col-form-label" id="termscond-{{$field['fieldID']}}">{{$field['label']}}</label>
                                    
                                     <input type="{{$field['type']}}" readonly id="textType" class="form-control typeForm formFieldHide">
                                     <input type="fieldID"  class="form-control formFieldHide" value="{{$field['fieldID']}}">
                                     <div class="input-group-append">
                                         <button class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal-{{$field['fieldID']}}">
                                         Edit
                                         </button>
                                         <button class="btn btn-outline-danger btn-sm" id="{{$field['fieldID']}}" onclick="deleteThis(event)">Delete</button>
                                     </div>
                                 </div>
                             </div>
                             <script>
                               function deleteThis(event) {
                                 event.target.parentElement.parentElement.parentElement.remove()
                               }
         
                                 let save{{$field['fieldID']}}= document.getElementById("saveButtonText-{{$field['fieldID']}}");
                                 let inputfield{{$field['fieldID']}} = document.getElementById("labelInput-{{$field['fieldID']}}");
                                 let textInpLabel{{$field['fieldID']}} = document.getElementById("termscond-{{$field['fieldID']}}");
         
                                 save{{$field['fieldID']}}.addEventListener("click", function() {
         
                                 console.log(inputfield{{$field['fieldID']}}.value)
                                 textInpLabel{{$field['fieldID']}}.textContent = inputfield{{$field['fieldID']}}.value;
         
         
                                 })
                                  
         
                               
                             </script>
                        @endif
                        @endif
                      @endforeach
                    </div>
            
                    @if ($pageNumber > 1)
                      <button class="btn btn-outline-danger">Remove Page</button>
                    @endif
            
                    <hr>
                  </div>
                </div>
              </div>
            @endfor
            
            
      </div><!-- End Left side columns -->

     
      <div class="col-lg-2"></div>
    </div>
  </div>
  
  <div class="tab-pane fade publish" id="publish">
    <div class="row">
      <div class="col-lg-2">
      </div>
      <div class="col-lg-8">
        <div style="margin-top: 120px">
          <div class="alert alert-primary alert-dismissible fade show" role="alert">
            <h4 class="alert-heading">Form Builder</h4>
            <p><i class="bi bi-exclamation-diamond"></i> Make sure label name for each fields is unique</p>
            <p><i class="bi bi-exclamation-diamond"></i> Form Title must be filled in (without 'Form' at the end)</p>
            <p><i class="bi bi-exclamation-diamond"></i> After done building your form, click on 'Create' button below</p>
            <hr>
          </div>
        </div>
        <div id="typeError" class="alert alert-danger" style="display: none;"></div>
        <div class="card p-3" role="alert">
          <h5 class="card-title text-center">Form Type</h5>
          <p class="text-center">Enter a name for your form</p>
          <hr>
          <div class="p-2">
            <div class="col-12 pt-2">
              <label class="form-label" ><b>Form Type*</b></label>
              <input type="text" name="formType" class="form-control form-type" value="{{ $form->type }}">
            </div>
          </div>
         
        </div>
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
          <h5 class="card-title text-center">Notification</h5>
          <p class="text-center">Select the user that needs to be notified after submitting the form</p>
          <hr>
          <div class="p-2">
            <div class="col-12 pt-2">
              <h5 class="form-label">Select Here</h5>
            <select id="e3" class="form-select" name="notifications" multiple>
              @php
                  $formJsonNotify = json_decode($form['notify']);
                  if ($formJsonNotify !== null) {
                    $formNotify = explode(",", $formJsonNotify[0]);
                  }
              @endphp
              @if (isset($formNotify))
              @foreach ($formNotify as $item)
              <option value="{{$item}}" selected>{{$item}}</option>
              @endforeach
              @endif
              @foreach ($allUser as $item)
                  <option value="{{$item->email}}">{{$item->email}}</option>
              @endforeach
            </select>
            <input type="hidden" id="selectedValuesEdit" name="notifications">
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
          <button type="button" class="btn btn-success" data-bs-dismiss="modal" id="saveEditBuild">Save</button>
      </div>
      </div>
      <div class="col-lg-2">
      </div>
    </div>
  </div>
</div>
</section>
  <script>
    function previewImageEdit(event, fieldID) {
        const input = event.target;
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function (e) {
                const preview = document.getElementById('preview-'+fieldID);
                preview.src = e.target.result;
                preview.style.display = 'block';
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
<script>
  function previewImage(event, idValueImage) {
    const input = event.target;
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function (event) {
            const preview = document.getElementById(idValueImage);
            console.log(preview)
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
  document.addEventListener('DOMContentLoaded', function () {
      const canvas = document.getElementById('signatureCanvas');
      const clearButton = document.getElementById('clearButton');
      const saveButton = document.getElementById('saveButton');
      const savedSignature = document.getElementById('savedSignature');
  
      const context = canvas.getContext('2d');
      let isDrawing = false;
      
      canvas.addEventListener('mousedown', (event) => {
          isDrawing = true;
          const x = event.clientX - canvas.getBoundingClientRect().left;
          const y = event.clientY - canvas.getBoundingClientRect().top;
          context.beginPath();
          context.moveTo(x, y);
      });
  
      canvas.addEventListener('mousemove', (event) => {
          if (!isDrawing) return;
  
          const x = event.clientX - canvas.getBoundingClientRect().left;
          const y = event.clientY - canvas.getBoundingClientRect().top;
  
          context.lineWidth = 2;
          context.lineCap = 'round';
          context.strokeStyle = '#000';
  
          context.lineTo(x, y);
          context.stroke();
          context.beginPath();
          context.moveTo(x, y);
      });
  
      canvas.addEventListener('mouseup', () => {
          isDrawing = false;
      });
  
      clearButton.addEventListener('click', () => {
          context.clearRect(0, 0, canvas.width, canvas.height);
      });
  
      saveButton.addEventListener('click', () => {
          const signatureImage = canvas.toDataURL();
          savedSignature.src = signatureImage;
      });
  });
  
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
@endsection


  