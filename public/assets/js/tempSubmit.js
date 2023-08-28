/*
=============================================================================================================================================
-----------------------------------------TEMPLATE BSUBMIT-----------------------------------------------------------------------------
==================================================================================================================================
*/
document.getElementById('tempsubmit-btn').addEventListener('click', function(event) {
  if (areRequiredFieldsFilled()) {
      saveTempSubmit();
  } else {
      event.preventDefault(); // Prevent form submission
      alert('Please fill out all required fields.');
  }
});

function areRequiredFieldsFilled() {
  const requiredInputs = document.querySelectorAll('[required]');
  let allFilled = true;

  requiredInputs.forEach(input => {
      if (input.value.trim() === '') {
          allFilled = false;
          input.classList.add('is-invalid');
      } else {
          input.classList.remove('is-invalid');
      }
  });

  return allFilled;
}



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

function convertImageTempToBase64(File, label, fieldType, submitedForm) {
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


async function saveTempSubmit() {
    const submitedForm = [];
    const formType = document.querySelector('.formTypeTemp').textContent;
    const formPublisher = document.querySelector('.formPublisher').value;
    //const field = document.querySelector('.page-content');
    const fieldType = document.querySelectorAll('.fieldTypeTemp');
    const approval = document.querySelector('input[name="approval"]').value
    const imageConversionPromises = [];

    fieldType.forEach((fieldsType) => {
       
        const labelName = fieldsType.querySelector('.form-labelTemp');
        console.log(labelName)
        const label = labelName.textContent;
        const fieldVal = fieldsType.querySelector('.inputTypeTemp');
        const fieldType = fieldVal ? fieldVal.getAttribute("type") : null;
        
       

        if (fieldType == 'text') {
            const Invalue = fieldsType.querySelector('input[name="text"]');
            const value = Invalue.value;
            submitedForm.push({ label, value, fieldType });
            
        } 
        else if (fieldType == 'email') {
          const Invalue = fieldsType.querySelector('input[name="email"]');
          const value = Invalue.value;
          submitedForm.push({ label, value, fieldType });
          
      } 
      else if (fieldType == 'number') {
        const Invalue = fieldsType.querySelector('input[name="number"]');
        const value = Invalue.value;
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
        } else if (fieldType == 'datetime') {
          const Invalue = fieldsType.querySelector('input[name="datetime"]');
          const value = Invalue.value;

          submitedForm.push({ label, value, fieldType });
        } else if (fieldType == 'time') {
          const Invalue = fieldsType.querySelector('input[name="time"]');
          const value = Invalue.value;

          submitedForm.push({ label, value, fieldType });
        } else if (fieldType == 'location') {
          const locationDetails = []
          const coordinates = fieldsType.querySelector('div[id="coordinatesSearch"]').textContent;
          const locationName = fieldsType.querySelector('p[id="locationName"]').textContent;
          const searchInput = fieldsType.querySelector('input[id="searchInput"]').value;
          
          locationDetails.push({coordinates, locationName, searchInput})

          
          submitedForm.push({ label, value: locationDetails, fieldType });
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
        else if (fieldType === 'file') {
          const fileInput = fieldsType.querySelector('input[name="file"]');
 
                if (fileInput && fileInput.files.length > 0) {
                  // If an image is selected, convert it to base64 using a Promise
                  const File = fileInput.files[0];
          
                  // Create a promise for the image conversion and push it to the array
                  imageConversionPromises.push(
                    convertImageTempToBase64(File,label, fieldType, submitedForm )
                  );
                } else {
                  // If no image is selected, send the form data without the image
                  submitedForm.push({ label, fieldType });
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

   /* if (approval) {    
      submitedForm.push({ label: "Approval", value: "Pending", fieldType: "approval" });
  } */

    let submit = [formType, submitedForm, approval, formPublisher];
    const complete = JSON.stringify(submit);

    console.log(complete);


    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    console.log(csrfToken);


    $.ajax({
        type: 'POST',
        url: "/submitTemp",
        contentType: 'application/json',
        data: JSON.stringify({formData:submit}),
        headers: {
          'X-CSRF-TOKEN': csrfToken, // You can set the CSRF token in the header
        },
        beforeSend: function () {
          // Show the loading screen
          $('#loading-screen-published').show();
      },
        success: function(response) {
          // Handle the success response if needed
          const redirectUrl = "/thankyou"
          window.location.replace(redirectUrl)
        },
        error: function(error) {
          // Handle the error response if needed
        },
        complete: function () {
          // Hide the loading screen
          $('#loading-screen-published').hide();
      },
      });
}
