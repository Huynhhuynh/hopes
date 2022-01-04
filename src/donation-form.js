/**
 * Donation form 
 * 
 */
import {hopes_price_format} from './helpers';
import HopesFieldValidate from './libs/field-validate';

class HopesDonationForm_Default {
  loggedIn = false;
  causeId = 0;
  currentAmount = null;
  currentStep = 0;
  paymentMethod = {};
  donorInfomation = {
    firstName: '',
    lastName: '',
    email: '',
  };

  constructor($form) {
    this.$form = $form;
    this.$amountField = $form.find('input[name=donation-amount]');
    this.loggedIn = parseInt($form.find('input[name=donor-logged-in]').val());
    this.causeId = $form.find('input[name=cause-id]').val();

    this.amountFieldTriggerOnChange();
    this.pickAmountHandle();
    this.nextStepHandle();
  }

  amountFieldTriggerOnChange() {
    this.$amountField.on( 'change', ( e ) => {
      const currentValue = e.target.value;
      this.$amountField.val(hopes_price_format(currentValue))

      // set amount
      this.currentAmount = parseFloat(currentValue);
    } )
  }

  pickAmountHandle() {
    const self = this;
    let customEventChange = new CustomEvent('change');

    this.$form.on('change', 'input[name=donation-amount-select]', e => {
      const value = e.target.value
      if( value == 'custom-amount' ) {
        self.$amountField.val( hopes_price_format ( '' ) ).focus()
      } else {
        self.$amountField.val(value).trigger('change');
        self.$amountField[0].dispatchEvent(customEventChange);
      }
    })
  }

  stepValidate() {
    const self = this;
    return [
      // Step 1 (donor infomation)
      () => { 
        let pass = [];
        self.$form.find('.hopes-form--first-step *[data-validate]')
          .each((index, field) => {
            const _pass = HopesFieldValidate(field);
            if(_pass != true) {
              pass.push(_pass);
            }
          })

        return pass.length ? pass : true;
      },
      // Step 2 (select payment method)
      () => {

      }
    ]
  }

  activeStepHandle() {
    let activeStep = this.currentStep;
    this.$form
      .find(`.hopes-form--step-${activeStep}`)
      .addClass('hopes-form__step--active')
      .siblings()
      .removeClass('hopes-form__step--active');
  }

  nextStepHandle() {
    const self = this;
    const $nextStepButton = this.$form.find('.donation-button-continue');
    
    $nextStepButton.on('click', (e) => {
      e.preventDefault();
      const pass = self.stepValidate()[self.currentStep].call();
      if(pass == true) {
        self.currentStep += 1;
        self.activeStepHandle();
      }
    })
  }
}

;((w, $) => {
  'use strict';
  w.donationFormsAvailable = [];

  $(() => {
    $('form.donation-form.donation-form__default-handle').each((index, form) => {
      const donationForm = new HopesDonationForm_Default( $( form ) );
      w.donationFormsAvailable.push( donationForm );
    })
  })

})(window, jQuery)

module.exports = {}