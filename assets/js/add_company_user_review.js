function add_company_user_review() {

    let name = get_value("name", "user name can't be empty"),
        slug = get_value("slug", "Slug can't be empty"),
        review = get_value("review"),
        star = get_value("star")



    if (name && slug) {
        $.post(server.add_company_user_review(), {
            name: name,
            slug: slug,
            review: review,
            star: star

        }, function(data) {
            console.log(data)
            if (isJsonString(data)) {
                data = JSON.parse(data)
                if (data.status) {
                    toast.success(data.message)
                    reload();
                } else {
                    toast.error(data.message)
                }
            } else {
                toast.error("Something went wrong with your request. Please try again")
            }

        });
    } else {
        toast.error("Fill all data");
    }
}


function update_company_user_review() {

    let name = get_value("name", "user name can't be empty"),
        slug = get_value("slug", "Slug can't be empty"),
        review = get_value("review"),
        star = get_value("star"),
        id = get_value("id")



    if (name && slug) {
        $.post(server.edit_company_user_review(), {
            name: name,
            slug: slug,
            review: review,
            star: star,
            id: id

        }, function(data) {
            console.log(data)
            if (isJsonString(data)) {
                data = JSON.parse(data)
                if (data.status) {
                    toast.success(data.message)
                    reload();
                } else {
                    toast.error(data.message)
                }
            } else {
                toast.error("Something went wrong with your request. Please try again")
            }

        });
    } else {
        toast.error("Fill all data");
    }
}