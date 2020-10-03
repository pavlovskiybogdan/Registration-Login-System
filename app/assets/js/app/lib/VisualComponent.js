class VisualComponent {
  constructor() {
    this.addTriggersToInput();
  }

  findById(id) {
    return document.getElementById(id);
  }

  openAlert() {
    this.alertElement.classList.remove(this.states.close);
    this.alertElement.classList.add(this.states.open);
  }

  closeAlert() {
    this.alertElement.classList.remove(this.states.open);
    this.alertElement.classList.add(this.states.close);
  }

  openModal(element) {
    const overflow = document.createElement('div');
    element.classList.remove('closed');
    overflow.classList.add('overflow');
    document.body.appendChild(overflow);
    overflow.onclick = () => {
      element.classList.add('closed');
      overflow.remove();
    };
  }

  addTriggersToInput() {
    HTMLInputElement.prototype.error = function error() {
      this.classList.add('is-invalid');
    };

    HTMLInputElement.prototype.safe = function safe() {
      this.classList.remove('is-invalid');
    };
  }

  get states() {
    return {
      open: 'opened',
      close: 'closed',
    };
  }

  get alertElement() {
    return document.querySelector('.alert.alert-success');
  }

  get languageOptions() {
    return document.querySelectorAll('.choose-language-block ul li');
  }
}

export default VisualComponent;
