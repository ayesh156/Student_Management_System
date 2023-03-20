// Teacher Verification
function tchVerification() {
    var uname = document.getElementById("t_uname");
    var pwd = document.getElementById("t_pwd");

    var f = new FormData();
    f.append("uname", uname.value);
    f.append("pwd", pwd.value);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "Verified") {
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

    r.open("POST", "tchVerification.php", true);
    r.send(f);
}

function verify() {
    var uname = document.getElementById("t_uname");
    var verification = document.getElementById("tvcode");

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

function tchSignout() {

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

function changeTchImg() {
    var view = document.getElementById("tchViewImg");
    var file = document.getElementById("tch_img");

    file.onchange = function () {
        var file1 = this.files[0];
        var url = window.URL.createObjectURL(file1);
        view.src = url;
    }
}

function loadTDistrict() {
    var province = document.getElementById("pro1");

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            document.getElementById("dis1").innerHTML = t;
        }
    }

    r.open("GET", "loadTDistrict.php?p=" + province.value, true);
    r.send();
}

function loadTCity() {
    var district = document.getElementById("dis1");

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            document.getElementById("city1").innerHTML = t;
        }
    }

    r.open("GET", "loadTCity.php?d=" + district.value, true);
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
    var address = document.getElementById("a1");
    var city = document.getElementById("city1");
    var pcode = document.getElementById("ps1");
    var image = document.getElementById("tch_img");

    var f = new FormData();
    f.append("e", email.value);
    f.append("u", uname.value);
    f.append("fn", fname.value);
    f.append("ln", lname.value);
    f.append("bday", bday.value);
    f.append("m", mobile.value);
    f.append("p", password.value);
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

function uploadNote() {
    var view = document.getElementById("fileName");
    var file = document.getElementById("noteFile");

    file.onchange = function () {
        var url = this.files[0].name;
        view.innerHTML = url;
    }
}

function addLessonNote() {
    var subject = document.getElementById("sub");
    var grade = document.getElementById("g2");
    var lesson = document.getElementById("les_name");
    var description = document.getElementById("desc");
    var note = document.getElementById("noteFile");

    var f = new FormData();
    f.append("sj", subject.value);
    f.append("gd", grade.value);
    f.append("ls", lesson.value);
    f.append("desc", description.value);
    f.append("note", note.files[0]);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "Success") {
                document.getElementById("alertmessage").innerHTML = "Note successfully uploaded";
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

    r.open("POST", "uploadNoteProcess.php", true);
    r.send(f);

}

function uploadAssignment() {
    var view = document.getElementById("assFileName");
    var file = document.getElementById("assFile");

    file.onchange = function () {
        var url = this.files[0].name;
        view.innerHTML = url;
    }
}


function addAssignment() {
    var subject = document.getElementById("sub2");
    var grade = document.getElementById("g3");
    var ass_name = document.getElementById("ass_name");
    var description = document.getElementById("ass_desc");
    var assign = document.getElementById("assFile");

    var f = new FormData();
    f.append("sj", subject.value);
    f.append("gd", grade.value);
    f.append("ass_name", ass_name.value);
    f.append("desc", description.value);
    f.append("assign", assign.files[0]);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "Success") {
                document.getElementById("alertmessage").innerHTML = "Assignment successfully uploaded";
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

    r.open("POST", "uploadAssignmentProcess.php", true);
    r.send(f);

}

function addMark(email,sasid){

    var amark = document.getElementById("amark"+email+sasid);

    var f = new FormData();
    f.append("email", email);
    f.append("sasid", sasid);
    f.append("amark", amark.value);

    var request = new XMLHttpRequest();

    request.onreadystatechange = function (){
        if(request.readyState == 4){
            var txt = request.responseText;
            if(txt == "Success"){
                document.getElementById("alertmessage").innerHTML = "Marks successfully added";
                $('#alertmodel').modal();          // initialized with defaults
                $('#alertmodel').modal({ keyboard: false });   // initialized with no keyboard
                $('#alertmodel').modal('show');
            }else{
                document.getElementById("alertmessage").innerHTML = txt;
                $('#alertmodel').modal();          // initialized with defaults
                $('#alertmodel').modal({ keyboard: false });   // initialized with no keyboard
                $('#alertmodel').modal('show');
            }
            
        }
    }

    request.open("POST","addMarkProcess.php",true);
    request.send(f);

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