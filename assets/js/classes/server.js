class server extends link {
  static add_company_review() {
    return link.domain() + "/services/company-review/add";
  }

  static edit_company_review() {
    return link.domain() + "/services/company-review/edit";
  }

  static add_company_user_review() {
    return link.domain() + "/services/company-user-review/add";
  }

  static edit_company_user_review() {
    return link.domain() + "/services/company-user-review/edit";
  }
  static add_state() {
    return link.domain() + "/services/state-to-state/add";
  }
  static update_state() {
    return link.domain() + "/services/state-to-state/edit";
  }


}