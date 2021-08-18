/**
 * Donor 
 * 
 */

;( ( w, $ ) => {
  'use strict';

  const doFragments = ( data = {} ) => { 
    $.each( data, ( selector, content ) => {
      if( $( selector ).length > 0 )
        $( selector ).html( content )
    } )
  }

  const getDataListCauses = async () => {
    const res = await $.ajax( {
      type: 'POST',
      url: wp.ajax.settings.url,
      data: {
        action: 'hopes_ajax_get_all_causes',
      },
      error: ( err ) => {
        console.log( err )
      }
    } )

    return res.result
  }

  const pushCauseOptions = async () => {
    let causes = await getDataListCauses()
      let dataListOptionHtml = ''
      
      if( ! causes || causes.length <= 0 ) return

      $.each( causes, ( index, item ) => {
        dataListOptionHtml += `<option value="${item.ID}">${item.post_title}</option>`
      } )

      $( 'select[name=cause-id]' ).append( dataListOptionHtml )
  }

  const getDonation = async ( params ) => {
    const result = await $.ajax( {
      type: 'POST',
      url: wp.ajax.settings.url,
      data: {
        action: 'hopes_ajax_query_donations',
        params
      } 
    } )

    console.log( result )
    if( result.success == true ) {
      doFragments( result.fragments );
    } else {
      alert( 'Internal error: Please refresh and try againt.' )
    }
    
  }

  const donorDonationFilterHandle = () => {
    let fields = $( 'input, select', '.donor-donation-table-entry' )

    const getDataSearch = () => {
      let s = {}
      fields.each( ( index, field ) => {
        let $field = $( field )
        if( $field.attr( 'name' ) && $field.val() )
          s[$field.attr( 'name' )] = $field.val()
      } )

      return s
    }

    fields.on( 'change', async e => {
      // console.log( getDataSearch() )
      getDonation( getDataSearch() )
    } )
  }

  /**
   * 
   */
  const donorInit = () => {
    pushCauseOptions()
    donorDonationFilterHandle()
  }

  /**
   * Browser load completed
   */
  $( w ).load( donorInit )

} )( window, jQuery )

module.exports = {}