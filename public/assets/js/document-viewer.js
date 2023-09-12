class DocumentViewer {

    #docuViewareId;
    #hiddenSnapIns = ['search', 'annotations', 'comments', 'redaction', 'thumbnails'];

    constructor(docuViewareId) {
        this.#docuViewareId = docuViewareId;
    }

    hideSnapIn() {
        const $this = this;
        $this.#hiddenSnapIns.forEach(function(snapIn) {
            DocuViewareAPI.HideSnapIn($this.#docuViewareId, snapIn);
        });
    }

    init() {
        this.onRegisterOnDocuViewareAPIReady();
    }

    viewDoc(file, docId) {
        const $this = this;
        var reader = new FileReader();
        reader.onload = function () {
            var arrayBuffer = this.result;
            setTimeout(function () {
                DocuViewareAPI.LoadFromByteArray($this.#docuViewareId, arrayBuffer, file.type, docId,
                    function() {
                    },
                    function() {
                    }
                );
            }, 2000);
        }
        reader.readAsArrayBuffer(file);
    }

    onRegisterOnDocuViewareAPIReady() {
        const docuViewareId = this.#docuViewareId;
        const $this = this;

        if (typeof DocuViewareAPI !== "undefined" && DocuViewareAPI.IsInitialized(docuViewareId)) {
            DocuViewareAPI.RegisterOnNewDocumentLoaded(docuViewareId, function () {
                $this.hideSnapIn();
            });
        } else {
            setTimeout(function () { $this.onRegisterOnDocuViewareAPIReady(); }, 10);
        }
    }
}