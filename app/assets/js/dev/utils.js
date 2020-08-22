const states = {
  open: 'opened',
  close: 'closed',
};

const erroredFieldClass = 'is-invalid';

const id = (itemId) => document.getElementById(itemId);

const alert = {
  success: document.querySelector('.alert.alert-success'),
  open() {
    this.success.classList.remove(states.close);
    this.success.classList.add(states.open);
  },
  close() {
    this.success.classList.remove(states.open);
    this.success.classList.add(states.close);
  },
};

const modal = {
  open(el) {
    const overflow = document.createElement('div');
    el.classList.remove('closed');
    overflow.classList.add('overflow');
    document.body.appendChild(overflow);
    overflow.onclick = () => this.overflowOnClick(el, overflow);
  },
  overflowOnClick(el, overflow) {
    el.classList.add('closed');
    overflow.remove();
  },
};

HTMLInputElement.prototype.error = function error() {
  this.classList.add(erroredFieldClass);
};

HTMLInputElement.prototype.safe = function safe() {
  this.classList.remove(erroredFieldClass);
};

export {
  id,
  alert,
  modal,
};
