<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Log;
use HttpRequest;
use curl;
use Cookie;

session_start();

class LoginController extends Controller
{
    public $credential;

    /*
    ** Check the  status of the response of your query and recirect you in case of failure.
    ** It takes as parameter(the status that response query gives you, the succes status you expect
    ** and the route of the redirection in case of failure).
    */

    function checkStatusRequest($status, $succes_status, $redirect)
    {
        if (strcmp($status, $succes_status) != 0) {
            exit(redirect($redirect));
        }        
    }

    /*
    ** Return the response header of the query "autenticate"
    */

    function getAuthenticateFile()
    {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $_SESSION['username'] = $username;
        $_SESSION['server'] = $_POST['url'];

        $url = 'http://' . $_SESSION['server'] . '/api/rest/authenticate?version=1.0';

        $opts = array(
            'http' => array(
                'method' => "GET",
                'header' => "Authorization: Basic " . base64_encode("$username:$password")
            )
        );
        $context = stream_context_create($opts);
        $header = get_headers($url, 0, $context);
        $this->checkStatusRequest($header[0], "HTTP/1.1 200 OK", "/login");
        $file_credential = file_get_contents($url, false, $context);
        return ($file_credential);
    }

    function getCredential()
    {
    
        $file = $this->getAuthenticateFile();

        $file = json_decode($file);
        $credential = $file->credential;

        if ($credential == "")
            echo ("<script language=\"javascript\"> alert('Something went wrong with the credential, try later'); </script>");
        $this->$credential = $credential;
        return ($credential);
    }

    /*
    ** Check if the user is an administrator. It return true if the user is an administrator
    ** and false if he isn't. This function take the AlcCookie as parameter.
    */

    function isAdmin($credential)
    {
        $url = 'http://' . $_SESSION['server'] . '/api/rest/1.0/sessions';
        $opts = array(
            'http' => array(
                'method' => 'GET',
                'header' => 'Cookie: AlcUserId=' . $credential . "\r\n"
            )
        );

        $context = stream_context_create($opts);
        $file = file_get_contents($url, false, $context);
        $admin = explode(",", explode(':', $file)[1])[0];
        return($admin);
    }

    function postSession($credential)
    {
        $url = 'http://' . $_SESSION['server'] . '/api/rest/1.0/sessions';
        $applicationName = array('applicationName' => 'PBXsManagementTests');

        $opts = array(
            'http' => array(
                'method' => "POST",
                'header' => "Content-type: application/json\r\n" .
                    "Cookie: AlcUserId=" . $credential . "\r\n",
                'content' => json_encode($applicationName)
            )
        );
        $context = stream_context_create($opts);
        $header = get_headers($url, 0, $context);
        $this->checkStatusRequest($header[0], "HTTP/1.1 200 OK", "/login");
    }

    function chooseStationType($stationType)
    {
        if ($stationType == '1')
            $stationType = "SIP_Extension";
        else if ($stationType == '2')
            $stationType ="ANALOG";
        else if ($stationType == '3')
            $stationType = "NOE_C_COLOR_IP_8068";
        else if ($stationType == '4')
            $stationType = "NOE_C_Color_IP";
        else if ($stationType == '5')
            $stationType = "NOE_B_IP_8028s";
        else;

        return ($stationType);
    }

    function getPbxNodeId($credential)
    {
        $url = 'http://' . $_SESSION['server'] . '/api/rest/1.0/pbxs/';
        $opts = array(
            'http' => array(
                'method' => 'GET',
                'header' => 'Cookie: AlcUserId=' . $credential . "\r\n"
            )
        );
        $context = stream_context_create($opts);
        $file = file_get_contents($url, false, $context);
        $nodeIdNumber = (json_decode($file));
        $file = explode('"', $file);
        $_SESSION['nodeId'] = $file[3];
        return($file[3]);
    }

    /*
    ** To user a Deskphone you need to enable this feature
    */

    function enableIpSoftphoneEmulation($credential, $phoneNumber)
    {
        $url = 'http://' . $_SESSION['server'] . '/api/rest/1.0/pbxs/' . $_SESSION['nodeId'] . '/instances/Subscriber/' . $phoneNumber . '/Tsc_IP_subscriber/' . $phoneNumber;

        $userArray = array(
            array('attributes' => array(
                array('name' => 'IP_Softphone_Emul', 'value' => array('Yes')),
            ))
        );
        $prefix = '';
        $content = "";
        foreach($userArray as $row) {
            $content = ($content . $prefix . json_encode($row));
            $prefix = ',';
        }

        $opts = array(
            'http' => array(
                'method' => 'PUT',
                'header' => 'Cookie: AlcUserId=' . $credential . "\r\n" .
                    "Content-type: application/json\r\n",
                'content' => $content
            )
        );
        $context = stream_context_create($opts);
        $header = get_headers($url, 0, $context);
    }

