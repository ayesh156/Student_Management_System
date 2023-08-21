// Student Verification
function stuVerification() {
    var uname = document.getElementById("s_uname");
    var pwd = document.getElementById("s_pwd");

    var f = new FormData();
    f.append("uname", uname.value);
    f.append("pwd", pwd.value);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "pay") {
                $('#epaymentModal').modal();          // initialized with defaults
                $('#epaymentModal').modal({ keyboard: false });   // initialized with no keyboard
                $('#epaymentModal').modal('show');
            } else if (t == "Verified") {
                window.location = "home.php";
            } else if (t == "notVerified") {
                $('#verificationModal').modal();          // initialized with defaults
                $('#verificationModal').modal({ keyboard: false });   // initialized with no keyboard
                $('#verificationModal').modal('show');
            } else {
                document.getElementById("alertmessage").innerHTML = t;
                $('#alertmodel').modal();          // initialized with defaults
                $('#alertmodel').modal({ keyboard: false });   // initialized with no keyboard
                $('#alertmodel').modal('show');
            }
        }
    }

    r.open("POST", "stuVerification.php", true);
    r.send(f);
}

function enPayNow() {
    var uname = document.getElementById("un3");
    var password = document.getElementById("p3");

    var f = new FormData();
    f.append("e", uname.value);
    f.append("p", password.value);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;

            if (t == '1') {
                document.getElementById("alertmessage").innerHTML = "Please Enter User name";
                $('#alertmodel').modal();          // initialized with defaults
                $('#alertmodel').modal({ keyboard: false });   // initialized with no keyboard
                $('#alertmodel').modal('show');
            } else if (t == '2') {
                document.getElementById("alertmessage").innerHTML = "Please Enter Password";
                $('#alertmodel').modal();          // initialized with defaults
                $('#alertmodel').modal({ keyboard: false });   // initialized with no keyboard
                $('#alertmodel').modal('show');
            } else if (t == '3') {
                document.getElementById("alertmessage").innerHTML = "Invalid Username or Password";
                $('#alertmodel').modal();          // initialized with defaults
                $('#alertmodel').modal({ keyboard: false });   // initialized with no keyboard
                $('#alertmodel').modal('show');
            } else {

                var obj = JSON.parse(t);

                var mail = obj["mail"];
                var oid = obj["id"];
                var amount = obj["amount"];

                // Payment completed. It can be a successful failure.
                payhere.onCompleted = function onCompleted(orderId) {
                    console.log("Payment completed. OrderID:" + orderId);

                    saveEnInvoice(oid, mail, amount);
                    // Note: validate the payment and show success or failure page to the customer
                };

                // Payment window closed
                payhere.onDismissed = function onDismissed() {
                    // Note: Prompt user to pay again or show an error page
                    console.log("Payment dismissed");
                };

                // Error occurred
                payhere.onError = function onError(error) {
                    // Note: show an error page
                    console.log("Error:" + error);
                    document.getElementById("alertmessage").innerHTML = error;
                    $('#alertmodel').modal();          // initialized with defaults
                    $('#alertmodel').modal({ keyboard: false });   // initialized with no keyboard
                    $('#alertmodel').modal('show');
                };

                // Put the payment variables here
                var payment = {
                    "sandbox": true,
                    "merchant_id": "1221178",    // Replace your Merchant ID
                    "return_url": "http://localhost/Student_Management_System/student/index.php",     // Important
                    "cancel_url": "http://localhost/Student_Management_System/student/index.php",     // Important
                    "notify_url": "http://sample.com/notify",
                    "order_id": obj["id"],
                    "items": obj["item"],
                    "amount": amount,
                    "currency": "LKR",
                    "hash": obj["hash"],
                    "first_name": obj["fname"],
                    "last_name": obj["lname"],
                    "email": mail,
                    "phone": obj["mobile"],
                    "address": obj["address"],
                    "city": obj["city"],
                    "country": "Sri Lanka",
                    "delivery_address": obj["address"],
                    "delivery_city": obj["city"],
                    "delivery_country": "Sri Lanka",
                    "custom_1": "",
                    "custom_2": ""
                };

                // Show the payhere.js popup, when "PayHere Pay" is clicked
                // document.getElementById('payhere-payment').onclick = function (e) {
                payhere.startPayment(payment);
                // };

            }

        }
    }

    r.open("POST", "enPayNowProcess.php", true);
    r.send(f);
}

