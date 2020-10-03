import BaseComponent from '../lib/BaseComponent';
import routes from '../config/routes.config';

class PasswordReset extends BaseComponent {
  init() {
    this.form = this.findById('password-reset-form');
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
    this.closeAlert();
  }

  successMessage() {
    this.form.email.safe();
    this.openAlert();
  }

  async isSuccessPasswordReset() {
    const { data } = await axios.post(routes.auth.send, { email: this.form.email.value });
    return Boolean(data);
  }
}

export default PasswordReset;
