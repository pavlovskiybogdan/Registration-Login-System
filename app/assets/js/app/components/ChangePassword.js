import BaseComponent from '../lib/BaseComponent';
import routes from '../config/routes.config';

class ChangePassword extends BaseComponent {
  init() {
    this.form = this.findById('change-password-form');
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
          this.openAlert();
        } else {
          this.closeAlert();
        }
      } else {
        this.form.password.error();
      }
    });
  }

  async resetPassRequestResponse() {
    return axios.post(routes.auth.reset, new FormData(this.form));
  }

  get isValidData() {
    const formData = new FormData(this.form);
    return (formData.get('password').length > 6
      && formData.get('password') === formData.get('password_confirm'));
  }
}

export default ChangePassword;
