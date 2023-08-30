function clicked(event) {
    const data = event.target.textContent;

   /*==========================================TEXT INPUT=============================================================================*/
   if (data == " Text Input") {

    //create element for the div and all the label and input inside div with class form-control
    const formElement = document.createElement("div");
    formElement.classList.add("form-field")
    formElement.setAttribute('title', 'text')
    formElement.setAttribute('draggable', 'true')

    
    //create label
    const label = document.createElement('label');
    label.textContent = data;
    label.classList.add("col-sm-2");
    label.classList.add("col-form-label")
    label.classList.add("labelBold")
    const idTime = Date.now() //set an unique id for each label
    const idValue = "textInputLabel-"+idTime
    label.setAttribute("id", idValue )

    //create input
    const inputDiv = document.createElement("div")
    inputDiv.classList.add("col-sm-10")
    inputDiv.classList.add("input-group")

    //create button Div
    const buttonDiv = document.createElement("div")
    buttonDiv.classList.add("input-group-append")
    
    const input = document.createElement('input');
    input.type = "text"
    input.readOnly = true;
    input.setAttribute("id", idValue);
    input.classList.add("form-control");
    input.classList.add("typeForm");

    const fieldID = document.createElement("input");
    fieldID.type = "fieldID"
    fieldID.classList.add("formFieldHide");
    fieldID.value = 'text'+Date.now();
    
    inputDiv.appendChild(input)
    inputDiv.appendChild(fieldID)
  
    //edit button
    const edit = document.createElement('button');
    edit.classList.add("btn")
    edit.classList.add("btn-outline-primary")
    //edit.classList.add("btn-sm")
    edit.setAttribute("data-bs-toggle", "modal");
    
    edit.setAttribute("data-bs-target", "#exampleModal-"+Date.now());
    edit.textContent = "Edit"

    edit.addEventListener("click", function(event) {
        
        openModal();
      });
    // Event listener for the "Edit" button
     function openModal() {
       const myModal = document.getElementById("exampleModal-" + Date.now());
       const bootstrapModal = new bootstrap.Modal(myModal);
       bootstrapModal.show();
     }

   //modal
   const modalDiv = document.createElement('div')
   modalDiv.classList.add("modal");
   modalDiv.classList.add('fade');
   modalDiv.setAttribute("role", "dialog");
   modalDiv.setAttribute("id", "exampleModal-"+Date.now());
   // Give a unique ID to the modalDiv

   // Add the modal content (you can customize this part as needed)
   modalDiv.innerHTML = `
   <div class="modal-dialog" role="document">
     <div class="modal-content">
       <div class="modal-header">
         <h5 class="modal-title" id="exampleModalLabel">${data}</h5>
         <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
           <span aria-hidden="true">&times;</span>
         </button>
       </div>
       <div class="modal-body">
       <label class="form-label"><b>label name: </b></label>
       <input class="form-control" id="labelInput-${idValue}" type="text" value="${data}">
       <label class="form-label pt-3"><b>Required  </b></label>
       <input class="form-check" id="requiredInput-${idValue}" type="checkbox">
       <label class="form-label pt-2"><b>Text Type:  </b></label>
       <select class="form-select" id="selectInput-${idValue}">
           <option value="text">text</option>
           <option value="email">email</option>
           </select>
       
       
       </div>
       <div class="modal-footer">
         <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
         <button type="button" class="btn btn-primary" data-bs-dismiss="modal" id="saveButtonText-${idValue}" >Save changes</button>
       </div>
     </div>
   </div>
 
   `;

    formElement.appendChild(modalDiv);

    function saveForm(e) {
        
       let input = inputfield.value;
       //textInpLabel.textContent = input;
       let inp = e.target.parentElement.parentElement.parentElement.parentElement.parentElement.querySelector("#"+idValue)
       inp.textContent = input;
       if (requiredField.checked) {
        const textInput = document.getElementById('textType');
        textInput.required = true
       } 

       const selectedValue = selectField.options[selectField.selectedIndex].value
           console.log(selectedValue)
           if (selectedValue == "email") {
            textInp.type = "email"
           }
      
       //console.log(inputfield)
     
   }

   //delete button an function
    const del = document.createElement('button');
    del.classList.add("btn")
    del.classList.add("btn-outline-danger");
    //del.classList.add("btn-sm")
    //const i = document.createElement("i")
    //i.classList.add("bi")
    //i.classList.add("bi-trash3-fill")
    //del.appendChild(i);
    del.setAttribute("id", idValue)
    del.textContent ="Delete"
    
    del.addEventListener('click', function(e){
      e.target.parentElement.parentElement.parentElement.remove()

    })
    
    //insert all element together
    const container = document.querySelector('.form-builder');
    formElement.appendChild(label);
    buttonDiv.appendChild(edit);
    buttonDiv.appendChild(del);
    inputDiv.appendChild(buttonDiv)
    formElement.appendChild(inputDiv);
    container.appendChild(formElement)
  


    //save edited modal
    let save = document.getElementById("saveButtonText-"+idValue);
    let inputfield = document.getElementById("labelInput-"+idValue);
    let requiredField = document.getElementById('requiredInput-'+idValue)
    let textInpLabel = document.getElementById(idValue);
    let textInp = document.querySelector("input[id='"+idValue+"']");
    let selectField = document.getElementById("selectInput-"+idValue);
    save.addEventListener("click", saveForm);

    // Collect the form data into a JSON object
    /*const formData = {
    label: data,
    inputType: input.type,
    value: input.value || null,
    }; */

   // Convert the JSON object to a JSON string
   //const formDataJSON = JSON.stringify(formData);

}
/*==========================================TEXTAREA=============================================================================*/
else if (data == " Textarea") {

    const formElement = document.createElement("div");
    formElement.classList.add("form-field")
    formElement.setAttribute('title', 'textarea')
    formElement.setAttribute('draggable', 'true')
    const label = document.createElement('label');
    label.textContent = data;
    label.classList.add("col-sm-2");
    label.classList.add("col-form-label");
    label.classList.add("labelBold")
    const idTime = Date.now() //set an unique id for each label
    const idValueTextArea = "textInputLabel-"+idTime
    label.setAttribute("id", idValueTextArea);

    const textareaDiv = document.createElement("div")
    textareaDiv.classList.add("col-sm-10")
    textareaDiv.classList.add("input-group")

    const buttonDiv = document.createElement("div")
    buttonDiv.classList.add("input-group-append");

    const input = document.createElement('textarea');
    input.classList.add("form-control");
    input.classList.add("typeForm");
    input.setAttribute('type', 'textarea');
    input.setAttribute('id', 'textarea');

    const fieldID = document.createElement("input");
    fieldID.type = "fieldID"
    fieldID.classList.add("formFieldHide");
    fieldID.value = 'textarea'+Date.now();

    textareaDiv.appendChild(input);
    textareaDiv.appendChild(fieldID);
    



    const edit = document.createElement('button');
    edit.classList.add("btn")
    edit.classList.add("btn-outline-primary")
    //edit.classList.add("btn-sm")
    edit.setAttribute("data-bs-toggle", "modal");
    edit.setAttribute("data-bs-target", "#exampleModal-" + Date.now());
    edit.textContent = "Edit"

    edit.addEventListener("click", function(event) {
        
        openModal(formElement);
      });
    

      function openModal(formElement) {
        const data = formElement.querySelector("label").textContent;
        const myModal = document.getElementById("exampleModal-" + Date.now());
        const bootstrapModal = new bootstrap.Modal(myModal);
    
        // Store references to the current modal's label and input elements
        const inputfield = myModal.querySelector("#labelInput");
        const textInpLabel = formElement.querySelector("#textInputLabel");
    
        // Update the input field in the modal with the current label text
        inputfield.value = textInpLabel.textContent;
    
        bootstrapModal.show();
    }
    


   //modal
   const modalDiv = document.createElement('div')
   modalDiv.classList.add("modal");
   modalDiv.classList.add('fade');
   modalDiv.setAttribute("role", "dialog");
   modalDiv.setAttribute("id", "exampleModal-" + Date.now());
 // Give a unique ID to the modalDiv

   // Add the modal content (you can customize this part as needed)
   modalDiv.innerHTML = `
   <div class="modal-dialog" role="document">
     <div class="modal-content">
       <div class="modal-header">
         <h5 class="modal-title" id="exampleModalLabel">${data}</h5>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true">&times;</span>
         </button>
       </div>
       <div class="modal-body">
       <label class="form-label"><b>label name: </b></label>
       <input class="form-control" id="labelInputArea-${idValueTextArea}" type="text" value="${data}">
       <label class="form-label pt-3"><b>Required  </b></label>
       <input class="form-check" id="requiredInput-${idValueTextArea}" type="checkbox">
       
       </div>
       <div class="modal-footer">
         
         <button type="button" class="btn btn-primary" data-dismiss="modal" id="saveButtonTextArea-${idValueTextArea}">Save changes</button>
       </div>
     </div>
   </div>
 
   `;

    formElement.appendChild(modalDiv);

    function saveForm(formElement) {
      
      const textInpLabel = formElement.querySelector("#"+idValueTextArea);
      const input = formElement.querySelector("#labelInputArea-"+idValueTextArea).value;
  
      textInpLabel.textContent = input;
      if (requiredField.checked) {
        const textInput = document.getElementById('textarea');
        textInput.required = true
       } 
  }
  

    const del = document.createElement('button');
    del.classList.add("btn")
    del.classList.add("btn-outline-danger")
    //del.classList.add("btn-sm")
    //const i = document.createElement("i")
    //i.classList.add("bi")
    //i.classList.add("bi-trash3-fill")
    //del.appendChild(i);
    del.textContent ="Delete"
    
    del.addEventListener('click', function(e){
      e.target.parentElement.parentElement.parentElement.remove()
  
    })
    const container = document.querySelector('.form-builder');
    formElement.appendChild(label);
    buttonDiv.appendChild(edit);
    buttonDiv.appendChild(del);
    textareaDiv.appendChild(buttonDiv)
    formElement.appendChild(textareaDiv);
    container.appendChild(formElement);


    let save = document.getElementById("saveButtonTextArea-"+idValueTextArea);
    let requiredField = document.getElementById('requiredInput-'+idValueTextArea)
    //let inputfield = document.getElementById("labelInputArea");
    //let textAreaLabel = document.getElementById("textArea");
    save.addEventListener("click", function() {
      saveForm(formElement);
  });
  
}
/*==========================================FILE INPUT=============================================================================*/
else if (data == " File Input") {

   //create element for the div and all the label and input inside div with class form-control
   const formElement = document.createElement("div");
   formElement.classList.add("form-field")
   formElement.setAttribute('title', 'file')
   formElement.setAttribute('draggable', 'true')
   const label = document.createElement('label');
   label.textContent = data;
   label.classList.add("col-sm-2")
   label.classList.add("col-form-label")
   label.classList.add("labelBold")
   const idTime = Date.now() //set an unique id for each label
   const idValueFile = "fileInputLabel-"+idTime
   label.setAttribute("id", idValueFile)

   const fileDiv = document.createElement("div")
   fileDiv.classList.add("col-sm-10")
   fileDiv.classList.add("input-group")
   const buttonDiv = document.createElement("div")
   buttonDiv.classList.add("input-group-append");

   const input = document.createElement('input');
   input.type = "file"
   input.setAttribute("accept", "image/*");
   input.setAttribute("capture", "user");
   
   input.classList.add("form-control");
   const hinput = document.createElement('input');
   hinput.type = "file allFile";
   hinput.setAttribute("id", "file");
   hinput.classList.add("formFieldHide");
   hinput.classList.add("typeForm");

  const fieldID = document.createElement("input");
  fieldID.type = "fieldID"
  fieldID.classList.add("formFieldHide");
  fieldID.value = 'file'+Date.now();
   
   fileDiv.appendChild(input)
   fileDiv.appendChild(hinput)
   fileDiv.appendChild(fieldID)

   //edit button
   const edit = document.createElement('button');
   edit.classList.add("btn")
   edit.classList.add("btn-outline-primary")
   //edit.classList.add("btn-sm")
   edit.setAttribute("data-bs-toggle", "modal");
   edit.setAttribute("data-bs-target", "#exampleModal-" + Date.now());
   edit.textContent = "Edit"

   edit.addEventListener("click", function() {
       openModal();
     });
   

     function openModal() {
       const myModal = document.getElementById("exampleModal-" + Date.now());
       const bootstrapModal = new bootstrap.Modal(myModal);
       bootstrapModal.show();
     }


  //modal
  const modalDiv = document.createElement('div')
  modalDiv.classList.add("modal");
  modalDiv.classList.add('fade');
  modalDiv.setAttribute("role", "dialog");
  modalDiv.setAttribute("id", "exampleModal-" + Date.now());
  // Give a unique ID to the modalDiv

  // Add the modal content (you can customize this part as needed)
  modalDiv.innerHTML = `
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">${data}</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <label class="form-label"><b>label name: </b></label>
      <input class="form-control" id="filelabelInput-${idValueFile}" type="text" value="${data}">
      <label class="form-label pt-3"><b>Required  </b></label>
      <input class="form-check" id="requiredInput-${idValueFile}" type="checkbox">
      
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" data-bs-dismiss="modal" id="saveButtonFile-${idValueFile}">Save changes</button>
      </div>
    </div>
  </div>

  `;

   formElement.appendChild(modalDiv);

   function saveForm() {
      
      let input = inputfield.value;
      fileInpLabel.textContent = input;
      if (requiredField.checked) {
        const textInput = document.getElementById('file');
        textInput.required = true
       } 
  }

  //delete button an function
   const del = document.createElement('button');
   del.classList.add("btn")
   del.classList.add("btn-outline-danger")
   //del.classList.add("btn-sm")
   //const i = document.createElement("i")
   //i.classList.add("bi")
   //i.classList.add("bi-trash3-fill")
   //del.appendChild(i);
   del.textContent ="Delete"
   
   del.addEventListener('click', function(e){
    e.target.parentElement.parentElement.parentElement.remove()
    
   
   })
   
   //insert all element together
   const container = document.querySelector('.form-builder');
   formElement.appendChild(label);
   buttonDiv.appendChild(edit);
   buttonDiv.appendChild(del);
   fileDiv.appendChild(buttonDiv)
   formElement.appendChild(fileDiv);
   container.appendChild(formElement);


   //save edited modal
   let save = document.getElementById("saveButtonFile-"+idValueFile);
   let inputfield = document.getElementById("filelabelInput-"+idValueFile);
   let fileInpLabel = document.getElementById(idValueFile);
   let requiredField = document.getElementById('requiredInput-'+idValueFile)
   save.addEventListener("click", saveForm);

}
/*==========================================DATE INPUT=============================================================================*/
else if (data == " Date Input"){

   //create element for the div and all the label and input inside div with class form-control
   const formElement = document.createElement("div");
   formElement.classList.add("form-field")
   formElement.setAttribute('draggable', 'true')
   const label = document.createElement('label');
   label.textContent = data;
   label.classList.add("col-sm-2")
   label.classList.add("col-form-label")
   label.classList.add("labelBold")
   const idTime = Date.now() //set an unique id for each label
   const idValueDate = "dateInputLabel-"+idTime
   label.setAttribute("id", idValueDate)

   const dateDiv = document.createElement("div")
   dateDiv.classList.add("col-sm-10")
   dateDiv.classList.add("input-group")
   const buttonDiv = document.createElement("div")
   buttonDiv.classList.add("input-group-append");

   const input = document.createElement('input');
   input.type = "date";
   input.setAttribute("id", "date");
   input.classList.add("form-control");
   input.classList.add("typeForm");

   const fieldID = document.createElement("input");
    fieldID.type = "fieldID"
    fieldID.classList.add("formFieldHide");
    fieldID.value = 'date'+Date.now();
   
   dateDiv.appendChild(input)
   dateDiv.appendChild(fieldID)

   //edit button
   const edit = document.createElement('button');
   edit.classList.add("btn")
   edit.classList.add("btn-outline-primary")
   //edit.classList.add("btn-sm")
   edit.setAttribute("data-bs-toggle", "modal");
   edit.setAttribute("data-bs-target", "#exampleModal-" + Date.now());
   edit.textContent = "Edit"

   edit.addEventListener("click", function() {
       openModal();
     });
   

     function openModal() {
       const myModal = document.getElementById("exampleModal-" + Date.now());
       const bootstrapModal = new bootstrap.Modal(myModal);
       bootstrapModal.show();
     }


  //modal
  const modalDiv = document.createElement('div')
  modalDiv.classList.add("modal");
  modalDiv.classList.add('fade');
  modalDiv.setAttribute("role", "dialog");
  modalDiv.setAttribute("id", "exampleModal-" + Date.now());
  // Give a unique ID to the modalDiv

  // Add the modal content (you can customize this part as needed)
  modalDiv.innerHTML = `
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">${data}</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <label class="form-label"><b>label name: </b></label>
      <input class="form-control" id="datelabelInput-${idValueDate}" type="text" value="${data}">
      <label class="form-label pt-3"><b>Required  </b></label>
      <input class="form-check" id="requiredInput-${idValueDate}" type="checkbox">
      
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" data-bs-dismiss="modal" id="saveButtonDate-${idValueDate}">Save changes</button>
      </div>
    </div>
  </div>

  `;

   formElement.appendChild(modalDiv);

   function saveForm() {
       
      let input = inputfield.value;
      dateInpLabel.textContent = input;
      if (requiredField.checked) {
        const textInput = document.getElementById('date');
        textInput.required = true
       } 
  }

  //delete button an function
   const del = document.createElement('button');
   del.classList.add("btn")
   del.classList.add("btn-outline-danger")
   //del.classList.add("btn-sm")
   //const i = document.createElement("i")
   //i.classList.add("bi")
   //i.classList.add("bi-trash3-fill")
   //del.appendChild(i);
   del.textContent ="Delete"
   
   del.addEventListener('click', function(e){
    e.target.parentElement.parentElement.parentElement.remove()
   
   })
   
   //insert all element together
   const container = document.querySelector('.form-builder');
   formElement.appendChild(label);
   buttonDiv.appendChild(edit);
   buttonDiv.appendChild(del);
   dateDiv.appendChild(buttonDiv)
   formElement.appendChild(dateDiv);
   container.appendChild(formElement);


   //save edited modal
   let save = document.getElementById("saveButtonDate-"+idValueDate);
   let inputfield = document.getElementById("datelabelInput-"+idValueDate);
   let dateInpLabel = document.getElementById(idValueDate);
   let requiredField = document.getElementById('requiredInput-'+idValueDate)
   save.addEventListener("click", saveForm);
}
/*==========================================TIME INPUT=============================================================================*/
else if (data == " Time Input") {

   //create element for the div and all the label and input inside div with class form-control
   const formElement = document.createElement("div");
   formElement.classList.add("form-field")
   formElement.setAttribute('draggable', 'true')
   const label = document.createElement('label');
   label.textContent = data;
   label.classList.add("col-sm-2")
   label.classList.add("col-form-label")
   label.classList.add("labelBold")
   const idTime = Date.now() //set an unique id for each label
   const idValueTime = "timeInputLabel-"+idTime
   label.setAttribute("id", idValueTime)

   const timeDiv = document.createElement("div")
   timeDiv.classList.add("col-sm-10")
   timeDiv.classList.add("input-group")
   const buttonDiv = document.createElement("div")
   buttonDiv.classList.add("input-group-append");

   const input = document.createElement('input');
   input.type = "time";
   input.setAttribute("id", "time")
   input.classList.add("form-control");
   input.classList.add("typeForm");

   const fieldID = document.createElement("input");
    fieldID.type = "fieldID"
    fieldID.classList.add("formFieldHide");
    fieldID.value = 'time'+Date.now();
   
   timeDiv.appendChild(input)
   timeDiv.appendChild(fieldID)

   //edit button
   const edit = document.createElement('button');
   edit.classList.add("btn")
   edit.classList.add("btn-outline-primary")
   //edit.classList.add("btn-sm")
   edit.setAttribute("data-bs-toggle", "modal");
   edit.setAttribute("data-bs-target", "#exampleModal-" + Date.now());
   edit.textContent = "Edit"

   edit.addEventListener("click", function() {
       openModal();
     });
   

     function openModal() {
       const myModal = document.getElementById("exampleModal-" + Date.now());
       const bootstrapModal = new bootstrap.Modal(myModal);
       bootstrapModal.show();
     }


  //modal
  const modalDiv = document.createElement('div')
  modalDiv.classList.add("modal");
  modalDiv.classList.add('fade');
  modalDiv.setAttribute("role", "dialog");
  modalDiv.setAttribute("id", "exampleModal-" + Date.now());
  // Give a unique ID to the modalDiv

  // Add the modal content (you can customize this part as needed)
  modalDiv.innerHTML = `
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">${data}</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <label class="form-label"><b>label name: </b></label>
      <input class="form-control" id="timelabelInput-${idValueTime}" type="text" value="${data}">
      <label class="form-label pt-3"><b>Required  </b></label>
      <input class="form-check" id="requiredInput-${idValueTime}" type="checkbox">
      
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" data-bs-dismiss="modal" id="saveButtonTime-${idValueTime}">Save changes</button>
      </div>
    </div>
  </div>

  `;

   formElement.appendChild(modalDiv);

   function saveForm() {
       
      let input = inputfield.value;
      timeInpLabel.textContent = input;
      if (requiredField.checked) {
        const textInput = document.getElementById('time');
        textInput.required = true
       } 
  }

  //delete button an function
   const del = document.createElement('button');
   del.classList.add("btn")
   del.classList.add("btn-outline-danger")
   //del.classList.add("btn-sm")
   //const i = document.createElement("i")
   //i.classList.add("bi")
   //i.classList.add("bi-trash3-fill")
   //del.appendChild(i);
   del.textContent ="Delete"
   
   del.addEventListener('click', function(e){
    e.target.parentElement.parentElement.parentElement.remove()
   })
   
   //insert all element together
   const container = document.querySelector('.form-builder');
   formElement.appendChild(label);
   buttonDiv.appendChild(edit);
   buttonDiv.appendChild(del);
   timeDiv.appendChild(buttonDiv)
   formElement.appendChild(timeDiv);
   container.appendChild(formElement);


   //save edited modal
   let save = document.getElementById("saveButtonTime-"+idValueTime);
   let inputfield = document.getElementById("timelabelInput-"+idValueTime);
   let timeInpLabel = document.getElementById(idValueTime);
   let requiredField = document.getElementById('requiredInput-'+idValueTime)
   save.addEventListener("click", saveForm);
}
/*==========================================SELECT FIELD=============================================================================*/
else if (data == " Select Field"){

   //create element for the div and all the label and input inside div with class form-control
   const formElement = document.createElement("div");
   formElement.classList.add("form-field")
   formElement.setAttribute('draggable', 'true')
   const label = document.createElement('label');
   label.textContent = data;
   label.classList.add("col-form-label")
   label.classList.add("labelBold")
   const idTime = Date.now() //set an unique id for each label
   const idValueSelect = "selectInputLabel-"+idTime
   label.setAttribute("id", idValueSelect)

   const selectDiv = document.createElement("div");
   const select = document.createElement("select");
   select.classList.add("form-select");
   select.classList.add("typeForm");
   select.setAttribute("name", "select");
   select.setAttribute("type", "select");
   select.setAttribute("id", "select");
   select.setAttribute("aria-label", "Default select example")
   const option = document.createElement("option")
   option.textContent = "Select";
   option.value = option.textContent;

   const fieldID = document.createElement("input");
    fieldID.type = "fieldID"
    fieldID.classList.add("formFieldHide");
    fieldID.value = 'select'+Date.now();
  

   select.appendChild(option);
   
   selectDiv.appendChild(select);
   selectDiv.appendChild(fieldID)

   let allOptionTexts = '';
   for (let i = 0; i < select.options.length; i++) {
     allOptionTexts += select.options[i].textContent + '\n';
   }
  
   


   //edit button
   const edit = document.createElement('button');
   edit.classList.add("btn")
   edit.classList.add("btn-outline-primary")
   edit.classList.add("btn-sm")
   edit.setAttribute("data-bs-toggle", "modal");
   edit.setAttribute("data-bs-target", "#exampleModal-" + Date.now());
   edit.textContent = "Edit"

   edit.addEventListener("click", function() {
       openModal();
     });
   

     function openModal() {
       const myModal = document.getElementById("exampleModal-" + Date.now());
       const bootstrapModal = new bootstrap.Modal(myModal);
       bootstrapModal.show();
     }


  //modal
  const modalDiv = document.createElement('div')
  modalDiv.classList.add("modal");
  modalDiv.classList.add('fade');
  modalDiv.setAttribute("role", "dialog");
  modalDiv.setAttribute("id", "exampleModal-" + Date.now());
  // Give a unique ID to the modalDiv

  // Add the modal content (you can customize this part as needed)
  modalDiv.innerHTML = `
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">${data}</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <label class="label-control"><b>label name: </b></label>
      <input class="form-control" id="selectlabel-${idValueSelect}" type="text" value="${data}"> <br>
      <label class="label-control"><b>Select Option: </b></label>
      <div class="alert alert-primary" role="alert">Type the option in and press 'ENTER' to add another option</div>
      <textarea class="form-control" id="selectOption-${idValueSelect}">
      ${allOptionTexts}
      </textarea>
      <label class="form-label pt-3"><b>Required  </b></label>
      <input class="form-check" id="requiredInput-${idValueSelect}" type="checkbox">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" data-bs-dismiss="modal" id="saveButtonSelect-${idValueSelect}">Save changes</button>
      </div>
    </div>
  </div>

  `;

   formElement.appendChild(modalDiv);

   function saveForm() {
  
    let input = inputfield.value;
    selectLabel.textContent = input;

    const selectOption = document.getElementById("selectOption-"+idValueSelect);
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

    if (requiredField.checked) {
      const textInput = document.getElementById('select');
      textInput.required = true
     } 
    
  }

  //delete button an function
   const del = document.createElement('button');
   del.classList.add("btn")
   del.classList.add("btn-outline-danger")
   del.classList.add("btn-sm")
   //const i = document.createElement("i")
   //i.classList.add("bi")
   //i.classList.add("bi-trash3-fill")
   //del.appendChild(i);
   del.textContent ="Delete"
   
   del.addEventListener('click', function(e){
    e.target.parentElement.remove()
    //console.log(e.target.parentElement)
   })
   
   //insert all element together
   const container = document.querySelector('.form-builder');
   formElement.appendChild(label);
   formElement.appendChild(selectDiv);
   formElement.appendChild(edit);
   formElement.appendChild(del);
   container.appendChild(formElement);


   //save edited modal
   let save = document.getElementById("saveButtonSelect-"+idValueSelect);
   let inputfield = document.getElementById("selectlabel-"+idValueSelect);
   let selectLabel = document.getElementById(idValueSelect);
   let requiredField = document.getElementById('requiredInput-'+idValueSelect)
   //let selectOption = document.getElementById("selectOption");
   //let selectval = selectOption.value;
   //let options = selectval.split('/n');
   
   save.addEventListener("click", saveForm);
} 
/*==========================================RADIO FIELD=============================================================================*/
else if (data == " Radio Field"){

  //create element for the div and all the label and input inside div with class form-control
  const formElement = document.createElement("fieldset");
  formElement.classList.add("form-field")
  formElement.setAttribute('draggable', 'true')
  const legend = document.createElement('legend');
  legend.textContent = data;
  legend.classList.add("col-form-label")
  legend.classList.add("labelBold")
  const idTime = Date.now() //set an unique id for each label
  const idValueRadio = "radioLabel-"+idTime
  legend.setAttribute("id", idValueRadio)

  const radioDiv = document.createElement("div");
  const divTime = Date.now()
  const idRadioDiv = "radioDiv-" +divTime
  radioDiv.setAttribute("id", idRadioDiv)
  radioDiv.classList.add("form-check")
  const input = document.createElement("input");
  input.type = "radio";
  input.value = "option";
  input.name = "formBuildRadio";
  input.classList.add("form-check-input");
  input.setAttribute("id", idValueRadio);
  const label = document.createElement("label")
  label.classList.add("form-check-label");
  input.classList.add("typeForm");
  label.textContent = "First Radio";

  const fieldID = document.createElement("input");
    fieldID.type = "fieldID"
    fieldID.classList.add("formFieldHide");
    fieldID.value = 'radio'+Date.now();


  radioDiv.appendChild(input);
  radioDiv.appendChild(label);

  

  const allRadioInputs = document.querySelectorAll('input[type="radio"][name="formBuildRadio"]');
  let labels = "";

  allRadioInputs.forEach((radioInput) => {
    // Find the parent div that contains the radio input and its label
    const radioDiv = radioInput.closest(".form-check");

    // Get the label element associated with the radio input
    const label = radioDiv.querySelector("label.form-check-label");

    // If a label is found, add its text content to the labels string
    if (label) {
      labels += label.textContent.trim() + "\n";
    }
  });
 console.log(labels)
 
  


  //edit button
  const edit = document.createElement('button');
  edit.classList.add("btn")
  edit.classList.add("btn-outline-primary")
  edit.classList.add("btn-sm")
  edit.setAttribute("data-bs-toggle", "modal");
  edit.setAttribute("data-bs-target", "#exampleModal-" + Date.now());
  edit.textContent = "Edit"

  edit.addEventListener("click", function() {
      openModal();
    });
  

    function openModal() {
      const myModal = document.getElementById("exampleModal-" + Date.now());
      const bootstrapModal = new bootstrap.Modal(myModal);
      bootstrapModal.show();
    }


 //modal
 const modalDiv = document.createElement('div')
 modalDiv.classList.add("modal");
 modalDiv.classList.add('fade');
 modalDiv.setAttribute("role", "dialog");
 modalDiv.setAttribute("id", "exampleModal-" + Date.now());
 // Give a unique ID to the modalDiv

 // Add the modal content (you can customize this part as needed)
 modalDiv.innerHTML = `
 <div class="modal-dialog" role="document">
   <div class="modal-content">
     <div class="modal-header">
       <h5 class="modal-title" id="exampleModalLabel">${data}</h5>
       <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
         <span aria-hidden="true">&times;</span>
       </button>
     </div>
     <div class="modal-body">
     <label class="form-label">label name: </label>
     <input class="form-control" id="radiolabel-${idValueRadio}" type="text" value="${data}"> <br>
     <label class="form-label">Options: </label>
     <div class="alert alert-primary" role="alert">Type the option in and press 'ENTER' to add another option</div>
     <textarea class="form-control" id="radioOption-${idValueRadio}"></textarea>
     <label class="form-label pt-3"><b>Required  </b></label>
      <input class="form-check" id="requiredInput-${idValueRadio}" type="checkbox">
     </div>
     <div class="modal-footer">
       <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
       <button type="button" class="btn btn-primary" data-bs-dismiss="modal" id="saveButtonRadio-${idValueRadio}">Save changes</button>
     </div>
   </div>
 </div>

 `;

  formElement.appendChild(modalDiv);

  function saveForm() {
 
   let input = inputfield.value;
   radioLabel.textContent = input;

   const radioOption = document.getElementById("radioOption-"+idValueRadio);
   const options = radioOption.value.trim().split('\n');
 
   //Remove the existing radioDiv element
   const radioDiv = document.querySelectorAll("#"+idRadioDiv);
   radioDiv.forEach((radDiv) => {
    radDiv.remove()
   });
  

  // Add new radio inputs and labels based on the textarea content
  options.forEach((text) => {
    if (text.trim() !== '') {
      const newRadioDiv = document.createElement("div");
      newRadioDiv.classList.add("form-check");
      newRadioDiv.setAttribute("id", idRadioDiv);
      
      const newInput = document.createElement("input");
      newInput.type = "radio";
      newInput.classList.add("form-check-input");
      newInput.setAttribute("id", idValueRadio)
      newInput.value = text.trim();
      newInput.name = "formBuildRadio";
      newInput.classList.add("typeForm");
      newRadioDiv.appendChild(newInput);

      const newLabel = document.createElement("label");
      newLabel.classList.add("form-check-label");
      newLabel.textContent = text.trim();
      newRadioDiv.appendChild(newLabel);

      formElement.appendChild(newRadioDiv);
    }
  });

  if (requiredField.checked) {
    const textInput = document.getElementById(`input[id=${idValueRadio}]`);
    textInput.required = true
   } 
   
 }

 //delete button an function
  const del = document.createElement('button');
  del.classList.add("btn")
  del.classList.add("btn-outline-danger")
  del.classList.add("btn-sm")
  //const i = document.createElement("i")
  //i.classList.add("bi")
  //i.classList.add("bi-trash3-fill")
  //del.appendChild(i);
  del.textContent ="Delete"
  
  del.addEventListener('click', function(e){
      e.target.parentElement.remove()
  
  })
  
  //insert all element together
  const container = document.querySelector('.form-builder');
  formElement.appendChild(legend);
  formElement.appendChild(fieldID);
  formElement.appendChild(radioDiv);
  formElement.appendChild(edit);
  formElement.appendChild(del);
  container.appendChild(formElement);


  //save edited modal
  let save = document.getElementById("saveButtonRadio-"+idValueRadio);
  let inputfield = document.getElementById("radiolabel-"+idValueRadio);
  let radioLabel = document.getElementById(idValueRadio);
  let requiredField = document.getElementById('requiredInput-'+idValueRadio)
  //let selectOption = document.getElementById("selectOption");
  //let selectval = selectOption.value;
  //let options = selectval.split('/n');
  
  save.addEventListener("click", saveForm);
}
/*==========================================CHECKBOX=============================================================================*/
else if(data == ' Checkbox') {
  //create element for the div and all the label and input inside div with class form-control
const formElement = document.createElement("div");
formElement.classList.add("form-field")
formElement.setAttribute('draggable', 'true')
const legend = document.createElement('legend');
legend.textContent = data;
legend.classList.add("col-form-label")
legend.classList.add("labelBold")
const idTime = Date.now() //set an unique id for each label
const idValueCheck = "checkLabel-"+idTime
legend.setAttribute("id", idValueCheck)

const checkDiv = document.createElement("div");
const divTime = Date.now()
const idCheckDiv = "checkDiv-" +divTime
checkDiv.setAttribute("id", idCheckDiv)
checkDiv.classList.add("form-check");
const input = document.createElement("input");
input.type = "checkbox";
input.value = "option";
input.name = "formBuildCheck";
input.classList.add("form-check-input");
input.classList.add("typeForm");
input.setAttribute("id", idValueCheck);
const label = document.createElement("label")
label.classList.add("form-check-label");
label.textContent = "First Checkbox";
label.setAttribute("for", "First Checkbox")

const fieldID = document.createElement("input");
    fieldID.type = "fieldID"
    fieldID.classList.add("formFieldHide");
    fieldID.value = 'check'+Date.now();

checkDiv.appendChild(input);
checkDiv.appendChild(label);


const allCheckInputs = document.querySelectorAll(`input[type="checkbox"][name="${idValueCheck}"]`);
let labels = "";

allCheckInputs.forEach((checkInput) => {
  // Find the parent div that contains the radio input and its label
  const checkDiv = checkInput.closest(".form-check");

  // Get the label element associated with the radio input
  const label = checkDiv.querySelector("label.form-check-label");

  // If a label is found, add its text content to the labels string
  if (label) {
    labels += label.textContent.trim() + "\n";
  }
});





//edit button
const edit = document.createElement('button');
edit.classList.add("btn")
edit.classList.add("btn-outline-primary")
edit.classList.add("btn-sm")
edit.setAttribute("data-bs-toggle", "modal");
edit.setAttribute("data-bs-target", "#exampleModal-" + Date.now());
edit.textContent = "Edit"

edit.addEventListener("click", function() {
    openModal();
  });


  function openModal() {
    const myModal = document.getElementById("exampleModal-" + Date.now());
    const bootstrapModal = new bootstrap.Modal(myModal);
    bootstrapModal.show();
  }


//modal
const modalDiv = document.createElement('div')
modalDiv.classList.add("modal");
modalDiv.classList.add('fade');
modalDiv.setAttribute("role", "dialog");
modalDiv.setAttribute("id", "exampleModal-" + Date.now());
// Give a unique ID to the modalDiv

// Add the modal content (you can customize this part as needed)
modalDiv.innerHTML = `
<div class="modal-dialog" role="document">
 <div class="modal-content">
   <div class="modal-header">
     <h5 class="modal-title" id="exampleModalLabel">${data}</h5>
     <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
       <span aria-hidden="true">&times;</span>
     </button>
   </div>
   <div class="modal-body">
   <label class="form-label">label name: </label>
   <input class="form-control" id="checklabel-${idValueCheck}" type="text" value="${data}"> <br>
   <label class="form-label">Select Option: </label>
   <div class="alert alert-primary" role="alert">Type the option in and press 'ENTER' to add another option</div>
   <textarea class="form-control" id="checkOption-${idValueCheck}"></textarea>
   <label class="form-label pt-3"><b>Required  </b></label>
   <input class="form-check" id="requiredInput-${idValueCheck}" type="checkbox">
   </div>
   <div class="modal-footer">
     <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
     <button type="button" class="btn btn-primary" data-bs-dismiss="modal" id="saveButtonCheck-${idValueCheck}">Save changes</button>
   </div>
 </div>
</div>

`;

formElement.appendChild(modalDiv);

function saveForm() {

 let input = inputfield.value;
 checkLabel.textContent = input;

 const checkOption = document.getElementById("checkOption-"+idValueCheck);
 const options = checkOption.value.trim().split('\n');

 //Remove the existing radioDiv element
 const checkboxDiv = document.querySelectorAll("#"+idCheckDiv);
 checkboxDiv.forEach((chDiv)  => {
  chDiv.remove();
 });
 

// Add new radio inputs and labels based on the textarea content
options.forEach((text) => {
  if (text.trim() !== '') {
    const newCheckDiv = document.createElement("div");
    newCheckDiv.classList.add("form-check");
    newCheckDiv.setAttribute("id", idCheckDiv);
    
    const newInput = document.createElement("input");
    newInput.type = "checkbox";
    newInput.classList.add("form-check-input");
    newInput.value = text.trim();
    newInput.name = "formBuildCheck";
    newInput.setAttribute("id", idValueCheck)
    newInput.classList.add("typeForm");
    newCheckDiv.appendChild(newInput);

    const newLabel = document.createElement("label");
    newLabel.classList.add("form-check-label");
    newLabel.textContent = text.trim();
    newCheckDiv.appendChild(newLabel);

    formElement.appendChild(newCheckDiv);
  }
});

if (requiredField.checked) {
  const textInput = document.getElementById(`input[id=${idValueCheck}]`);
  textInput.required = true
 } 
 
}

//delete button an function
const del = document.createElement('button');
del.classList.add("btn")
del.classList.add("btn-outline-danger")
del.classList.add("btn-sm")
//const i = document.createElement("i")
//i.classList.add("bi")
//i.classList.add("bi-trash3-fill")
//del.appendChild(i);
del.textContent ="Delete"

del.addEventListener('click', function(e){
  e.target.parentElement.remove()

})

//insert all element together
const container = document.querySelector('.form-builder');
formElement.appendChild(legend);
formElement.appendChild(fieldID)
formElement.appendChild(checkDiv);
formElement.appendChild(edit);
formElement.appendChild(del);
container.appendChild(formElement);


//save edited modal
let save = document.getElementById("saveButtonCheck-"+idValueCheck);
let inputfield = document.getElementById("checklabel-"+idValueCheck);
let checkLabel = document.getElementById(idValueCheck);
let requiredField = document.getElementById('requiredInput-'+idValueCheck)
//let selectOption = document.getElementById("selectOption");
//let selectval = selectOption.value;
//let options = selectval.split('/n');

save.addEventListener("click", saveForm);

} 
/*==========================================LOCATION=============================================================================*/
else if (data == " Location") {

//create element for the div and all the label and input inside div with class form-control
const formElement = document.createElement("div");
formElement.classList.add("form-field")
formElement.setAttribute('draggable', 'true')
//create label
const label = document.createElement('label');
label.textContent = data;
label.classList.add("col-sm-2");
label.classList.add("col-form-label")
label.classList.add("labelBold")
const idTime = Date.now() //set an unique id for each label
const idValueLocation = "textInputLabel-"+idTime
label.setAttribute("id", idValueLocation )

//create input
const inputDiv = document.createElement("div")
inputDiv.classList.add("col-sm-10")
inputDiv.classList.add("input-group")

//create button Div
const buttonDiv = document.createElement("div")
buttonDiv.classList.add("input-group-append")

const input = document.createElement('input');
input.type = "text location"
input.readOnly = true;
input.setAttribute("id", "textType");
input.classList.add("form-control");
input.classList.add("typeForm");
input.classList.add("formFieldHide");

const fieldID = document.createElement("input");
    fieldID.type = "fieldID"
    fieldID.classList.add("formFieldHide");
    fieldID.value = 'loc'+Date.now();

const loc = document.createElement('button');
loc.classList.add("btn")
loc.classList.add("btn-outline-primary");
loc.textContent = "Get Location";

inputDiv.appendChild(input)
inputDiv.appendChild(loc)
inputDiv.appendChild(fieldID)

//edit button
const edit = document.createElement('button');
edit.classList.add("btn")
edit.classList.add("btn-outline-primary")
//edit.classList.add("btn-sm")
edit.setAttribute("data-bs-toggle", "modal");

edit.setAttribute("data-bs-target", "#exampleModal-"+Date.now());
edit.textContent = "Edit"

edit.addEventListener("click", function(event) {
    
    openModal();
  });
// Event listener for the "Edit" button
 function openModal() {
   const myModal = document.getElementById("exampleModal-" + Date.now());
   const bootstrapModal = new bootstrap.Modal(myModal);
   bootstrapModal.show();
 }

//modal
const modalDiv = document.createElement('div')
modalDiv.classList.add("modal");
modalDiv.classList.add('fade');
modalDiv.setAttribute("role", "dialog");
modalDiv.setAttribute("id", "exampleModal-"+Date.now());
// Give a unique ID to the modalDiv

// Add the modal content (you can customize this part as needed)
modalDiv.innerHTML = `
<div class="modal-dialog" role="document">
 <div class="modal-content">
   <div class="modal-header">
     <h5 class="modal-title" id="exampleModalLabel">${data}</h5>
     <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
       <span aria-hidden="true">&times;</span>
     </button>
   </div>
   <div class="modal-body">
   <label class="form-label">label name: </label>
   <input class="form-control" id="labelInput-${idValueLocation}" type="text" value="${data}">
   
   </div>
   <div class="modal-footer">
     <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
     <button type="button" class="btn btn-primary" data-bs-dismiss="modal" id="saveButtonText-${idValueLocation}" >Save changes</button>
   </div>
 </div>
</div>

`;

formElement.appendChild(modalDiv);

function saveForm(e) {
    
   let input = inputfield.value;
   //textInpLabel.textContent = input;
   let inp = e.target.parentElement.parentElement.parentElement.parentElement.parentElement.querySelector("#"+idValueLocation)
   inp.textContent = input;
   //console.log(inputfield)
 
}

//delete button an function
const del = document.createElement('button');
del.classList.add("btn")
del.classList.add("btn-outline-danger")
//del.classList.add("btn-sm")
//const i = document.createElement("i")
//i.classList.add("bi")
//i.classList.add("bi-trash3-fill")
//del.appendChild(i);
del.setAttribute("id", idValueLocation)
del.textContent ="Delete"

del.addEventListener('click', function(e){
  e.target.parentElement.parentElement.parentElement.remove()
})

//insert all element together
const container = document.querySelector('.form-builder');
formElement.appendChild(label);
buttonDiv.appendChild(edit);
buttonDiv.appendChild(del);
inputDiv.appendChild(buttonDiv)
formElement.appendChild(inputDiv);

container.appendChild(formElement);


//save edited modal
let save = document.getElementById("saveButtonText-"+idValueLocation);
let inputfield = document.getElementById("labelInput-"+idValueLocation);
let textInpLabel = document.getElementById(idValueLocation);
save.addEventListener("click", saveForm);
}
//====================================DATE AND TIME RANGE============================================================================
else if (data == " Date/Time Range") {

//create element for the div and all the label and input inside div with class form-control
const formElement = document.createElement("div");
formElement.classList.add("form-field")
formElement.setAttribute('draggable', 'true')
//create label
const label = document.createElement('label');
label.textContent = data;
label.classList.add("col-sm-2");
label.classList.add("col-form-label")
label.classList.add("labelBold")
const idTime = Date.now() //set an unique id for each label
const idValueDateTime = "textInputLabel-"+idTime
label.setAttribute("id", idValueDateTime )

//create input
const inputDiv = document.createElement("div")
inputDiv.classList.add("col-sm-10")
inputDiv.classList.add("input-group")

//create button Div
const buttonDiv = document.createElement("div")
buttonDiv.classList.add("input-group-append")

const input = document.createElement('input');
input.type = "text datetime";
input.readOnly = true;
input.classList.add("form-control");
input.classList.add("typeForm");
input.setAttribute("id", "reservationdatetime");
input.value = "07/24/2023 12:00 AM - 07/24/2023 11:59 PM"

const fieldID = document.createElement("input");
    fieldID.type = "fieldID"
    fieldID.classList.add("formFieldHide");
    fieldID.value = 'datetime'+Date.now();

inputDiv.appendChild(input)
inputDiv.appendChild(fieldID)

//edit button
const edit = document.createElement('button');
edit.classList.add("btn")
edit.classList.add("btn-outline-primary")
//edit.classList.add("btn-sm")
edit.setAttribute("data-bs-toggle", "modal");

edit.setAttribute("data-bs-target", "#exampleModal-"+Date.now());
edit.textContent = "Edit"

edit.addEventListener("click", function(event) {
    
    openModal();
  });
// Event listener for the "Edit" button
 function openModal() {
   const myModal = document.getElementById("exampleModal-" + Date.now());
   const bootstrapModal = new bootstrap.Modal(myModal);
   bootstrapModal.show();
 }

//modal
const modalDiv = document.createElement('div')
modalDiv.classList.add("modal");
modalDiv.classList.add('fade');
modalDiv.setAttribute("role", "dialog");
modalDiv.setAttribute("id", "exampleModal-"+Date.now());
// Give a unique ID to the modalDiv

// Add the modal content (you can customize this part as needed)
modalDiv.innerHTML = `
<div class="modal-dialog" role="document">
 <div class="modal-content">
   <div class="modal-header">
     <h5 class="modal-title" id="exampleModalLabel">${data}</h5>
     <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
       <span aria-hidden="true">&times;</span>
     </button>
   </div>
   <div class="modal-body">
   <label class="form-label">label name: </label>
   <input class="form-control" id="DateTimelabelInput-${idValueDateTime}" type="text" value="${data}">
   
   </div>
   <div class="modal-footer">
     <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
     <button type="button" class="btn btn-primary" data-bs-dismiss="modal" id="saveButtonText-${idValueDateTime}" >Save changes</button>
   </div>
 </div>
</div>

`;

formElement.appendChild(modalDiv);

function saveForm(e) {
    
   let input = inputfield.value;
   //textInpLabel.textContent = input;
   let inp = e.target.parentElement.parentElement.parentElement.parentElement.parentElement.querySelector("#"+idValueDateTime)
   inp.textContent = input;
   //console.log(inputfield)
 
}

//delete button an function
const del = document.createElement('button');
del.classList.add("btn")
del.classList.add("btn-outline-danger")
//del.classList.add("btn-sm")
//const i = document.createElement("i")
//i.classList.add("bi")
//i.classList.add("bi-trash3-fill")
//del.appendChild(i);
del.setAttribute("id", idValueDateTime)
del.textContent ="Delete"

del.addEventListener('click', function(e){
  e.target.parentElement.parentElement.parentElement.remove()
})

//insert all element together
const container = document.querySelector('.form-builder');
formElement.appendChild(label);
buttonDiv.appendChild(edit);
buttonDiv.appendChild(del);
inputDiv.appendChild(buttonDiv)
formElement.appendChild(inputDiv);
container.appendChild(formElement);

//save edited modal
let save = document.getElementById("saveButtonText-"+idValueDateTime);
let inputfield = document.getElementById("DateTimelabelInput-"+idValueDateTime);
let textInpLabel = document.getElementById(idValueDateTime);
save.addEventListener("click", saveForm);
}
//====================================RATING============================================================================
else if (data == " Star Rating") {

//create element for the div and all the label and input inside div with class form-control
const formElement = document.createElement("div");
formElement.classList.add("form-field")
formElement.setAttribute('draggable', 'true')
//create label
const label = document.createElement('label');
label.textContent = data;
label.classList.add("col-sm-2");
label.classList.add("col-form-label")
label.classList.add("labelBold")
const idTime = Date.now() //set an unique id for each label
const idValueRating = "RatingLabel-"+idTime
label.setAttribute("id", idValueRating )

//create input
const inputDiv = document.createElement("div")
inputDiv.classList.add("col-sm-10")
inputDiv.classList.add("input-group")
inputDiv.classList.add("star-rating")
inputDiv.classList.add("d-inline-flex")

//create button Div
const buttonDiv = document.createElement("div")
buttonDiv.classList.add("input-group-append")

const input1 = document.createElement('i');
input1.classList.add("fas")
input1.classList.add("fa-star")
const input2 = document.createElement('i');
input2.classList.add("fas")
input2.classList.add("fa-star")
const input3 = document.createElement('i');
input3.classList.add("fas")
input3.classList.add("fa-star")
const input4 = document.createElement('i');
input4.classList.add("fas")
input4.classList.add("fa-star")
const input5 = document.createElement('i');
input5.classList.add("fas")
input5.classList.add("fa-star")
const input = document.createElement('input');
input.type = "hidden";
input.classList.add("typeForm");

const fieldID = document.createElement("input");
    fieldID.type = "fieldID"
    fieldID.classList.add("formFieldHide");
    fieldID.value = 'starrating'+Date.now();



inputDiv.appendChild(input1)
inputDiv.appendChild(input2)
inputDiv.appendChild(input3)
inputDiv.appendChild(input4)
inputDiv.appendChild(input5)
inputDiv.appendChild(input)
inputDiv.appendChild(fieldID)

//edit button
const edit = document.createElement('button');
edit.classList.add("btn")
edit.classList.add("btn-outline-primary")
//edit.classList.add("btn-sm")
edit.setAttribute("data-bs-toggle", "modal");

edit.setAttribute("data-bs-target", "#exampleModal-"+Date.now());
edit.textContent = "Edit"

edit.addEventListener("click", function(event) {
    
    openModal();
  });
// Event listener for the "Edit" button
 function openModal() {
   const myModal = document.getElementById("exampleModal-" + Date.now());
   const bootstrapModal = new bootstrap.Modal(myModal);
   bootstrapModal.show();
 }

//modal
const modalDiv = document.createElement('div')
modalDiv.classList.add("modal");
modalDiv.classList.add('fade');
modalDiv.setAttribute("role", "dialog");
modalDiv.setAttribute("id", "exampleModal-"+Date.now());
// Give a unique ID to the modalDiv

// Add the modal content (you can customize this part as needed)
modalDiv.innerHTML = `
<div class="modal-dialog" role="document">
 <div class="modal-content">
   <div class="modal-header">
     <h5 class="modal-title" id="exampleModalLabel">${data}</h5>
     <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
       <span aria-hidden="true">&times;</span>
     </button>
   </div>
   <div class="modal-body">
   <label class="form-label">label name: </label>
   <input class="form-control" id="ratinglabelInput-${idValueRating}" type="text" value="${data}">
   
   </div>
   <div class="modal-footer">
     <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
     <button type="button" class="btn btn-primary" data-bs-dismiss="modal" id="saveButtonText-${idValueRating}" >Save changes</button>
   </div>
 </div>
</div>

`;

formElement.appendChild(modalDiv);

function saveForm(e) {
    
   let input = inputfield.value;
   //textInpLabel.textContent = input;
   let inp = e.target.parentElement.parentElement.parentElement.parentElement.parentElement.querySelector("#"+idValueRating)
   inp.textContent = input;
   //console.log(inputfield)
 
}

//delete button an function
const del = document.createElement('button');
del.classList.add("btn")
del.classList.add("btn-outline-danger")
//del.classList.add("btn-sm")
//const i = document.createElement("i")
//i.classList.add("bi")
//i.classList.add("bi-trash3-fill")
//del.appendChild(i);
del.setAttribute("id", idValueRating)
del.textContent ="Delete"

del.addEventListener('click', function(e){
  e.target.parentElement.parentElement.parentElement.remove()
})

//insert all element together
const container = document.querySelector('.form-builder');
formElement.appendChild(label);
buttonDiv.appendChild(edit);
buttonDiv.appendChild(del);
inputDiv.appendChild(buttonDiv)
formElement.appendChild(inputDiv);
container.appendChild(formElement);

//save edited modal
let save = document.getElementById("saveButtonText-"+idValueRating);
let inputfield = document.getElementById("ratinglabelInput-"+idValueRating);
let textInpLabel = document.getElementById(idValueRating);
save.addEventListener("click", saveForm);
}
//====================================YOUTUBE============================================================================
else if (data == " Youtube") {

//create element for the div and all the label and input inside div with class form-control
const formElement = document.createElement("div");
formElement.classList.add("form-field")
formElement.setAttribute('draggable', 'true')
//create label
const label = document.createElement('label');
label.textContent = data;
label.classList.add("col-sm-2");
label.classList.add("col-form-label")
label.classList.add("labelBold")
const idTime = Date.now() //set an unique id for each label
const idValueYoutube = "youtubeLabel-"+idTime
label.setAttribute("id", idValueYoutube)

//create input
const inputDiv = document.createElement("div")
inputDiv.classList.add("col-sm-10")
inputDiv.classList.add("input-group")
inputDiv.classList.add("star-rating")
inputDiv.classList.add("d-inline-flex")

//create button Div
const buttonDiv = document.createElement("div")
buttonDiv.classList.add("input-group-append")

const input1 = document.createElement('input');
input1.type = "text youtube";
input1.classList.add("form-control");
input1.classList.add("typeForm");
input1.classList.add("formFieldHide");
input1.value = "";
input1.setAttribute("id", "val-"+idValueYoutube)

const input = document.createElement("iframe");
input.width = 420;
input.height = 315;
input.src = ""
input.setAttribute("id", "src-"+idValueYoutube)

const fieldID = document.createElement("input");
    fieldID.type = "fieldID"
    fieldID.classList.add("formFieldHide");
    fieldID.value = 'youtube'+Date.now();


inputDiv.appendChild(input1)
inputDiv.appendChild(input)
inputDiv.appendChild(fieldID)


//edit button
const edit = document.createElement('button');
edit.classList.add("btn")
edit.classList.add("btn-outline-primary")
//edit.classList.add("btn-sm")
edit.setAttribute("data-bs-toggle", "modal");

edit.setAttribute("data-bs-target", "#exampleModal-"+Date.now());
edit.textContent = "Edit"

edit.addEventListener("click", function(event) {
    
    openModal();
  });
// Event listener for the "Edit" button
 function openModal() {
   const myModal = document.getElementById("exampleModal-" + Date.now());
   const bootstrapModal = new bootstrap.Modal(myModal);
   bootstrapModal.show();
 }

//modal
const modalDiv = document.createElement('div')
modalDiv.classList.add("modal");
modalDiv.classList.add('fade');
modalDiv.setAttribute("role", "dialog");
modalDiv.setAttribute("id", "exampleModal-"+Date.now());
// Give a unique ID to the modalDiv

// Add the modal content (you can customize this part as needed)
modalDiv.innerHTML = `
<div class="modal-dialog" role="document">
 <div class="modal-content">
   <div class="modal-header">
     <h5 class="modal-title" id="exampleModalLabel">${data}</h5>
     <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
       <span aria-hidden="true">&times;</span>
     </button>
   </div>
   <div class="modal-body">
   <label class="form-label">label name: </label>
   <input class="form-control" id="youtubelabelInput-${idValueYoutube}" type="text" value="${data}">
   <label class="form-label">Youtube Link: </label>
   <input class="form-control" id="youtubeSrc-${idValueYoutube}" type="text">
   
   </div>
   <div class="modal-footer">
     <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
     <button type="button" class="btn btn-primary" data-bs-dismiss="modal" id="saveButtonText-${idValueYoutube}" >Save changes</button>
   </div>
 </div>
</div>

`;

formElement.appendChild(modalDiv);

function saveForm(e) {
    
   let input = inputfield.value;
   let inputSrc = srcInput.value;
   //textInpLabel.textContent = input;
   let inp = e.target.parentElement.parentElement.parentElement.parentElement.parentElement.querySelector("#"+idValueYoutube)
   inp.textContent = input;
   let srcYoutube = e.target.parentElement.parentElement.parentElement.parentElement.parentElement.querySelector("#src-"+idValueYoutube)
   let valYoutube = e.target.parentElement.parentElement.parentElement.parentElement.parentElement.querySelector("#val-"+idValueYoutube)
   //const videoID = inputSrc.split("v=")[1].split("&")[0];
   let videoID;
   if (inputSrc.includes("watch?v=")) {
     // Link format: https://www.youtube.com/watch?v=eZ5fovFH5v0
     videoID = inputSrc.split("watch?v=")[1].split("&")[0];
   } else if (inputSrc.includes("youtu.be/")) {
     // Link format: https://youtu.be/eZ5fovFH5v0
     videoID = inputSrc.split("youtu.be/")[1];
   } else {
     // Invalid YouTube link format, handle the error or return null
     return null;
   }
   const embedLink = `https://www.youtube.com/embed/${videoID}`;
   srcYoutube.src = embedLink;
   valYoutube.value = embedLink;
   //console.log(inputfield)
 
}

//delete button an function
const del = document.createElement('button');
del.classList.add("btn")
del.classList.add("btn-outline-danger")
//del.classList.add("btn-sm")
//const i = document.createElement("i")
//i.classList.add("bi")
//i.classList.add("bi-trash3-fill")
//del.appendChild(i);
del.setAttribute("id", idValueYoutube)
del.textContent ="Delete"

del.addEventListener('click', function(e){
  e.target.parentElement.parentElement.parentElement.remove()
})

//insert all element together
const container = document.querySelector('.form-builder');
formElement.appendChild(label);
buttonDiv.appendChild(edit);
buttonDiv.appendChild(del);
inputDiv.appendChild(buttonDiv)
formElement.appendChild(inputDiv);
container.appendChild(formElement);

//save edited modal
let save = document.getElementById("saveButtonText-"+idValueYoutube);
let inputfield = document.getElementById("youtubelabelInput-"+idValueYoutube);
let srcInput = document.getElementById("youtubeSrc-"+idValueYoutube)
let textInpLabel = document.getElementById(idValueYoutube);
save.addEventListener("click", saveForm);
}
/*==========================================HEADING=============================================================================*/
else if (data == " Heading") {

//create element for the div and all the label and input inside div with class form-control
const formElement = document.createElement("div");
formElement.classList.add("form-field")
formElement.setAttribute('title', 'text')
formElement.setAttribute('draggable', 'true')

//create label
const label = document.createElement('label');
label.textContent = data;
label.classList.add("col-sm-2");
label.classList.add("col-form-label")
label.classList.add("formFieldHide")
const idTime = Date.now() //set an unique id for each label
const idValue = "headingLabel-"+idTime
label.setAttribute("id", idValue )

const label1 = document.createElement('h2');
label1.textContent = data;
const idTime1 = Date.now() //set an unique id for each label
const idValue1 = "headingTitleLabel-"+idTime1
label1.setAttribute("id", idValue1 )

const label2 = document.createElement('p');
label2.textContent = "SubHeading";
const idTime2 = Date.now() //set an unique id for each label
const idValue2 = "subHeadingLabel"
label2.setAttribute("id", idValue2 )

//create input
const inputDiv = document.createElement("div")
inputDiv.classList.add("col-sm-10")

//create button Div
const buttonDiv = document.createElement("div")
buttonDiv.classList.add("input-group-append")

const input = document.createElement('input');
input.type = "Heading"
input.setAttribute("id", "textType");
input.classList.add("formFieldHide");
input.classList.add("typeForm");

const fieldID = document.createElement("input");
    fieldID.type = "fieldID"
    fieldID.classList.add("formFieldHide");
    fieldID.value = 'heading'+Date.now();

inputDiv.appendChild(input)
input.appendChild(fieldID)

//edit button
const edit = document.createElement('button');
edit.classList.add("btn")
edit.classList.add("btn-outline-primary")
//edit.classList.add("btn-sm")
edit.setAttribute("data-bs-toggle", "modal");

edit.setAttribute("data-bs-target", "#exampleModal-"+Date.now());
edit.textContent = "Edit"

edit.addEventListener("click", function(event) {
    
    openModal();
  });
// Event listener for the "Edit" button
 function openModal() {
   const myModal = document.getElementById("exampleModal-" + Date.now());
   const bootstrapModal = new bootstrap.Modal(myModal);
   bootstrapModal.show();
 }

//modal
const modalDiv = document.createElement('div')
modalDiv.classList.add("modal");
modalDiv.classList.add('fade');
modalDiv.setAttribute("role", "dialog");
modalDiv.setAttribute("id", "exampleModal-"+Date.now());
// Give a unique ID to the modalDiv

// Add the modal content (you can customize this part as needed)
modalDiv.innerHTML = `
<div class="modal-dialog" role="document">
 <div class="modal-content">
   <div class="modal-header">
     <h5 class="modal-title" id="exampleModalLabel">${data}</h5>
     <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
       <span aria-hidden="true">&times;</span>
     </button>
   </div>
   <div class="modal-body">
   <label class="form-label">Heading: </label>
   <input class="form-control" id="labelInput-${idValue}" type="text" value="${data}">
   <label class="form-label">SubHeading: </label>
   <input class="form-control" id="label1Input-${idValue}" type="text" value="">
   
   </div>
   <div class="modal-footer">
     <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
     <button type="button" class="btn btn-primary" data-bs-dismiss="modal" id="saveButtonText-${idValue}" >Save changes</button>
   </div>
 </div>
</div>

`;

formElement.appendChild(modalDiv);

function saveForm(e) {
    
   let input = inputfield.value;
   let input1 = inputfield1.value;
   //textInpLabel.textContent = input;
   //let inp = e.target.parentElement.parentElement.parentElement.parentElement.parentElement.querySelector("#"+idValue)
   let inp = label1
   inp.textContent = input;
   let inp1 = label2
   inp1.textContent = input1;
   let inp2 = label
   inp2.textContent = input;
  
   console.log(inp)
 
}

//delete button an function
const del = document.createElement('button');
del.classList.add("btn")
del.classList.add("btn-outline-danger");
//del.classList.add("btn-sm")
//const i = document.createElement("i")
//i.classList.add("bi")
//i.classList.add("bi-trash3-fill")
//del.appendChild(i);
del.setAttribute("id", idValue)
del.textContent ="Delete"

del.addEventListener('click', function(e){
  e.target.parentElement.parentElement.parentElement.remove()

})

//insert all element together
const container = document.querySelector('.form-builder');
const hr = document.createElement("hr")
const br = document.createElement("br")
formElement.appendChild(label);
formElement.appendChild(label1);
formElement.appendChild(label2);
buttonDiv.appendChild(edit);
buttonDiv.appendChild(del);
inputDiv.appendChild(buttonDiv)
formElement.appendChild(inputDiv);
formElement.appendChild(hr);

container.appendChild(formElement);


//save edited modal
let save = document.getElementById("saveButtonText-"+idValue);
let inputfield = document.getElementById("labelInput-"+idValue);
let inputfield1 = document.getElementById("label1Input-"+idValue);
let textInpLabel = document.getElementById(idValue);
save.addEventListener("click", saveForm);

// Collect the form data into a JSON object
/*const formData = {
label: data,
inputType: input.type,
value: input.value || null,
}; */

// Convert the JSON object to a JSON string
//const formDataJSON = JSON.stringify(formData);

}
/*==========================================IMAGE=============================================================================*/
else if (data == " Image") {

//create element for the div and all the label and input inside div with class form-control
const formElement = document.createElement("div");
formElement.classList.add("form-field")
formElement.setAttribute('draggable', 'true')
//create label
const label = document.createElement('label');
label.textContent = data;
label.classList.add("col-sm-2");
label.classList.add("col-form-label")
label.classList.add("labelBold")
const idTime = Date.now() //set an unique id for each label
const idValueImage = "textInputLabel-"+idTime
label.setAttribute("id", idValueImage )

//create input
const inputDiv = document.createElement("div")
inputDiv.classList.add("col-sm-10")
inputDiv.classList.add("input-group")

//create button Div
const buttonDiv = document.createElement("div")
buttonDiv.classList.add("input-group-append")

const input = document.createElement('input');
input.type = "file"
input.setAttribute("id", "imageType");
input.classList.add("form-control");
input.classList.add("typeForm");
input.classList.add("formFieldHide");
input.setAttribute("accept", "image/*");
//input.setAttribute("onchange", "previewImage(event)");

const separate = document.createElement("br");

const imgPrevID = 'imgPrev'+Date.now()
    const imgpreview = document.createElement("img");
    imgpreview.setAttribute("id", imgPrevID);
imgpreview.src = "#";
imgpreview.alt = "preview";
imgpreview.classList.add("imgPreview")

const fieldID = document.createElement("input");
    fieldID.type = "fieldID"
    fieldID.classList.add("formFieldHide");
    fieldID.value = 'image'+Date.now();

inputDiv.appendChild(input)
inputDiv.appendChild(fieldID)

//edit button
const edit = document.createElement('button');
edit.classList.add("btn")
edit.classList.add("btn-outline-primary")
//edit.classList.add("btn-sm")
edit.setAttribute("data-bs-toggle", "modal");

edit.setAttribute("data-bs-target", "#exampleModal-"+Date.now());
edit.textContent = "Edit"

edit.addEventListener("click", function(event) {
    
    openModal();
  });
// Event listener for the "Edit" button
 function openModal() {
   const myModal = document.getElementById("exampleModal-" + Date.now());
   const bootstrapModal = new bootstrap.Modal(myModal);
   bootstrapModal.show();
 }

//modal
const modalDiv = document.createElement('div')
modalDiv.classList.add("modal");
modalDiv.classList.add('fade');
modalDiv.setAttribute("role", "dialog");
modalDiv.setAttribute("id", "exampleModal-"+Date.now());
// Give a unique ID to the modalDiv

// Add the modal content (you can customize this part as needed)
modalDiv.innerHTML = `
<div class="modal-dialog" role="document">
 <div class="modal-content">
   <div class="modal-header">
     <h5 class="modal-title" id="exampleModalLabel">${data}</h5>
     <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
       <span aria-hidden="true">&times;</span>
     </button>
   </div>
   <div class="modal-body">
   <label class="form-label">label name: </label>
   <input class="form-control" id="labelInput-${idValueImage}" type="text" value="${data}">
   <label class="form-label">Select Image: </label>
   <input class="form-control" type="file" onchange="previewImage(event, '${imgPrevID}')">
   
   </div>
   <div class="modal-footer">
     <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
     <button type="button" class="btn btn-primary" data-bs-dismiss="modal" id="saveButtonText-${idValueImage}" >Save changes</button>
   </div>
 </div>
</div>

`;

formElement.appendChild(modalDiv);

function saveForm(e) {
    
   let input = inputfield.value;
   //textInpLabel.textContent = input;
   let inp = e.target.parentElement.parentElement.parentElement.parentElement.parentElement.querySelector("#"+idValueImage)
   inp.textContent = input;
   //console.log(inputfield)
 
}

//delete button an function
const del = document.createElement('button');
del.classList.add("btn")
del.classList.add("btn-outline-danger")
//del.classList.add("btn-sm")
//const i = document.createElement("i")
//i.classList.add("bi")
//i.classList.add("bi-trash3-fill")
//del.appendChild(i);
del.setAttribute("id", idValueImage)
del.textContent ="Delete"

del.addEventListener('click', function(e){
  e.target.parentElement.parentElement.parentElement.remove()
})

//insert all element together
const container = document.querySelector('.form-builder');
formElement.appendChild(label);
buttonDiv.appendChild(edit);
buttonDiv.appendChild(del);
inputDiv.appendChild(buttonDiv);
formElement.appendChild(imgpreview);
formElement.appendChild(inputDiv);
container.appendChild(formElement);


//save edited modal
let save = document.getElementById("saveButtonText-"+idValueImage);
let inputfield = document.getElementById("labelInput-"+idValueImage);
let textInpLabel = document.getElementById(idValueImage);
save.addEventListener("click", saveForm);
}
/*==========================================CHECKBOX Rating=============================================================================*/
else if(data == ' Checkbox Rating') {
//create element for the div and all the label and input inside div with class form-control
const formElement = document.createElement("div");
formElement.classList.add("form-field")
formElement.setAttribute('draggable', 'true')
const legend = document.createElement('label');
legend.textContent = data;
legend.classList.add("col-form-label")
legend.classList.add("labelBold")
const idTime = Date.now() //set an unique id for each label
const idValueCheckRate = "checkLabel-"+idTime
legend.setAttribute("id", idValueCheckRate)

//cehckdiv 
const checkDiv = document.createElement("div");
const divTime = Date.now()
const idCheckDiv = "checkDiv-" +divTime
//checkDiv.setAttribute("id", idCheckDiv)
checkDiv.classList.add("form-check");
checkDiv.classList.add("form-check-inline");
const input = document.createElement("input");
input.type = "radio";
input.value = "1";
input.name = idValueCheckRate;
input.classList.add("form-check-input");
//input.setAttribute("id", "First Checkbox");
const label = document.createElement("label")
label.classList.add("form-check-label");
label.textContent = "Disagree";
//label.setAttribute("for", "First Checkbox")

checkDiv.appendChild(input);
checkDiv.appendChild(label);

//checkdiv1
const checkDiv1 = document.createElement("div");
const divTime1 = Date.now()
const idCheckDiv1 = "checkDiv-" +divTime1
//checkDiv.setAttribute("id", idCheckDiv1)
checkDiv1.classList.add("form-check");
checkDiv1.classList.add("form-check-inline");
const input1 = document.createElement("input");
input1.type = "radio";
input1.value = "2";
//input.name = idValueCheckRate;
input1.classList.add("form-check-input");
//input.setAttribute("id", "First Checkbox");
const label1 = document.createElement("label")
label1.classList.add("form-check-label");
label1.textContent = "2";2
//label.setAttribute("for", "Sec Checkbox")

checkDiv1.appendChild(input1);
checkDiv1.appendChild(label1);

//checkdiv2
const checkDiv2 = document.createElement("div");
const divTime2 = Date.now()
const idCheckDiv2 = "checkDiv-" +divTime2
//checkDiv.setAttribute("id", idCheckDiv1)
checkDiv2.classList.add("form-check");
checkDiv2.classList.add("form-check-inline");
const input2 = document.createElement("input");
input2.type = "radio";
input2.value = "3";
//input.name = idValueCheckRate;
input2.classList.add("form-check-input");
//input.setAttribute("id", "First Checkbox");
const label2 = document.createElement("label")
label2.classList.add("form-check-label");
label2.textContent = "3";
//label.setAttribute("for", "Sec Checkbox")

checkDiv2.appendChild(input2);
checkDiv2.appendChild(label2);

//checkdiv3
const checkDiv3 = document.createElement("div");
const divTime3 = Date.now()
const idCheckDiv3 = "checkDiv-" +divTime3
//checkDiv.setAttribute("id", idCheckDiv1)
checkDiv3.classList.add("form-check");
checkDiv3.classList.add("form-check-inline");
const input3 = document.createElement("input");
input3.type = "radio";
input3.value = "4";
//input.name = idValueCheckRate;
input3.classList.add("form-check-input");
//input.setAttribute("id", "First Checkbox");
const label3 = document.createElement("label")
label3.classList.add("form-check-label");
label3.textContent = "4";
//label.setAttribute("for", "Sec Checkbox")

checkDiv3.appendChild(input3);
checkDiv3.appendChild(label3);

//checkdiv4
const checkDiv4 = document.createElement("div");
const divTime4 = Date.now()
const idCheckDiv4 = "checkDiv-" +divTime4
//checkDiv.setAttribute("id", idCheckDiv1)
checkDiv4.classList.add("form-check");
checkDiv4.classList.add("form-check-inline");
const input4 = document.createElement("input");
input4.type = "radio";
input4.value = "5";
//input.name = idValueCheckRate;
input4.classList.add("form-check-input");
//input.setAttribute("id", "First Checkbox");
const label4 = document.createElement("label")
label4.classList.add("form-check-label");
label4.textContent = "Agree";
//label.setAttribute("for", "Sec Checkbox")

checkDiv4.appendChild(input4);
checkDiv4.appendChild(label4);

const fieldID = document.createElement("input");
    fieldID.type = "fieldID"
    fieldID.classList.add("formFieldHide");
    fieldID.value = 'checkrating'+Date.now();







const allCheckInputs = document.querySelectorAll(`input[type="checkbox"][name="${idValueCheckRate}"]`);
let labels = "";

allCheckInputs.forEach((checkInput) => {
// Find the parent div that contains the radio input and its label
const checkDiv = checkInput.closest(".form-check");

// Get the label element associated with the radio input
const label = checkDiv.querySelector("label.form-check-label");

// If a label is found, add its text content to the labels string
if (label) {
  labels += label.textContent.trim() + "\n";
}
});





//edit button
const edit = document.createElement('button');
edit.classList.add("btn")
edit.classList.add("btn-outline-primary")
edit.classList.add("btn-sm")
edit.setAttribute("data-bs-toggle", "modal");
edit.setAttribute("data-bs-target", "#exampleModal-" + Date.now());
edit.textContent = "Edit"

edit.addEventListener("click", function() {
  openModal();
});


function openModal() {
  const myModal = document.getElementById("exampleModal-" + Date.now());
  const bootstrapModal = new bootstrap.Modal(myModal);
  bootstrapModal.show();
}


//modal
const modalDiv = document.createElement('div')
modalDiv.classList.add("modal");
modalDiv.classList.add('fade');
modalDiv.setAttribute("role", "dialog");
modalDiv.setAttribute("id", "exampleModal-" + Date.now());
// Give a unique ID to the modalDiv

// Add the modal content (you can customize this part as needed)
modalDiv.innerHTML = `
<div class="modal-dialog" role="document">
<div class="modal-content">
 <div class="modal-header">
   <h5 class="modal-title" id="exampleModalLabel">${data}</h5>
   <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
     <span aria-hidden="true">&times;</span>
   </button>
 </div>
 <div class="modal-body">
 <label class="form-label">label name: </label>
 <input class="form-control" id="checklabel-${idValueCheckRate}" type="text" value="${data}"> <br>
 </div>
 <div class="modal-footer">
   <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
   <button type="button" class="btn btn-primary" data-bs-dismiss="modal" id="saveButtonCheck-${idValueCheckRate}">Save changes</button>
 </div>
</div>
</div>

`;

formElement.appendChild(modalDiv);

function saveForm() {

let input = inputfield.value;
checkLabel.textContent = input;

const checkOption = document.getElementById("checkOption-"+idValueCheckRate);
const options = checkOption.value.trim().split('\n');

//Remove the existing radioDiv element
const checkboxDiv = document.querySelectorAll("#"+idCheckDiv);
checkboxDiv.forEach((chDiv)  => {
chDiv.remove();
});


// Add new radio inputs and labels based on the textarea content
options.forEach((text) => {
if (text.trim() !== '') {
  const newCheckDiv = document.createElement("div");
  newCheckDiv.classList.add("form-check");
  newCheckDiv.setAttribute("id", idCheckDiv);
  
  const newInput = document.createElement("input");
  newInput.type = "checkbox";
  newInput.classList.add("form-check-input");
  newInput.value = text.trim();
  newInput.name = idValueCheck;
  newInput.classList.add("typeForm");
  newCheckDiv.appendChild(newInput);

  const newLabel = document.createElement("label");
  newLabel.classList.add("form-check-label");
  newLabel.textContent = text.trim();
  newCheckDiv.appendChild(newLabel);

  formElement.appendChild(newCheckDiv);
}
});

}

//delete button an function
const del = document.createElement('button');
del.classList.add("btn")
del.classList.add("btn-outline-danger")
del.classList.add("btn-sm")
//const i = document.createElement("i")
//i.classList.add("bi")
//i.classList.add("bi-trash3-fill")
//del.appendChild(i);
del.textContent ="Delete"

del.addEventListener('click', function(e){
e.target.parentElement.remove()

})

//insert all element together
const container = document.querySelector('.form-builder');
const hide = document.createElement("input");
hide.classList.add('typeForm');
hide.classList.add('formFieldHide');
hide.type = "Rating"
formElement.appendChild(legend);
formElement.appendChild(hide);
formElement.appendChild(fieldID);
const br = document.createElement('br')
formElement.appendChild(br);
formElement.appendChild(checkDiv);
formElement.appendChild(checkDiv1);
formElement.appendChild(checkDiv2);
formElement.appendChild(checkDiv3);
formElement.appendChild(checkDiv4);
formElement.appendChild(edit);
formElement.appendChild(del);
container.appendChild(formElement);


//save edited modal
let save = document.getElementById("saveButtonCheck-"+idValueCheckRate);
let inputfield = document.getElementById("checklabel-"+idValueCheckRate);
let checkLabel = document.getElementById(idValueCheckRate);
//let selectOption = document.getElementById("selectOption");
//let selectval = selectOption.value;
//let options = selectval.split('/n');

save.addEventListener("click", saveForm);

} /*==========================================SIGNATURE=============================================================================*/
else if (data == " Signature") {

//create element for the div and all the label and input inside div with class form-control
const formElement = document.createElement("div");
formElement.classList.add("form-field")
formElement.setAttribute('draggable', 'true')
//create label
const label = document.createElement('label');
label.textContent = data;
label.classList.add("col-sm-2");
label.classList.add("col-form-label")
label.classList.add("labelBold")
const idTime = Date.now() //set an unique id for each label
const idValueSignature = "signatureLabel-"+idTime
label.setAttribute("id", idValueSignature )

//create input
const inputDiv = document.createElement("div")
inputDiv.classList.add("col-sm-10")
inputDiv.classList.add("input-group")

//create button Div
const buttonDiv = document.createElement("div")
buttonDiv.classList.add("input-group-append")

const input = document.createElement('input');
input.type = "Signature"
input.classList.add("formFieldHide");
input.classList.add("typeForm");


const canvas = document.createElement('canvas')
canvas.setAttribute('id', "signatureCanvas")
canvas.classList.add("canvasBack")

const fieldID = document.createElement("input");
    fieldID.type = "fieldID"
    fieldID.classList.add("formFieldHide");
    fieldID.value = 'signature'+Date.now();


inputDiv.appendChild(input)
inputDiv.appendChild(canvas)
inputDiv.appendChild(fieldID)


//edit button
const edit = document.createElement('button');
edit.classList.add("btn")
edit.classList.add("btn-outline-primary")
//edit.classList.add("btn-sm")
edit.setAttribute("data-bs-toggle", "modal");

edit.setAttribute("data-bs-target", "#exampleModal-"+Date.now());
edit.textContent = "Edit"

edit.addEventListener("click", function(event) {
  
  openModal();
});
// Event listener for the "Edit" button
function openModal() {
 const myModal = document.getElementById("exampleModal-" + Date.now());
 const bootstrapModal = new bootstrap.Modal(myModal);
 bootstrapModal.show();
}

//modal
const modalDiv = document.createElement('div')
modalDiv.classList.add("modal");
modalDiv.classList.add('fade');
modalDiv.setAttribute("role", "dialog");
modalDiv.setAttribute("id", "exampleModal-"+Date.now());
// Give a unique ID to the modalDiv

// Add the modal content (you can customize this part as needed)
modalDiv.innerHTML = `
<div class="modal-dialog" role="document">
<div class="modal-content">
 <div class="modal-header">
   <h5 class="modal-title" id="exampleModalLabel">${data}</h5>
   <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
     <span aria-hidden="true">&times;</span>
   </button>
 </div>
 <div class="modal-body">
 <label class="form-label">label name: </label>
 <input class="form-control" id="labelInput-${idValueSignature}" type="text" value="${data}">
 
 </div>
 <div class="modal-footer">
   <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
   <button type="button" class="btn btn-primary" data-bs-dismiss="modal" id="saveButtonText-${idValueSignature}" >Save changes</button>
 </div>
</div>
</div>

`;

formElement.appendChild(modalDiv);

function saveForm(e) {
  
 let input = inputfield.value;
 //textInpLabel.textContent = input;
 let inp = e.target.parentElement.parentElement.parentElement.parentElement.parentElement.querySelector("#"+idValueSignature)
 inp.textContent = input;
 //console.log(inputfield)

}

//delete button an function
const del = document.createElement('button');
del.classList.add("btn")
del.classList.add("btn-outline-danger")
//del.classList.add("btn-sm")
//const i = document.createElement("i")
//i.classList.add("bi")
//i.classList.add("bi-trash3-fill")
//del.appendChild(i);
del.setAttribute("id", idValueSignature)
del.textContent ="Delete"

del.addEventListener('click', function(e){
e.target.parentElement.parentElement.parentElement.remove()
})

//insert all element together
const container = document.querySelector('.form-builder');
formElement.appendChild(label);
buttonDiv.appendChild(edit);
buttonDiv.appendChild(del);
inputDiv.appendChild(buttonDiv);
formElement.appendChild(inputDiv);
container.appendChild(formElement);


//save edited modal
let save = document.getElementById("saveButtonText-"+idValueSignature);
let inputfield = document.getElementById("labelInput-"+idValueSignature);
let textInpLabel = document.getElementById(idValueSignature);
save.addEventListener("click", saveForm);
} /*==========================================SEARCH LOCATION=============================================================================*/
else if (data == " Search Location") {

    //create element for the div and all the label and input inside div with class form-control
    const formElement = document.createElement("div");
    formElement.classList.add("form-field")
    formElement.setAttribute('title', 'text')
    formElement.setAttribute('draggable', 'true')

    
    //create label
    const label = document.createElement('label');
    label.textContent = data;
    label.classList.add("col-sm-2");
    label.classList.add("col-form-label")
    label.classList.add("labelBold")
    const idTime = Date.now() //set an unique id for each label
    const idValueSearch = "searchLocationLabel-"+idTime
    label.setAttribute("id", idValueSearch )

    //create input
    const inputDiv = document.createElement("div")
    inputDiv.classList.add("col-sm-10")
    inputDiv.classList.add("input-group")

    //create button Div
    const buttonDiv = document.createElement("div")
    buttonDiv.classList.add("input-group-append")
    
    const input = document.createElement('input');
    input.type = "search"
    input.setAttribute("id", "search");
    input.classList.add("form-control");
    input.classList.add("typeForm");

    const fieldID = document.createElement("input");
    fieldID.type = "fieldID"
    fieldID.classList.add("formFieldHide");
    fieldID.value = 'searchLabel'+Date.now();
    
    inputDiv.appendChild(input)
    inputDiv.appendChild(fieldID)
  
    //edit button
    const edit = document.createElement('button');
    edit.classList.add("btn")
    edit.classList.add("btn-outline-primary")
    //edit.classList.add("btn-sm")
    edit.setAttribute("data-bs-toggle", "modal");
    
    edit.setAttribute("data-bs-target", "#exampleModal-"+Date.now());
    edit.textContent = "Edit"

    edit.addEventListener("click", function(event) {
        
        openModal();
      });
    // Event listener for the "Edit" button
     function openModal() {
       const myModal = document.getElementById("exampleModal-" + Date.now());
       const bootstrapModal = new bootstrap.Modal(myModal);
       bootstrapModal.show();
     }

   //modal
   const modalDiv = document.createElement('div')
   modalDiv.classList.add("modal");
   modalDiv.classList.add('fade');
   modalDiv.setAttribute("role", "dialog");
   modalDiv.setAttribute("id", "exampleModal-"+Date.now());
   // Give a unique ID to the modalDiv

   // Add the modal content (you can customize this part as needed)
   modalDiv.innerHTML = `
   <div class="modal-dialog" role="document">
     <div class="modal-content">
       <div class="modal-header">
         <h5 class="modal-title" id="exampleModalLabel">${data}</h5>
         <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
           <span aria-hidden="true">&times;</span>
         </button>
       </div>
       <div class="modal-body">
       <label class="form-label"><b>label name: </b></label>
       <input class="form-control" id="labelInput-${idValueSearch}" type="text" value="${data}">
       <label class="form-label pt-3"><b>Required  </b></label>
       <input class="form-check" id="requiredInput-${idValueSearch}" type="checkbox">
       
       
       </div>
       <div class="modal-footer">
         <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
         <button type="button" class="btn btn-primary" data-bs-dismiss="modal" id="saveButtonText-${idValueSearch}" >Save changes</button>
       </div>
     </div>
   </div>
 
   `;

    formElement.appendChild(modalDiv);

    function saveForm(e) {
        
       let input = inputfield.value;
       //textInpLabel.textContent = input;
       let inp = textInpLabel
       inp.textContent = input;
       if (requiredField.checked) {
        const textInput = document.getElementById('search');
        textInput.required = true
       } 
      
       //console.log(inputfield)
     
   }

   //delete button an function
    const del = document.createElement('button');
    del.classList.add("btn")
    del.classList.add("btn-outline-danger");
    //del.classList.add("btn-sm")
    //const i = document.createElement("i")
    //i.classList.add("bi")
    //i.classList.add("bi-trash3-fill")
    //del.appendChild(i);
    del.setAttribute("id", idValueSearch)
    del.textContent ="Delete"
    
    del.addEventListener('click', function(e){
      e.target.parentElement.parentElement.parentElement.remove()

    })
    
    //insert all element together
    const container = document.querySelector('.form-builder')
    const search = document.createElement("button")
    search.classList.add("btn")
    search.classList.add("btn-success")
    search.textContent = "Search"
    formElement.appendChild(label);
    buttonDiv.appendChild(search)
    buttonDiv.appendChild(edit);
    buttonDiv.appendChild(del);
    inputDiv.appendChild(buttonDiv)
    formElement.appendChild(inputDiv);
    container.appendChild(formElement)
  


    //save edited modal
    let save = document.getElementById("saveButtonText-"+idValueSearch);
    let inputfield = document.getElementById("labelInput-"+idValueSearch);
    let requiredField = document.getElementById('requiredInput-'+idValueSearch)
    let textInpLabel = document.getElementById(idValueSearch);
    save.addEventListener("click", saveForm);

    // Collect the form data into a JSON object
    /*const formData = {
    label: data,
    inputType: input.type,
    value: input.value || null,
    }; */

   // Convert the JSON object to a JSON string
   //const formDataJSON = JSON.stringify(formData);

} /*==========================================TERMS AND CONDITION=============================================================================*/
else if (data == " Terms & Condition") {

  //create element for the div and all the label and input inside div with class form-control
  const formElement = document.createElement("div");
  formElement.classList.add("form-field")
  formElement.setAttribute('draggable', 'true')
  const legend = document.createElement('legend');
  legend.textContent = data;
  legend.classList.add("col-form-label")
  legend.classList.add("form-check-label");
  const idTime = Date.now() //set an unique id for each label
  const idValueCheck = "checkLabel-"+idTime
  legend.setAttribute("id", idValueCheck)

  const checkDiv = document.createElement("div");
  const divTime = Date.now()
  const idCheckDiv = "checkDiv-" +divTime
  checkDiv.setAttribute("id", idCheckDiv)
  checkDiv.classList.add("form-check");
  checkDiv.classList.add("checkboxOptionBuild");
  const input = document.createElement("input");
  input.type = "checkbox";
  input.value = "option";
  input.name = "formBuildCheck";
  input.classList.add("form-check-input");
  input.setAttribute("id", "check");

  const tandc = document.createElement('input');
  tandc.type = "hidden";
  tandc.name = "termsconditiontext";
  tandc.setAttribute("id", "termsconditiontext")

  const inputype = document.createElement("input")
  inputype.type = "termscondition"
  inputype.classList.add("typeForm")
  inputype.classList.add("formFieldHide")

  const fieldID = document.createElement("input");
      fieldID.type = "fieldID"
      fieldID.classList.add("formFieldHide");
      fieldID.value = 'checkID'+Date.now();

  checkDiv.appendChild(input);
  checkDiv.appendChild(tandc);
  checkDiv.appendChild(inputype);
  checkDiv.appendChild(legend);
  

  //edit button
  const edit = document.createElement('button');
  edit.classList.add("btn")
  edit.classList.add("btn-outline-primary")
  edit.classList.add("btn-sm")
  edit.setAttribute("data-bs-toggle", "modal");
  edit.setAttribute("data-bs-target", "#exampleModal-" + Date.now());
  edit.textContent = "Edit"

  edit.addEventListener("click", function() {
      openModal();
    });
  

    function openModal() {
      const myModal = document.getElementById("exampleModal-" + Date.now());
      const bootstrapModal = new bootstrap.Modal(myModal);
      bootstrapModal.show();
    }


 //modal
 const modalDiv = document.createElement('div')
 modalDiv.classList.add("modal");
 modalDiv.classList.add('fade');
 modalDiv.setAttribute("role", "dialog");
 modalDiv.setAttribute("id", "exampleModal-" + Date.now());
 // Give a unique ID to the modalDiv

 // Add the modal content (you can customize this part as needed)
 modalDiv.innerHTML = `
 <div class="modal-dialog" role="document">
   <div class="modal-content">
     <div class="modal-header">
       <h5 class="modal-title" id="exampleModalLabel">${data}</h5>
       <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
         <span aria-hidden="true">&times;</span>
       </button>
     </div>
     <div class="modal-body">
     <label class="form-label"><b>label name: </b></label>
     <input class="form-control" id="checklabel-${idValueCheck}" type="text" value="${data}"> <br>
     <label class="form-label"><b>Terms and Condition Content: </b></label>
      <textarea class="form-control" rows="6" id="termscondition-${idValueCheck}"></textarea> <br>
     <label class="form-label pt-3"><b>Required  </b></label>
     <input class="form-check" id="requiredInput-${idValueCheck}" type="checkbox">
     </div>
     <div class="modal-footer">
       <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
       <button type="button" class="btn btn-primary" data-bs-dismiss="modal" id="saveButtonCheck-${idValueCheck}">Save changes</button>
     </div>
   </div>
 </div>

 `;

  formElement.appendChild(modalDiv);

  function saveForm() {
 
   let termsconditionCont = document.getElementById('termscondition-'+idValueCheck).value
   tandcContent.value = termsconditionCont;
   let input = inputfield.value;
   checkLabel.textContent = input;

  if (requiredField.checked) {
    const textInput = document.getElementById('check');
    textInput.required = true
   } 
   
 }

 //delete button an function
  const del = document.createElement('button');
  del.classList.add("btn")
  del.classList.add("btn-outline-danger")
  del.classList.add("btn-sm")
  //const i = document.createElement("i")
  //i.classList.add("bi")
  //i.classList.add("bi-trash3-fill")
  //del.appendChild(i);
  del.textContent ="Delete"
  
  del.addEventListener('click', function(e){
    e.target.parentElement.remove()
  
  })
  
  //insert all element together
  const container = document.querySelector('.form-builder')
  formElement.appendChild(fieldID)
  formElement.appendChild(checkDiv);
  formElement.appendChild(edit);
  formElement.appendChild(del);
  container.appendChild(formElement);


  //save edited modal
  let save = document.getElementById("saveButtonCheck-"+idValueCheck);
  let inputfield = document.getElementById("checklabel-"+idValueCheck);
  let checkLabel = document.getElementById(idValueCheck);
  let requiredField = document.getElementById('requiredInput-'+idValueCheck);
  let tandcContent = document.getElementById('termsconditiontext');
  //let selectOption = document.getElementById("selectOption");
  //let selectval = selectOption.value;
  //let options = selectval.split('/n');
  
  save.addEventListener("click", saveForm);

}

    
    
  
}



