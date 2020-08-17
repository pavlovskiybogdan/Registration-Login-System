import axios from 'axios';
import { id } from '../utils';

const ACTION = '/login-action';

class Auth {
  init() {
    this.form = id('login-form');
    if (this.form) {
      this.formSubmitHandler();
    }
  }
  formSubmitHandler() {
    this.form.addEventListener('submit', async (event) => {
      event.preventDefault();
      const { data } = await axios.post(ACTION, new FormData(this.form));
      data ? window.location.href = '/profile' : this.form.email.error();
    });
  }
}

export default Auth;