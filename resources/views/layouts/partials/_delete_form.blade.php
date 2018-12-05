<form class="delete-form" action="/user/delete" method="post">
    @csrf
    <div class="row">
        <div class="input-field col s12">
            <input id="phoneNumber" name="phoneNumber" type="tel">
            <label for="tel" data-error="wrong" data-success="Ok">Phone Number<span style="color:mediumseagreen"> *</span></label>
        </div>
    </div>
    <div class="row">
        <div class="input-field col s12">
            <button href="#" id="buttonCreate" class="btn waves-effect waves-light col s12">Delete</button>
        </div>
    </div>
</form>