/**
 * Donor 
 * 
 */

;( ( w, $ ) => {
  'use strict';

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

  const causeSearchInputUpdateDataList = () => {
    const causeSearchInput = $( 'input[name=cause-search]' )
    const causeDatalist = $( 'datalist#cause-search' )

    if( causeSearchInput.length <= 0 || causeDatalist.length <= 0 ) return

    causeSearchInput.one( 'input', async e => {
      let causes = await getDataListCauses()
      let dataListOptionHtml = ''
      
      if( ! causes || causes.length <= 0 ) return

      $.each( causes, ( index, item ) => {
        dataListOptionHtml += `<option value="${item.post_title}" />`
      } )

      causeDatalist.html( dataListOptionHtml )
    } )
  }

  /**
   * 
   */
  const donorInit = () => {
    causeSearchInputUpdateDataList()
  }

  /**
   * Browser load completed
   */
  $( w ).load( donorInit )

} )( window, jQuery )

module.exports = {}