<form class="modifie-form" action="/user/edit" method="post">
    @csrf
    <div class="row">
        <div class="input-field col s6">
            <input class="validate" name="firstName" id="firstName" type="text" aria-required="true" required="" class="validate">
            <label for="firstName" data-error="wrong" data-success="Ok">First Name<span style="color:mediumseagreen"> *</span></label>
        </div>
        <div class="input-field col s6">
            <input class="validate" id="lastName" name="lastName" type="text">
            <label for="lastName" data-error="wrong" data-success="Ok">Last Name<span style="color:mediumseagreen"> *</span></label>
        </div>
    </div>
    <div class="row">
        <div class="input-field col s12">
            <input id="phoneNumber" name="phoneNumber" type="tel">
            <label for="tel" data-error="wrong" data-success="Ok">Phone Number<span style="color:mediumseagreen"> *</span></label>
        </div>
    </div>
    <div class="row">
        <div class="input-field col s12">
            <button href="#" id="buttonEdit" class="btn waves-effect waves-light col s12">Edit</button>
        </div>
    </div>
</form>