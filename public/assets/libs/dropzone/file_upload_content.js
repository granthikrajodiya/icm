var dropzone = new Dropzone('#upload-form', { // The camelized version of the ID of the form element

  // The configuration we've talked about above
  autoProcessQueue: false,
  uploadMultiple: false,
  parallelUploads: 1,  // since we're using a global 'currentFile', we could have issues if parallelUploads > 1, so we'll make it = 1
  maxFilesize: 2048,   // max individual file size 1024 MB
  chunking: true,      // enable chunking
  forceChunking: true, // forces chunking when file.size < chunkSize
  parallelChunkUploads: true, // allows chunks to be uploaded in parallel (this is independent of the parallelUploads option)
  chunkSize: 2000000,  // chunk size 2,000,000 bytes (~2MB)
  retryChunks: true,   // retry chunks on failure
  retryChunksLimit: 3, // retry maximum of 3 times (default is 3)
  acceptedFiles: "audio/*,image/*,.json,.zip,.xls,.xlsx,.txt,.ppt,.pptx,.pdf,.mp3,.doc,.docx,.3ds,.aac,.ai,.avi,.bmp,.cad,.cdr,.css,.dat,.dll,.dmg,.doc,.eps,.fla,.flv,.html,.indd,.iso,.js,.midi,.mov,.mp3,.mpg,.pdf,.php,.ppt,.ps,.psd,.raw,.sql,.xml,.exe,.msi",
  addRemoveLinks: false,
  timeout: 120000,
  maxFiles: 1,
  previewsContainer: ".dropzone-previews",

  // The setting up of the dropzone
  init: function() {
    var myDropzone = this;
  }
});

$('#upload-form').on("submit", function(e) {
  // Make sure that the form isn't actually being sent.
  e.preventDefault();
  e.stopPropagation();
  dropzone.processQueue();
});


