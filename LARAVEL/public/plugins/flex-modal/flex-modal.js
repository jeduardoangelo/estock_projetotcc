var FlexModal = class {
    static show(params) {
        if (!params) params = {};

        let flexModalOverlay = document.createElement("div");
        let flexModal = document.createElement("div");
        let flexModalTitle = document.createElement("div");
        let flexModalTitleText = document.createElement("span");
        let flexModalTitleBtnClose = document.createElement("span");
        let flexModalBody = document.createElement("div");

        let uniqueId = '_' + Math.random().toString(36).substr(2, 9);
        flexModalOverlay.id = uniqueId;

        if (typeof params.target === 'string') {
            params.target = document.querySelector(params.target);
        }

        if (params.target) {
            flexModalOverlay.originalParentNode = params.target.parentNode;
        }

        flexModalOverlay.classList.add("flexModalOverlay");
        flexModal.classList.add("flexModal");
        flexModalTitle.classList.add("flexModalTitle");
        flexModalTitleText.classList.add("flexModalTitleText");
        flexModalTitleBtnClose.classList.add("flexModalTitleBtnClose");
        flexModalBody.classList.add("flexModalBody");

        if (params.target) {
            flexModalBody.appendChild(params.target);
        }

        if (typeof params.content === 'string') {
            flexModalBody.style.padding = "20px";
            flexModalBody.style.textAlign = "center";
            flexModalBody.innerHTML = params.content;
        }

        if (this.isDomElement(params.content)) {
            flexModalBody.appendChild(params.content);
        }

        if (params.title) {
            flexModalTitleText.innerHTML = params.title;
        }

        if (params.noTitle) {
            flexModalTitle.style.display = 'none';
        }

        if (params.noBtnClose) {
            flexModalTitleBtnClose.style.display = 'none';
        }

        if (params.onlyContent) {
            flexModalTitle.style.display = 'none';
            flexModal.style.backgroundColor = 'transparent';
            flexModal.style.boxShadow = 'none';
            flexModal.style.padding = '0';
        }

        if (params.theme) {
            flexModal.classList.add(params.theme);
        }

        if (params.overlayClass) {
            flexModalOverlay.classList.add(params.overlayClass);
        }



        flexModalTitleBtnClose.innerHTML = "&#10005";
        flexModalTitleBtnClose.addEventListener("click", function () {
            FlexModal.dismiss(flexModalOverlay.id, params);
            if (params.onClickBtnClose) params.onClickBtnClose();
        });

        flexModalOverlay.addEventListener("click", function () {
            FlexModal.dismiss(flexModalOverlay.id, params);
            if (params.onClickOverlay) params.onClickOverlay();
        });

        flexModalOverlay.addEventListener("keydown", function (event) {
            if (event.key == 'Escape') { FlexModal.dismiss(flexModalOverlay.id, params); }
        });

        flexModal.addEventListener("click", function (event) {
            event.stopPropagation();
        });

        flexModalOverlay.appendChild(flexModal);
        flexModal.appendChild(flexModalTitle);
        flexModalTitle.appendChild(flexModalTitleText);
        flexModalTitle.appendChild(flexModalTitleBtnClose);
        flexModal.appendChild(flexModalBody);
        document.body.appendChild(flexModalOverlay);

        flexModal.tabIndex = 0;
        flexModal.focus();
        return uniqueId;
    }

    static hide(modalId, params) { FlexModal.dismiss(modalId, params); }
    static close(modalId, params) { FlexModal.dismiss(modalId, params); }
    static dismiss(modalId, params) {
        if (modalId) {
            let target = document.getElementById(modalId);
            FlexModal.animatedClosing(target, params);
        } else {
            let allTargets = document.querySelectorAll('.flexModalOverlay');
            let lastTarget = allTargets.item(allTargets.length - 1);
            FlexModal.animatedClosing(lastTarget, params);
        }

        if (params) {
            if (params.onClose) params.onClose();
            if (params.onDismiss) params.onDismiss();
            if (params.onHide) params.onHide();
        }
    }

    static hideAll() { this.dismissAll(); }
    static closeAll() { this.dismissAll(); }
    static dismissAll() {
        let allTargets = document.querySelectorAll('.flexModalOverlay');
        for (let target of allTargets) {
            FlexModal.animatedClosing(target);
        }
    }

    static selfClose(event) { this.selfDismiss(event); }
    static selfDismiss(event) {
        let flexModalOverlay = this.seekParent(event.target, ".flexModalOverlay");
        let flexModalTitleBtnClose = flexModalOverlay.querySelector(".flexModalTitleBtnClose");
        flexModalTitleBtnClose.click();
    }

    static animatedClosing(flexModalOverlay, params) {
        flexModalOverlay.classList.add('closing');

        setTimeout(() => {
            if (flexModalOverlay.originalParentNode) {
                for (let element of flexModalOverlay.querySelectorAll(".flexModalBody > *")) {
                    flexModalOverlay.originalParentNode.appendChild(element);
                }
            }

            if (!flexModalOverlay.parentNode) return;
            flexModalOverlay.parentNode.removeChild(flexModalOverlay);

            if (params && params.afterClose) params.afterClose();

        }, 500);
    }

    static showYesNo(params) {
        if (!params.yes) params.yes = {};
        if (!params.no) params.no = {};

        if (!params.title) params.title = "Atenção";
        if (!params.question) params.question = "";

        if (!params.yes.text) params.yes.text = "Sim";
        if (!params.yes.class) params.yes.class = "";

        if (!params.no.text) params.no.text = "Não";
        if (!params.no.class) params.no.class = "";

        let innerContent = document.createElement("div");
        innerContent.classList.add("flexModalYesNoContent");

        let spanQuestion = document.createElement("span");
        spanQuestion.classList.add("flexModalYesNoQuestion");
        spanQuestion.innerHTML = params.question;

        let boxButtons = document.createElement("div");
        boxButtons.classList.add("flexModalYesNoBoxButtons");

        let btnYes = document.createElement("button");
        btnYes.type = "button";
        btnYes.innerHTML = params.yes.text;
        btnYes.class = params.yes.class;
        if (params.yes.class != "") btnYes.setAttribute('class', params.yes.class);

        let btnNo = document.createElement("button");
        btnNo.type = "button";
        btnNo.innerHTML = params.no.text;
        btnNo.class = params.no.class;
        if (params.no.class != "") btnNo.setAttribute('class', params.no.class);

        innerContent.appendChild(spanQuestion);
        innerContent.appendChild(boxButtons);
        boxButtons.appendChild(btnNo);
        boxButtons.appendChild(btnYes);

        params.content = innerContent;
        params.noBtnClose = true;
        let modalId = this.show(params);

        return new Promise((resolve) => {

            btnYes.onclick = () => {
                FlexModal.dismiss(modalId, params);
                resolve(true);
            };

            btnNo.onclick = () => {
                FlexModal.dismiss(modalId, params);
                resolve(false);
            };

        });
    }

    static showInputRequest(params) {
        let form = document.createElement("form");
        let spanContent = document.createElement("span");
        let input = document.createElement("input");
        let btnOk = document.createElement("button");
        let btnCancel = document.createElement("button");

        form.classList.add("flexModalFormInputRequest");
        input.type = "text";
        input.style.textAlign = "center";
        btnOk.type = "submit";
        btnOk.innerHTML = "OK";
        btnCancel.type = "button";
        btnCancel.innerHTML = "Cancelar";

        if (params.input) {
            if (params.input.required) input.required = true;
            if (params.input.id) input.id = params.input.id;
            if (params.input.class) input.className = params.input.class;
            if (params.input.placeholder) input.placeholder = params.input.placeholder;
        }

        if (params.btnOk) {
            if (params.btnOk.text) btnOk.innerHTML = params.btnOk.text;
            if (params.btnOk.id) btnOk.id = params.btnOk.id;
            if (params.btnOk.class) btnOk.className = params.btnOk.class;
        }

        if (params.btnCancel) {
            if (params.btnCancel.text) btnCancel.innerHTML = params.btnCancel.text;
            if (params.btnCancel.id) btnCancel.id = params.btnCancel.id;
            if (params.btnCancel.class) btnCancel.className = params.btnCancel.class;
        }

        if (typeof params.content === 'string') {
            spanContent.innerHTML = params.content;
            form.style.padding = "20px";
            form.style.textAlign = "center";
            input.style.marginTop = "20px";
        }

        if (params.maxlength) input.setAttribute('maxlength', params.maxlength);

        if (this.isDomElement(params.content)) {
            spanContent = params.content;
        }

        form.appendChild(spanContent);
        form.appendChild(input);
        form.appendChild(btnOk);
        if (params.btnCancel) form.appendChild(btnCancel);
        params.content = form;

        return new Promise((resolve, reject) => {
            form.addEventListener("submit", (event) => {
                event.preventDefault();
                FlexModal.dismiss(null, params);
                resolve(input.value);
            });

            btnCancel.addEventListener('click', () => {
                FlexModal.dismiss(null);
                reject(input.value);
            });

            this.show(params);
            setTimeout(() => { input.focus(); }, 100);
        });
    }

    static showSelectRequest(params) {
        let form = document.createElement("form");
        let spanContent = document.createElement("span");
        let select = document.createElement('select');
        let btnOk = document.createElement("button");
        let btnCancel = document.createElement("button");

        form.classList.add("flexModalFormInputRequest");
        select.style.textAlign = "center";
        btnOk.type = "submit";
        btnOk.innerHTML = "OK";
        btnCancel.type = "button";
        btnCancel.innerHTML = "Cancelar";

        if (params.select) {
            if (params.select.required) select.required = true;
            if (params.select.id) select.id = params.select.id;
            if (params.select.class) select.className = params.select.class;

            if (params.data == undefined) throw ('Data object undefined!');
            let data = params.data;
            data.map((value, key) => {
                let options = document.createElement('option');
                options.text = value.description
                options.value = value.value
                select.add(options, select[key])
            })
        }

        if (params.btnOk) {
            if (params.btnOk.text) btnOk.innerHTML = params.btnOk.text;
            if (params.btnOk.id) btnOk.id = params.btnOk.id;
            if (params.btnOk.class) btnOk.className = params.btnOk.class;
        }

        if (params.btnCancel) {
            if (params.btnCancel.text) btnCancel.innerHTML = params.btnCancel.text;
            if (params.btnCancel.id) btnCancel.id = params.btnCancel.id;
            if (params.btnCancel.class) btnCancel.className = params.btnCancel.class;
        }

        if (typeof params.content === 'string') {
            spanContent.innerHTML = params.content;
            form.style.padding = "20px";
            form.style.textAlign = "center";
            select.style.marginTop = "20px";
        }

        if (this.isDomElement(params.content)) {
            spanContent = params.content;
        }

        form.appendChild(spanContent);
        form.appendChild(select);
        form.appendChild(btnOk);
        if (params.btnCancel) form.appendChild(btnCancel);
        params.content = form;

        return new Promise((resolve) => {
            form.addEventListener("submit", (event) => {
                event.preventDefault();
                FlexModal.dismiss(null, params);
                resolve(select.value);
            });

            btnCancel.addEventListener('click', () => FlexModal.dismiss(null));

            this.show(params);
            setTimeout(() => { select.focus(); }, 100);
        });
    }

    static isDomElement(element) {
        return element instanceof Element || element instanceof HTMLDocument;
    }

    static seekParent(element, strQuery) {
        let currentParent = element;

        while (true) {
            currentParent = currentParent.parentNode;
            if (!currentParent) break;
            let parentIsFound = false;

            for (let node of document.querySelectorAll(strQuery)) {
                if (node.isSameNode(currentParent)) { parentIsFound = true; break; }
            }

            if (parentIsFound) break;
        }

        return currentParent;
    }
}