    function pbxPostUser($credential)
    {
        $nodeiD = "407";
        $phoneNumber = $_POST['phoneNumber'];
        $lastName = $_POST["lastName"];
        $firstName = $_POST["firstName"];
        $stationType = $_POST["stationType"];
        $clickAndPh = "A4980_Pro";
        $costId = $_POST["costId"];
        $costName = $_SESSION['username'];
        $stationType = $this->chooseStationType($stationType);        
        $url = 'http://' . $_SESSION['server'] . '/api/rest/1.0/pbxs/' . $_SESSION['nodeId'] . '/instances/Subscriber';

        if ($lastName == "")
            $lastName = "oxe" . $phoneNumber;
        if ($firstName == "")
            $firstName = "oxe" . $phoneNumber;

        $userArray = array(
            array('attributes' => array(
                array('name' => 'Directory_Number', 'value' => array($phoneNumber)),
                array('name' => 'Annu_Name', 'value' => array($lastName)),
                array('name' => 'Annu_First_Name', 'value' => array($firstName)),
                array('name' => 'Station_Type', 'value' => array($stationType)),
                array('name' => 'ClickAndPh', 'value' => array($clickAndPh)),
                array('name' => 'Cost_Center_Name', 'value' => array('adminC5')),
                array('name' => 'Cost_Center_Id', 'value' => array('104')),
            ))
        );

        $prefix = '';
        $newUser = "";
        foreach($userArray as $row) {
            $newUser = ($newUser . $prefix . json_encode($row));
            $prefix = ',';
        }
        print($newUser);

        $opts = array(
            'http' => array(
                'method' => 'POST',
                'header' => 'Cookie: AlcUserId=' . $credential . "\r\n" .
                    "Content-type: application/json\r\n",
                'content' => $newUser
            )
        );
        $context = stream_context_create($opts);
        $header = get_headers($url, 0, $context);
        $_SESSION['header_create'] = $header[0];
        if ($_POST["stationType"] > 2)
            $this->enableIpSoftphoneEmulation($credential, $phoneNumber);
    }

    function alcCookieIsEmpty($credential)
    {
        if ($credential == "")
            return (true);
        else
            return (false);
    }

    /*
    ** Display all users created in the PBX
    */

    function dispPbxUsers()
    {

        $credential = $_SESSION['cookieAlc'];
        $server = 'http://' . $_SESSION['server'] . '/api/rest/1.0/pbxs/' . $_SESSION['nodeId'] . '/instances/Subscriber';

        $opts = array(
            'http' => array(
                'method' => 'GET',
                'header' => 'Cookie: AlcUserId=' . $credential . "\r\n"
            )
        );
        $context = stream_context_create($opts);
        $file = file_get_contents($server, false, $context);
        print(" \n");
        echo nl2br(str_replace(' ', '&nbsp;', (json_encode(json_decode($file), JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES))));
    }

    /*
    ** Display user associate at your personnal administrator account
    */

    function dispYourUsers()
    {
        $credential = $_SESSION['AlcCookie'];
        $server = 'http://' . $_SESSION['server'] . '/api/rest/1.0/logins';
        $opts = array(
            'http' => array(
                'method' => 'GET',
                'header' => 'Cookie: AlcUserId=' . $credential . "\r\n"
            )
        );
        $context = stream_context_create($opts);
        $file = file_get_contents($server, false, $context);
        $file = explode('"', $file);
        $allUsers = "";
        foreach ($file as $key => $value) {
            if ($key % 2 == 1  && $key >= 3) {
                $allUsers = $allUsers . " " . $value;
            }
        }
        $allUsers = explode(' ', $allUsers);
        $_SESSION['users'] = $allUsers;
        return view('create_user_displayed');
    }

    /*
    ** Get all information of a single user.
    ** It take as parameter the username and his index in the array
    */

    function getUserInfo($username, $nb)
    {
        $credential = $_SESSION['AlcCookie'];

        $server = 'http://' . $_SESSION['server'] . '/api/rest/1.0/users/' . $username;

        $opts = array(
            'http' => array(
                'method' => 'GET',
                'header' => 'Cookie: AlcUserId=' . $credential . "\r\n"
            )
        );
        $context = stream_context_create($opts);
        $file = file_get_contents($server, false, $context);
        $file = explode(",", $file);
        $userInfo = array($username => $file);
        $infosUsers[$nb] = $userInfo;
        return ($userInfo);
    }

