var request = require('request');
var http = require('http');

var option = {
    url: 'https://o2g-instance1.ale-aapp.com/api/rest/authenticate?version=1.0',
    auth: {
        username: 'oxe19140',
        password: '0000'
    }
};

http.createServer(function(request, response, option) {
    response.writeHead(200, {"Content-Type": "text/plain"});
    response.write("Hello World");
    function execute(option) {
        request.get(option);
    };
    response.end();
    }).listen(8888);

//request.get(option);

/*var https = require("https");
var fs = reqiore("fs");

var options = {
    hostname: 'https://o2g-instance1.ale-aapp.com/api/rest/authenticate?version=1.0',
    port: 443,
    authenticate: {
        username: 'oxe19140',
        password: '0000'
    },
    method: "GET"
};

var req = https.request(options, function() {

});*/