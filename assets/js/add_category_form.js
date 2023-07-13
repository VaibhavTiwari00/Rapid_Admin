$("#btn-crete-category").click(function() {


    let title = $("#c-title");
    let slug = $("#c-slug");
    let vi = $("#c-visibility");
    let di = document.getElementById("category-display-img");
    let hi = document.getElementById("category-header-img");

    if (title.val() != "") {
        if (slug.val() != "") {
            if (di.files.length > 0) {
                if (hi.files.length > 0) {


                    formdata = new FormData();
                    formdata.append("title", title.val());
                    formdata.append("slug", slug.val());
                    formdata.append("vi", vi.val());
                    formdata.append("di", di.files[0])
                    formdata.append("hi", hi.files[0])

                    $.ajax({
                        url: DOMAIN + "/api/category/add",
                        type: "POST",
                        data: formdata,
                        processData: false,
                        contentType: false,
                        success: function(data) {
                            console.log(data);
                            try {
                                if (data != "" && data != null) {
                                    let res = JSON.parse(data);
                                    console.log(res);
                                    if (res.result == 'success') {
                                        toast.success("Category added successfully");
                                        window.location.reload();
                                    } else {
                                        toast.error(res.message);
                                    }
                                }
                            } catch (error) {
                                console.log(error);
                                toast.error(error.message);
                            }
                        }
                    });


                } else {
                    toast.error("Please select a category header img");
                }


            } else {
                toast.error("Please select a category display img");
            }

        } else {
            toast.error("Category slug Can't be empty");
        }

    } else {
        toast.error("Category title can't be empty");
    }

});