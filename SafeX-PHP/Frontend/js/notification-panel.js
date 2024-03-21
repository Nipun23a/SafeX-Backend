function handleFormSubmit(formId) {
    document.getElementById(formId).addEventListener("submit", function(event) {
        event.preventDefault();
        var form = this;
        var formData = new FormData(form);
        fetch(form.action, {
            method: form.method,
            body: formData
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            if (data.status === 'success') {
                swal({
                    title: "Success",
                    text: data.message,
                    icon: "success",
                }).then(function(result) { 
                    location.replace(location.href);
                  })
            } else {
                swal({
                    title: "Error",
                    text: data.message,
                    icon: "error",
                });
            }
        })
        .catch(error => {
            console.error('There was a problem with the fetch operation:', error);
            swal({
                title: "Error",
                text: "An error occurred while processing your request. Please try again later.",
                icon: "error",
            });
        });
    });    
}
