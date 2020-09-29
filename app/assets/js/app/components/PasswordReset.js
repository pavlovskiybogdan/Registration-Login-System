import BaseComponent from './BaseComponent';
import { id, alert } from '../utils';

export default class PasswordReset extends BaseComponent {
  init() {
    this.form = id('password-reset-form');
    if (this.form) {
      this.formSubmitHandler();
    }
  }

  formSubmitHandler() {
    this.form.addEventListener('submit', async (event) => {
      event.preventDefault();
      return await this.isSuccessPasswordReset()
        ? this.successMessage()
        : this.triggerError();
    });
  }

  triggerError() {
    this.form.email.error();
    alert.close();
  }

  successMessage() {
    this.form.email.safe();
    alert.open();
  }

  async isSuccessPasswordReset() {
    const { data } = await axios.post(this.routes.auth.send, { email: this.form.email.value });
    return Boolean(data);
  }
}
