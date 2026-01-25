const dropArea = document.getElementById('drop-area');
const fileInput = document.getElementById('fileElem');
const preview = document.getElementById('preview');

// Prevent default behaviors for drag/drop
['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
  dropArea.addEventListener(eventName, e => e.preventDefault(), false);
});

// Highlight drop area on drag over
['dragenter', 'dragover'].forEach(eventName => {
  dropArea.addEventListener(eventName, () => dropArea.classList.add('highlight'), false);
});
['dragleave', 'drop'].forEach(eventName => {
  dropArea.addEventListener(eventName, () => dropArea.classList.remove('highlight'), false);
});

// Handle file drop
dropArea.addEventListener('drop', (e) => {
  const files = e.dataTransfer.files;
  fileInput.files = files;
  handleFiles(files);
});

// Handle file selection via input
fileInput.addEventListener('change', () => {
  handleFiles(fileInput.files);
});

// Preview images
function handleFiles(files) {
  preview.innerHTML = ""; // clear previous preview

  Array.from(files).forEach(file => {
    if (!file.type.startsWith("image/")) {
      alert(`"${file.name}" is not an image.`);
      return;
    }

    const imgBox = document.createElement("div");
    imgBox.classList.add("mb-3");

    const img = document.createElement("img");
    img.src = URL.createObjectURL(file);
    img.classList.add("img-thumbnail");
    img.style.maxWidth = "200px";

    imgBox.appendChild(img);
    preview.appendChild(imgBox);
  });
}

// AJAX form submission
$('#productForm').on('submit', function (e) {
  e.preventDefault();
  $("#messages").html('');
  $(".submit-note").hide();
  $(".spinner-border").show();

  const formData = new FormData(this); // includes all inputs + files

  $.ajax({
    url: $(this).attr('action'), // use form action dynamically
    method: 'POST',
    data: formData,
    contentType: false,
    processData: false,
    success: function (response) {
      try {
        const res = typeof response === "string" ? JSON.parse(response) : response;

        if (res.success) {
          $("#messages").html("<div class='alert alert-success'>" + res.message + "</div>");
          $(".submit-note").show();
          $('#productForm')[0].reset();
          $('#preview').html('');
        } else {
          $("#messages").html('<div class="alert alert-danger">' + res.message + '</div>');
        }
      } catch (err) {
        console.error("JSON parse error:", response);
        $("#messages").html("<div class='alert alert-danger'> Something went wrong (invalid response)</div>");
      } finally {
        $(".spinner-border").hide();
      }
    },
    error: function (xhr) {
      $("#messages").html("<div class='alert alert-danger'> Server error: " + xhr.statusText + "</div>");
      $(".spinner-border").hide();
    }
  });
});
