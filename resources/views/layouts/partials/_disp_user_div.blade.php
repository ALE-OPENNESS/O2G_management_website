<div id="login-page">
    <div class="card-title" id="div_names">
        <div class="row">
            <div class='input-field col s3'><b>User</div>
            <div class='input-field col s3'>Firstname</div>
            <div class='input-field col s3'>Lastname</div>
            <div class='input-field col s3'>Type</b></div>
        </div>
    </div>
    <div class="card-users-disp" id="div_users">
        <form class="login-form" method="post">
            @csrf
            <?php
                foreach ($_SESSION['users'] as $key => $value)
                    if (!($key == 0))
                        foreach ($_SESSION['usersInfo'][$value] as $key1 => $value1)
                            echo "<div class='row'> <div class='input-field col s3'>" . $value . " " . "</div> <div class='input-field col s3'>" . explode('"', $_SESSION['usersInfo'][$value][$value][1])[3] . " </div> <div class='input-field col s3'>" . explode('"', $_SESSION['usersInfo'][$value][$value][2])[3] . " " . "</div> <div class='input-field col s3'>" . explode('"', $_SESSION['usersInfo'][$value][$value][4])[5] . '</div><div class="row"></div>';
            ?>
        </form>
    </div>
</div>