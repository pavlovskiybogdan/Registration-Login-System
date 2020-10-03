import BaseComponent from '../lib/BaseComponent';
import routes from '../config/routes.config';

class Auth extends BaseComponent {
  init() {
    this.form = this.findById('login-form');
    if (this.form) {
      this.formSubmitHandler();
    }
  }

  formSubmitHandler() {
    this.form.addEventListener('submit', async (event) => {
      event.preventDefault();
      const { data } = await axios.post(routes.auth.login, new FormData(this.form));
      if (data) {
        window.location.href = routes.auth.profile;
      } else {
        this.form.email.error();
      }
    });
  }
}

export default Auth;
