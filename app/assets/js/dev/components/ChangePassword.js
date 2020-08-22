import axios from 'axios';
import { id, alert } from '../utils';

const ACTION = '/reset-password-action';

class ChangePassword {
  init() {
    this.form = id('change-password-form');
    if (this.form) {
      this.formSubmitHandler();
    }
  }

  formSubmitHandler() {
    this.form.addEventListener('submit', async (event) => {
      event.preventDefault();
      if (this.isValidData) {
        this.form.password.safe();
        const { data } = await this.resetPassRequestResponse();
        if (data) {
          alert.open();
        } else {
          alert.close();
        }
      } else {
        this.form.password.error();
      }
    });
  }

  async resetPassRequestResponse() {
    return axios.post(ACTION, new FormData(this.form));
  }

  get isValidData() {
    const formData = new FormData(this.form);
    return formData.get('password').length > 6
      && formData.get('password') === formData.get('password_confirm');
  }
}

export default ChangePassword;