function saveEnInvoice(oid, mail, amount) {

    var f = new FormData();
    f.append("m", mail);
    f.append("a", amount);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "Success") {
                window.location = "enInvoice.php?a=" + amount + "&oid=" + oid;
            } else {
                document.getElementById("alertmessage").innerHTML = t;
                $('#alertmodel').modal();          // initialized with defaults
                $('#alertmodel').modal({ keyboard: false });   // initialized with no keyboard
                $('#alertmodel').modal('show');
            }
        }
    }

    r.open("POST", "saveEnInvoice.php", true);
    r.send(f);
}

function verify() {
    var uname = document.getElementById("s_uname");
    var verification = document.getElementById("svcode");

    var f = new FormData();
    f.append("uname", uname.value);
    f.append("v", verification.value);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "Success") {
                $('#alertmodel').modal();          // initialized with defaults
                $('#alertmodel').modal({ keyboard: false });   // initialized with no keyboard
                $('#alertmodel').modal('hide');
                window.location = "home.php";
            } else {
                document.getElementById("alertmessage").innerHTML = t;
                $('#alertmodel').modal();          // initialized with defaults
                $('#alertmodel').modal({ keyboard: false });   // initialized with no keyboard
                $('#alertmodel').modal('show');
            }
        }
    }

    r.open("POST", "verifyProcess.php", true);
    r.send(f);
}

function stuSignout() {

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "success") {
                window.location = "index.php";
            } else {
                document.getElementById("alertmessage").innerHTML = t;
                $('#alertmodel').modal();          // initialized with defaults
                $('#alertmodel').modal({ keyboard: false });   // initialized with no keyboard
                $('#alertmodel').modal('show');
            }
        }
    }

    r.open("GET", "logouts.php", true)
    r.send();

}

function changeStuImg() {
    var view = document.getElementById("stuViewImg");
    var file = document.getElementById("stu_img");

    file.onchange = function () {
        var file1 = this.files[0];
        var url = window.URL.createObjectURL(file1);
        view.src = url;
    }
}

function loadSDistrict() {
    var province = document.getElementById("pro1");

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            document.getElementById("dis1").innerHTML = t;
        }
    }

    r.open("GET", "loadSDistrict.php?p=" + province.value, true);
    r.send();
}

function loadSCity() {
    var district = document.getElementById("dis1");

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            document.getElementById("city1").innerHTML = t;
        }
    }

    r.open("GET", "loadSCity.php?d=" + district.value, true);
    r.send();
}

