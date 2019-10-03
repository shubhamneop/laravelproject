<?php

namespace App\Traits;
use Illuminate\Http\Request;

/**
 * storing image
 */
trait StoreImageTrait {

  public function verifyAndStoreImage( Request $request, $fieldname = 'image', $directory = 'unknown' ) {

    if( $request->hasFile($fieldname ) ) {

        if (!$request->file($fieldname)->isValid()) {

            flash('Invalid Image!')->error()->important();

            return redirect()->back()->withInput();

        }
          

        return $request->file($fieldname)->store($directory, 'public');

    }

    return null;

}


}
