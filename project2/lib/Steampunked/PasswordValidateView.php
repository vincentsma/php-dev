<?php
/**
 * Created by PhpStorm.
 * User: Vincent
 * Date: 4/11/16
 * Time: 18:10
 */

namespace Steampunked;


class PasswordValidateView extends View {

    public function __construct($site, $get) {
        $this->site = $site;

        $this->setTitle("Sign Up");

        $this->validator = strip_tags($get['v']);

        $this->errorcode = null;

        if (isset($get['e'])) {
            $this->errorcode = intval(strip_tags($get['e']));
        }
    }

    public function present() {
        $html =<<<HTML
<form method="post" action="post/password-validate.php">

HTML;
        if ($this->errorcode == 1) {
            $html .= '<p style="color:red; text-align: center;">Email entered is invalid</p>';
        } elseif ($this->errorcode == 2) {
            $html .= '<p style="color:red; text-align: center;">Passwords do not match</p>';
        } elseif ($this->errorcode == 3) {
            $html .= '<p style="color:red; text-align: center;">Password too short</p>';
        }

        $html .=<<<HTML
    <input type="hidden" name="validator" value="$this->validator">
	<fieldset>
		<legend>Change Password</legend>
		<p>
			<label for="email">Email</label><br>
			<input type="email" id="email" name="email" placeholder="Email">
		</p>
		<p>
			<label for="password">Password:</label><br>
			<input type="password" id="password" name="password" placeholder="Password">
		</p>
		<p>
			<label for="password2">Password (again):</label><br>
			<input type="password" id="password2" name="password2" placeholder="password">
		</p>
		<p>
			<input class="button2" type="submit" name="submit" value="OK"> <input class="button2" type="submit" name="submit" value="Cancel">
		</p>

	</fieldset>
</form>
HTML;

        return $html;
    }

    private $site;
    private $errorcode;
    private $validator;
}