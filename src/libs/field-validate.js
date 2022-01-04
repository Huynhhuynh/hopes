export default function HopesFieldValidate(field) {
  const value = field.value;
  const validateTypes = field.dataset.validate.split( ',' );
  
  let invalid = [];
  let actions = {};

  let wrapper = document.createElement('DIV');
  wrapper.classList.add('hopes-validate-field');
  field.parentNode.insertBefore(wrapper, field);
  wrapper.appendChild(field);

  const validateEmail = ( email ) => {
    const re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
  }
  
  validateTypes.forEach( type => {
    switch( type ) {
      case 'not-empty':
        if( ! value.trim() ) {
          invalid.push( {
            type,
            message: 'This field is required.'
          } )
        }
        break;

      case 'number':
        if( typeof (value - 0) !== 'number' ) {
          invalid.push( {
            type,
            message: 'This field is number format.'
          } );
        }
        break;
      
      case 'email':
        if( ! validateEmail( value ) ) {
          invalid.push( {
            type,
            message: 'This field is email format.'
          } );
        }
        break;

      default:
        pass = true;
    }
  } );

  actions.isInvalid = () => {
    return invalid.length ? true : false;
  }

  if(actions.isInvalid()) {
    wrapper.classList.add('__invalid')
  } else {
    wrapper.classList.remove('__invalid')
  }

  field.addEventListener('change', e => { 
    wrapper.classList.remove('__invalid');
  })

  let isInvalid = ((invalid.length > 0) ? true : false);
  return isInvalid ? {
    pass: false,
    field,
    wrapper,
    invalid,
    actions
    } : true;
}