function updateProfile() {
    var email = document.getElementById("e1");
    var uname = document.getElementById("un1");
    var fname = document.getElementById("fn1");
    var lname = document.getElementById("ln1");
    var bday = document.getElementById("bd1");
    var mobile = document.getElementById("m1");
    var password = document.getElementById("p1");
    var gender = document.getElementById("g1");
    var grade = document.getElementById("gd1");
    var address = document.getElementById("a1");
    var city = document.getElementById("city1");
    var pcode = document.getElementById("ps1");
    var image = document.getElementById("stu_img");

    var f = new FormData();
    f.append("e", email.value);
    f.append("u", uname.value);
    f.append("fn", fname.value);
    f.append("ln", lname.value);
    f.append("bday", bday.value);
    f.append("m", mobile.value);
    f.append("p", password.value)
    f.append("gr", gender.value);
    f.append("gd", grade.value);
    f.append("a", address.value);
    f.append("c", city.value);
    f.append("pc", pcode.value);
    f.append("image", image.files[0]);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;

            if (t == "pay") {
                $('#paymentModal').modal();          // initialized with defaults
                $('#paymentModal').modal({ keyboard: false });   // initialized with no keyboard
                $('#paymentModal').modal('show');
            } else if (t == "Success") {
                document.getElementById("alertmessage").innerHTML = "Teacher updated successfully";
                $('#alertmodel').modal();          // initialized with defaults
                $('#alertmodel').modal({ keyboard: false });   // initialized with no keyboard
                $('#alertmodel').modal('show');
            } else {
                document.getElementById("alertmessage").innerHTML = t;
                $('#alertmodel').modal();          // initialized with defaults
                $('#alertmodel').modal({ keyboard: false });   // initialized with no keyboard
                $('#alertmodel').modal('show');
            }
        }
    }

    r.open("POST", "updateProfileProcess.php", true);
    r.send(f);

}

function payNow() {
    var uname = document.getElementById("un2");
    var password = document.getElementById("p2");
    var grade = document.getElementById("gd2");

    var f = new FormData();
    f.append("e", uname.value);
    f.append("p", password.value);
    f.append("g", grade.value);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;

            if (t == '1') {
                document.getElementById("alertmessage").innerHTML = "Please Enter User name";
                $('#alertmodel').modal();          // initialized with defaults
                $('#alertmodel').modal({ keyboard: false });   // initialized with no keyboard
                $('#alertmodel').modal('show');
            } else if (t == '2') {
                document.getElementById("alertmessage").innerHTML = "Please Enter Password";
                $('#alertmodel').modal();          // initialized with defaults
                $('#alertmodel').modal({ keyboard: false });   // initialized with no keyboard
                $('#alertmodel').modal('show');
            } else if (t == '3') {
                document.getElementById("alertmessage").innerHTML = "Invalid Username or Password";
                $('#alertmodel').modal();          // initialized with defaults
                $('#alertmodel').modal({ keyboard: false });   // initialized with no keyboard
                $('#alertmodel').modal('show');
            } else {

                var obj = JSON.parse(t);

                var mail = obj["mail"];
                var oid = obj["id"];
                var amount = obj["amount"];
                var gid = grade.value;

                // Payment completed. It can be a successful failure.
                payhere.onCompleted = function onCompleted(orderId) {
                    console.log("Payment completed. OrderID:" + orderId);

                    saveInvoice(oid, mail, amount, gid);
                    // Note: validate the payment and show success or failure page to the customer
                };

                // Payment window closed
                payhere.onDismissed = function onDismissed() {
                    // Note: Prompt user to pay again or show an error page
                    console.log("Payment dismissed");
                };

                // Error occurred
                payhere.onError = function onError(error) {
                    // Note: show an error page
                    console.log("Error:" + error);
                    document.getElementById("alertmessage").innerHTML = error;
                    $('#alertmodel').modal();          // initialized with defaults
                    $('#alertmodel').modal({ keyboard: false });   // initialized with no keyboard
                    $('#alertmodel').modal('show');
                };

                // Put the payment variables here
                var payment = {
                    "sandbox": true,
                    "merchant_id": "1221178",    // Replace your Merchant ID
                    "return_url": "http://localhost/eshop/Student_Management_System/student/profile.php",     // Important
                    "cancel_url": "http://localhost/eshop/Student_Management_System/student/profile.php",     // Important
                    "notify_url": "http://sample.com/notify",
                    "order_id": obj["id"],
                    "items": obj["item"],
                    "amount": amount,
                    "currency": "LKR",
                    "hash": obj["hash"],
                    "first_name": obj["fname"],
                    "last_name": obj["lname"],
                    "email": mail,
                    "phone": obj["mobile"],
                    "address": obj["address"],
                    "city": obj["city"],
                    "country": "Sri Lanka",
                    "delivery_address": obj["address"],
                    "delivery_city": obj["city"],
                    "delivery_country": "Sri Lanka",
                    "custom_1": "",
                    "custom_2": ""
                };

                // Show the payhere.js popup, when "PayHere Pay" is clicked
                // document.getElementById('payhere-payment').onclick = function (e) {
                payhere.startPayment(payment);
                // };

            }

        }
    }

    r.open("POST", "payNowProcess.php", true);
    r.send(f);
}

