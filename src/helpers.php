<?php

use Illuminate\Support\Str;

if (! function_exists('render_template')) {
    /**
     * Render template with Data
     *
     * @param string $template
     * @param array $data
     * @return void
     */
    function render_template($template, array $data)
    {
        $scope = smarty()->createData();
        $scope->assign($data);
        $template_obj = smarty()->createTemplate($template, $scope);

        return $template_obj->fetch();
    }
}

if (! function_exists('hotline_escape')) {
    /**
     * Xóa hết chỉ gửi số để gọi
     *
     * @param string $hotline
     * @return string
     */
    function hotline_escape($hotline)
    {
        if (blank($hotline) || !is_string($hotline)) {
            return null;
        }

        return Str::of($hotline)
            ->replaceMatches('/\s+/', '')
            ->replaceMatches('/[^0-9]/', '')
            ->__toString();
    }
}

if (! function_exists('clean_request')) {
    /**
     * Làm sạch dữ liệu nhận từ form người dùng
     *
     * @param string|array $request
     * @return mixed
     */
    function clean_request($request)
    {
        if (blank($request)) {
            return $request;
        }

        if (is_string($request)) {
            return Str::of($request)
                ->stripTags()
                ->replaceMatches('/[^\w\s.\-\@]/', '')
                ->__toString();
        }

        if (is_array($request)) {
            return collect($request)
                ->map(function ($val) {
                    $value = Str::of($val)
                        ->stripTags()
                        ->replaceMatches('/[^\w\s.\-\@]/', '')
                        ->__toString();

                    return $value;
                })
                ->toArray();
        }

        return;
    }
}
