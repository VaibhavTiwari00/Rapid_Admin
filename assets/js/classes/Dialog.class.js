class Dialog {

    constructor() { // Constructor
        this.#addCsslink("dialog_class_css", "dialog");
    }


    addCsslink(id, filename) {
        var head = document.getElementsByTagName('head')[0];
        var link = document.createElement('link');
        link.rel = 'stylesheet';
        link.type = 'text/css';
        link.id = id;
        link.href = Root.link() + '/assets/css/' + filename + '.class.css';
        head.appendChild(link);
    }


    removeCssLink(id) {
        document.getElementsByTagName('head')[0].removeChild(document.getElementById(id));
    }


    openFrameDialog(url) {
        this.#addCsslink("dialog_frame_css", "dialog.frame");

        let body = document.getElementsByTagName('body')[0];

        let dialog = `
                <div class="dialog_container_background" id="farame-dialog" onclick="closeFrameDialog(event)">
                    <div class="dialog_container">
                        <iframe class="dialog-iframe" src="${url}" frameborder="0"></iframe>
                    </div>
                </div>
        `;

        let body_content = body.innerHTML;
        body.innerHTML = body_content + dialog;

    }



}


function closeFrameDialog() {
    document.getElementsByTagName('head')[0].removeChild(document.getElementById("dialog_frame_css"));
    document.getElementsByTagName('body')[0].removeChild(document.getElementById('farame-dialog'));
}