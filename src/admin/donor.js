/**
 * Donor 
 * 
 */
import { hopes_pagination_render } from '../helpers';

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

  const paginationHandle = ( { data, pagination } ) => {
    let args = getDataSearch();
    args.paged = pagination.pageNumber
    getDonation( args )
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

    if( result.success == true ) {
      doFragments( result.fragments );
      
      // Add pagination 
      if( result.pagination_params ) {
        hopes_pagination_render( 
          result.pagination_params.element_target, 
          result.pagination_params, 
          paginationHandle );
      }
    } else {
      alert( 'Internal error: Please refresh and try againt.' )
    }   
  }

  const getDataSearch = () => {
    let fields = $( 'input, select', '.donor-donation-table-entry' );
    let s = {}
    fields.each( ( index, field ) => {
      let $field = $( field )
      if( $field.attr( 'name' ) && $field.val() )
        s[$field.attr( 'name' )] = $field.val()
    } )
    return s
  }

  const donorDonationFilterHandle = () => {
    let fields = $( 'input, select', '.donor-donation-table-entry' );
    fields.on( 'change', async e => {
      let args = getDataSearch();
      args.pagination = true;
      getDonation( args )
    } )
  }

  const getDonationInit = () => {
    let args = getDataSearch();
    args.pagination = true;
    getDonation( args )
  }

  /**
   * Donor Init
   */
  const donorInit = () => {
    pushCauseOptions()
    getDonationInit()
    donorDonationFilterHandle()
  }

  /**
   * Browser load completed
   */
  $( w ).load( donorInit )
} )( window, jQuery )

module.exports = {}