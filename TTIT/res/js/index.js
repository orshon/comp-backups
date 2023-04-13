let _class = function(e){
    return document.getElementsByClassName(e);
};
let _id = function(e){
    return document.getElementById(e);
};
function validate(e) {
    var phone = _id("elphone").value;
    var name = _id("elname").value;
    var email = _id("elemail").value;
    var unit = _id("elunit").value;
    var text = _id("eltext").value;
    if (phone !== "") {
        if ((/^\d+$/.test(phone) !== true) || (phone.length < 8 || phone.length > 10)) {
            alert("בבקשה הכניסו מספר טלפון ממספרים בלבד, מעל 8 ספרות");
            return false;
        }
    }
    if (name !== "") {
        if ((name.length > 25 || name.length < 2)) {
            alert("בבקשה הכניסו שם שהוא מעל תו 1 וקצר מ25 תווים.");
            return false;
        }
    }
    if (email !== "") {
        if (/\S+@\S+\.\S+/.test(email) !== true || (email.length > 100 || email.length < 5)) {
            alert("בבקשה הכניסו מייל בפורמט נכון.");
            return false;
        }
    }
    if (unit !== "") {
        if (unit.length > 40) {
            alert("בבקשה הכניסו יחידה שהיא מעל תו 1 וקצרה מ40 תווים.");
            return false;
        }
    }
    if (text === "") {
        alert("אנא רשמו לנו את הרעיון שלכם בתיבת הטקסט המיועדת לכך.");
        return false;
    }
    else if (text.length > 500 || text.length < 2) {
        alert("בבקשה הכניסו טקסט שהוא מעל תו 1 וקצר מ500 תווים.");
        return false;
    }
}
function onSubmit(token) {
    document.getElementById("myform").submit();
}
