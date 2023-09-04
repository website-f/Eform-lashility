function validateFormFields() {
  const requiredFields = document.querySelectorAll('.val[required]');
  let isValid = true;

  requiredFields.forEach(field => {
    if (field.type === 'checkbox' || field.type === 'radio') {
      const group = document.querySelectorAll(`[name="${field.name}"]`);
      const isGroupChecked = Array.from(group).some(input => input.checked);
      if (!isGroupChecked) {
        isValid = false;
        alert('Please select at least one option.');
      }
    } else if (!field.value) {
      isValid = false;
      field.classList.add('is-invalid');
      alert('There is a missing field!');
    } else {
      field.classList.remove('is-invalid');
    }
  });

  return isValid;
}

document.getElementById('submit-btn').addEventListener('click', function(event) {
  event.preventDefault(); // Prevent default form submission

  const isValid = validateFormFields();

  if (isValid) {
    saveSubmit(); // Call your saveSubmit function
  }
});


// Update the function to use Promise for image conversion
//function convertImageToBase64(File,label, fieldType, submitedForm) {
//  return new Promise((resolve, reject) => {
//    const reader = new FileReader();
//    reader.readAsDataURL(File);
//    reader.onload = function () {
//      const base64Image = reader.result.split(',')[1]; // Get base64 part
//      // Add the base64Image to the formFields array
//      submitedForm.push({ label, value: base64Image, fieldType });
//      resolve();
//    };
//    reader.onerror = function (error) {
//      reject(error);
//    };
//  });
//}

function convertImageToBase64(File, label, fieldType, submitedForm) {
  return new Promise((resolve, reject) => {
    const reader = new FileReader();
    reader.readAsDataURL(File);
    reader.onload = function () {
      const base64Image = reader.result.split(',')[1]; // Get base64 part

      // Extract the file extension from the File object's name property
      const fileName = File.name;
      const fileExtension = fileName.substr(fileName.lastIndexOf('.') + 1);

      // Add the base64Image and fileExtension to the formFields array
      submitedForm.push({ label, value: base64Image, fieldType, fileExtension });
      resolve();
    };
    reader.onerror = function (error) {
      reject(error);
    };
  });
}



