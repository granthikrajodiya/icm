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
    acceptedFiles: "image/*",
    addRemoveLinks: true,
    timeout: 120000,
    maxFiles: 1,
    previewsContainer: ".dz-preview",
    // The setting up of the dropzone
    init: function() {
      var myDropzone = this;
    }
});
    





