document.addEventListener("DOMContentLoaded", function() {
    const contactList = document.querySelector(".contacts .contacts-list");
    const searchBar = document.querySelector(".contacts #search-input");
    const receiver = document.querySelector("#receiver_id");
    const form = document.querySelector(".type-area");
    const inputField = form.querySelector(".input-field");
    const chatBox = document.querySelector(".message-container");
    const contactHeader = document.querySelector(".messages-header");

    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
      return new bootstrap.Tooltip(tooltipTriggerEl);
    });

    loadContacts();
    loadContactHeader();

    function loadContacts() {
        let xhr = new XMLHttpRequest();
        xhr.open("GET", "server/message_function.php", true);
        xhr.onload = () => {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    let data = xhr.response;
                    contactList.innerHTML = data;
                }
            }
        };
        xhr.send();
    }

    function loadMessages() {
        let formData = new FormData(form);

        let xhr = new XMLHttpRequest();
        xhr.open("POST", "server/load_message_function.php", true);
        xhr.onload = () => {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    let data = xhr.response;
                    chatBox.innerHTML = data;
                    chatBox.scrollTop = chatBox.scrollHeight;

                    var tooltipTriggerList = [].slice.call(chatBox.querySelectorAll('[data-toggle="tooltip"]'));
                    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                        return new bootstrap.Tooltip(tooltipTriggerEl);
                    });
                }
            }
        };

        xhr.send(formData);
    }

    function loadContactHeader() {
        let formData = new FormData(form);

        let xhr = new XMLHttpRequest();
        xhr.open("POST", "server/load_header.php", true);
        xhr.onload = () => {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    let data = xhr.response;
                    contactHeader.innerHTML = data;
                }
            }
        };

        xhr.send(formData);
    }

    searchBar.addEventListener("input", function() {
        let searchterm = searchBar.value.trim();

        let xhr = new XMLHttpRequest();
        xhr.open("POST", "server/search.php", true);
        xhr.onload = () => {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    let data = xhr.response;
                    contactList.innerHTML = data;
                }
            }
        };
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.send("searchTerm=" + encodeURIComponent(searchterm));
    });

    contactList.addEventListener("click", function(event) {
        const referralCard = event.target.closest('.referral-card');

        if (referralCard) {
            const dataContactId = referralCard.getAttribute("data-contact-id");
            if (dataContactId) {
                receiver.value = dataContactId;
            }
        }
        loadMessages();
        loadContactHeader();
    });

    form.addEventListener("submit", function(event) {
        event.preventDefault();

        $("#send-button").addClass("d-none");
        $("#sending-button").removeClass("d-none");

        let formData = new FormData(form);
        formData.append("message", inputField.value.trim());

        let xhr = new XMLHttpRequest();
        xhr.open("POST", "server/send_message_function.php", true);
        xhr.onload = () => {
            $("#send-button").removeClass("d-none");
            $("#sending-button").addClass("d-none");
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    // Handle the response if needed
                    console.log(xhr.responseText);
                    inputField.value = "";
                    loadMessages();
                }
            }
        };

        xhr.send(formData);
    });
});
