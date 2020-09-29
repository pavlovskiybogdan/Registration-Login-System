import BaseComponent from './BaseComponent';
import { id } from '../utils';

class Auth extends BaseComponent {
  init() {
    this.form = id('login-form');
    if (this.form) {
      this.formSubmitHandler();
    }
  }

  formSubmitHandler() {
    this.form.addEventListener('submit', async (event) => {
      event.preventDefault();
      const { data } = await axios.post(this.routes.auth.login, new FormData(this.form));
      if (data) {
        window.location.href = this.routes.auth.profile;
      } else {
        this.form.email.error();
      }
    });
  }
}

export default Auth;