function saveInvoice(oid, mail, amount, gid) {

    var f = new FormData();
    f.append("m", mail);
    f.append("a", amount);
    f.append("g", gid);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "Success") {
                window.location = "invoice.php?a=" + amount + "&gid=" + gid + "&oid=" + oid;
            } else {
                document.getElementById("alertmessage").innerHTML = t;
                $('#alertmodel').modal();          // initialized with defaults
                $('#alertmodel').modal({ keyboard: false });   // initialized with no keyboard
                $('#alertmodel').modal('show');
            }
        }
    }

    r.open("POST", "saveInvoice.php", true);
    r.send(f);
}

function printInvoice() {
    var body = document.body.innerHTML;
    var page = document.getElementById("page").innerHTML;

    document.body.innerHTML = "<html><head><title></title></head><body>" +
        page + "</body>";
    window.print();
    document.body.innerHTML = body;
}

var answerid;
function uploadAnsModal(id) {
    $('#uploadAnsModal').modal();          // initialized with defaults
    $('#uploadAnsModal').modal({ keyboard: false });   // initialized with no keyboard
    $('#uploadAnsModal').modal('show');
    answerid = id;
}

function uploadAnswerFile() {
    var view = document.getElementById("aswFileName");
    var file = document.getElementById("aswFile");

    file.onchange = function () {
        var url = this.files[0].name;
        view.innerHTML = url;
    }
}

function uploadAnswer() {
    var answer = document.getElementById("aswFile");

    var f = new FormData();
    f.append("aid", answerid);
    f.append("answer", answer.files[0]);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "Success") {
                document.getElementById("alertmessage").innerHTML = "Answer successfully uploaded";
                $('#alertmodel').modal();          // initialized with defaults
                $('#alertmodel').modal({ keyboard: false });   // initialized with no keyboard
                $('#alertmodel').modal('show');

                $('#uploadAnsModal').modal();          // initialized with defaults
                $('#uploadAnsModal').modal({ keyboard: false });   // initialized with no keyboard
                $('#uploadAnsModal').modal('hide');
            } else {
                document.getElementById("alertmessage").innerHTML = t;
                $('#alertmodel').modal();          // initialized with defaults
                $('#alertmodel').modal({ keyboard: false });   // initialized with no keyboard
                $('#alertmodel').modal('show');
            }
        }
    }

    r.open("POST", "uploadAnswerProcess.php", true);
    r.send(f);

}

function assignmentView(p) {

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            document.getElementById("assignmentView").innerHTML = t;
        }
    }

    r.open("GET", "assignmentView.php?page=" + p, true);
    r.send();

}

function assignmentSearch(x) {
    var txt = document.getElementById("assingn_search");

    var f = new FormData();
    f.append("t", txt.value);
    f.append("page", x);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            document.getElementById("assignmentView").innerHTML = t;
        }
    }

    r.open("POST", "assignmentSearchProcess.php", true);
    r.send(f);
    
}

function noteView(p) {

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            document.getElementById("noteView").innerHTML = t;
        }
    }

    r.open("GET", "noteView.php?page=" + p, true);
    r.send();
}

function noteSearch(x) {
    var txt = document.getElementById("note_search");

    var f = new FormData();
    f.append("t", txt.value);
    f.append("page", x);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            document.getElementById("noteView").innerHTML = t;
        }
    }

    r.open("POST", "noteSearchProcess.php", true);
    r.send(f);
    
}