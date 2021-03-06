<form action="#" method="post">
    <fieldset>
        <legend>Login Information</legend>
        <div class='form-group'>
            <div class='col-sm-12'>
                <label for="user_login">Username</label>
                <input class="form-control" id="user_login" name="user[login]" required="true" size="30" type="text" />
            </div>
        </div>
        <div class='form-group'>
            <div class='col-sm-6'>
                <label for="user_password">Password</label>
                <input class="form-control" id="user_password" name="user[password]" size="30" type="password" />
            </div>
            <div class='col-sm-6'>
                <label for="user_password_confirmation">Password confirmation</label>
                <input class="form-control" id="user_password_confirmation" name="user[password_confirmation]" size="30" type="password" />
            </div>
        </div>
    </fieldset>
    <fieldset>
        <legend>Personal Information</legend>
        <div class='form-group'>
            <div class='col-sm-4'>
                <label for="user_title">Title</label>
                <input class="form-control" id="user_title" name="user[title]" size="30" type="text" />
            </div>
            <div class='col-sm-4'>
                <label for="user_firstname">First name</label>
                <input class="form-control" id="user_firstname" name="user[firstname]" required="true" size="30" type="text" />
            </div>
            <div class='col-sm-4'>
                <label for="user_lastname">Last name</label>
                <input class="form-control" id="user_lastname" name="user[lastname]" required="true" size="30" type="text" />
            </div>
        </div>
        <div class='form-group'>
            <div class='col-sm-12'>
                <label for="user_email">Email</label>
                <input class="form-control required email" id="user_email" name="user[email]" required="true" size="30" type="text" />
            </div>
        </div>
    </fieldset>
    <fieldset>
        <legend>Options</legend>
        <div class='form-group'>
            <div class='col-sm-12'>
                <label for="user_locale">Language</label>
                <select class="form-control" id="user_locale" name="user[locale]"><option value="de" selected="selected">Deutsch</option>
                    <option value="en">English</option></select>
            </div>
        </div>
    </fieldset>
</form>