// Admin Verification
function adminVerification() {
    var adInput = document.getElementById("adInput");

    var f = new FormData();
    f.append("input", adInput.value);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "Success") {
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

    r.open("POST", "adminVerificationProcess.php", true);
    r.send(f);
}

function verify() {
    var verification = document.getElementById("advcode");

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "success") {
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

    r.open("GET", "verificationProcess.php?v=" + verification.value, true);
    r.send();
}

function adminSignout() {

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

function studentView(p) {

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            document.getElementById("studentView").innerHTML = t;
        }
    }

    r.open("GET", "studentView.php?page=" + p, true);
    r.send();

}

function studentSearch(x) {
    var txt = document.getElementById("stu_search");

    var f = new FormData();
    f.append("t", txt.value);
    f.append("page", x);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            document.getElementById("studentView").innerHTML = t;
        }
    }

    r.open("POST", "studentSearchProcess.php", true);
    r.send(f);
}

function changeStudentImg1() {
    var view = document.getElementById("stuViewImg");
    var file = document.getElementById("stu_img1");

    file.onchange = function () {
        var file1 = this.files[0];
        var url = window.URL.createObjectURL(file1);
        view.src = url;
    }
}

function updateStuDetails1() {
    var email = document.getElementById("e1");
    var uname = document.getElementById("un1");
    var fname = document.getElementById("fn1");
    var lname = document.getElementById("ln1");
    var vcode = document.getElementById("vc1");
    var pwd = document.getElementById("p1");
    var bday = document.getElementById("bd1");
    var mobile = document.getElementById("m1");
    var gender = document.getElementById("g1");
    var grade = document.getElementById("gd1");
    var status = document.getElementById("st1");
    var address = document.getElementById("a1");
    var city = document.getElementById("city1");
    var pcode = document.getElementById("ps1");
    var image = document.getElementById("stu_img1");

    var f = new FormData();
    f.append("e", email.value);
    f.append("u", uname.value);
    f.append("fn", fname.value);
    f.append("ln", lname.value);
    f.append("vc", vcode.value);
    f.append("pwd", pwd.value);
    f.append("bday", bday.value);
    f.append("m", mobile.value);
    f.append("gr", gender.value);
    f.append("gd", grade.value);
    f.append("st", status.value);
    f.append("a", address.value);
    f.append("c", city.value);
    f.append("pc", pcode.value);
    f.append("image", image.files[0]);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "Success") {
                document.getElementById("alertmessage").innerHTML = "Student updated successfully";
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

    r.open("POST", "updateStuDetailsProcess.php", true);
    r.send(f);

}

function blockStudent(email){

    var request = new XMLHttpRequest();

    request.onreadystatechange = function (){
        if(request.readyState == 4){
            var txt = request.responseText;
            if(txt == "blocked"){
                document.getElementById("sb"+email).innerHTML = "Unblock";
                document.getElementById("sb"+email).classList = "btn2 blue";
            }else if(txt == "unblocked"){
                document.getElementById("sb"+email).innerHTML = "Block";
                document.getElementById("sb"+email).classList = "btn2 red";
            }else{
                document.getElementById("alertmessage").innerHTML = txt;
                $('#alertmodel').modal();          // initialized with defaults
                $('#alertmodel').modal({ keyboard: false });   // initialized with no keyboard
                $('#alertmodel').modal('show');
            }
            
        }
    }

    request.open("GET","studentBlockProcess.php?email="+email,true);
    request.send();

}

function changeAdminImg() {
    var view = document.getElementById("adminViewImg");
    var file = document.getElementById("admin_img");

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
    var vcode = document.getElementById("vc2");
    var bday = document.getElementById("bd2");
    var mobile = document.getElementById("m2");
    var gender = document.getElementById("g2");
    var address = document.getElementById("a2");
    var city = document.getElementById("city2");
    var pcode = document.getElementById("ps2");
    var image = document.getElementById("admin_img");

    var f = new FormData();
    f.append("e", email.value);
    f.append("u", uname.value);
    f.append("fn", fname.value);
    f.append("ln", lname.value);
    f.append("vc", vcode.value);
    f.append("bday", bday.value);
    f.append("m", mobile.value);
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
                document.getElementById("alertmessage").innerHTML = "Admin updated successfully";
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

function changeadminImg2() {
    var view = document.getElementById("ad2ViewImg");
    var file = document.getElementById("admin2_img");

    file.onchange = function () {
        var file1 = this.files[0];
        var url = window.URL.createObjectURL(file1);
        view.src = url;
    }
}

function loadS3District() {
    var province = document.getElementById("pro3");

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            document.getElementById("dis3").innerHTML = t;
        }
    }

    r.open("GET", "loadS3District.php?p=" + province.value, true);
    r.send();
}

