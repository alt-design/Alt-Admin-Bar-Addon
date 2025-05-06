<?php

declare(strict_types=1);

namespace AltDesign\AltAdminBar\Http\Controllers;

use AltDesign\AltAdminBar\Helpers\Data;
use Illuminate\Http\Request;

class AdminBarController
{
    public function setRevision(
        Request $request,
        Data $data
    ) {
        if (! auth()->user() || ! auth()->user()->isSuper()) {
            return response(403, 'Unauthenticated');
        }

        $validated = $request->validate([
            'collection' => 'required|string',
            'site' => 'required|string',
            'page' => 'required',
            'epoch' => 'sometimes|int',
        ]);

        if ($epoch = ($validated['epoch'] ?? null))
        {
            $epoch = (int) $epoch;
        }

        $data->setRevisionEpoch(
            collection: $validated['collection'],
            siteHandle: $validated['site'],
            pageId: $validated['page'],
            epoch: $epoch,
        );

        return redirect()->back();
    }
}
