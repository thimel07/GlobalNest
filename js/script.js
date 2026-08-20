document.addEventListener(
    "DOMContentLoaded",
    function () {


        /*
        =================================
        GLOBALNEST JAVASCRIPT
        =================================
        */


        console.log(
            "GlobalNest JavaScript loaded."
        );



        /*
        =================================
        DELETE CONFIRMATION
        =================================
        */


        window.confirmDelete = function () {

            return confirm(
                "Are you sure you want to delete this property?"
            );

        };



        /*
        =================================
        ROOMMATE INTEREST
        =================================
        */


        window.showMatchMessage = function (name) {

            alert(
                "You showed interest in " +
                name +
                ". You can contact them through the platform."
            );

        };



        /*
        =================================
        AJAX PROPERTY SEARCH
        =================================
        */


        let searchBox =
        document.getElementById(
            "ajaxSearch"
        );


        let results =
        document.getElementById(
            "ajaxResults"
        );


        if (
            searchBox &&
            results
        ) {


            searchBox.addEventListener(
                "keyup",
                function () {


                    let search =
                    searchBox.value;


                    /*
                    If search is empty,
                    show a message.
                    */

                    if (
                        search.length === 0
                    ) {

                        results.innerHTML = "";

                        return;

                    }


                    /*
                    AJAX request
                    */

                    fetch(
                        "ajax-properties.php?search="
                        +
                        encodeURIComponent(search)
                    )


                    .then(
                        response =>
                        response.text()
                    )


                    .then(
                        data => {

                            results.innerHTML =
                            data;

                        }
                    )


                    .catch(
                        error => {

                            results.innerHTML =
                            "<p>Unable to load properties.</p>";

                            console.log(error);

                        }
                    );


                }
            );


        }



        /*
        =================================
        SIMPLE FORM VALIDATION
        =================================
        */


        let forms =
        document.querySelectorAll(
            "form"
        );


        forms.forEach(
            function (form) {


                form.addEventListener(
                    "submit",
                    function (event) {


                        let requiredFields =
                        form.querySelectorAll(
                            "[required]"
                        );


                        let valid = true;


                        requiredFields.forEach(
                            function (field) {


                                if (
                                    field.value.trim() === ""
                                ) {

                                    valid = false;

                                    field.style.border =
                                    "1px solid red";

                                } else {

                                    field.style.border =
                                    "1px solid #ddd";

                                }

                            }
                        );


                        if (!valid) {

                            event.preventDefault();


                            alert(
                                "Please fill in all required fields."
                            );

                        }


                    }
                );


            }
        );



        /*
        =================================
        IMAGE PREVIEW
        =================================
        */


        let imageInput =
        document.querySelector(
            'input[type="file"]'
        );


        if (imageInput) {


            imageInput.addEventListener(
                "change",
                function () {


                    let file =
                    imageInput.files[0];


                    if (!file) {

                        return;

                    }


                    /*
                    Check image type
                    */

                    if (
                        !file.type.startsWith(
                            "image/"
                        )
                    ) {

                        alert(
                            "Please select an image file."
                        );

                        imageInput.value = "";

                        return;

                    }


                    /*
                    Check file size
                    */

                    if (
                        file.size > 5000000
                    ) {

                        alert(
                            "Image must be smaller than 5 MB."
                        );

                        imageInput.value = "";

                    }


                }
            );


        }


    }
);