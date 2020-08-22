import axios from 'axios';
import { id, alert } from '../utils';

const ACTION = '/send-link-action';

class PasswordReset {
  init() {
    this.form = id('password-reset-form');
    if (this.form) {
      this.formSubmitHandler();
    }
  }

  formSubmitHandler() {
    this.form.addEventListener('submit', async (event) => {
      event.preventDefault();
      return await this.sendPasswordResetRequest()
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

  async sendPasswordResetRequest() {
    const { data } = await axios.post(ACTION, { email: this.form.email.value });
    return Boolean(data);
  }
}

export default PasswordReset;