//=====================================================ADD PAGE FUNCTION========================================================= =====================
const pageContainer = document.querySelector('.paginate');
document.getElementById("addPage").addEventListener("click", addPage);
pageNumber = 2;

function addPage() {
    const card = document.createElement('div')
    card.classList.add("card");
    card.classList.add("form-page");
    card.setAttribute("data-page", pageNumber)
    const cardBody = document.createElement('div')
    cardBody.classList.add("card-body");
    const removeButton = document.createElement('button');
    removeButton.textContent = "Remove Page";
    removeButton.classList.add("btn");
    removeButton.classList.add("btn-danger");
    removeButton.classList.add("mt-4");
    removeButton.addEventListener("click", () => removePage(card)); // Pass the card element to removePage function
    const hr = document.createElement('hr');
    const br = document.createElement('br');
    const formBuilder = document.createElement('div');
    formBuilder.classList.add("row");
    formBuilder.classList.add("g-3");
    formBuilder.classList.add("form-builder");
    formBuilder.setAttribute("ondrop", "drop(event)");
    formBuilder.setAttribute("ondragover", "allowDrop(event)");
    formBuilder.setAttribute("id", "formContainer");

    card.appendChild(cardBody);
    cardBody.appendChild(removeButton);
    card.appendChild(hr)
    card.appendChild(br)
    card.appendChild(formBuilder);
    card.appendChild(hr)

    pageContainer.appendChild(card);
    pageNumber++
}

let firstCardRemoved = false; // Keep track if the first card is removed

function removePage(card) {
    if (!firstCardRemoved) {
        // If the first card is not removed, just mark it as removed
        firstCardRemoved = true;
    } else {
        // If the first card is already removed, remove the subsequent cards
        pageContainer.removeChild(card);
    }
}