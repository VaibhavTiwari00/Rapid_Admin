ClassicEditor.create(document.querySelector("#description"), {
  licenseKey: "",
  link: {
    decorators: {
      isExternal: {
        mode: 'manual',
        label: 'Open in a new tab',
        attributes: {
          target: '_blank'
        }
      }
    }
  }
})
  .then((editor) => {
    window.editor = editor;
  })
  .catch((error) => {
    console.error("Oops, something went wrong!");
    console.error(
      "Please, report the following error on https://github.com/ckeditor/ckeditor5/issues with the build id and the error stack trace:"
    );
    console.warn("Build id: rmhkejpaumo9-nohdljl880ze");
    console.error(error);
  });

function getFormData(object) {
  let form_data = new FormData();

  for (let key in object) {
    form_data.append(key, object[key]);
  }

  return form_data;
}

function update_state() {
  let stateform = get_value("state-form", "State name can't be empty"),
    stateto = get_value("state-to", "State name can't be empty"),
    slug = get_value("slug", "Slug can't be empty"),
    title = get_value("title", "Title can't be empty"),
    h1 = get_value("page-h1", "Page-h1 can't be empty"),
    h2 = get_value("page-h2"),
    about1 = get_value("about-1"),
    about2 = get_value("about-2"),
    seo = get_value("meta-tags"),
    rating = get_value("rating", "Route-rating can't be empty"),
    distance = get_value("distance", "Distance can't be empty"),
    days = get_value("days", "Days can't be empty"),
    id = get_value("id"),
    state_form_img_alt = get_value(
      "state-form-img-alt",
      "Alt atribute can't be empty"
    ),
    state_to_img_alt = get_value(
      "state-to-img-alt",
      "Alt atribute can't be empty"
    );

  let display_img_form = document.getElementById("state-form-img");
  display_img_form =
    display_img_form.files.length > 0 ? display_img_form.files[0] : false;
  let display_img_to = document.getElementById("state-to-img");
  display_img_to =
    display_img_to.files.length > 0 ? display_img_to.files[0] : false;

  let add_product_form_data = new FormData();
  add_product_form_data.append("display_img_form", display_img_form);
  add_product_form_data.append("display_img_to", display_img_to);

  if (
    title &&
    slug &&
    h1 &&
    rating &&
    distance &&
    days &&
    stateform &&
    stateto &&
    state_form_img_alt &&
    state_to_img_alt
  ) {
    fetch(server.update_state(), {
      method: "POST",
      body: getFormData({
        stateform: stateform,
        stateto: stateto,
        slug: slug,
        title: title,
        h1: h1,
        h2: h2,
        id: id,
        about1: about1,
        about2: about2,
        seo: seo,
        rating: rating,
        distance: distance,
        days: days,
        state_form_img_alt: state_form_img_alt,
        state_to_img_alt: state_to_img_alt,
        content: JSON.stringify(note),
        img1: display_img_form,
        img2: display_img_to,
      }),
    })
      .then((result) => result.text())
      .then((res) => {
        console.log(res);
        toast.success("Page Created Successfully");
      });
  } else {
    toast.error("Fill all data");
  }
}
