let description;
ClassicEditor
    .create(document.querySelector('#description'))
    .then(editor => {
        description = editor;
    })
    .catch(error => {
        console.error(error);
    });



function add_company_review() {
    let title = get_value("name", "Company name can't be empty"),
        slug = get_value("slug", "Slug can't be empty"),
        text = description.getData(),
        seo = get_value("meta-tags"),
        phone = get_value("phone"),
        star = get_value("star", "Star can't be empty"),
        addr1 = get_value("addr1", "Address can't be empty"),
        addr2 = get_value("addr2"),
        mc = get_value("mc"),
        us_dot = get_value("us_dot")


    if (title && slug && text != "" && star && addr1) {
        $.post(server.add_company_review(), {
            name: title,
            slug: slug,
            text: text,
            seo: seo,
            phone: phone,
            star: star,
            addr1: addr1,
            addr2: addr2,
            mc: mc,
            us_dot: us_dot


        }, function(data) {
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