function loadS3City() {
    var district = document.getElementById("dis3");

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            document.getElementById("city3").innerHTML = t;
        }
    }

    r.open("GET", "loadS3City.php?d=" + district.value, true);
    r.send();
}

function updateAdminDetails() {
    var email = document.getElementById("e3");
    var uname = document.getElementById("un3");
    var fname = document.getElementById("fn3");
    var lname = document.getElementById("ln3");
    var vcode = document.getElementById("vc3");
    var bday = document.getElementById("bd3");
    var mobile = document.getElementById("m3");
    var gender = document.getElementById("g3");
    var address = document.getElementById("a3");
    var city = document.getElementById("city3");
    var pcode = document.getElementById("ps3");
    var image = document.getElementById("admin2_img");
    
    var f = new FormData();
    f.append("e", email.value);
    f.append("u", uname.value);
    f.append("fn", fname.value);
    f.append("ln", lname.value);
    f.append("vc", vcode.value);
    f.append("bday", bday.value);
    f.append("m", mobile.value);
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
                document.getElementById("alertmessage").innerHTML = "Admin updated successfully";
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

    r.open("POST", "updateAdminProcess.php", true);
    r.send(f);

}

function adminSearch(x) {
    var txt = document.getElementById("ad_search");

    var f = new FormData();
    f.append("t", txt.value);
    f.append("page", x);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            document.getElementById("adminView").innerHTML = t;
        }
    }

    r.open("POST", "adminSearchProcess.php", true);
    r.send(f);
}

function adminView(p) {

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            document.getElementById("adminView").innerHTML = t;
        }
    }

    r.open("GET", "adminView.php?page=" + p, true);
    r.send();

}

function teacherView(p) {

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            document.getElementById("teacherView").innerHTML = t;
        }
    }

    r.open("GET", "teacherView.php?page=" + p, true);
    r.send();

}

function teacherSearch(x) {
    var txt = document.getElementById("tch_search");

    var f = new FormData();
    f.append("t", txt.value);
    f.append("page", x);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            document.getElementById("teacherView").innerHTML = t;
        }
    }

    r.open("POST", "teacherSearchProcess.php", true);
    r.send(f);
}

function blockTeacher(email){

    var request = new XMLHttpRequest();

    request.onreadystatechange = function (){
        if(request.readyState == 4){
            var txt = request.responseText;
            if(txt == "blocked"){
                document.getElementById("tb"+email).innerHTML = "Unblock";
                document.getElementById("tb"+email).classList = "btn2 blue";
            }else if(txt == "unblocked"){
                document.getElementById("tb"+email).innerHTML = "Block";
                document.getElementById("tb"+email).classList = "btn2 red";
            }else{
                document.getElementById("alertmessage").innerHTML = txt;
                $('#alertmodel').modal();          // initialized with defaults
                $('#alertmodel').modal({ keyboard: false });   // initialized with no keyboard
                $('#alertmodel').modal('show');
            }
            
        }
    }

    request.open("GET","teacherBlockProcess.php?email="+email,true);
    request.send();

}

function changeTeacherImg() {
    var view = document.getElementById("tchViewImg");
    var file = document.getElementById("tch_img");

    file.onchange = function () {
        var file1 = this.files[0];
        var url = window.URL.createObjectURL(file1);
        view.src = url;
    }
}

function loadS4District() {
    var province = document.getElementById("pro4");

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            document.getElementById("dis4").innerHTML = t;
        }
    }

    r.open("GET", "loadS4District.php?p=" + province.value, true);
    r.send();
}

function loadS4City() {
    var district = document.getElementById("dis4");

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            document.getElementById("city4").innerHTML = t;
        }
    }

    r.open("GET", "loadS4City.php?d=" + district.value, true);
    r.send();
}

function updateTchDetails() {
    var email = document.getElementById("e4");
    var uname = document.getElementById("un4");
    var fname = document.getElementById("fn4");
    var lname = document.getElementById("ln4");
    var vcode = document.getElementById("vc4");
    var pwd = document.getElementById("p4");
    var bday = document.getElementById("bd4");
    var mobile = document.getElementById("m4");
    var gender = document.getElementById("g4");
    var subject = document.getElementById("sj");
    var status = document.getElementById("st4");
    var address = document.getElementById("a4");
    var city = document.getElementById("city4");
    var pcode = document.getElementById("ps4");
    var image = document.getElementById("tch_img");

    var f = new FormData();
    f.append("e", email.value);
    f.append("u", uname.value);
    f.append("fn", fname.value);
    f.append("ln", lname.value);
    f.append("vc", vcode.value);
    f.append("pwd", pwd.value);
    f.append("bday", bday.value);
    f.append("m", mobile.value);
    f.append("gr", gender.value);
    f.append("sj", subject.value);
    f.append("st", status.value);
    f.append("a", address.value);
    f.append("c", city.value);
    f.append("pc", pcode.value);
    f.append("image", image.files[0]);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "Success") {
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

    r.open("POST", "updateTchDetailsProcess.php", true);
    r.send(f);

}

