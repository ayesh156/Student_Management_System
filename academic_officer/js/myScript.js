// Acadamic Officer Verification
function officerVerification() {
    var uname = document.getElementById("ao_uname");
    var pwd = document.getElementById("ao_pwd");

    var f = new FormData();
    f.append("uname", uname.value);
    f.append("pwd", pwd.value);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if(t == "Verified"){
                window.location = "home.php";
            }else if (t == "notVerified") {
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

    r.open("POST", "officerVerification.php", true);
    r.send(f);
}

function verify() {
    var uname = document.getElementById("ao_uname");
    var verification = document.getElementById("aovcode");

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

function officerSignout() {

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

function adminSignout() {

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "success") {
                window.location = "../index.php";
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

function changeStudentImg() {
    var view = document.getElementById("stuViewImg");
    var file = document.getElementById("stu_img");

    file.onchange = function () {
        var file1 = this.files[0];
        var url = window.URL.createObjectURL(file1);
        view.src = url;
    }
}

function addStudent() {
    var email = document.getElementById("e1");
    var uname = document.getElementById("un1");
    var fname = document.getElementById("fn1");
    var lname = document.getElementById("ln1");
    var pwd = document.getElementById("p1");
    var bday = document.getElementById("bd1");
    var mobile = document.getElementById("m1");
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
    f.append("pwd", pwd.value);
    f.append("bday", bday.value);
    f.append("m", mobile.value);
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
            if (t == "Success") {
                document.getElementById("alertmessage").innerHTML = "Student added successfully";
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

    r.open("POST", "addStudentProcess.php", true);
    r.send(f);

}

function sendStuVerification() {
    var email = document.getElementById("e1");
    var uname = document.getElementById("un1");
    var password = document.getElementById("p1");

    var f = new FormData();
    f.append("e", email.value);
    f.append("u", uname.value);
    f.append("p", password.value);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "Success") {
                document.getElementById("alertmessage").innerHTML = "Verification send successfully";
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

    r.open("POST", "sendStuVerification.php", true);
    r.send(f);
}

function changeOfficerImg() {
    var view = document.getElementById("officerViewImg");
    var file = document.getElementById("officer_img");

    file.onchange = function () {
        var file1 = this.files[0];
        var url = window.URL.createObjectURL(file1);
        view.src = url;
    }
}

function loadS2District() {
    var province = document.getElementById("pro2");

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            document.getElementById("dis2").innerHTML = t;
        }
    }

    r.open("GET", "loadS2District.php?p=" + province.value, true);
    r.send();
}

function loadS2City() {
    var district = document.getElementById("dis2");

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            document.getElementById("city2").innerHTML = t;
        }
    }

    r.open("GET", "loadS2City.php?d=" + district.value, true);
    r.send();
}

function updateProfile() {
    var email = document.getElementById("e2");
    var uname = document.getElementById("un2");
    var fname = document.getElementById("fn2");
    var lname = document.getElementById("ln2");
    var bday = document.getElementById("bd2");
    var mobile = document.getElementById("m2");
    var password = document.getElementById("p2");
    var gender = document.getElementById("g2");
    var address = document.getElementById("a2");
    var city = document.getElementById("city2");
    var pcode = document.getElementById("ps2");
    var image = document.getElementById("officer_img");

    var f = new FormData();
    f.append("e", email.value);
    f.append("u", uname.value);
    f.append("fn", fname.value);
    f.append("ln", lname.value);
    f.append("bday", bday.value);
    f.append("m", mobile.value);
    f.append("p", password.value)
    f.append("gr", gender.value);
    f.append("a", address.value);
    f.append("c", city.value);
    f.append("pc", pcode.value);
    f.append("image", image.files[0]);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "Success") {
                document.getElementById("alertmessage").innerHTML = "Academic officer updated successfully";
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

function displayResult(email,id){

    var request = new XMLHttpRequest();

    request.onreadystatechange = function (){
        if(request.readyState == 4){
            var txt = request.responseText;
            if(txt == "Release"){
                document.getElementById("rd"+email+id).innerHTML = "Not Release";
                document.getElementById("rd"+email+id).classList = "btn2 red";
            }else if(txt == "notRelease"){
                document.getElementById("rd"+email+id).innerHTML = "Release";
                document.getElementById("rd"+email+id).classList = "btn2 green";
            }else{
                document.getElementById("alertmessage").innerHTML = txt;
                $('#alertmodel').modal();          // initialized with defaults
                $('#alertmodel').modal({ keyboard: false });   // initialized with no keyboard
                $('#alertmodel').modal('show');
            }
            
        }
    }

    request.open("GET","displayResultProcess.php?email="+email+"&aid="+id,true);
    request.send();

}

function resultView(p) {

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            document.getElementById("resultView").innerHTML = t;
        }
    }

    r.open("GET", "resultView.php?page=" + p, true);
    r.send();

}

function resultSearch(x) {
    var txt = document.getElementById("re_search");

    var f = new FormData();
    f.append("t", txt.value);
    f.append("page", x);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            document.getElementById("resultView").innerHTML = t;
        }
    }

    r.open("POST", "resultSearchProcess.php", true);
    r.send(f);
}