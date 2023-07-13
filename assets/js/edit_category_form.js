$("#btn-crete-category").click(function () {


    let title = $("#c-title");
    let slug = $("#c-slug");
    let vi = $("#c-visibility");
    let di = document.getElementById("category-display-img");
    let hi = document.getElementById("category-header-img");

    if (title.val() == "") {
        toast.error("Category title can't be empty");
    }

    if (slug.val() == "") {
        toast.error("Category slug Can't be empty");
    }

    if (DI_FILE_SELECT) {
        if (di.files.length == 0) {
            toast.error("Please select a category display img");
        } else {
            di_ = di.files[ 0 ];
        }
    }

    if (HI_FILE_SELECT) {
        if (hi.files.length == 0) {
            toast.error("Please select a category header img");
        } else {
            hi_ = hi.files[ 0 ];
        }
    }


    formdata = new FormData();
    formdata.append("category_id", tour_code);
    formdata.append("title", title.val());
    formdata.append("slug", slug.val());
    formdata.append("vi", vi.val());
    formdata.append("di", di_);
    formdata.append("hi", hi_);

    $.ajax({
        url: DOMAIN + "/api/category/edit/" + tour_code,
        type: "POST",
        data: formdata,
        processData: false,
        contentType: false,
        success: function (data) {
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

});