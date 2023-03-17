import "./bootstrap";

import Alpine from "alpinejs";
import axios from "axios";

window.Alpine = Alpine;

Alpine.start();

const editForms = document.querySelectorAll(".edit-form");
const editModals = document.querySelectorAll(".edit-modal");
const editButtons = document.querySelectorAll(".open_modal");
let openModal = null;

editButtons.forEach((button) => {
    button.addEventListener("click", (event) => {
        editModals.forEach((modal) => {
            if (button.dataset.id === modal.dataset.id) {
                modal.classList.add("show");
                console.log(modal);
                openModal = modal;
            }
        });

        event.stopPropagation();
    });
});

window.addEventListener("click", (e) => clickOutside(e));

const clickOutside = (e) => {
    if (openModal.querySelector(".inner-modal-form").contains(e.target)) {
        // Clicked in box
    } else {
        if (openModal) {
            openModal.classList.remove("show");
            openModal = null;
        }
    }
};

editForms.forEach((form) => {
    form.addEventListener("submit", (e) => {
        e.preventDefault();
        const formData = serializeForm(e.target);

        axios
            .put(form.action, {
                ...formData,
            })
            .then(() => {
                window.location.reload();
            })
            .catch((error) => {
                if (error.response.data.errors) {
                    if (error.response.data.errors.name)
                        form.elements["edit-name"].classList.add("error");
                    if (error.response.data.errors.iso)
                        form.elements["edit-iso"].classList.add("error");
                }
            });
    });
});

const serializeForm = function (form) {
    const obj = {};
    const formData = new FormData(form);
    for (const key of formData.keys()) {
        obj[key] = formData.get(key);
    }
    return obj;
};
