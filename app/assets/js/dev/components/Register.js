import axios from 'axios';
import { id } from '../utils';
import registerFieldsRules from '../rules';

const COUNTRIES_API_LINK = 'https://restcountries.eu/rest/v2/all';
const ACTION = '/register-action';

class Register {
  init() {
    if (this.map.form.country) {
      this.addCountryOptions();
    }
    if (this.map.form) {
      this.formOnSubmit();
    }
    if (this.map.avatar) {
      this.avatarOnChange();
    }
  }

  avatarOnChange() {
    this.map.avatar.addEventListener('change', () => {
      if (this.map.avatar.files) {
        const reader = new FileReader();
        reader.onload = (e) => this.showImage(e.target.result);
        reader.readAsDataURL(this.map.avatar.files[0]);
      }
    });
  }

  formOnSubmit() {
    this.map.form.addEventListener('submit', async (event) => {
      event.preventDefault();
      if (await this.isValidEmail() && this.validate()) {
        const { status } = await this.sendRegistrationRequest();
        if (status === 200) {
          window.location.href = '/profile';
        }
      }
    });
  }

  async sendRegistrationRequest() {
    return axios.post(ACTION, new FormData(this.map.form), {
      headers: { 'Content-Type': 'multipart/form-data' },
    });
  }

  async isValidEmail() {
    const { data } = await axios.post('/check-user-email', { email: this.map.form.email.value });
    if (data.length === 0) {
      this.map.form.email.safe();
    } else {
      this.map.form.email.nextElementSibling.innerText = 'This email is already been taken';
      this.map.form.email.error();
    }
    return data.length === 0;
  }

  addCountryOptions() {
    fetch(COUNTRIES_API_LINK)
      .then((response) => response.json())
      .then((data) => {
        data.forEach((country) => {
          const option = this.createOption(country.name);
          this.map.form.country.appendChild(option);
        });
      });
  }

  // eslint-disable-next-line class-methods-use-this
  validate() {
    registerFieldsRules.rules.forEach((rule, index) => {
      const errors = [];

      if (
        rule.field.value.length < rule.min
        || rule.field.value.length > rule.max
      ) {
        errors.push(rule.field.nextElementSibling.innerText);
      }

      if (
        rule.field.name === 'password'
        && rule.field.value !== registerFieldsRules.rules[index + 1].field.value
      ) {
        errors.push('Passwords doesn\'t match');
      }

      if (errors.length) {
        rule.field.error();
        // eslint-disable-next-line no-param-reassign,prefer-destructuring
        rule.field.nextElementSibling.innerText = errors[0];
      } else if (rule.field.type === 'text' || rule.field.type === 'password') {
        rule.field.safe();
      }
    });

    return !document.querySelector('.is-invalid');
  }

  // eslint-disable-next-line class-methods-use-this
  createOption(value) {
    const option = document.createElement('option');
    option.innerText = value;
    option.value = value;
    return option;
  }

  showImage(src) {
    this.map.imagePreview.style.display = 'block';
    this.map.imagePreview.querySelector('img').setAttribute('src', src);
  }

  // eslint-disable-next-line class-methods-use-this
  get map() {
    return {
      form: id('register-form'),
      imagePreview: id('image-preview'),
      avatar: id('avatar'),
    };
  }
}

export default Register;
