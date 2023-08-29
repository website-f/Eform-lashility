
document.getElementById("saveBuild").addEventListener("click", saveFormData);
document.getElementById("clearBuild").addEventListener("click", clearFormData);
const formContainer = document.getElementById("formContainer");

// Update the function to use Promise for image conversion
function convertImageToBase64(file, formFields, fieldID, label, type, pageNumber) {
  return new Promise((resolve, reject) => {
    const reader = new FileReader();
    reader.readAsDataURL(file);
    reader.onload = function () {
      const base64Image = reader.result.split(',')[1]; // Get base64 part
      // Add the base64Image to the formFields array
      formFields.push({ label, type, fieldID, image: base64Image, pageNumber });
      resolve();
    };
    reader.onerror = function (error) {
      reject(error);
    };
  });
}

// Update the function to use Promise for image conversion
function convertLogoImageToBase64(logoFile) {
  return new Promise((resolve, reject) => {
    const reader = new FileReader();
    reader.readAsDataURL(logoFile);
    reader.onload = function () {
      const base64LogoImage = reader.result.split(',')[1]; // Get base64 part
      // Add the base64Image to the formFields array
      resolve(base64LogoImage);
    };
    reader.onerror = function (error) {
      reject(error);
    };
  });
}

async function saveFormData() {
    // Fetch all the form elements within the container
    const formPage = document.querySelectorAll(".form-page");
    const formType = document.querySelector('.form-type').value;
    const formSub = document.querySelector('.formSubtitle').value;
    const formCreator = document.querySelector('.form-creator').value;
    const approval = document.querySelector('select[name="approval"]').value;
    const approver = document.querySelector('select[name="approver"]').value;
    const notify = document.querySelector('input[name="notifications"]').value;
    const notifyOption = []
    notifyOption.push(notify)
    const completeNotify = JSON.stringify(notifyOption);
    
    let logo = ''
    const logoImageConversionPromises = []
    const formLogo = document.querySelector('.form-logo-create');
    console.log(formLogo)
    if (formLogo && formLogo.files.length > 0) {
      // If an image is selected, convert it to base64 using a Promise
      const logoFile = formLogo.files[0];

      // Create a promise for the image conversion and push it to the array
      logoImageConversionPromises.push(
        convertLogoImageToBase64(logoFile)
      );
    } else {
      logo = '';
    }
    
    const formFields = [];

    const imageConversionPromises = [];

    formPage.forEach((page, index) => {

      const fields = page.querySelectorAll('.form-field');
      const pageNumber = index + 1;
          fields.forEach((element, index) => {
              const formLabel = element.querySelector(".col-form-label")
              const label = formLabel.textContent;
              const labelID = formLabel.getAttribute("id")
              const formControl = element.querySelector(".typeForm");
              const type = formControl ? formControl.getAttribute("type") : null;
              const required = formControl ? formControl.getAttribute("required") : null;
              const fieldID = element.querySelector("input[type='fieldID']").value;
              
              
              if (type == 'select') {
                const selectOption = []
                for (let i = 0; i < formControl.options.length; i++) {
                  // Step 4: Check if an option is selected and add its value to the array
                      selectOption.push(formControl.options[i].value);
              } 
               if(approval == 1) {
                if (required == null) {
                  formFields.push({ label, type, selectOption, fieldID, pageNumber, required: 'no'});
                } else {
                  formFields.push({ label, type, selectOption, fieldID, pageNumber, required: 'yes'});
                }
               } else {
                if (required == null) {
                  formFields.push({ label, type, selectOption, fieldID, pageNumber, approval: "pending", required: 'no'});
                } else {
                  formFields.push({ label, type, selectOption, fieldID, pageNumber, approval: "pending", required: 'yes'});
                }
               }
                
              }
              else if (type == 'checkbox') {
                
                const checkboxes = document.querySelectorAll(`input[id=${labelID}]`);
                const checkValues = [];
                      // Step 3: Loop through all checkboxes
                      checkboxes.forEach(checkbox => {
                          // Step 4: Check if a checkbox is checked and add its value to the array
                             checkValues.push(checkbox.value);
                      });
                if(approval == 1) {
                  if (required == null) {
                    formFields.push({ label, type, checkValues, fieldID, pageNumber, required: 'no'});
                   } else {
                     formFields.push({ label, type, checkValues, fieldID, pageNumber, required: 'yes'});
                   }
                } else {
                  if (required == null) {
                    formFields.push({ label, type, checkValues, fieldID, pageNumber, approval: "pending", required: 'no'});
                   } else {
                     formFields.push({ label, type, checkValues, fieldID, pageNumber, approval: "pending", required: 'yes'});
                   }
                }
              }
              else if (type == 'radio') {
                const radios = document.querySelectorAll(`input[id=${labelID}]`);
                const radioValues = [];
          console.log(radioValues)
                      // Step 3: Loop through all checkboxes
                      radios.forEach(radio => {
                          // Step 4: Check if a checkbox is checked and add its value to the array
                             radioValues.push(radio.value);
                      });
                if(approval == 1) {
                  if (required == null) {
                   formFields.push({ label, type, radioValues, fieldID, pageNumber, required: 'no'});
                  } else {
                    formFields.push({ label, type, radioValues, fieldID, pageNumber, required: 'yes'});
                  }
                } else {
                  if (required == null) {
                    formFields.push({ label, type, radioValues, fieldID, pageNumber, approval: "pending", required: 'no'});
                   } else {
                     formFields.push({ label, type, radioValues, fieldID, pageNumber, approval: "pending", required: 'yes'});
                   }
                
                }
              } 
              else if (type == "text youtube") {
                let youtube = document.querySelector('input[type="text youtube"]')
                const youtubeLink = youtube.value;
          
                formFields.push({ label, type, fieldID, youtubeLink, pageNumber})
              }
              else if (type == "termscondition") {
          
                
                  formFields.push({ label, type, fieldID, pageNumber, required: 'yes'})
                
              }
              else if (type == "Heading") {
                let subheading = document.getElementById("subHeadingLabel").textContent

          
                formFields.push({ label, type, fieldID, subheading, pageNumber})
              }
              
              else if (type == "file") {
                const imageInput = element.querySelector('input[type="file"]');
                console.log(imageInput.files)
                if (imageInput && imageInput.files.length > 0) {
                  // If an image is selected, convert it to base64 using a Promise
                  const imageFile = imageInput.files[0];
          
                  // Create a promise for the image conversion and push it to the array
                  imageConversionPromises.push(
                    convertImageToBase64(imageFile, formFields, fieldID, label, type, pageNumber)
                  );
                } else {
                  // If no image is selected, send the form data without the image
                  formFields.push({ label, type, pageNumber });
                }
              }
               else {
                if(approval == 1) {
                  if (required == null) {
                    formFields.push({ label, type, pageNumber, fieldID, required: 'no'});
                  } else {
                    formFields.push({ label, type, pageNumber, fieldID, required: 'yes'});
                  }
                  
                } else {
                  if (required == null) {
                    formFields.push({ label, type, pageNumber, fieldID, approval: "pending", required: 'no'});
                  } else {
                    formFields.push({ label, type, pageNumber, fieldID, approval: "pending", required: 'yes'});
                  }
                  
                }
                
              }
            });
    
  });
  
  // Wait for all image conversion promises to complete
  try {
    await Promise.all(imageConversionPromises);
  } catch (error) {
    console.error('Image Conversion Error:', error);
  }
  // Wait for all image conversion promises to complete
  try {
    const base64LogoImages = await Promise.all(logoImageConversionPromises);
    if (base64LogoImages.length > 0) {
      logo = base64LogoImages[0];
    }
  } catch (error) {
    console.error('Image Conversion Error:', error);
  }
    // Convert the formData array to JSON
    //const formDataJSON = JSON.stringify(formData);
    if (!formType || formFields.length === 0) {
        alert("form title and form fields cant be empty")
    }

    let forms = [formType, formFields, approval, formCreator, approver, completeNotify, logo, formSub]
    let formsComplete = JSON.stringify(forms)

    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    
  console.log(csrfToken)
  console.log(forms);
  
    // Send the JSON data to the backend (you need to implement the backend API)
    // For example, you can use fetch() to send a POST request to the server.
    
    $.ajax({
      type: 'POST',
      url: "/form",
      contentType: 'application/json',
      data: JSON.stringify({formData:forms}),
      headers: {
        'X-CSRF-TOKEN': csrfToken, // You can set the CSRF token in the header
      },
      success: function(response) {
        // Handle the success response if needed
        const successMessage = "Form data saved successfully!";
        const redirectUrl = "/forms?success=" + encodeURIComponent(successMessage);
        window.location.href = redirectUrl;
      },
      error: function(error) {
        // Handle the error response if needed
        if (error.status === 422) {
          const validationErrors = error.responseJSON.errors;

          if (validationErrors && validationErrors['formData.0']) {
              const errorMessage = validationErrors['formData.0'][0];
              $('#typeError').text(errorMessage);
              $('#typeError').show(); // Show the error message
          } else {
              $('#typeError').hide(); // Hide the error message
          }

          // Handle other validation errors if needed
      } else {
          // Handle other types of errors
      }
      },
    });

  
  
}
 
function clearFormData() {
  formContainer.innerHTML = '';
  //console.log(formContainer.children);
}
