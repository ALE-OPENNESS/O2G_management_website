/*var api = "/api/rest/";
var server = "o2g-instance1.ale-aapp.com";
var version = "1.0";
var http = "https://"

document.getElementById("buttonLogIn").onclick = function () {
    let username = "adminC5"//document.getElementById("username").value;
    //alert(username + " : est mon username");
    let password = "admin@5C5"//document.getElementById("password").value;
    //alert(password + " : est mon password");
    if (!((document.getElementById("url").value) === ""))
        server = document.getElementById("url").value;
    console.log(server + " : est mon url");
    let xhr = new XMLHttpRequest();
    xhr.open("GET", http + server + api  +"authenticate?version=" + version, true);
    xhr.withCredentials = true;
    console.log(username + " et " + password);
    xhr.setRequestHeader ("Authorization", "Basic " + btoa(username + ":" + password));
    
    xhr.onload = function () {
    console.log(xhr.responseText);
    };
    
    xhr.send();
    console.log("status = " + xhr.status);
    xhr.onerror = function () {
        //connected.setStatus(false, "API Server unreachable");
        console.log("erreur");
    };
   // window.location = "https://www.google.com"
}*/

$(document).ready(function() {
    $('select').material_select();
});

///****** Code en JQuery ******\

var api = "/api/rest";
var server = "o2g-instance1.ale-aapp.com";
var version = "1.0";
var https = "https://";

$("#buttonLogIn").on("click", () => {
    let username = "adminC5"//$("#username").val();
    let password = "admin@5C5"//$("#password").val();
    //server = $("#url").val();
    console.log(username + " : est mon login");
    console.log(password + " : est mon mdp");
    console.log(https + server + api  + "/authenticate?version=" + version + " : est mon url");

    /*var authentPromise = new Promise(function(resolve, reject) {
        $.ajax({
            type: "GET",
            url: https + server + api  + "/authenticate?version=" + version,
            //username: username,
            //password: password,
            beforeSend: function(xhr) {
                xhr.setRequestHeader("Authorization", "Basic " + btoa(username + ":" + password));
            },
            //crossOrigin: true,
            success: function (data) {
                console.log("success");
                resolve();
            },
            error: function() {
                console.log("error");
                reject();
            }
        });
    });

    authentPromise.then(function(){
        $.ajax({
            type: "POST",
            //contentType: 'application/json',
            beforeSend: function (xhr) {
                xhr.setRequestHeader ("Content-Type", "application/json");
            },
            data: {applicationName: "username"},
            url: https + server + api + "/" + version + "/sessions",
            crossOrigin: true,
            success: function () {
                console.log("success1")
            },
            error: function() {
                console.log("error1");
            }
        })
        window.location = "/user/create"
    }).catch(function(){
        alert("Wrong password and/or username");
        window.location = "/login";
    });*/

    $.ajax({
        type: "GET",
        url: https + server + api  + "/authenticate?version=" + version,
        beforeSend: function(xhr) {
            xhr.setRequestHeader("Authorization", "Basic " + btoa(username + ":" + password));
        },
        xhrFields: {
            withCredentials: true
        },
        //crossOrigin: true,
        success: function (data) {
            console.log("success athentification");
            console.log(data);
        },
        error: function() {
            console.log("error");
            alert("Bad username and/or password");
        }
    });

    $.ajax({
        type: "POST",
        contentType: 'application/json',
        //beforeSend: function (xhr) {
        //    xhr.setRequestHeader ("Content-Type", "application/json");
        //},
        data: JSON.stringify({"applicationName" : username}),
        url: https + server + api + "/" + version + "/sessions",
        xhrFields: {
            withCredentials: true
        },
        crossOrigin: true,
        success: function () {
            console.log("success1")
            //window.location = "/user/create"
        },
        error: function() {
            console.log("error1");
        }
    })
}); 

//\****************************/

