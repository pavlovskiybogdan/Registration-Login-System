import BaseComponent from '../lib/BaseComponent';
import routes from '../config/routes.config';

class Register extends BaseComponent {
  init() {
    if (this.map.country) {
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
        reader.onload = (event) => this.showImage(event.target.result);
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
          window.location.href = routes.auth.profile;
        }
      }
    });
  }

  async sendRegistrationRequest() {
    return axios.post(routes.auth.register, new FormData(this.map.form), {
      headers: { 'Content-Type': 'multipart/form-data' },
    });
  }

  async isValidEmail() {
    const { data } = await axios.post(routes.user.checkEmail, {
      email: this.map.form.email.value,
    });

    if (data.length === 0) {
      this.map.form.email.safe();
    } else {
      this.map.form.email.nextElementSibling.innerText = 'This email is already been taken';
      this.map.form.email.error();
    }

    return data.length === 0;
  }

  addCountryOptions() {
    fetch(routes.api.countries)
      .then((response) => response.json())
      .then((data) => {
        data.forEach((country) => {
          const option = this.createOption(country.name);
          this.map.country.appendChild(option);
        });
      });
  }

  validate() {
    this.fields.forEach((field, index) => {
      const errors = [];

      if (
        field.name === 'password'
        && field.value !== this.fields[index + 1].value
      ) {
        errors.push('Passwords doesn\'t match');
      }

      if (errors.length) {
        field.error();
        // eslint-disable-next-line no-param-reassign,prefer-destructuring
        field.nextElementSibling.innerText = errors[0];
      } else if (field.type === 'text' || field.type === 'password') {
        field.safe();
      }
    });

    return !document.querySelector('.is-invalid');
  }

  createOption(value) {
    const option = document.createElement('option');
    option.innerText = value;
    option.value = value;
    return option;
  }

  showImage(src) {
    this.map.imagePreview.style.display = 'block';
    this.map.imagePreview.firstElementChild.setAttribute('src', src);
  }

  get map() {
    return {
      form: this.findById('register-form'),
      country: this.findById('country'),
      imagePreview: this.findById('image-preview'),
      avatar: this.findById('avatar'),
    };
  }

  get fields() {
    return [
      this.findById('firstname'),
      this.findById('lastname'),
      this.findById('email'),
      this.findById('password'),
      this.findById('password_confirm'),
    ];
  }
}

export default Register;
