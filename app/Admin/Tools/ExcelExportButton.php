<?php

namespace App\Admin\Tools;

use Encore\Admin\Admin;

class ExcelExportButton
{
    protected string $resource;

    public function __construct(string $resource)
    {
        $this->resource = $resource;
    }

    public function render(): string
    {
        $prefix = config('admin.route.prefix', 'admin');
        $url = url("{$prefix}/excel/export/{$this->resource}");

        // Preserve current query filters in the export URL
        $queryString = http_build_query(request()->except(['_token', '_method', 'page']));
        if ($queryString) {
            $url .= '?' . $queryString;
        }

        return <<<HTML
<a href="{$url}" class="btn btn-sm btn-success" style="margin-right:5px;">
    <i class="fa fa-file-excel-o"></i>&nbsp; Exporter Excel
</a>
HTML;
    }

    public function __toString(): string
    {
        return $this->render();
    }
}
