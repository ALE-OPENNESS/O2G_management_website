<form class="login-form" action="/user/create" method="post">
                @csrf
                <div class="row">
                    <div class="input-field col s6">
                        <input id="costName" type="text" name="costName" disabled value="<?php echo $_SESSION['username']; ?>">
                        <label for="costName">Cost Center Name</label>
                    </div>
                    <div class="input-field col s6">
                        <input id="costId" type="number" name="costId">
                        <label for="costId">Cost Ceneter Id (default : 255)</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s6">
                        <input class="validate" name="firstName" id="firstName" type="text" aria-required="true" class="validate">
                        <label for="firstName" data-error="wrong" data-success="Ok">First Name</label>
                    </div>
                    <div class="input-field col s6">
                        <input class="validate" id="lastName" name="lastName" type="text">
                        <label for="lastName" data-error="wrong" data-success="Ok">Last Name</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s6">
                        <input id="phoneNumber" type="tel" name="phoneNumber">
                        <label for="tel" data-error="wrong" data-success="Ok">Phone Number<span style="color:mediumseagreen"> *</span></label>
                    </div>
                    <div class="input-field col s6">
                        <select class="icons" id="stationType" name="stationType">
                            <option value="1" selected>SIP Extension</option>
                            <option value="3">IP DESKTOP 8068</option>
                            <option value="4">IP DESKTOP 4068</option>
                            <option value="5">IP DESKTOP 8028s</option>
                        </select>
                        <label for="stationType">Station Type</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s6">
                        <h6 style="font-size:11px;"><span style="color:mediumseagreen">* </span>Required fields</h6>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <button href="#" type="submit" name="buttonCreate" id="buttonCreate" class="btn waves-effect waves-light col s12">CREATE</button>
                    </div>
                </div>
            </form>