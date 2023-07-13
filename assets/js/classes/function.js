function validate_name(name) {
    if (name != "") {
        let test_string = /^[A-Za-z\s]+$/ //returns true if matched, vaidates for a-z and A-Z and white space
        if (test_string.test(name)) {
            return true;
        } else {
            return false;
        }

    } else {
        return false;
    }
}


function validate_mail(mail) {
    if (mail != "") {

        let test_string = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/; //returns true if matched, vaidates for a-z and A-Z and white space
        if (test_string.test(mail)) {
            return true;
        } else {
            return false;
        }

    } else {
        return false;
    }
}


function validate_mobile(mobile) {
    if (mobile != "") {
        let test_string = /^(9|8|7|6)[0-9]+$/; //returns true if mobile number start with 
        if (mobile.length == 10 && test_string.test(mobile)) {
            return true;
        } else {
            return false;
        }
    } else {
        return false;
    }
}

function get_value(id, error) {
    let ele = document.getElementById(id);
    if (ele != undefined) {
        let value = ele.value;
        if (value != "") {
            return value;
        } else {
            if (error != undefined) {
                toast.error(error);
                return false;
            } else {
                return '';
            }
        }
    } else {
        return false;
    }
}

function isJsonString(str) {
    try {
        JSON.parse(str);
    } catch (e) {
        return false;
    }
    return true;
}


function reload(now = false) {
    let t = (now) ? now : 2000
    setTimeout(function() {
        window.location.reload()
            // console.log("reload")
    }, t)
}