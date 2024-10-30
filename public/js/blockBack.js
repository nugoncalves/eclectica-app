let formChanged = false;
let isSubmitting = false;

document.querySelectorAll("#main_form input, #main_form textarea, #main_form select").forEach(function (input) {
  input.addEventListener("change", function (e) {
    console.log("Change detected on:", e.target.name); // Log field being changed

    // For file inputs, we do not mark the form as changed
    if (e.target.type !== "file") {
      formChanged = true;
      console.log("Form changed status:", formChanged); // Log formChanged status
    }
  });
});

// Flag the form as being submitted when the submit button is clicked
document.querySelector("#main_form").addEventListener("submit", function () {
  isSubmitting = true; // Form is being submitted
  console.log("Form is submitting:", isSubmitting); // Log form submission
});

// Before unload event to warn about unsaved changes
window.addEventListener("beforeunload", function (e) {
  console.log("BeforeUnload triggered - FormChanged:", formChanged, "IsSubmitting:", isSubmitting); // Log beforeunload values
  // Enforce strict condition
  if (formChanged === true && isSubmitting === false) {
    e.preventDefault(); // This line is not necessary for all browsers, but keeps it safer
    e.returnValue = "You have unsaved changes!"; // Only return this if formChanged is true and not submitting
    console.log("Unsaved changes alert triggered.");
  } else {
    console.log("No unsaved changes, or form is submitting.");
  }
});