    /*
    ** Get all information of each users.
    */

    function getAllUsersInfo()
    {
        $i = 0;
        $userInfo = array();
        foreach($_SESSION['users'] as $key => $value) {
            $i += 1;
            if ($key >= 1 || $value != "")
                $userInfo[$_SESSION['users'][$key]]  = $this->getUserInfo($_SESSION['users'][$key], $key);
        }
        $_SESSION['usersInfo'] = $userInfo;
        return;
    }

    /*
    ** Edit firstname and lastname of a user
    */

    function pbxPutUser($credential)
    {
        $phoneNumber = $_POST['phoneNumber'];
        $lastName = $_POST["lastName"];
        $firstName = $_POST["firstName"];

        $url = 'http://' . $_SESSION['server'] . '/api/rest/1.0/pbxs/' . $_SESSION['nodeId'] . '/instances/Subscriber/' . $phoneNumber;

        $userArray = array(
            array('attributes' => array(
                array('name' => 'Annu_Name', 'value' => array($lastName)),
                array('name' => 'Annu_First_Name', 'value' => array($firstName))
            ))
        );

        $prefix = '';
        $newUser = "";
        foreach($userArray as $row) {
            $newUser = ($newUser . $prefix . json_encode($row));
            $prefix = ',';
        }
        print($newUser);

        $opts = array(
            'http' => array(
                'method' => 'PUT',
                'header' => 'Cookie: AlcUserId=' . $credential . "\r\n" .
                    "Content-type: application/json\r\n",
                'content' => $newUser
            )
        );
        $context = stream_context_create($opts);
        $header = get_headers($url, 0, $context);
        $_SESSION['header_edit'] = $header[0];
    }

    function login() {
        $credential = $this->getCredential();
        
        $this->postSession($credential);
        if ($this->isAdmin($credential) === 'false') {
            echo ("<script> alert('You must have an Administrator account.'); </script>");
            return redirect('/');
        }
        echo ("<script> alert('You must have an Administrator account.'); </script>");
        $cookie = Cookie::forever('AlcUserId', $credential, 120);
        $_COOKIE['cookieAlc'] = $this->$credential;
        $_SESSION['AlcCookie'] = $this->$credential;
        $this->dispYourUsers();
        $this->getAllUsersInfo();
        return redirect('/user/create');
    }

    /*
    ** Create a user and reflesh the user displayed in the array
    */

    function create() {
        
        $cookie = Cookie::get('AlcUserId');
        $cookie = $_SESSION['AlcCookie'];

        if ($this->alcCookieIsEmpty($cookie) == true)
            return redirect('/');
        $this->getPbxNodeId($cookie);
        $this->pbxPostUser($cookie);
        $this->dispYourUsers();
        $this->getAllUsersInfo();
        $this->dispYourUsers();
        $this->getAllUsersInfo();
        return redirect('/user/create');
    }

    /* 
    ** Log out and delete AlcCoockie
    */

    function deleteSession()
    {
        $credential = $_SESSION['AlcCookie'];
        $url = 'http://' . $_SESSION['server'] . '/api/rest/1.0/sessions';        

        $opts = array(
            'http' => array(
                'method' => "DELETE",
                'header' => "Cookie: AlcUserId=" . $credential . "\r\n"
            )
        );
        $context = stream_context_create($opts);
        $header = get_headers($url, 0, $context);
        print_r($header);
        $_SESSION['AlcCookie'] = "";
        return redirect('/');
    }

    function deleteUser()
    {
        $credential = $_SESSION['AlcCookie'];
        $nodeId = $this->getPbxNodeId($credential);
        $userNumber = $_POST['phoneNumber'];
        $url = 'http://' . $_SESSION['server'] . '/api/rest/1.0/pbxs/' . $nodeId . '/instances/Subscriber/' . $userNumber;        

        $opts = array(
            'http' => array(
                'method' => "DELETE",
                'header' => "Cookie: AlcUserId=" . $credential . "\r\n"
            )
        );
        $context = stream_context_create($opts);
        $header = get_headers($url, 0, $context);
        $_SESSION['header_delete'] = $header[0];
        return redirect('/user/delete');
    }

    function editUser()
    {
        $cookie = $_SESSION['AlcCookie'];

        if ($this->alcCookieIsEmpty($cookie) == true)
            return redirect('/');
        $this->getPbxNodeId($cookie);
        $this->pbxPutUser($cookie);
        $this->dispYourUsers();
        $this->getAllUsersInfo();
        return redirect('/user/edit');
    }
} 

?>