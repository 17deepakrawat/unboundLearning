export function handleFormSubmit(event, form) {
  event.preventDefault(); // Prevent the default form submission
  var formId = form.id;
  console.log('Form ID:', formId);

  // Optionally, you can proceed with form submission using AJAX or other logic
  // $.ajax({
  //     url: 'your-server-endpoint',
  //     method: 'POST',
  //     data: $(form).serialize(),
  //     success: function(response) {
  //         console.log('Form submitted successfully');
  //     }
  // });

  return false; // To ensure the form does not submit
}
