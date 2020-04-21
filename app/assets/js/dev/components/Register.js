import axios from 'axios';
import { register } from "../rules";
import { id } from "../utils";

const COUNTRIES_API_LINK = 'https://restcountries.eu/rest/v2/all';
const ACTION = '/register-action';

class Register {
    init() {
        this.map();
        this.addCountryOptions();

        if (this.selectors.form) {
            this.formOnSubmit();
        }

        if (this.selectors.avatar) {
            this.avatarOnChange();
        }
    }

    map() {
        this.selectors = {
            form: id('register-form'),
            imagePreview: id('image-preview'),
            avatar: id('avatar')
        }
    }

    avatarOnChange() {
        this.selectors.avatar.addEventListener('change', () => {
            if (this.selectors.avatar.files) {
                const reader = new FileReader();
                reader.onload = (e) => this.showImage(e.target.result);
                reader.readAsDataURL(this.selectors.avatar.files[0]);
            }
        })
    }

    formOnSubmit() {
        this.selectors.form.addEventListener('submit', async (e) => {
            e.preventDefault();

            if (await this.isValidEmail() && this.validate()) {
                const { status } = await this.sendRegistrationRequest();
                if (status === 200) {
                    window.location.href = '/profile';
                }
            }
        });
    }

    async sendRegistrationRequest() {
        return await axios.post(ACTION, new FormData(this.selectors.form), {
            headers: { 'Content-Type': 'multipart/form-data' }
        });
    }

    async isValidEmail() {
        const { data } = await axios.post('/check-user-email', { email: this.selectors.form.email.value });

        if (data.length === 0) {
            this.selectors.form.email.safe();
        } else {
            this.selectors.form.email.nextElementSibling.innerText = 'This email is already been taken';
            this.selectors.form.email.error();
        }

        return data.length === 0;
    }

    addCountryOptions() {
        if (this.selectors.form.country) {
            fetch(COUNTRIES_API_LINK)
                .then(response => response.json())
                .then((data) => {
                    data.map((country) => {
                        const option = this.createOption(country.name);
                        this.selectors.form.country.appendChild(option);
                    });
                });
        }
    }

    validate() {
        register.rules.forEach((rule, index) => {
            const errors = [];

            if (
                rule.field.value.length < rule.min
                || rule.field.value.length > rule.max
            ) {
                errors.push(rule.field.nextElementSibling.innerText);
            }

            if (
                rule.field.name === 'password'
                && rule.field.value !== register.rules[index + 1].field.value
            ) {
                errors.push('Passwords doesn\'t match');
            }

            if (errors.length) {
                rule.field.error();
                rule.field.nextElementSibling.innerText = errors[0];
            } else {
                if (rule.field.type === 'text' || rule.field.type === 'password') {
                    rule.field.safe();
                }
            }
        });

        return !Boolean(document.querySelector('.is-invalid'));
    }

    createOption(value) {
        const option = document.createElement('option');
        option.innerText = value;
        option.value = value;
        return option;
    }

    showImage(src) {
        this.selectors.imagePreview.style.display = 'block';
        this.selectors.imagePreview.querySelector('img').setAttribute('src', src);
    }
}

export default Register;