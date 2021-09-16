export default function HopesFieldValidate( $field ) {
  const value = $field.val();
  const validateTypes = $field.data( 'validate' ).split( ',' );
  
  let invalit = []

  const validateEmail = ( email ) => {
    const re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
  }
  
  validateTypes.forEach( type => {
    switch( type ) {
      case 'not-empty':
        if( ! value.trim() ) {
          invalit.push( {
            type,
            message: 'This field is required.'
          } )
        }
        break;

      case 'number':
        if( typeof (value - 0) !== 'number' ) {
          invalit.push( {
            type,
            message: 'This field is number format.'
          } );
        }
        break;
      
      case 'email':
        if( ! validateEmail( value ) ) {
          invalit.push( {
            type,
            message: 'This field is email format.'
          } );
        }
        break;

      default:
        pass = true;
    }
  } );

  return invalit.length ? {
    pass: false,
    field: $field,
    invalit
  } : true;
}