$("#buttonCreate").on("click", () => {
    console.log("button create pressed")
    var nodeiD = "407";
    var phoneNumber = "19988";//($("#phoneNumber").val()).match(/\S+/g) || [];
    var lastName = "Samaras";//($("#lastName").val()).match(/\S+/g) || [];
    var firstName = "Ken";//($("#firstName").val()).match(/\S+/g) || [];
    var stationType = "SIP_Extension";//$("#stationType").val();//"SIP_Extension";
    var clickAndPh = "A4980_Pro";
    var costName = "adminC5";//($("#costName").val()).match(/\S+/g) || [];//"adminC5"
    var costId = "104";//$("#costId").val()//"104";

    /*var tabJson = '{ "attributes" : [ ' + 
                '{ "name": "Directory_number", "value": ["' + phoneNumber + '"]},' + 
                '{"name": "Annu_Name", "value": ["' + lastName[0] + '"]},' + 
                '{"name": "Annu_First_Name", "value": ["' + firstName[0] + '"]},' + 
                '{"name": "Station_Type", "value": ["' + stationType + '"]},' +
                '{"name": "ClickAndPh", "value": ["' + clickAndPh + '"]},' +
                '{"name": "Cost_Center_Name", "value": ["' + costName[0] + '"]},' +
                '{"name": "Cost_Center_Id", "value": ["' + costId + '"]}' +
                ']}';*/
    
    //console.log("tabjson = " + tabJson);
    /*console.log("phone = " + phoneNumber);
    console.log("lastname = " + lastName[0]);
    console.log("firstname = " + firstName[0]);
    console.log("station type = " + stationType);
    console.log("coste id = " + costId);
    console.log("coste name = " + costName[0]);*/
    
    if (stationType == 1)
        stationType = "SIP_Extension";
    else if (stationType == 2)
        stationType ="ANALOG";
    else if (stationType == 3)
        stationType = "NOE_C_COLOR_IP_8068";
    else;

    console.log("station type = " + stationType);

    var arrayValues = ['{"name": "Directory_number", "value": ["' + phoneNumber + '"]}', '{"name": "Annu_Name", "value": ["' + lastName[0] + '"]},', '{"name": "Annu_First_Name", "value": ["' + firstName[0] + '"]},', '{"name": "Station_Type", "value": ["' + stationType + '"]},', '{"name": "ClickAndPh", "value": ["' + clickAndPh + '"]},', '{"name": "Cost_Center_Name", "value": ["' + costName[0] + '"]},', '{"name": "Cost_Center_Id", "value": ["' + costId + '"]}'];

    $.ajax({
        type: "GET",
        url: https + server + api + "/" + version + "/sessions",
        success: function (data) {
            console.log("success get sessions");
        },
        error: function() {
            console.log("error get sessions");
        }
    })

    $.ajax({
        type: "GET",
        url: https + server + api + '/' + version + "/pbxs",
        success: function (data) {
            console.log("success and data = " + data);
            console.log(data);
            nodeiD = (Object.values(data))[0];
            //nodeiD = nodeiD[0]
            console.log(nodeiD);

        },
        error: function() {
            console.log("error get pbx nodeiD");
        }
    })

    console.log("phone = " + phoneNumber);
    console.log("lastname = " + lastName);
    console.log("firstname = " + firstName);
    console.log("station type = " + stationType);
    console.log("coste id = " + costId);
    console.log("coste name = " + costName);

    $.ajax({
        type: "POST",
        contentType: 'application/json',
        url: https + server + api + "/" + version + "/pbxs/" + nodeiD + "/instances/Subscriber",
        //data: tabJson,
        data: JSON.stringify({"attribute" : arrayValues}),
        crossOrigin: true,
        success: function () {
            console.log("success post user")
        },
        error: function() {
            console.log("error post user");
        }
    })
});

$("#buttonLogOutTTTT").on("click", () => {
    console.log("button pressed");
    $.ajax({
        type: "DELETE",
        url: https + server + api + "/" + version + "/sessions",
        xhrFields: {
            withCredentials: true
        },
        crossOrigin: true,
        success: function () {
            console.log("success log out")
            //window.location = "/login"
        },
        error: function() {
            console.log("error log out");
        }
    })
});

M.toast({html: 'I am a toast!', classes: 'rounded'});