/**
 * Helpers 
 * 
 */

export function hopes_pagination_render( el, params, callback ) { 
  let $wrap = jQuery( el );
  if( $wrap.length <= 0 ) return;

  let args = {
    dataSource: [...Array(params.total).keys()],
    pageSize: params.items_per_page,
    pageNumber: params.current_page,
    autoHidePrevious: true,
    autoHideNext: true,
    callback: ( data, pagination ) => {
      console.log( pagination )
      if( callback ) callback.call( null, { data, pagination } )
    }
  }

  $wrap.empty();
  $wrap.pagination( args )
}