async function saveSubmit(event) {
    const submitedForm = [];
    const formType = document.querySelector('.formType').textContent;
    const formSubtitle = document.querySelector('.formSub').textContent;
    const formLogo = document.querySelector('.formLogoSubmit').value;
    const formPublisher = document.querySelector('.formPublisher').value;
    const field = document.querySelector('.page-content');
    const fieldType = document.querySelectorAll('.fieldType');
    const approval = document.querySelector('input[name="approval"]').value
    const approver = document.querySelector('input[name="approver"]').value
    const userEmail = document.querySelector('input[name="emailNotify"]').value
    const notify = document.querySelector('input[name="notify"]').value
    const notifyOption = []
    notifyOption.push(notify)
    const completeNotify = JSON.stringify(notifyOption);
console.log(notify)
    const imageConversionPromises = [];
    let fileFieldInsert = null;

    fieldType.forEach((fieldsType) => {
       
        const labelName = fieldsType.querySelector('.form-label');
        const label = labelName.textContent;
        const fieldVal = fieldsType.querySelector('.inputType');
        const fieldType = fieldVal ? fieldVal.getAttribute("type") : null;
        
       

        if (fieldType == 'text') {
            const Invalue = fieldsType.querySelector('input[name="text"]');
            console.log(Invalue)
            const value = Invalue.value;
            
            submitedForm.push({ label, value, fieldType });
            
        } 
        if (fieldType == 'email') {
          const Invalue = fieldsType.querySelector('input[name="email"]');
          console.log(Invalue)
          const value = Invalue.value;
          
          submitedForm.push({ label, value, fieldType });
          
      } 
        else if (fieldType == 'approval') {
          const Invalue = fieldsType.querySelector('.approvalValue');
          const value = Invalue.textContent;
          
          submitedForm.push({ label, value, fieldType });
          
      } 
         else if (fieldType == 'textarea') {
            const Invalue = fieldsType.querySelector('textarea[name="textarea"]');
            const value = Invalue.value;
            
            submitedForm.push({ label, value, fieldType });
        } else if (fieldType == 'date') {
          const Invalue = fieldsType.querySelector('input[name="date"]');
          const datevalue = Invalue.value;
          const valueParts = datevalue.split("-");
          const value = `${valueParts[2]}-${valueParts[1]}-${valueParts[0]}`;
          
          submitedForm.push({ label, value, fieldType });
        } else if (fieldType == 'text datetime') {
          const Invalue = fieldsType.querySelector('input[name="datetime"]');
          const value = Invalue.value;

          submitedForm.push({ label, value, fieldType });
        } else if (fieldType == 'time') {
          const Invalue = fieldsType.querySelector('input[name="time"]');
          const value = Invalue.value;

          submitedForm.push({ label, value, fieldType });
        } else if (fieldType == 'hidden') {
          const Invalue = fieldsType.querySelector('input[name="starrating"]');
          const value = Invalue.value;

          submitedForm.push({ label, value, fieldType });
        } else if (fieldType == 'text location') {
          const fieldID = fieldsType.querySelector('.val').id.replace('coordinatesGetLocation', '');
          const Invalue = fieldsType.querySelector(`div[id="coordinatesGetLocation${fieldID}"]`);
          const value = Invalue.textContent;

          submitedForm.push({ label, value, fieldType });
        } else if (fieldType == 'search') {
          const fieldID = fieldsType.querySelector('.val').id.replace('coordinatesSearch', '');
          const Invalue = fieldsType.querySelector(`#coordinatesSearch${fieldID}`);
          const locationValue = fieldsType.querySelector(`#locationName${fieldID}`);
          const value = Invalue.textContent;
          const location = locationValue.textContent;
      
          submitedForm.push({ label, value, location, fieldType });
        }else if (fieldType == 'select') {
          const Invalue = fieldsType.querySelector('select[name="select"]');
          const value = Invalue.value;

          submitedForm.push({ label, value, fieldType });
        } else if (fieldType === 'checkbox') {
          const checkboxes = fieldsType.querySelectorAll('input[type="checkbox"]');
          const checkedValues = [];
      
          checkboxes.forEach((checkbox) => {
              if (checkbox.checked) {
                  checkedValues.push(checkbox.value);
              }
          });
      
          submitedForm.push({ label, value: checkedValues, fieldType });
        } else if (fieldType === 'radio') {
          const radioButtons = fieldsType.querySelectorAll('input[type="radio"]');
          let selectedValue = null;
      
          radioButtons.forEach((radio) => {
              if (radio.checked) {
                  selectedValue = radio.value;
              }
          });
      
          submitedForm.push({ label, value: selectedValue, fieldType });
        } 
        else if (fieldType == 'Rating') {
          const radioButtons = fieldsType.querySelectorAll('input[name="rating"]');
          let selectedValue = null;
          radioButtons.forEach((radio) => {
              if (radio.checked) {
                  selectedValue = radio.value;
              }
          });
          
      
          submitedForm.push({ label, value: selectedValue, fieldType });
        } 
        else if (fieldType === 'file allFile') {
          const fileInput = fieldsType.querySelector('input[name="file allFile"]');
   
          if (fileInput && fileInput.files.length > 0) {
              // If an image is selected, convert it to base64 using a Promise
              const File = fileInput.files[0];
              
              // Create a promise for the image conversion and push it to the array
              imageConversionPromises.push(
                  convertImageToBase64(File, label, fieldType, submitedForm)
              );
          } else {
              // If no image is selected, mark the flag
              fileFieldInsert = { label, value: '', fieldType: 'file allFile' };
          }
      } 
        else if (fieldType === 'Signature') {
          const signInput = fieldsType.querySelector('canvas[name="signature"]');

                if (signInput) {
                  // If an image is selected, convert it to base64 using a Promise
                  const signDataUrl = signInput.toDataURL();
                   const Sign = signDataUrl.split(',')[1];
                  console.log(Sign)
                  // Create a promise for the image conversion and push it to the array
                  submitedForm.push({ label, value: Sign, fieldType });
                
                } else {
                  // If no image is selected, send the form data without the image
                  submitedForm.push({ label, fieldType });
                }
        }

       
        
    });
    
    // Wait for all image conversion promises to complete
    try {
      await Promise.all(imageConversionPromises);
    } catch (error) {
      console.error('Image Conversion Error:', error);
    }
    if (fileFieldInsert) {
      submitedForm.push(fileFieldInsert);
    }
   

    let submit = [formType, submitedForm, approval, formPublisher, approver, completeNotify, userEmail, formSubtitle, formLogo];
    const complete = JSON.stringify(submit);

    console.log(complete);



    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    console.log(csrfToken);


    $.ajax({
        type: 'POST',
        url: "/submit",
        contentType: 'application/json',
        data: JSON.stringify({formData:submit}),
        headers: {
          'X-CSRF-TOKEN': csrfToken, // You can set the CSRF token in the header
        },
        beforeSend: function () {
          // Show the loading screen
          $('#loading-screen-published').show();
          $('#buttonLoading').show();
      },
        success: function(response) {
          // Handle the success response if needed
          const currentUrl = window.location.href;

    // Redirect to the thank you page with the previous URL as a query parameter
    const redirectUrl = "/thankyou?previous=" + encodeURIComponent(currentUrl);
    window.location.replace(redirectUrl);
        },
        error: function(error) {
          // Handle the error response if needed
        },
        complete: function () {
          // Hide the loading screen
          $('#loading-screen-published').hide();
          $('#buttonLoading').hide();
      },
      });
}

