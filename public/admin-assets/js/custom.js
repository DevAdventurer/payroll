function Button(button) {
    this.buttonOldHtml = button.innerHTML;
    this.process = function() {
        button.innerHTML = '<span class="spinner-border spinner-border-sm me-1" role="status" aria-hidden="true"></span>&nbsp;' + this.buttonOldHtml;
        button.disabled = true;
    }
    this.normal = function() {
        button.innerHTML = this.buttonOldHtml;
        button.disabled = false;
    }
}

clearErrors = function() {
        Array.from(document.getElementsByClassName('validate')).map(function(e, f) {
            e.innerHTML = '';
        });
        Array.from(document.getElementsByClassName('error')).map(function(e, f) {
            e.innerHTML = '';
        });

        Array.from(document.getElementsByClassName('form-group')).map(function(e, f) {
            e.classList.remove("has-error");
        });

        //var remvcl = document.getElementsByClassName('form-group');
        //remvcl.classList.remove("as-error");
}
handleErrors = function(error, options={}) {
    //console.log('error', error)
    var options = {
        element:options.element?options.element:'small',
        style:options.style,
        class:options.class?options.class:'text-danger'
    }
    if (!error)
        return;
    if (error.message) {
        //return toastr.error(error.message);
        Toastify({
            text: error.message,
            duration: 3000,
            close: true,
            gravity: "top", // `top` or `bottom`
            position: "right", // `left`, `center` or `right`
            stopOnFocus: true, // Prevents dismissing of toast on hover
            className: "bg-danger",

        }).showToast();
    }
    var element = '';
    Array.from(document.getElementsByClassName('validate')).map(function(e, f) {
        e.innerHTML = '';
    });
    // console.log(error);
    // Object.entries(error.errors).map(function(a, b, c) {
    //     var ele = document.querySelector('.validate.' + a[0]);
    //     if (ele) {
    //         a[1].map(function(e, f) {
    //             ele.innerHTML = e;
    //         });
    //     } else {
    //         element = document.createElement(options.element);
    //         element.setAttribute('class', 'validate '+options.class+' ' + a[0]);
    //         element.setAttribute('style', options.style);
    //         a[1].map(function(e, f) {
    //             var textnode = document.createTextNode(e);
    //             element.appendChild(textnode);
    //         });
    //         var input = document.querySelector('[name="' + a[0] + '"]');
    //         if (input)
    //             input.parentNode.insertBefore(element, input.nextSibling);
    //             input.parentNode.classList.add("has-error");
    //     }
    // });


    if (error && error.errors) {
        Object.entries(error.errors).map(function(a, b, c) {
            var ele = document.querySelector('.validate.' + a[0]);
    
            var input = document.querySelector('[name="' + a[0] + '"]');
            if (input) {
                input.parentNode.classList.add("has-error");
    
                // Create the `element` if it doesn't exist
                var element = document.createElement(options.element);
                element.setAttribute('class', 'validate ' + options.class + ' ' + a[0]);
                element.setAttribute('style', options.style);
                a[1].map(function(e, f) {
                    var textnode = document.createTextNode(e);
                    element.appendChild(textnode);
                });
    
                // Insert `element` if it doesn't already exist
                if (!ele) {
                    input.parentNode.insertBefore(element, input.nextSibling);
                } else {
                    ele.innerHTML = ''; // Clear existing content
                    a[1].map(function(e, f) {
                        var textnode = document.createTextNode(e);
                        ele.appendChild(textnode);
                    });
                }
            }
        });
    } else {
       console.log('error', error)
    }
}


// document.querySelector('.slugify').addEventListener('change', function() {
//     console.log('You selected: ', this.value);
// });




function setCookie(cname, cvalue, exdays) {
  const d = new Date();
  d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
  let expires = "expires="+d.toUTCString();
  document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

function getCookie(cname) {
  let name = cname + "=";
  let ca = document.cookie.split(';');
  for(let i = 0; i < ca.length; i++) {
    let c = ca[i];
    while (c.charAt(0) == ' ') {
      c = c.substring(1);
    }
    if (c.indexOf(name) == 0) {
      return c.substring(name.length, c.length);
    }
  }
  return "";
}

function delete_cookie(name) {
  document.cookie = name +'=; Path=/; Expires=Thu, 01 Jan 1970 00:00:01 GMT;';
}



// Function to auto-resize the textarea based on its content
function autoResize(textarea) {
    textarea.style.height = 'auto'; // Reset the height
    textarea.style.height = textarea.scrollHeight + 'px'; // Set the height to match the scroll height
}

// Check if the element with ID 'address' exists
var addressTextarea = document.getElementById('address');
if (addressTextarea) {
    addressTextarea.addEventListener('keydown', function(event) {
        if (event.key === 'Enter') {
            event.preventDefault(); // Prevent the default behavior (form submission, etc.)
            this.value += '\n'; // Insert a newline character at the cursor position
            autoResize(this); // Adjust the height after adding the newline
        }
    });

    // Initial call to set the height correctly if there's initial content
    window.addEventListener('load', function() {
        autoResize(addressTextarea);
    });
}

// Check if the element with ID 'mobile_no' exists
var phoneInput = document.getElementById('mobile_no');
if (phoneInput) {
    var prefilledNumber = "+91";

    function resetInput() {
        phoneInput.value = '';
    }

    phoneInput.addEventListener('focus', function() {
        if (phoneInput.value.trim() === "" || phoneInput.value.trim() === prefilledNumber) {
            phoneInput.value = prefilledNumber;
            phoneInput.setSelectionRange(prefilledNumber.length, prefilledNumber.length);
        }
    });

    phoneInput.addEventListener('blur', function() {
        if (phoneInput.value.trim() === prefilledNumber) {
            resetInput();
        }
    });

    phoneInput.addEventListener('input', function() {
        var enteredValue = phoneInput.value.trim();
        if (enteredValue.startsWith(prefilledNumber) || enteredValue === "") {
            if (enteredValue === "") {
                resetInput();
            }
        } else {
            phoneInput.value = prefilledNumber;
            phoneInput.setSelectionRange(prefilledNumber.length, prefilledNumber.length);
        }
    });
}


$('.select-mediatype').focus(function() {
    $(this).closest('.onFocus').addClass('focused');
});

// Optionally remove the border color when the input loses focus
$('.select-mediatype').blur(function() {
    $(this).closest('.onFocus').removeClass('focused');
});