function blockOfficer(email){

    var request = new XMLHttpRequest();

    request.onreadystatechange = function (){
        if(request.readyState == 4){
            var txt = request.responseText;
            if(txt == "blocked"){
                document.getElementById("ob"+email).innerHTML = "Unblock";
                document.getElementById("ob"+email).classList = "btn2 blue";
            }else if(txt == "unblocked"){
                document.getElementById("ob"+email).innerHTML = "Block";
                document.getElementById("ob"+email).classList = "btn2 red";
            }else{
                document.getElementById("alertmessage").innerHTML = txt;
                $('#alertmodel').modal();          // initialized with defaults
                $('#alertmodel').modal({ keyboard: false });   // initialized with no keyboard
                $('#alertmodel').modal('show');
            }
            
        }
    }

    request.open("GET","officerBlockProcess.php?email="+email,true);
    request.send();

}

function officerView(p) {

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            document.getElementById("officerView").innerHTML = t;
        }
    }

    r.open("GET", "officerView.php?page=" + p, true);
    r.send();

}

function officerSearch(x) {
    var txt = document.getElementById("aof_search");

    var f = new FormData();
    f.append("t", txt.value);
    f.append("page", x);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            document.getElementById("officerView").innerHTML = t;
        }
    }

    r.open("POST", "officerSearchProcess.php", true);
    r.send(f);
}

function sendTchInvite() {
    var t_email = document.getElementById("ti_e");
    var t_username = document.getElementById("ti_u");
    var t_password = document.getElementById("ti_p");

    var f = new FormData();
    f.append("e", t_email.value);
    f.append("u", t_username.value);
    f.append("p", t_password.value);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "Success") {
                document.getElementById("alertmessage").innerHTML = "Invitation send successfully";
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

    r.open("POST", "sendTchInvitation.php", true);
    r.send(f);
}

function changeOfficerImg() {
    var view = document.getElementById("acoViewImg");
    var file = document.getElementById("aco_img");

    file.onchange = function () {
        var file1 = this.files[0];
        var url = window.URL.createObjectURL(file1);
        view.src = url;
    }
}

function loadS5District() {
    var province = document.getElementById("pro5");

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            document.getElementById("dis5").innerHTML = t;
        }
    }

    r.open("GET", "loadS5District.php?p=" + province.value, true);
    r.send();
}

function loadS5City() {
    var district = document.getElementById("dis5");

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            document.getElementById("city5").innerHTML = t;
        }
    }

    r.open("GET", "loadS5City.php?d=" + district.value, true);
    r.send();
}

function updateAcoDetails() {
    var email = document.getElementById("e5");
    var uname = document.getElementById("un5");
    var fname = document.getElementById("fn5");
    var lname = document.getElementById("ln5");
    var vcode = document.getElementById("vc5");
    var pwd = document.getElementById("p5");
    var bday = document.getElementById("bd5");
    var mobile = document.getElementById("m5");
    var gender = document.getElementById("g5");
    var status = document.getElementById("st5");
    var address = document.getElementById("a5");
    var city = document.getElementById("city5");
    var pcode = document.getElementById("ps5");
    var image = document.getElementById("aco_img");

    var f = new FormData();
    f.append("e", email.value);
    f.append("u", uname.value);
    f.append("fn", fname.value);
    f.append("ln", lname.value);
    f.append("vc", vcode.value);
    f.append("pwd", pwd.value);
    f.append("bday", bday.value);
    f.append("m", mobile.value);
    f.append("gr", gender.value);
    f.append("st", status.value);
    f.append("a", address.value);
    f.append("c", city.value);
    f.append("pc", pcode.value);
    f.append("image", image.files[0]);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "Success") {
                document.getElementById("alertmessage").innerHTML = "Academic Officer updated successfully";
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

    r.open("POST", "updateAcoDetailsProcess.php", true);
    r.send(f);

}

function sendOfficerInvite() {
    var o_email = document.getElementById("oi_e");
    var o_username = document.getElementById("oi_u");
    var o_password = document.getElementById("oi_p");

    var f = new FormData();
    f.append("e", o_email.value);
    f.append("u", o_username.value);
    f.append("p", o_password.value);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "Success") {
                document.getElementById("alertmessage").innerHTML = "Invitation send successfully";
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

    r.open("POST", "sendOfficerInvitation.php", true);
    r.send(f);
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