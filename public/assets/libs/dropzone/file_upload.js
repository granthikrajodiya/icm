/**
 * GooTools.net custom JS for file upload
 */

var dropzone = new Dropzone('#datanodeupload', 
{
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
  success: function(file, response)
  {
    
    if (response.is_success == true) {
      show_toastr('Success', response.message, 'success');
      if(response.subfolder != '' && response.subfolder != undefined && response.subfolder != null){
        getFileList(response.subfolder);
      }else{
        getFileList();
      }
    } else if (response.is_success == false) {
      show_toastr('Error', response.message, 'error');
    }
   // $('#commonModal').modal('hide');
  },
  error: function(file, response)
  {
    show_toastr('Error', response, 'error');
  }
});

